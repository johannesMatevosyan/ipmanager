<div class = "row">
<?php 
	echo '<div class = "span2" style = "margin-top:7px; background:yellow; ">'.$data->category_id.'</div>';
	echo '<div class = "span1" style = "margin-top:7px">'.$data->fullname.'</div>';
	echo '<div class = "span2" style = "margin-top:7px; background:yellow;"> id </div>';
	 echo '<div class = "span2" style = "margin-top:7px">Test </div>';
	echo '<div class = "span1" style = "margin-top:7px; background:yellow;">vlan</div>';
//	 echo '<div class = "order-item"><img height = "10" width = "10" src = "'.Yii::app()->baseUrl.'/images/osnastki/'.$osnastkaInfo->image_path.'"></div>';

//	echo '<div class = "order-item"><img src = "'.$data->category_id.'"></div>';
	echo '<div class = "span1" style = "">';
		echo '<button  class = "btn btn-info info-button" data-id = "'.$data->Id.'">View</button>';
    echo '</div>';
    echo '<div class = "span1" style = "">';
		echo '<a class = "galleryImageDeleteLink" href = "'.Yii::app()->createUrl('admin/admin/deleteOrder', array('deleteOrder'=>$data->Id)).'"><i class="icon-remove"></i></a>';
    echo '</div>';
//    echo '<div class = "span2" style = "margin-top:7px"> '.$data->date.'</div>';
    echo '<div class = "span4" style = "margin-top:7px; background:yellow;">comments</div>';
?>
</div>

