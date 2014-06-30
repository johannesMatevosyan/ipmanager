<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->IdUsers,
);

$this->menu=array(
	array('label'=>'List Users','url'=>array('index')),
	array('label'=>'Create Users','url'=>array('create')),
	array('label'=>'Update Users','url'=>array('update','id'=>$model->IdUsers)),
	array('label'=>'Delete Users','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->IdUsers),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Users','url'=>array('admin')),
);
?>

<h1>View Users #<?php echo $model->IdUsers; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'IdUsers',
		'idRoles',
		'userFName',
		'userLName',
		'userEmail',
		'userPhone',
		'userPassword',
		'userRegDate',
		'userBallance',
	),
)); ?>
