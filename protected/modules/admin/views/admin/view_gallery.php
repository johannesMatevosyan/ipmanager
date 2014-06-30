<div id="admin_gallery">
    <a class = "btn btn-primary" href = "<?php echo Yii::app()->createUrl("admin/admin/addImage")?>">Добавить Картинку</a>
    <form name = "SliderImages" method = "POST">
<?php 
   $this->widget('zii.widgets.CListView', array(
        'dataProvider'=>$sliderImages,
        'itemView'=>'_gallery'
    ));
?>
    <input class = "btn btn-info" style = "margin-left:550px;margin-top:20px;" type = "submit" value = "СОХРАНИТЬ">
    </form>
</div>