<?php

/**
 * This is the model class for table "{{barinfo}}".
 *
 * The followings are the available columns in table '{{barinfo}}':
 * @property integer $id
 * @property string $name
 * @property integer $area_id
 * @property integer $maleCount
 * @property integer $femaleCount
 * @property string $lastUpdate
 */
class Barinfo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{barinfo}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, maleCount, femaleCount, lastUpdate', 'required'),
			array('area_id, maleCount, femaleCount', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>128),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, area_id, maleCount, femaleCount, lastUpdate', 'safe', 'on'=>'search'),

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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'area_id' => 'Area',
			'maleCount' => 'Male Count',
			'femaleCount' => 'Female Count',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('area_id',$this->area_id);
		$criteria->compare('maleCount',$this->maleCount);
		$criteria->compare('femaleCount',$this->femaleCount);
		$criteria->compare('lastUpdate',$this->lastUpdate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function incCounter($userModel,$barId)
	{

		$criteria=new CDbCriteria;
		$criteria->addInCondition('id',$barId);

		if($userModel['gender'] === 'Male'){
			$this->updateCounters(array('maleCount'=>+1),$criteria);	
		}
		else if($userModel['gender'] === 'Female'){
			$this->updateCounters(array('femaleCount'=>+1),$criteria);
		}
	}

	public function decCounter($userModel,$barId)
	{
		$criteria = new CDbCriteria;
		$criteria->addInCondition('id',$barId);

		if($userModel['gender'] === 'Male'){
			$this->updateCounters(array('maleCount'=>-1),$criteria);	
		}
		else if($userModel['gender'] === 'Female'){
			$this->updateCounters(array('femaleCount'=>-1),$criteria);
		}
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Barinfo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
