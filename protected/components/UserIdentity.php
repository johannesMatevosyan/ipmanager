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
            
            $this->setState( 'FName', $user->userFName);
            $this->setState( 'LName', $user->userLName);
            $this->setState( 'Phone', $user->userPhone);
            $this->setState( 'RegDate', $user->userRegDate);            
 
            $this->errorCode = self::ERROR_NONE;
        }
       return !$this->errorCode;
    }
 
    public function getId(){
        return $this->_id;
    }
}