<div class = "gallery-row">
<?php 
	echo '<img width = "150px" height = "100px" alt = "'.$data->alt.'" title = "'.$data->title.'" src = "'.Yii::app()->baseUrl.'/images/slider/'.$data->imagePath.'">';
	echo '<input class = "galleryInput" type = "text" value = "'.$data->alt.'"   name = "SliderImages[alt]['.$data->Id.']">&nbsp;&nbsp;Alt';
	echo '<input class = "galleryInput" type = "text" value = "'.$data->title.'" name = "SliderImages[title]['.$data->Id.']">&nbsp;&nbsp;Title';
	echo '<a class = "galleryImageDeleteLink" href = "'.Yii::app()->createUrl('admin/admin/viewGallery', array('deleteId'=>$data->Id)).'"><img width ="40px" height = "40px" title = "Удалить" src = "'.Yii::app()->baseUrl.'/themes/backend/img/ic-delete.png"></a>';
?>
</div>
