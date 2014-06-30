<div class = "row">
<?php 
	echo '<div class = "span3" style = "margin-top:7px">'.$data->fio.'</div>';
	echo '<div class = "span2" style = "margin-top:7px">'.$data->email.'</div>';
	echo '<div class = "span2" style = "margin-top:7px">'.$data->date.'</div>';
	// echo '<div class = "order-item"><img height = "100" width = "100" src = "'.Yii::app()->baseUrl.'/images/pechati/'.$pechatInfo->image_path.'"></div>';
	// echo '<div class = "order-item"><img height = "100" width = "100" src = "'.Yii::app()->baseUrl.'/images/osnastki/'.$osnastkaInfo->image_path.'"></div>';

//	echo '<div class = "order-item"><img src = "'.$data->category_id.'"></div>';
	echo '<div class = "span3" style = "text-align:right">';
		echo '<button  class = "btn btn-info info-button-recovery" data-id = "'.$data->Id.'">Просмотреть</button>';
		echo '<a class = "galleryImageDeleteLink" href = "'.Yii::app()->createUrl('admin/admin/deleteOrder', array('deleteRecovery'=>$data->Id)).'"><img width ="40px" height = "40px" title = "Удалить" src = "'.Yii::app()->baseUrl.'/themes/backend/img/ic-delete.png"></a>';
	echo '</div>';
?>
</div>

