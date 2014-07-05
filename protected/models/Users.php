<?php

class Users extends CActiveRecord
{
	public $userPassword_confirm;
	public $userPassword_current;
	public $userPassword_new;
	public $userEmail_confirm;
	public $minUserRegDate;
	public $maxUserRegDate;
        
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                    array('userEmail', 'unique'),
                    array('userFName, userEmail, userPassword, userRole', 'required'),
                    array('userFName, userLName, userEmail, userEmail_confirm, userPassword_current, userPassword, userPassword_confirm', 'length', 'max'=>255),
                    array('userPhone', 'length', 'max'=>150),
                    //array('userPhone', 'match', 'pattern'=>'/^([+]?[0-9 ]+)$/'),
                    array('userEmail, userEmail_confirm', 'email'),
                    // The following rule is used by search().
                    // Please remove those attributes that should not be searched.
                    array('userActiveKey, userPassword_current, userPassword_new, userPhone','safe'),
                    array('IdUsers, userRole, userFName, userLName, userEmail, userPhone, userRegDate, userBallance, userActive, minUserRegDate, maxUserRegDate, userBanned, userLastVisit', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'IdUsers' => 'Id Users',
			'userRole' => 'Role',
			'userFName' => 'Userame',
			'userLName' => 'Фамилия',
			'userEmail' => 'Email',
			'userPhone' => 'Phone',
			'userPassword' => 'Password',
			'userRegDate' => 'Дата регистрации',
			'userBallance' => 'Баланс',
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

		$criteria=new CDbCriteria(array('order'=>'IdUsers DESC'));
                
		$criteria->compare('IdUsers',$this->IdUsers);
		$criteria->compare('userRole',$this->userRole,true);
		$criteria->compare('userFName',$this->userFName,true);
		$criteria->compare('userLName',$this->userLName,true);
		$criteria->compare('userEmail',$this->userEmail,true);
		$criteria->compare('userPhone',$this->userPhone);
		$criteria->compare('userPassword',$this->userPassword,true);
		$criteria->compare('userRegDate',$this->userRegDate,true);
		$criteria->compare('userBallance',$this->userBallance);
                
                if(!empty($this->minUserRegDate))
                {
                    $criteria->addCondition('userRegDate >= :min_reg_date');
                    
                    $criteria->params[':min_reg_date'] = $this->minUserRegDate.' 00:00:00';
                }
                if(!empty($this->maxUserRegDate))
                {                 
                    $criteria->addCondition('userRegDate <= :max_reg_date');
                    
                    $criteria->params[':max_reg_date'] = $this->maxUserRegDate.' 23:59:59';
                }

		return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
                    'pagination'=>array(
                            'pageSize'=>30,
                        ),
		));
	}
}