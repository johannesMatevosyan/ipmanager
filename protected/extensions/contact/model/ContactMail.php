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
class ContactMail extends CActiveRecord
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
		return 'tbl_email_config';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('mail_to, mail_subject, mail_message', 'numerical'),
		
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
			'mail_to' => 'Рecipient Mail ',
			'mail_subject' => 'Mail subject',
			'mail_message' => 'Mail message',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */

}