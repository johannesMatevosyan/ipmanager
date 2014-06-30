<?php

/**
 * This is the model class for table "stbl_pages".
 *
 * The followings are the available columns in table 'stbl_pages':
 * @property integer $Id
 * @property string $PageLink
 * @property string $metaKey
 * @property string $metaDesc
 */
class Pages extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Pages the static model class
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
		return 'stbl_pages';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('metaKey, metaDesc, PageContent, PageName, PageTitle', 'required'),
			array('metaKey, metaDesc', 'length', 'max'=>100),
		    array('Id, PageLink, PageContent, metaKey, PageName, PageTitle, metaDesc', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, PageLink, PageName, metaKey, PageTitle, metaDesc', 'safe', 'on'=>'search'),
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
			'PageLink' => 'Page Link',
			'metaKey' => 'Мета Ключи',
			'metaDesc' => 'Мета Описание',
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
		$criteria->compare('PageLink',$this->PageLink,true);
		$criteria->compare('metaKey',$this->metaKey,true);
		$criteria->compare('metaDesc',$this->metaDesc,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}