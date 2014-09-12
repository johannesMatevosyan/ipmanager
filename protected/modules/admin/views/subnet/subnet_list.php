<style type = "text/css">
    input {
        width:150px;
    }
    .add-subnet {
        margin-right:40px;
    }
    input[name="SubnetModel[vlan_id]"], input[name="SubnetModel[site_id]"] {
      width:110px;
    }

</style>
<?php 
$query = "SELECT DISTINCT LEFT(ip, 7) AS ip FROM stbl_subnet";
$subnetFullList = Yii::app()->db->createCommand($query)->queryAll();

echo CHtml::link('+ Download Excel Format', array('/admin/subnet/downloadSubnetList'), array('class' =>'btn btn-success download-file'));
if (Yii::app()->user->getState('role') == 'admin') {
    
    echo CHtml::link('+ Download SQL Backup', array('/admin/subnet/downloadBackup'), array('class' =>'btn btn-warning download-file'));

    echo CHtml::link('+ Add Subnet', array('/admin/subnet/subnetform'), array('class' =>'btn btn-primary add-subnet'));
    foreach ($subnetFullList as $value) {
        $ipFirstTwoOctets = explode('.', $value['ip']);
        $ipFirstTwoOctets = $ipFirstTwoOctets[0] . '.' . $ipFirstTwoOctets[1];
        echo '<a class = "btn btn-default" style = "margin:0 2px;" href = "?SubnetModel%5Bip%5D='.$ipFirstTwoOctets.'">'.$ipFirstTwoOctets.'</a>';
    }

    $this->widget('bootstrap.widgets.TbGridView', array(
        'dataProvider'=>$subnetList->search(),
        'type' =>'bordered',
        'id'=>'subnet-admin',
        'ajaxUpdate'=>false,
        'filter'=>$subnetList,
        'htmlOptions'=> array('class'=>'user-list'),
        'columns'=>array(
            array(
                'name'=>'ip',
                'header'=>'<b>SUBNET</b>',
                'value'=>'WidgetHelper::getSubnetIpAddress($data)'
            ),
            
            array(
                'name'=>'site_id',
                'header'=>'<b>Site ID</b>',
                'value'=>'$data->site_id',
                'headerHtmlOptions'=>array('style'=>'min-width:60px;'),
            ),
             array(
                'name'=>'site_details',
                'header'=>'<b>Site details</b>',
                'value'=>'$data->site_details',
            ),
             array(
                'name'=>'vlan_id',
                'header'=>'<b> Vlan ID</b>',
                'value'=>'$data->vlan_id',
                'htmlOptions'=>array('style'=>'max-width:6px'),
            ),  
             array(
                'name'=>'purpose',
                'header'=>'<b>Purpose</b>',
                'value'=>'$data->purpose',
            ),
             array(
                'name'=>'comments',
                'header'=>'<b>Comments</b>',
                'value'=>'$data->comments',
            ),
           array(
                'name'=>'modify_info',
                'header'=>'<b>MODIFIED</b>',
                'value'=>'WidgetHelper::getModifyInfo($data)',
                'htmlOptions'=>array('width'=>150),                
            ),
           array(
            	'name'=>'Edit',
                'header'=>'EDIT',
                'value'=>'WidgetHelper::getSubnetEditButton($data)',
                'filter'=>false
            ),
            array(
                'name'=>'Delete',
                'header'=>'DELETE',
                'value'=>'WidgetHelper::getSubnetDeleteButton($data)',
                'filter'=>false
            ),
        ),
    ));
} else {

foreach ($subnetFullList as $value) {
        $ipFirstTwoOctets = explode('.', $value['ip']);
        $ipFirstTwoOctets = $ipFirstTwoOctets[0] . '.' . $ipFirstTwoOctets[1];
        echo '<a class = "btn btn-default" style = "margin:0 2px;" href = "?SubnetModel%5Bip%5D='.$ipFirstTwoOctets.'">'.$ipFirstTwoOctets.'</a>';
    }
    $this->widget('bootstrap.widgets.TbGridView', array(
        'dataProvider'=>$subnetList->search(),
        'type' =>'bordered',
        'htmlOptions'=> array('class'=>'user-list'),
		'filter'=>$subnetList,
        'columns'=>array(
            array(
                'name'=>'ip',
                'header'=>'<b>SUBNET</b>',
                'value'=>'WidgetHelper::getSubnetIpAddress($data)'
            ),
            array(
                'name'=>'site_id',
                'header'=>'<b>Site ID</b>',
                'value'=>'$data->site_id',
                'headerHtmlOptions'=>array('style'=>'min-width:60px;'),
            ),
            array(
                'name'=>'site_details',
                'header'=>'<b>Site details</b>',
                'value'=>'$data->site_details',
            ),
            array(
                'name'=>'vlan_id',
                'header'=>'<b> Vlan ID</b>',
                'value'=>'$data->vlan_id',
                'htmlOptions'=>array('style'=>'max-width:6px'),
            ),  
            array(
                'name'=>'purpose',
                'header'=>'<b>Purpose</b>',
                'value'=>'$data->purpose',
            ),
            array(
                'name'=>'comments',
                'header'=>'<b>Comments</b>',
                'value'=>'$data->comments',
            ),  
        ),
    ));
}
