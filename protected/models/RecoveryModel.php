<?php

/**
 * This is the model class for table "tbl_recovery".
 *
 * The followings are the available columns in table 'tbl_recovery':
 * @property integer $Id
 * @property string $mainfile_path
 * @property string $info
 * @property string $phone
 * @property string $email
 * @property string $certificate_path
 * @property string $wishes
 */
class RecoveryModel extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return RecoveryModel the static model class
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
		return 'tbl_recovery';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email', 'required'),
			array('email', 'email'),
			array('mainfile_path,  certificate_path', 'file'),
			array('mainfile_path, phone, email, certificate_path, date', 'length', 'max'=>100),
			array('info, wishes, fio', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, mainfile_path, info, phone, email, certificate_path, wishes', 'safe', 'on'=>'search'),
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
			'fio'=>"ФИО",
			'Id' => 'ID',
			'mainfile_path' => 'Файл Оттисков',
			'info' => '',
			'phone' => 'Номер Телефона',
			'email' => 'Адрес Электронной Почты',
			'certificate_path' => 'Копия Свидетельства',
			'wishes' => 'Ваши Пожелания',
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
		$criteria->compare('mainfile_path',$this->mainfile_path,true);
		$criteria->compare('info',$this->info,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('certificate_path',$this->certificate_path,true);
		$criteria->compare('wishes',$this->wishes,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}