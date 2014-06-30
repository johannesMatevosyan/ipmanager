<?php

class Call extends CFormModel
{
	public $name;
	public $email;
	public $phone;
	public $body;
	public $copy;
	//public $verifyCode;

	public function rules()
	{
		return array(
			// name, email, subject and body are required
			array('name, email, phone, body', 'required'),
			// email has to be a valid email address
			array('email', 'email'),
			array('phone', 'match', 'pattern'=>'/^([+]?[0-9 ]+)$/'),
			array('copy', 'safe'),
			// verifyCode needs to be entered correctly
			//array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
		);
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
			'verifyCode'=>'Verification Code',
		);
	}
}