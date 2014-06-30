<?php

/**
 * This is the model class for table "tbl_orders".
 *
 * The followings are the available columns in table 'tbl_orders':
 * @property integer $Id
 * @property string $fullname
 * @property string $place
 * @property string $oggrn
 * @property string $inn
 * @property string $fio
 * @property string $phone
 * @property string $info
 * @property string $mainfile_path
 * @property string $file_path
 * @property integer $payment_method
 */
class OrderModel extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return OrderModel the static model class
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
		return 'tbl_orders';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('osnastka_id', 'required', 'message'=>'Выберите печать'),
			array('pechat_id', 'required', 'message'=>'Выберите оснастку'),
			array('fullname, category_id, fio, payment_method', 'required'),
			array('payment_method, pechat_id, osnastka_id', 'numerical', 'integerOnly'=>true),
			array('fullname, place, oggrn, inn, phone','length', 'max'=>100),
			array('fio', 'length', 'max'=>150),
			array('info', 'length', 'max'=>1000),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, fullname, place, oggrn, inn, fio, phone, info, mainfile_path, file_path, payment_method', 'safe', 'on'=>'search'),
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
			'fullname' => 'Полное наименование юр. лица',
			'place' => 'Местонахождение юр.лица',
			'oggrn' => 'ОГРН',
			'inn' => 'ИНН',
			'fio' => 'Ваше ФИО',
			'phone' => 'Контактный телефон',
			'info' => 'Дополнительная информация',
			'mainfile_path' => 'Прикрепить файл',
			'file_path' => 'Прикрепить дополнительный файл',
			'payment_method' => 'Метод оплаты',
			'osnastka_id'=>'Id Оснастки',
			'pechat_id'=>'Id Печати',
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
		$criteria->compare('fullname',$this->fullname,true);
		$criteria->compare('place',$this->place,true);
		$criteria->compare('oggrn',$this->oggrn,true);
		$criteria->compare('inn',$this->inn,true);
		$criteria->compare('fio',$this->fio,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('info',$this->info,true);
		$criteria->compare('mainfile_path',$this->mainfile_path,true);
		$criteria->compare('file_path',$this->file_path,true);
		$criteria->compare('payment_method',$this->payment_method);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}