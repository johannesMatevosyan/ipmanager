<?php

class WidgetHelper
{
	public static function getUserEditButton($user)
	{
		echo '<a class = "btn btn-warning" href = "'.Yii::app()->createUrl('admin/users/userform', array('userId' => $user->IdUsers)).'" >Edit</a>';
	}

	public static function getUserDeleteButton($user)
	{
		echo '<a onclick = "return confirm(\'Are you sure you want to delete this user?\')" class = "btn btn-danger" href = "'.Yii::app()->createUrl('admin/users/deleteUser', array('userId' => $user->IdUsers)).'">Delete</a>';
	}

	public static function getSetAdminCheckbox($user)
	{
		$checkboxValue = $user->userRole == "admin" ? 'checked = "TRUE"' : '';
		echo '<input type = "checkbox" class = "set-admin" name = "setAdmin" '.$checkboxValue.'" data-user-id = "'.$user->IdUsers.'">';
	}

	public static function getSubnetEditButton($subnet)
	{
		echo CHtml::link('Edit', array('/admin/subnet/subnetform','subnetId' => $subnet->Id), array('class' => 'btn btn-warning'));
	}

	public static function getSubnetDeleteButton($subnet)
	{
		echo CHtml::link('Delete', array('/admin/subnet/deleteSubnet', 'subnetId' => $subnet->Id), array('class' => 'btn btn-danger', 'confirm' => 'Are you sure you want to delete this Subnet?'));
	}

	public static function getSubnetIpAddress($network)
	{
		//$IP = IPModel::model()->findByPk($network->ip_id);
		echo $network->ip, '/', $network->subnet;
	}


	public static function getIpEditButton($ip)
	{
		echo CHtml::link('Edit', array('/admin/subnet/ipForm','ipId' => $ip->Id), array('class' => 'btn btn-warning'));
	}

	public static function getIpDeleteButton($ip)
	{
		echo CHtml::link('Delete', array('/admin/subnet/deleteIp', 'ipId' => $ip->Id), array('class' => 'btn btn-danger', 'confirm' => 'Are you sure you want to delete this IP Address?'));
	}

	public static function getHostsInSubnet($subnet_mask)
	{
		echo SubnetCalculator::getHostsCountBySubnetMask($subnet_mask);
	}

    public static function getModifyInfo($data)
    {
        $modifyInfo = unserialize($data->modify_info);

       echo 'Created By : ', '<i>' . @$modifyInfo['create']['username'] . '</i>', '<br> In :', $modifyInfo['create']['date'];
        echo '<br> Last Edited By : ', isset($modifyInfo['edit']) ? '<i>'.$modifyInfo['edit']['username'].'</i>' : 'NOT MODIFIED', '<br> In :', isset($modifyInfo['edit']) ? $modifyInfo['edit']['date'] : 'NOT MODIFIED';
    }
}
