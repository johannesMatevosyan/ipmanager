<?php

/**
 * This is the model class for table "stbl_ip".
 *
 * The followings are the available columns in table 'stbl_ip':
 * @property integer $Id
 * @property string $ip
 * @property integer $root_subnet
 */
class IpModel extends CActiveRecord
{


	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return IpModel the static model class
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
		return 'stbl_ip';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ip', 'unique'),
			array('ip, root_subnet', 'required'),
			array('root_subnet', 'numerical', 'integerOnly'=>true),
			array('ip', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, ip, root_subnet', 'safe', 'on'=>'search'),
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
			'ip' => 'Ip',
			'root_subnet' => 'Root Subnet',
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
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('root_subnet',$this->root_subnet);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}