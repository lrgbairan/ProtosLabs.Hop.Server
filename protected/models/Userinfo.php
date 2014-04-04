<?php

/**
 * This is the model class for table "{{userinfo}}".
 *
 * The followings are the available columns in table '{{userinfo}}':
 * @property integer $id
 * @property integer $lvl_id
 * @property string $rfidTag
 * @property string $gender
 * @property string $email
 * @property integer $currentExp
 * @property integer $status_id
 * @property string $lastUpdate
 *
 * The followings are the available model relations:
 * @property Usercurrentbar[] $usercurrentbars
 * @property Userlog[] $userlogs
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
			array('lvl_id, rfidTag, gender, email, currentExp, status_id, lastUpdate', 'required'),
			array('lvl_id, currentExp, status_id', 'numerical', 'integerOnly'=>true),
			array('rfidTag, email', 'length', 'max'=>128),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, lvl_id, rfidTag, gender, email, currentExp, status_id, lastUpdate', 'safe', 'on'=>'search'),

			array('lastUpdate','default',
              	  'value'=>new CDbExpression('NOW()'),
              	  'setOnEmpty'=>false,'on'=>'update'),
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
			'usercurrentbars' => array(self::HAS_ONE, 'Usercurrentbar', 'user_id'),
			'userlogs' => array(self::HAS_ONE, 'Userlog', 'user_id'),
			'userlvl' => array(self::HAS_ONE,'Level','id'),
			'userstat' => array(self::HAS_ONE,'Status','id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'lvl_id' => 'Lvl',
			'rfidTag' => 'Rfid Tag',
			'gender' => 'Gender',
			'email' => 'Email',
			'currentExp' => 'Current Exp',
			'status_id' => 'Status',
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
	
	public function updateStatus($statusId){

		$date = new DateTime();
	//	$date->getTimestamp();
	//	$date->format('d-m-Y H:i:s a');

		$this->status_id = $statusId;
	//	$this->lastUpdate = $date;
		$this->save();

	}

	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('lvl_id',$this->lvl_id);
		$criteria->compare('rfidTag',$this->rfidTag,true);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('currentExp',$this->currentExp);
		$criteria->compare('status_id',$this->status_id);
		$criteria->compare('lastUpdate',$this->lastUpdate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
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
