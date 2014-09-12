<?php
class SubnetController extends Controller
{
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */

    public function accessRules()
    {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('getSubnetList','subnetCalculator', 'downloadSubnetList'),
                'users'=>array("@"),
                'expression'=>'Yii::app()->user->getState("role") == "user" || Yii::app()->user->getState("role") == "admin"',

            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('admin', 'getMaxSubnet' , 'subnetForm', 'deleteSubnet', 'getSuitableNetwork', 'downloadBackup'),
                'users'=>array("@"),
                'expression'=>'Yii::app()->user->getState("role") == "admin"',
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    public function actionGetSubnetList()
    {
        $subnetList = new SubnetModel;
        $subnetList->unsetAttributes();
        if (isset($_GET['SubnetModel'])) {
            $subnetList->attributes = $_GET['SubnetModel'];
        }
        $this->render('subnet_list', compact('subnetList', 'ipList'));
    }

    public function actionSubnetCalculator()
    {
        $network = NULL;
        if(!empty($_GET["ip"]) && !empty($_GET["mask"]))
            $network = SubnetCalculator::get_network($_GET["ip"],$_GET["mask"]);

        $this->render('calculator', compact('network'));
    }

    public function actionSubnetForm($subnetId = NULL)
    {
        $dateNow = date('m-d-Y H-i-s');
        Yii::app()->language = 'en';
        $network = new SubnetModel();
        if ($subnetId) {
            $network = SubnetModel::model()->findByPk($subnetId);
            $network->modify_info   = unserialize($network->modify_info);
            $createUserName = $network->modify_info;
            $createUserName = $createUserName['create'];
            $editUserName = Yii::app()->user->getState('FName');
            $network->modify_info = serialize(array('create' =>$createUserName, 'edit' => array('username'=>$editUserName, 'date'=> $dateNow)));

        } else {
            $network->modify_info = serialize(array('create' => array('username' => Yii::app()->user->getState('FName'), 'date'=>$dateNow)));
        }
        if (isset($_POST['SubnetModel'])) {
            if (isset($_POST['SubnetModel']['Id'])) {
                $network->setIsNewRecord(false);
            }
            $network->attributes = $_POST['SubnetModel'];
            $networkInfo = SubnetCalculator::get_network($network->ip, SubnetCalculator::getByteMaskBySubnetMask($network->subnet));
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
            
            $network->networkId = $networkDigitalValue;
            $network->broadcastId = $broadcastDigitalOctets;
         //   echo $broadcastDigitalOctets; die;

            if ($network->save())
                $this->redirect(Yii::app()->createUrl('/admin/subnet/getsubnetlist'));
        }
        $ipList = IpModel::model()->findAll();
        $this->render('_form', compact('network', 'ipList'));
    }

    public function actionDeleteSubnet($subnetId)
    {
        if ( $subnetId )
            SubnetModel::model()->deleteByPk($subnetId);
        $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionGetSuitableNetwork()
    {
        if (isset($_POST['ip'])) {
            $existHostSum = 0;
            $ip = $_POST['ip'];

            $existNetworkList = SubnetModel::model()->findAllByAttributes(array('ip'=> $ip));
            $ipMaxSubnet      = SubnetCalculator::getMaxSubnet($ip);
            $maxAvailable     = SubnetCalculator::getHostsCountBySubnetMask(SubnetCalculator::getMaxSubnet($ip));

            foreach ($existNetworkList as $value) {
                $existHostSum += SubnetCalculator::getHostsCountBySubnetMask($value->subnet);
            }
            
            $availableHosts = $maxAvailable - $existHostSum;
            $nearestByteNumber =  pow(2, floor(log($availableHosts, 2)));
            $binaryPower = log($nearestByteNumber, 2);
            $response = array();
			$response['exist_subnet'] = array();
            foreach ($existNetworkList as $key => $value) {
                $response['exist_subnet'][] = $value->subnet;
            }
            $response['available_subnet'] = 32 - $binaryPower;
            print_r(json_encode($response));
        }
    }

    public function actionDownloadSubnetList()
    {
        $query = 'SELECT * FROM stbl_subnet';
        $subnets = Yii::app()->db->createCommand($query)->queryAll();
        $newSubnetList = array();
        $i = 0;
        foreach ($subnets as $key => $value) {
            $newSubnetList[$i] = new SubnetModel();
            $newSubnetList[$i]->Id       = $value['Id'];
            $newSubnetList[$i]->subnet   = $value['ip'] .'/'. $value['subnet'];
            $newSubnetList[$i]->hosts    = $value['hosts'];
            $newSubnetList[$i]->company  = $value['company'];
            $newSubnetList[$i]->website  = $value['website'];
            $newSubnetList[$i]->vlan_id  = $value['vlan_id'];
            $newSubnetList[$i]->comments = $value['comments'];
            $newSubnetList[$i]->purpose  = $value['purpose'];
            $newSubnetList[$i]->site_id  = $value['site_id'];
            $i++;
        }
        $subnetList = new CArrayDataProvider($newSubnetList);
        $this->render('subnet_excel', compact('subnetList'));
    }

    public function actionIpForm($ipId = NULL)
    {
        Yii::app()->language = 'en';
        $ipAddress = new IpModel();
        if ($ipId) {
                $ipAddress = IpModel::model()->findByPk($ipId);
        }
        if (isset($_POST['IpModel'])) {
            if (isset($_POST['IpModel']['Id'])) {
                $ipAddress->setIsNewRecord(false);
            }
            $ipAddress->attributes = $_POST['IpModel'];
            if ($ipAddress->save())
                $this->redirect(Yii::app()->createUrl('/admin/subnet/getsubnetlist'));
        }

        $this->render('ip_form', compact('ipAddress'));
    }

    public function actionDeleteIp($ipId)
    {
        if ( $ipId )
            IpModel::model()->deleteByPk($ipId);
        $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionDownloadBackup()
    {
        $sqlFilePath = Yii::getPathOfAlias('webroot') . '/files/backup.sql';
        file_put_contents($sqlFilePath, "");
        $fileContent = "CREATE TABLE IF NOT EXISTS `stbl_subnet` (
          `Id` int(11) NOT NULL AUTO_INCREMENT,
          `ip` int(20) DEFAULT NULL,
          `hosts` int(11) DEFAULT NULL,
          `company` varchar(120) DEFAULT NULL,
          `subnet` int(11) DEFAULT NULL,
          `website` varchar(120) DEFAULT NULL,
          `vlan_id` int(11) DEFAULT NULL,
          `comments` text,
          `purpose` varchar(255) DEFAULT NULL,
          `site_id` int(11) DEFAULT NULL,
          PRIMARY KEY (`Id`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;         
        INSERT INTO `stbl_subnet` (`Id`, `ip`, `hosts`, `company`, `subnet`, `website`, `vlan_id`, `comments`, `purpose`, `site_id`) VALUES";

        $subnetList = SubnetModel::model()->findAll();

        $counter = false;
        foreach ( $subnetList as $subnet) {
            if ($counter)
                $fileContent .= ', ';
                $fileContent .= '(' . $subnet->Id. ', "'.$subnet->ip. '" , '. $subnet->hosts. ', "'.$subnet->company. '", ' . $subnet->subnet. ', "'.$subnet->website.'", '.$subnet->vlan_id. ', "' . $subnet->comments. '", "'.$subnet->purpose.'", ' .$subnet->site_id. ')';
            $counter = true;
        }

        // $fileContent .= "; CREATE TABLE IF NOT EXISTS `stbl_ip` (
        //   `Id` int(11) NOT NULL AUTO_INCREMENT,
        //   `ip` varchar(20) DEFAULT NULL,
        //   `root_subnet` int(11) DEFAULT NULL,          
        //   PRIMARY KEY (`Id`)
        // ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;         
        // INSERT INTO `stbl_ip` (`Id`, `ip`, `root_subnet`) VALUES";

        // $ipList = IpModel::model()->findAll();

        // $counter = false;
        // foreach ( $ipList as $ip) {
        //     if ($counter)
        //         $fileContent .= ', ';
        //         $fileContent .= '(' . $ip->Id. ', "'.$ip->ip. '" , '. $ip->root_subnet.')';
        //     $counter = true;
        // }


        file_put_contents($sqlFilePath, $fileContent);

        
        $filename = Yii::getPathOfAlias('webroot') . '/files/backup.sql';
          
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.basename($filename));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filename));
        ob_clean();
        flush();
        readfile($filename);
        exit;
        }

}

