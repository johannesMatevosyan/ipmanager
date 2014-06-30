<?php

/** 
 * This is the model class for table "stbl_partners". 
 * 
 * The followings are the available columns in table 'stbl_partners': 
 * @property integer $IdPartner
 * @property string $name
 * @property string $path
 * @property string $link
 * @property string $date
 */ 
class PartnersModel extends CActiveRecord
{ 
    /** 
     * Returns the static model of the specified AR class. 
     * @param string $className active record class name. 
     * @return PartnersModel the static model class 
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
        return 'stbl_partners'; 
    } 

    /** 
     * @return array validation rules for model attributes. 
     */ 
    public function rules() 
    { 
        // NOTE: you should only define rules for those attributes that 
        // will receive user inputs. 
        return array( 
            array('name', 'unique'),
            array('name', 'required'),
            array('path', 'required', 'message'=>'Choose Partner Banner cannot be blank'),
            array('link', 'url', 'defaultScheme' => 'http://, https://'),
            array('name, path, link', 'length', 'max'=>255),
            // The following rule is used by search(). 
            // Please remove those attributes that should not be searched. 
            array('IdPartner, name, aprove, path, link, date', 'safe', 'on'=>'search'), 
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
            'IdPartner' => 'Id Partner',
            'name' => 'Partner Name',
            'path' => '',
            'link' => 'Url to Partner Site',
            'date' => 'Date',
            'aprove' => 'Aprove',
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

        $criteria->compare('IdPartner',$this->IdPartner);
        $criteria->compare('name',$this->name,true);
        $criteria->compare('path',$this->path,true);
        $criteria->compare('link',$this->link,true);
        $criteria->compare('date',$this->date,true);
        $criteria->compare('aprove',$this->aprove,true);

        return new CActiveDataProvider($this, array( 
            'criteria'=>$criteria, 
        )); 
    } 
}