<?php

/**
 * This is the model class for table "stbl_gallery".
 *
 * The followings are the available columns in table 'stbl_gallery':
 * @property integer $IdImage
 * @property string $imageName
 * @property string $imagePath
 * @property integer $imageActive
 */
class Gallery extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Gallery the static model class
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
		return 'stbl_gallery';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('imageActive', 'numerical', 'integerOnly'=>true),
			array('imageName, imagePath', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('IdImage, imageName, imagePath, imageActive', 'safe', 'on'=>'search'),
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
			'IdImage' => 'Id Image',
			'imageName' => 'Имя',
			'imagePath' => 'Папка',
			'imageActive' => 'Видимость',
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

		$criteria->compare('IdImage',$this->IdImage);
		$criteria->compare('imageName',$this->imageName,true);
		$criteria->compare('imagePath',$this->imagePath,true);
		$criteria->compare('imageActive',$this->imageActive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}