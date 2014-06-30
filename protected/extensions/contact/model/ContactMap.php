<?php

/**
 * This is the model class for table "tbl_contact_config".
 *
 * The followings are the available columns in table 'tbl_contact_config':
 * @property integer $Id
 * @property double $map_latitude
 * @property double $map_longitude
 * @property string $captcha_color
 * @property string $captcha_back_color
 */
class ContactMap extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ContactConfig the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_contact_map';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('latitude,longitude', 'numerical'),

			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, latitude, longitude,width, height', 'safe', 'on'=>'search'),
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
			'Id' => 'ID',
			'latitude' => 'Map Latitude',
			'longitude' => 'Map Longitude',
			'width' => 'Captcha Color',
			'height' => 'Captcha Back Color',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('Id',$this->Id);
		$criteria->compare('map_latitude',$this->map_latitude);
		$criteria->compare('map_longitude',$this->map_longitude);
		$criteria->compare('captcha_color',$this->captcha_color,true);
		$criteria->compare('captcha_back_color',$this->captcha_back_color,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}