<?php

/**
 * This is the model class for table "{{usercurrentbar}}".
 *
 * The followings are the available columns in table '{{usercurrentbar}}':
 * @property integer $id
 * @property integer $user_id
 * @property integer $bar_id
 * @property integer $entryStatus
 * @property string $lastUpdate
 *
 * The followings are the available model relations:
 * @property Userinfo $user
 */
class Usercurrentbar extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	
	private $_userInfo;
	private $_barId;
	
	public function tableName()
	{
		return '{{usercurrentbar}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, bar_id, entryStatus', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, bar_id, entryStatus, lastUpdate', 'safe', 'on'=>'search'),


			array('lastUpdate','default',
              	  'value'=>new CDbExpression('NOW()'),
              	  'setOnEmpty'=>false,'on'=>'update'),
			array('lastUpdate','default',
              	  'value'=>new CDbExpression('NOW()'),
              	  'setOnEmpty'=>false,'on'=>'insert'),
			array('bar_id','default',
              	  'value'=>0,
              	  'setOnEmpty'=>false,'on'=>'insert'),
			array('entryStatus','default',
              	  'value'=>0,
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
			'user' => array(self::BELONGS_TO, 'Userinfo', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'bar_id' => 'Bar',
			'entryStatus' => 'Entry Status',
			'lastUpdate' => 'Last Update',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('bar_id',$this->bar_id);
		$criteria->compare('entryStatus',$this->entryStatus);
		$criteria->compare('lastUpdate',$this->lastUpdate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function updateStatus($userInfo,$barId){

		$this->_userInfo = $userInfo;
		$this->_barId = $barId;

		if($this->entryStatus === '0' && $barId !== '0'){
			$this->entryStatus = '1';
			$this->bar_id = $barId;
		}
		else if($this->entryStatus === '1'){
			$this->entryStatus = '0';
			$this->bar_id = '0';
		}	
		$this->save();
	}

	
	protected function afterSave()
	{
	    parent::afterSave();

	    if($this->entryStatus === '1')
	   		Barinfo::model()->incCounter($this->_userInfo,array($this->_barId));
	   	else if($this->entryStatus === '0')
	   		Barinfo::model()->decCounter($this->_userInfo,array($this->_barId));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Usercurrentbar the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
