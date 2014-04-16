<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	private $_userModel;
	private $_currentBarModel;
	private $_lvlModel;

	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
				
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}
 
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}


	// FOR TERMINAL //
	public function actionEnter()
	{
		if(isset($_GET['rfid']) && isset($_GET['barId'])){
			$barId = array($_GET['barId']);
			$userInfo = $this->loadUserInfoModel(array($_GET['rfid']),'rfidTag');
			if($userInfo === null){
				// if rfid tag not registered to database
			}
			else{
				$lvlModel = $this->loadLvlModel(array($userInfo['lvl_id']));
				if($lvlModel === null){
					
				}	
				else{
					if(($userInfo->stamina + 20) > $lvlModel->maxStamina)
						$userInfo->stamina = (int)$lvlModel->maxStamina;
					else
						$userInfo->stamina += 20;
					
					$userInfo->save();
				}
 				$userCurrentBar = $this->loadUserCurrentBarModel(array($userInfo['id']));
				if($userCurrentBar === null){	
				}
				else{
					$userCurrentBar->updateStatus($userInfo,$_GET['barId']);
				}				
			}
		}		
	}

	public function actionLeave(){

		if(isset($_GET['id'])){
			$userCurrentBar = $this->loadUserCurrentBarModel(array( $_GET['id']));
			$barId = $userCurrentBar['bar_id'];
			if($userCurrentBar === null){
			}
			else{
				$userInfo = $this->loadUserInfoModel(array($userCurrentBar['user_id']), 'id');
				if($userInfo === null){
				// if rfid tag not registered to database
				}
				else{
					$userCurrentBar->updateStatus($userInfo,$barId);
				}				
			}
		}
	}

	public function actionCurrentBar(){

		if(isset($_GET['id'])){
			if($_GET['id'] !== '0'){
				$userCurrentBar = $this->loadUserCurrentBarModel(array($_GET['id']));
				if($userCurrentBar === null){}
				else{
					$criteria=new CDbCriteria;
					$criteria->addInCondition('id',array($userCurrentBar['bar_id']));
					$barInfo = Barinfo::model()->find($criteria);
					if($barInfo === null){
						print(json_encode(array('error'=>'1')));
					}
					else{
						$rows[] = $barInfo->attributes;
						print(json_encode(array('error'=>'0','bar'=>$rows)));	
					}			
				}
			}
			else
				print(json_encode(array('error'=>'1')));
		}	
	}

	public function actionPurchase(){

		if(isset($_GET['id']) && isset($_GET['exp'])){

			$userInfo = $this->loadUserInfoModel(array($_GET['id']), 'id');	
			if($userInfo === null){

			}
			else{
				
				$lvlModel = $this->loadLvlModel(array($userInfo['lvl_id']));
				if($lvlModel === null){
					
				}	
				else{
					if(($userInfo->stamina + 20) > $lvlModel->maxStamina)
						$userInfo->stamina = (int)$lvlModel->maxStamina;
					else
						$userInfo->stamina += 20;

					$currentExp = $userInfo['currentExp'] + $_GET['exp'];
					if($currentExp > $lvlModel['expNeeded']){
						$userInfo['lvl_id'] = $userInfo['lvl_id'] + 1;
						$userInfo['currentExp'] = $userInfo['currentExp'] - $lvlModel['expNeeded'];
						$userInfo->save();
					}
				}		
			}
		}
	}
	
	public function actionBarDetails(){
	
		if(isset($_GET['area_id'])){
			$criteria=new CDbCriteria;
			$criteria->addInCondition('id',array($_GET['area_id']));
		
			$areaModel = Area::model()->find($criteria);
			if($areaModel === null){}
			else{
				$criteria=new CDbCriteria;
				$criteria->addInCondition('area_id',array($areaModel->id));
				$models = Barinfo::model()->findAll($criteria);
			}
			foreach ($models as $model) {
				$rows[] = $model->attributes;
			}
		print(json_encode(array('bar'=>$rows)));	
		}
	}

	public function actionAreaDetails(){

		$models = Area::model()->findAll();
		foreach ($models as $model) {
				$rows[] = $model->attributes;
		}
		print(json_encode(array('area'=>$rows)));
	}

	public function actionLogin(){

		$model = new Userlog;

		if(isset($_GET['username']) && isset($_GET['password'])){

			$model->username = $_GET['username'];
			$model->password = $_GET['password'];

			$user = $model->login();
			if($user === null){
				print(json_encode(array('error'=>'1')));
			}
			else{
				$userInfo = $this->loadUserInfoModel(array($user->id),'log_id');
				$rows1[] = array('username'=>$user->username);
				$rows2[] = array('id'=>$userInfo->id,'stamina'=>$userInfo->stamina, 'image'=>$userInfo->image);
				print(json_encode(array('error'=>'0','userlog'=>$rows1,'userinfo'=>$rows2)));	
			}
		}
	} 

	public function actionSearchProfile(){

		if(isset($_GET['id'])){
			$userInfo = Userinfo::model()->findByPk($_GET['id']);
			if($userInfo === null){
				print(json_encode(array('error'=>'1')));
			}
			else{
				$userLogModel = Userlog::model()->findByPk($userInfo->log_id);
				$lvlModel = Level::model()->findByPk($userInfo->lvl_id);
				$statModel = Status::model()->findByPk($userInfo->status_id);
				$rows[] = array('username'=>$userLogModel->username, 'level'=>$userInfo->lvl_id,
								'title'=>$lvlModel->aliasName,'currentExp'=>$userInfo->currentExp, 'nextLevel'=>$lvlModel->expNeeded,
								'status_id'=>$userInfo->status_id, 'status'=>$statModel->status, 'stamina'=>$userInfo->stamina,
								'gender'=>$userInfo->gender, 'email'=>$userInfo->email, 'image'=>$userInfo->image);
				print(json_encode(array('error'=>'0','data'=>$rows)));
			}			
		}
	}

	public function actionSaveStatus(){

		if(isset($_GET['id']) && isset($_GET['statusId'])){
			$id = $_GET['id'];
			$statusId = $_GET['statusId'];
			$model = $this->loadUserInfoModel(array($_GET['id']),'id');
			$model->updateStatus($statusId);
		}
	}

	public function actionUsers(){

		if(isset($_GET['bar'])){

			$users = Usercurrentbar::model()->findAll('bar_id=?',array($_GET['bar']));
			if(!empty($users)){
				foreach($users as $user){
					$userInfo = Userinfo::model()->findByPk($user->user_id);
					$userLogModel = Userlog::model()->findByPk($userInfo->log_id);
					$rows[] = array('id'=>$userInfo->id,'username'=>$userLogModel->username, 'image'=>$userInfo->image, 'status_id'=>$userInfo->status_id);
				}
				print(json_encode(array('users'=>$rows)));
			}
		}
	}

	public function loadUserInfoModel($id,$column){

		if($this->_userModel === null){

			$criteria=new CDbCriteria;
			$criteria->addInCondition($column,$id);

			$this->_userModel = Userinfo::model()->find($criteria);			

		}
		return $this->_userModel;
	}

	public function loadUserCurrentBarModel($id){

		if($this->_currentBarModel === null){
			$criteria = new CDbCriteria;
			$criteria->addInCondition('user_id',$id);
			$this->_currentBarModel = Usercurrentbar::model()->find($criteria);
		}
		return $this->_currentBarModel;
	}


	public function loadLvlModel($id){

		if($this->_lvlModel === null){
			$criteria = new CDbCriteria;
			$criteria->addInCondition('id',$id);
			$this->_lvlModel = Level::model()->find($criteria); 
		}
		return $this->_lvlModel;
	}


	public function actionRefreshStamina(){
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$model = Userinfo::model()->findByPk($id);
			$lvlModel = Level::model()->findByPk($model->lvl_id);
			if(!empty($model)){
				if(strtotime($model->nextRefresh) < strtotime('now')) {
					$model->nextRefresh = DateTime::createFromFormat('Y-m-d', date('Y-m-d'))->modify('+1 day')->format('Y-m-d');
					$model->stamina = $lvlModel->maxStamina;
					if($model->save()){
						$row[] = array('stamina'=>$model->stamina);
						print(json_encode(array('flag'=>'true','data'=>$row)));
					}
					else
						print(json_encode(array('flag'=>'false')));
				}
				else
					print(json_encode(array('flag'=>'false')));			
			}
		}
	}

	public function actionSearchUsers(){
		if(isset($_GET['searchText'])){
			$searchText = $_GET['searchText'];
			$criteria = new CDbCriteria();
			$criteria->condition("username LIKE :text");
			$criteria->params = array(':text' => trim($searchText) . '%');
			
			//$models = User
				$userInfo = Userinfo::model()->findByPk($user->user_id);
					$userLogModel = Userlog::model()->findByPk($userInfo->log_id);
		}
	}




	// FOR MINGLE //

	public function actionGetMingleRequests(){
		if(isset($_GET['id'])){
			$criteria = new CDbCriteria;
			$criteria->addInCondition('receiver_id',array($_GET['id']));
			$criteria->addInCondition('user_token', array(0));
			$models = Mingle::model()->findAll($criteria);
			if(!empty($models)){
				foreach($models as $model){
					$userInfo = Userinfo::model()->findByPk($model->user_id);
					$userLogModel = Userlog::model()->findByPk($userInfo->log_id);
					$rows[] = array('id'=>$model->id,'user_id'=>$model->user_id, 'username'=>$userLogModel->username);
				}
				print(json_encode(array('error'=>'0','data'=>$rows)));
			}		
			else
				print(json_encode(array('error'=>'1')));
		}
	}

	public function actionSendMingleRequest(){
		if(isset($_GET['user_id']) && isset($_GET['receiver_id'])){
			$criteria = new CDbCriteria();
			$criteria->addInCondition('user_id',array($_GET['user_id']));
			$criteria->addInCondition('receiver_id',array($_GET['receiver_id']));
			$modelMingle = Mingle::model()->find($criteria);

			if($modelMingle !== null){
				print(json_encode(array('flag'=>'false')));
			}
			else{
				$model = new Mingle();
				$model->user_id = $_GET['user_id'];
				$model->receiver_id = $_GET['receiver_id'];
				$model->save();
				print(json_encode(array('flag'=>'true')));
			}
		}
	}

	public function actionConsumeStamina(){
		if(isset($_GET['id']) && isset($_GET['stamina'])){
			$userId = $_GET['id'];
			$stamina = $_GET['stamina'];
			$model = Userinfo::model()->findByPk($userId);
			if($model !== null){
				$model->stamina = (int)$stamina;
				$model->save();
				print(json_encode(array('flag'=>'true')));	
			}
			else
				print(json_encode(array('flag'=>'false')));
		} 
	}

	public function actionCheckMingleAccept(){

		if(isset($_GET['user_id'])){
			$criteria = new CDbCriteria();
			$criteria->addInCondition('user_id',array($_GET['user_id']));
			$models = Mingle::model()->findAll($criteria);
			$flag = false;
			if(!empty($models)){
				foreach($models as $model){
					if($model->user_token == 1){
						$flag = true;
						$model->receiver_token = 1;
						$rows[] = array('user_id'=>$model->user_id,'receiver_id'=>$model->receiver_id);
						$model->save();
					}
				}
				if($flag)
					print(json_encode(array('flag'=>'true','data'=>$rows)));
				else
					print(json_encode(array('flag'=>'false')));
			}
			else
				print(json_encode(array('flag'=>'false')));
		}
	}

	public function actionDeleteMingle(){

		$criteria = new CDbCriteria();
		$criteria->addInCondition('user_id',array($_GET['user_id']));
		$criteria->addInCondition('receiver_id',array($_GET['receiver_id']));
		$model = Mingle::model()->find($criteria);

		if(!empty($model)){
			$model->delete();	
			//print(json_encode(array($model->user_id,$model->receiver_id)));		
		}
	}

	public function actionAcceptMingleRequest(){
		if(isset($_GET['id'])){
			$model = Mingle::model()->findByPk($_GET['id']);
			if($model !== null){
				$model->user_token = 1;
				if($model->save())
					print(json_encode(array('flag'=>'true')));
				else
					print(json_encode(array('flag'=>'false')));			
			}
			else
				print(json_encode(array('flag'=>'false')));
		}

	}

	public function actionRandomArea(){
		
		$placeId = rand(1, 4);
		$model = Minglearea::model()->findByPk($placeId);
		$row[] = array('area'=>$model->area);
		print(json_encode(array('data'=>$row)));

	}

	public function actionGetStatus(){
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$model = Status::model()->findByPk($id);
			$row[] = array('status'=>$model->status);
			print(json_encode(array('data'=>$row)));
		}
	}


	// FOR SIGNUP PAGE //

	public function actionCheckUser(){

		if(isset($_GET['username'])){
			$username = $_GET['username'];
			$model = Userlog::model()->find('LOWER(username)=?',array($username));
			if(!empty($model))
				print(json_encode(array('flag'=>'false')));
			else
				print(json_encode(array('flag'=>'true')));
		}
	}

	public function actionCheckRFID(){
		if(isset($_GET['rfid'])){
			$rfid = $_GET['rfid'];
			$model = Userinfo::model()->find('rfidTag=?',array($rfid));
			if(!empty($model))
				print(json_encode(array('flag'=>'false')));
			else
				print(json_encode(array('flag'=>'true')));
		}
	}


	public function actionSaveUser(){

		if(isset($_GET['username']) && isset($_GET['password']) && isset($_GET['gender']) && isset($_GET['RFID']) && isset($_GET['email'])){

			$username = $_GET['username'];
			$password = $_GET['password'];
			$gender   = $_GET['gender'];
			$rfid 	  = $_GET['RFID'];
			$email 	  = $_GET['email'];

			$userInfoModel = new Userinfo();
			$userLogModel = new Userlog();
			$userBarModel = new Usercurrentbar();

			$userLogModel->username = $username;
			$userLogModel->password = $password;
			if($userLogModel->save()){
				$userInfoModel->rfidTag = $rfid;
				$userInfoModel->gender  = $gender;
				$userInfoModel->email   = $email;
				$userInfoModel->log_id  = $userLogModel->id;
				if($userInfoModel->save()){
					$userBarModel->user_id  = $userInfoModel->id;
					if($userBarModel->save())
						print(json_encode(array('flag'=>'true')));
					else
						print(json_encode(array('flag'=>'false')));
				}
				else
					print(json_encode(array('flag'=>'false')));
			}
			else
				print(json_encode(array('flag'=>'false')));
		}

	}


	// FOR SYNC //
	
	public function getModifiedBarInfo(){

		if(isset($_GET['lastSyncDate'])){

			$lastSyncDate = $_GET['lastSyncDate'];
			if(strlen($lastSyncDate)){
    			//$criteria = new CDbCriteria;
 				//$criteria->condition="lastUpdate > " + $lastSyncDate;
 				//$rows[] = Barinfo::model()->findAll($criteria);
   			}
   			print(json_encode(array('data'=>$rows)));
		}
	}

	// build into one function
	public function actionGetModels(){

	}

	public function actionGetAllArea(){
		$models = Area::model()->findAll();
		foreach ($models as $model) {
				$rows[] = $model->attributes;
		}
		print(json_encode(array('data'=>$rows)));
	}
	
	public function actionGetAllLevel(){
		$models = Level::model()->findAll();
		foreach ($models as $model) {
				$rows[] = $model->attributes;
		}
		print(json_encode(array('data'=>$rows)));
	}

	public function actionGetAllStatus(){
		$models = Status::model()->findAll();
		foreach ($models as $model) {
				$rows[] = $model->attributes;
		}
		print(json_encode(array('data'=>$rows)));
	}

	public function actionGetAllBars(){
		$models = Barinfo::model()->findAll();
		foreach ($models as $model) {
				$rows[] = $model->attributes;
		}
		print(json_encode(array('data'=>$rows)));
	}

	public function actionGetAllUsers(){

        $models = Userinfo::model()->with('usercurrentbars')->findAll();
		foreach ($models as $model){
			$userLogModel = Userlog::model()->findByPk($model->log_id);
			$lvlModel 	  = Level::model()->findByPk($model->lvl_id);
			$statModel 	  = Status::model()->findByPk($model->status_id);

			$rows[] = array('id'=>$model->id, 
							'username'=>$userLogModel->username, 
							'level'=>$model->lvl_id,
							'title'=>$lvlModel->aliasName,
							'currentExp'=>$model->currentExp,
							'status'=>$statModel->status,
							'gender'=>$model->gender, 
							'email'=>$model->email, 
							'bar_id'=>$model->usercurrentbars->bar_id,
							'lastUpdate'=>$model->lastUpdate,
							'deleted'=>$model->deleted);
		}
		print(json_encode(array('data'=>$rows)));

	}

	public function actionModifiedUsers(){

		if(isset($_GET['date'])){

			$lastSync = $_GET['date'];
			$criteria = new CDbCriteria();
			$criteria->condition = 't.lastUpdate > :date';
			$criteria->params = array(':date'=>$lastSync);
			$criteria->order = 't.lastUpdate DESC';

			$models = Userinfo::model()->with('usercurrentbars')->findAll($criteria);
			if(!empty($models)){

				foreach($models as $model){
					$userLogModel = Userlog::model()->findByPk($model->log_id);
					$lvlModel = Level::model()->findByPk($model->lvl_id);
					$statModel = Status::model()->findByPk($model->status_id);
					$rows[] = array('id'=>$model->id,'username'=>$userLogModel->username, 'level'=>$model->lvl_id, 'title'=>$lvlModel->aliasName,
								    'currentExp'=>$model->currentExp,'status'=>$statModel->status,'bar_id'=>$model->usercurrentbars->bar_id, 'lastUpdate'=>$model->lastUpdate,'deleted'=>$model->deleted);
				}
				print(json_encode(array('error'=>'0','data'=>$rows)));
			}
			else
				print(json_encode(array('error'=>'1')));	
		}

	}

	public function actionModifiedBars(){

		if(isset($_GET['date'])){

			$lastSync = $_GET['date'];
			$criteria = new CDbCriteria();
			$criteria->select = 't.id, t.name, t.area_id, t.maleCount, t.femaleCount, t.lastUpdate,t.deleted';
			$criteria->condition = 't.lastUpdate > :date';
			$criteria->params = array(':date'=>$lastSync);
			$criteria->order = 't.lastUpdate DESC';

			$models = Barinfo::model()->findAll($criteria);

			if(!empty($models)){
				foreach($models as $model){
					$rows[] = array('id'=>$model->id, 'name'=>$model->name, 'area_id'=>$model->area_id, 'maleCount'=>$model->maleCount, 'femaleCount'=>$model->femaleCount,
								    'lastUpdate'=>$model->lastUpdate,'deleted'=>$model->deleted);
				}
				print(json_encode(array('error'=>'0','data'=>$rows)));
			}	
			else{
				print(json_encode(array('error'=>'1')));
			}
		}
	}

	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}