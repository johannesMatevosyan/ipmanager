<h1>Печати</h1>
    <a style = "float:right" class = "btn btn-primary" href = "<?php echo Yii::app()->createUrl('admin/admin/addshtampcategory')?>">Добавить Категорию</a>
    <ul>
        <?php foreach ($shtampCategories as $key => $value) {
            echo '<li><a href="'.Yii::app()->createUrl('admin/admin/getShtampData', array('category'=>$value->Id)).'">'.$value->name.'</a></li>';
        }?>
    </ul>