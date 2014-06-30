<?php

class ContactModel extends CActiveRecord
{
    public $verifyCode;
    public function tableName()
    {
        return 'tbl_contacts';
    }

    public function rules()
    {
        return array(
            array('first_name, email, message', 'required'),
            array('email', 'email'),      
            array
            (
                'verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()
            )
                      // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
           
        );
    }

    public function relations()
    {
        return array(
        );
    }

    public function attributeLabels()
    {
        return array(
            'Id'         => 'Id',
            'first_name' => 'First Name',
            'last_name'  => 'Last Name',
            'email'      => 'E-Mail',
            'phone'      => 'Phone',
            'company'    => 'Company',
            'message'    => 'Message',
        );
    }

    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('Id',$this->Id,true);
        $criteria->compare('first_name',$this->first_name,true);
        $criteria->compare('last_name',$this->last_name,true);
        $criteria->compare('email',$this->email,true);
        $criteria->compare('company',$this->company,true);
        $criteria->compare('message',$this->message,true);


        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}