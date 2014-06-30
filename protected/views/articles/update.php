<?php
/* @var $this ArticlesController */
/* @var $model Articles */

$this->breadcrumbs=array(
	'Articles'=>array('index'),
	$model->IdArticles=>array('view','id'=>$model->IdArticles),
	'Update',
);

$this->menu=array(
	array('label'=>'List Articles', 'url'=>array('index')),
	array('label'=>'Create Articles', 'url'=>array('create')),
	array('label'=>'View Articles', 'url'=>array('view', 'id'=>$model->IdArticles)),
	array('label'=>'Manage Articles', 'url'=>array('admin')),
);
?>

<h1>Update Articles <?php echo $model->IdArticles; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>