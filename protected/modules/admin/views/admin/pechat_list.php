	<h1><?php echo $pageInfo->name;?></h1>
	<div class = "addButtonGroup">
		<a class = "btn btn-primary" href = "<?php echo Yii::app()->createUrl('admin/admin/addShtamp', array('category'=>$pageInfo->Id))?>">Добавить Печать</a>
		<a class = "btn btn-primary" href = "<?php echo Yii::app()->createUrl('admin/admin/addOsnastka', array('category'=>$pageInfo->Id))?>">Добавить Оснастку</a>
	</div>
	<h3>Описание</h3>
	<form method = "POST">
		<div class = "row" style = "margin-left:0px">
		<label>Название страницы</label>
			<input type = "text" style = "width:647px" name = "page[name]" placeholder = "Название страницы" value = "<?php echo $pageInfo->name?>">
		</div>
		<div class = "row" style = "margin-left:0px">
		<label>Ссылка страницы</label>
			<input type = "text" style = "width:647px" name = "page[link]" placeholder = "Ссылка страницы" value = "<?php echo $pageInfo->link?>">
		</div>
		<div class = "row" style = "margin-left:0px">
		<label>Заголовок страницы</label>
			<input type = "text" style = "width:647px" name = "page[title]" placeholder = "Заголовок страницы" value = "<?php echo $pageInfo->title?>">
		</div>
		<div class = "row" style = "margin-left:0px">
		<label>Мета Ключи</label>
			<input type = "text" style = "width:647px" name = "page[metaKey]" placeholder = "Мета Ключи" value = "<?php echo $pageInfo->metaKey?>">
		</div>
		<div class = "row" style = "margin-left:0px">
		<label>Мета Описание</label>
			<input type = "text" style = "width:647px" name = "page[metaDesc]" placeholder = "Мета Описание" value = "<?php echo $pageInfo->metaDesc?>">
		</div>
	<?php 
				$this->Widget('ext.filemanager.widgets.FManager', 
					array(
						'editorHtml' => $pageInfo->description,
						'name'=>'page[description]'
					));    
	?>
	 <input type = "hidden" name = "page[page_id]" value = "<?php echo $pageInfo->Id;?>">
	 <button style = "margin-left:250px; margin-top:20px;" class = "btn btn-info" type = "submit">СОХРАНИТЬ</button>
	</form>
	<br>
	<br>
	<h3>Печати</h3>
	<div class = "shtamps">
		<form method = "POST">
		<?php 
			foreach ($shtamps as $key => $value) {
				echo '<div class = "pechati-item">';
				echo '<img width = "100px" height = "100px" src = "'.Yii::app()->baseUrl.'/images/pechati/'.$value->image_path.'" alt = "'.$value->alt.'" title = "'.$value->title.'">';
				echo '<input type = "text" value = "'.$value->alt.'"  name = ShtampsModel[alt]['.$value->Id.']>&nbsp;alt';
				echo '<input type = "text" value = "'.$value->title.'" name = ShtampsModel[title]['.$value->Id.']>&nbsp;title';
				echo '<input type = "text" value = "'.$value->price.'" name = ShtampsModel[price]['.$value->Id.']>&nbsp;цена';
				echo '<a class = "galleryImageDeleteLink" href = "'.Yii::app()->createUrl('admin/admin/deleteItem', array('deleteShtampId'=>$value->Id)).'"><img width ="40px" height = "40px" title = "Удалить" src = "'.Yii::app()->baseUrl.'/themes/backend/img/ic-delete.png"></a>';
				echo '</div>';
			}
		?>
			<br>
		<input type = "hidden" name = "page_id" value = "<?php echo $pageInfo->Id;?>">
		<button style = "margin-left:250px" class = "btn btn-info" type = "submit">СОХРАНИТЬ</button>
	</form>
	</div>
	<br>
	<br>
-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	<h3>Оснастки</h3>
	<div class = "osnastki">
	<form method = "POST">
		<?php 
			foreach ($osnastki as $key => $value) {
				echo '<div class = "pechati-item">';
				echo '<img width = "100px" height = "100px" src = "'.Yii::app()->baseUrl.'/images/osnastki/'.$value->image_path.'" alt = "'.$value->alt.'" title = "'.$value->title.'">';
				echo '<input type = "text" value = "'.$value->alt.'" name = OsnastkiModel[alt]['.$value->Id.']>&nbsp;alt';
				echo '<input type = "text" value = "'.$value->title.'" name = OsnastkiModel[title]['.$value->Id.']>&nbsp;title';
				echo '<input type = "text" value = "'.$value->price.'" name = OsnastkiModel[price]['.$value->Id.']>&nbsp;цена';
				echo '<a class = "galleryImageDeleteLink" href = "'.Yii::app()->createUrl('admin/admin/deleteItem', array('deleteOsnastkiId'=>$value->Id)).'"><img width ="40px" height = "40px" title = "Удалить" src = "'.Yii::app()->baseUrl.'/themes/backend/img/ic-delete.png"></a>';
				echo '</div>';
			}
		?>
			<br>
		<input type = "hidden" name = "page_id" value = "<?php echo $pageInfo->Id;?>">
		<button style = "margin-left:250px" class = "btn btn-info" type = "submit">СОХРАНИТЬ</button>
	</form>
	</div>