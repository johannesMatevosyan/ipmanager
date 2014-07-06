<?php

class UserIdentity extends CUserIdentity {
    protected $_id;

    public function authenticate(){
        // Производим стандартную аутентификацию, описанную в руководстве.
        $user = Users::model()->find(' userEmail = ?', array($this->username));
        if(($user===null) || ($this->password!==$user->userPassword)) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } else {
            $this->_id = $user->IdUsers;
            $this->username = $user->userEmail;
            
            Yii::app()->user->setState('FName', $user->userFName);
            Yii::app()->user->setState('LName', $user->userLName);
            Yii::app()->user->setState('Phone', $user->userPhone);
            Yii::app()->user->setState('RegDate', $user->userRegDate);            
            Yii::app()->user->setState('role', $user->userRole);            
 
            $this->errorCode = self::ERROR_NONE;
        }
       return !$this->errorCode;
    }
 
    public function getId(){
        return $this->_id;
    }
}