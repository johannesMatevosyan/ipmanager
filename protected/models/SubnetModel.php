<?php

/**
 * This is the model class for table "stbl_subnet".
 *
 * The followings are the available columns in table 'stbl_subnet':
 * @property integer $Id
 * @property string $ip
 * @property integer $hosts
 * @property string $company
 * @property integer $subnet
 * @property string $website
 * @property integer $vlan_id
 * @property string $comments
 * @property string $purpose
 * @property integer $site_id
 * @property string $site_details
 * @property string $modify_info
 */
class SubnetModel extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SubnetModel the static model class
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
		return 'stbl_subnet';
	}

	public function validSubnet()
	{
       if ( isset($_POST['SubnetModel']['ip'], $_POST['SubnetModel']['subnet'])) {
         
         	$networkInfo = SubnetCalculator::get_network($_POST['SubnetModel']['ip'], SubnetCalculator::getByteMaskBySubnetMask($_POST['SubnetModel']['subnet']));
            $networkId = $networkInfo['network'];
            $broadcastId = $networkInfo['broadcast address'];

            $networkOctets   = explode('.', $networkId);
            $broadcastOctets = explode('.', $broadcastId);
            $networkOctets   = array_map('intval', $networkOctets);
            $broadcastOctets = array_map('intval',  $broadcastOctets);
            
            $networkDigitalValue = $networkOctets[0] * pow(256, 3) + 
                                   $networkOctets[1] * pow(256, 2) + 
                                   $networkOctets[2] * pow(256, 1) + 
                                   $networkOctets[3] * pow(256, 0);

            $broadcastDigitalOctets = $broadcastOctets[0] * pow(256, 3) +
                                      $broadcastOctets[1] * pow(256, 2) + 
                                      $broadcastOctets[2] * pow(256, 1) + 
                                      $broadcastOctets[3] * pow(256, 0);
            if(!isset($_GET['subnetId']))
				$subnet = Yii::app()->db->createCommand('SELECT ip, site_id FROM `stbl_subnet` WHERE (('.$networkDigitalValue.' <= networkId AND '.$broadcastDigitalOctets.' >= broadcastId ) OR ('.$networkDigitalValue.' >= networkId AND '.$networkDigitalValue.' <= broadcastId ) OR ('.$broadcastDigitalOctets.' >= networkId AND '.$broadcastDigitalOctets.' <= broadcastId ))')->queryRow();
			else 	
				$subnet = Yii::app()->db->createCommand('SELECT ip, site_id FROM `stbl_subnet` WHERE ((('.$networkDigitalValue.' <= networkId AND '.$broadcastDigitalOctets.' >= broadcastId ) OR ('.$networkDigitalValue.' >= networkId AND '.$networkDigitalValue.' <= broadcastId ) OR ('.$broadcastDigitalOctets.' >= networkId AND '.$broadcastDigitalOctets.' <= broadcastId )) AND (Id <> '.$_GET['subnetId'].'))')->queryRow();
           if ( $subnet ) {
           		$validationMessage = 'Subnet is not correct for this IP cover - '. $subnet['ip'];
  		   		$this->addError('subnet', $validationMessage );
           }
       }
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('subnet, ip, purpose, site_details, modify_info', 'required'),
			array('subnet, vlan_id, site_id', 'numerical', 'integerOnly'=>true),
			array('ip', 'length', 'max'=>20),
			array('subnet','validSubnet'),
			array('company, website', 'length', 'max'=>120),
			array('purpose', 'length', 'max'=>255),
			array('site_details', 'length', 'max'=>520),
			array('modify_info', 'length', 'max'=>250),
			array('comments', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, ip, hosts, company, subnet, website, vlan_id, comments, purpose, site_id, site_details, modify_info', 'safe', 'on'=>'search'),
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
			'ip' => 'Network Subnet',
			'hosts' => 'Hosts',
			'company' => 'Company',
			'subnet' => 'Subnet Size',
			'website' => 'Website',
			'vlan_id' => 'Vlan ID',
			'comments' => 'Comments',
			'purpose' => 'Purpose',
			'site_id' => 'Site ID',
			'site_details' => 'Site Details',
			'modify_info' => 'MODIFIED',
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
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('hosts',$this->hosts);
		$criteria->compare('company',$this->company,true);
		$criteria->compare('subnet',$this->subnet);
		$criteria->compare('website',$this->website,true);
		$criteria->compare('vlan_id',$this->vlan_id);
		$criteria->compare('comments',$this->comments,true);
		$criteria->compare('purpose',$this->purpose,true);
		$criteria->compare('site_id',$this->site_id);
		$criteria->compare('site_details',$this->site_details,true);
		$criteria->compare('modify_info',$this->modify_info,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}