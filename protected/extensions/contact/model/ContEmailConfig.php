<?php

/**
 * This is the model class for table "cont_email_config".
 *
 * The followings are the available columns in table 'cont_email_config':
 * @property integer $Id
 * @property string $mail_to
 * @property string $mail_subject
 * @property string $mail_message
 */
class ContEmailConfig extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ContEmailConfig the static model class
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
		return 'cont_email_config';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                        array('mail_to, mail_subject, mail_message','required'),
                        array('mail_to','email'),
			array('mail_to, mail_subject', 'length', 'max'=>100),
			array('mail_message', 'length', 'max'=>500),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, mail_to, mail_subject, mail_message', 'safe', 'on'=>'search'),
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
			'mail_to' => 'Mail To',
			'mail_subject' => 'Mail Subject',
			'mail_message' => 'Mail Message',
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
		$criteria->compare('mail_to',$this->mail_to,true);
		$criteria->compare('mail_subject',$this->mail_subject,true);
		$criteria->compare('mail_message',$this->mail_message,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}