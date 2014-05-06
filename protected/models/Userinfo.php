<?php

/**
 * This is the model class for table "{{userinfo}}".
 *
 * The followings are the available columns in table '{{userinfo}}':
 * @property integer $id
 * @property string $rfid
 * @property integer $log_id
 * @property integer $class_id
 * @property integer $lvl_id
 * @property string $gender
 * @property string $email
 * @property integer $currentExp
 * @property integer $status_id
 * @property string $about
 * @property integer $stamina
 * @property string $nextRefresh
 * @property string $image
 * @property string $lastUpdate
 * @property integer $deleted
 *
 * The followings are the available model relations:
 * @property Usercurrentbar[] $usercurrentbars
 */
class Userinfo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{userinfo}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rfid, gender, email', 'required'),
			array('log_id, class_id, lvl_id, currentExp, status_id, stamina, deleted', 'numerical', 'integerOnly'=>true),
			array('rfid', 'length', 'max'=>20),
			array('email', 'length', 'max'=>128),
			array('about', 'length', 'max'=>200),
			array('image', 'length', 'max'=>5000),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, rfid, log_id, class_id, lvl_id, gender, email, currentExp, status_id, about, stamina, nextRefresh, image, lastUpdate, deleted', 'safe', 'on'=>'search'),


			array('lastUpdate','default',
              	  'value'=>new CDbExpression('NOW()'),
              	  'setOnEmpty'=>false,'on'=>'update'),
			array('lastUpdate','default',
              	  'value'=>new CDbExpression('NOW()'),
              	  'setOnEmpty'=>false,'on'=>'insert'),
			array('deleted','default',
              	  'value'=>0,
              	  'setOnEmpty'=>false,'on'=>'insert'),
			array('lvl_id','default',
              	  'value'=>1,
              	  'setOnEmpty'=>false,'on'=>'insert'),
			array('class_id','default',
              	  'value'=>3,
              	  'setOnEmpty'=>false,'on'=>'insert'),
			array('currentExp','default',
              	  'value'=>0,
              	  'setOnEmpty'=>false,'on'=>'insert'),
			array('status_id','default',
              	  'value'=>1,
              	  'setOnEmpty'=>false,'on'=>'insert'),
			array('stamina','default',
              	  'value'=>100,
              	  'setOnEmpty'=>false,'on'=>'insert'),
			array('nextRefresh','default',
              	  'value'=> DateTime::createFromFormat('Y-m-d', date('Y-m-d'))->modify('+1 day')->format('Y-m-d'),
              	  'setOnEmpty'=>false,'on'=>'insert'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'usercurrentbars' => array(self::HAS_MANY, 'Usercurrentbar', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'rfid' => 'Rfid',
			'log_id' => 'Log',
			'class_id' => 'Class',
			'lvl_id' => 'Lvl',
			'gender' => 'Gender',
			'email' => 'Email',
			'currentExp' => 'Current Exp',
			'status_id' => 'Status',
			'about' => 'About',
			'stamina' => 'Stamina',
			'nextRefresh' => 'Next Refresh',
			'image' => 'Image',
			'lastUpdate' => 'Last Update',
			'deleted' => 'Deleted',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('rfid',$this->rfid,true);
		$criteria->compare('log_id',$this->log_id);
		$criteria->compare('class_id',$this->class_id);
		$criteria->compare('lvl_id',$this->lvl_id);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('currentExp',$this->currentExp);
		$criteria->compare('status_id',$this->status_id);
		$criteria->compare('about',$this->about,true);
		$criteria->compare('stamina',$this->stamina);
		$criteria->compare('nextRefresh',$this->nextRefresh,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('lastUpdate',$this->lastUpdate,true);
		$criteria->compare('deleted',$this->deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	public function updateStatus($statusId){

		$date = new DateTime();
	//	$date->getTimestamp();
	//	$date->format('d-m-Y H:i:s a');

		$this->status_id = $statusId;
	//	$this->lastUpdate = $date;
		$this->save();

	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Userinfo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
