<?php

/**
 * This is the model class for table "{{barinfo}}".
 *
 * The followings are the available columns in table '{{barinfo}}':
 * @property integer $id
 * @property string $name
 * @property integer $area_id
 * @property string $category
 * @property string $image
 * @property string $address
 * @property string $description
 * @property string $daysOpen
 * @property string $budget
 * @property string $entranceFee
 * @property string $popular
 * @property integer $maleCount
 * @property integer $femaleCount
 * @property string $contactNumber
 * @property string $mapUrl
 * @property string $lastUpdate
 * @property integer $deleted
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
			array('name, maleCount, femaleCount,lastUpdate', 'required'),
			array('area_id, maleCount, femaleCount, deleted', 'numerical', 'integerOnly'=>true),
			array('name, category, image, address, daysOpen, budget, entranceFee, popular, mapUrl', 'length', 'max'=>128),
			array('description', 'length', 'max'=>200),
			array('contactNumber', 'length', 'max'=>15),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, area_id, category, image, address, description, daysOpen, budget, entranceFee, popular, maleCount, femaleCount, contactNumber, mapUrl, lastUpdate, deleted', 'safe', 'on'=>'search'),
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
			'category' => 'Category',
			'image' => 'Image',
			'address' => 'Address',
			'description' => 'Description',
			'daysOpen' => 'Days Open',
			'budget' => 'Budget',
			'entranceFee' => 'Entrance Fee',
			'popular' => 'Popular',
			'maleCount' => 'Male Count',
			'femaleCount' => 'Female Count',
			'contactNumber' => 'Contact Number',
			'mapUrl' => 'Map Url',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('area_id',$this->area_id);
		$criteria->compare('category',$this->category,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('daysOpen',$this->daysOpen,true);
		$criteria->compare('budget',$this->budget,true);
		$criteria->compare('entranceFee',$this->entranceFee,true);
		$criteria->compare('popular',$this->popular,true);
		$criteria->compare('maleCount',$this->maleCount);
		$criteria->compare('femaleCount',$this->femaleCount);
		$criteria->compare('contactNumber',$this->contactNumber,true);
		$criteria->compare('mapUrl',$this->mapUrl,true);
		$criteria->compare('lastUpdate',$this->lastUpdate,true);
		$criteria->compare('deleted',$this->deleted);

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
