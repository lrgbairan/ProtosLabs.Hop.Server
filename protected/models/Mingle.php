<?php

/**
 * This is the model class for table "{{mingle}}".
 *
 * The followings are the available columns in table '{{mingle}}':
 * @property integer $id
 * @property integer $user_id
 * @property integer $receiver_id
 * @property integer $user_token
 * @property integer $receiver_token
 * @property integer $seen
 * @property string $lastUpdate
 * @property integer $deleted
 */
class Mingle extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{mingle}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, receiver_id', 'required'),
			array('user_id, receiver_id, user_token, receiver_token, seen, deleted', 'numerical', 'integerOnly'=>true),
			array('lastUpdate', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, receiver_id, user_token, receiver_token, seen, lastUpdate, deleted', 'safe', 'on'=>'search'),

			array('lastUpdate','default',
              	  'value'=>new CDbExpression('NOW()'),
              	  'setOnEmpty'=>false,'on'=>'update'),
			array('lastUpdate','default',
              	  'value'=>new CDbExpression('NOW()'),
              	  'setOnEmpty'=>false,'on'=>'insert'),
			array('deleted','default',
              	  'value'=>'0',
              	  'setOnEmpty'=>false,'on'=>'insert'),
			array('user_token','default',
              	  'value'=> 0,
              	  'setOnEmpty'=>false,'on'=>'insert'),
			array('receiver_token','default',
              	  'value'=> 0,
              	  'setOnEmpty'=>false,'on'=>'insert'),
			array('seen','default',
              	  'value'=> 0,
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
			'receiver_id' => 'Receiver',
			'user_token' => 'User Token',
			'receiver_token' => 'Receiver Token',
			'seen' => 'Seen',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('receiver_id',$this->receiver_id);
		$criteria->compare('user_token',$this->user_token);
		$criteria->compare('receiver_token',$this->receiver_token);
		$criteria->compare('seen',$this->seen);
		$criteria->compare('lastUpdate',$this->lastUpdate,true);
		$criteria->compare('deleted',$this->deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Mingle the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
