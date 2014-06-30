<?php

class Articles extends CActiveRecord
{

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'stbl_articles';
	}

	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('articleCategory, articleActive', 'numerical', 'integerOnly'=>true),
			array('articleName, articleAlias', 'length', 'max'=>255),
			array('articleName, articleCategory', 'required'),
			array('articleImageName, articleImagePath, articleText, articleDesc, articleCreateDate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('IdArticles, articleName, articleAlias, articleCategory, articleImageName, articleImagePath, articleText, articleDesc, articleActive, articleCreateDate', 'safe', 'on'=>'search'),
		);
	}

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
			'IdArticles' => 'Id Articles',
			'articleName' => 'Имя',
			'articleAlias' => 'Алиас',
			'articleCategory' => 'Категория',
			'articleImageName' => 'Имя картинки',
			'articleImagePath' => 'Путь картинки',
			'articleText' => 'Текст',
			'articleDesc' => 'Описание',
			'articleActive' => 'Видимость',
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('IdArticles',$this->IdArticles);
		$criteria->compare('articleName',$this->articleName,true);
		$criteria->compare('articleAlias',$this->articleAlias,true);
		$criteria->compare('articleCategory',$this->articleCategory);
		$criteria->compare('articleImageName',$this->articleImageName,true);
		$criteria->compare('articleImagePath',$this->articleImagePath,true);
		$criteria->compare('articleText',$this->articleText,true);
		$criteria->compare('articleDesc',$this->articleDesc,true);
		$criteria->compare('articleActive',$this->articleActive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}