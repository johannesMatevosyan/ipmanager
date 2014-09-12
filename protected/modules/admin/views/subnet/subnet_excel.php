<?php
ini_set('display_errors',1);
    $this->widget('ext.eexcelwriter.components.EExcelWriter', array(
        'dataProvider' => $subnetList,
        'title'        => 'EExcelWriter',
        'stream'       => FALSE,
        'fileName'     => Yii::getPathOfAlias('webroot').'/files/subnet_list.xls',
        'columns'      => array(
                'Id',
                'subnet',
                'hosts',
                'vlan_id',
                'comments',
                'purpose',
                'site_id', 
        ),
    ));

    $this->redirect('http://localhost/ipmanager/files/subnet_list.xls');