<?php 
echo CHtml::link('+ Add User', array('/admin/users/userform'), array('class' =>'btn btn-primary'));
$this->widget('bootstrap.widgets.TbGridView', array(
    'dataProvider'=>$userList,
    'type' =>'bordered',
    'htmlOptions'=> array('class'=>'user-list'),
    'columns'=>array(
        'userFName',
        'userEmail',
        'userPassword',
        array(
            'name'=>'Set Admin',
            'header'=>'Set Admin',
            'value'=>'WidgetHelper::getSetAdminCheckbox($data)',
        ),    
        array(
        	'name'=>'Edit',
            'header'=>'Edit',
            'value'=>'WidgetHelper::getUserEditButton($data)',
        ),
        array(
            'name'=>'Delete',
            'header'=>'Delete',
            'value'=>'WidgetHelper::getUserDeleteButton($data)',
        ),      
    ),
));