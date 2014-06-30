<?php
?>
<ul class="nav nav-tabs" id="orderTab">
  <li class="active"><a href="#create" data-toggle="tab">Создание Печатей</a></li>
  <li><a href="#recovery" data-toggle="tab">Восстановление Печатей</a></li>
</ul>
 
<div class="tab-content">
  <div class="tab-pane active" id="create">
		<div class = "container" id = "orderContainer">
			<div class = "row"> 
			  	<div class ="span2" style="background:yellow;">Subnet</div>
			  	<div class ="span1">Site ID</div>
			  	<div class ="span2" style="background:yellow;">Site</div>
			  	<div class ="span2">Purpose</div>
			  	<div class ="span1" style="background:yellow;">VLAN ID</div>
                <div class ="span1" style = "">Edit</div>
                <div class ="span1" style = "background:yellow;">Delete</div>
			  	<div class ="span4" style = "background:yellow;">Comments</div>

		  	</div>
		  	<?php
				$this->widget('zii.widgets.CListView', array(
					'dataProvider'=>$orders,
					'itemView'=>'_order',
					'summaryText'=>'',
				)); 
			?>
		</div>
  </div>
  
  <div class="tab-pane" id="recovery">

		<div class = "container" id = "recoveryContainer">
			<div class = "row"> 
			  	<div class ="span3">ФИО Заказчика</div>
			  	<div class ="span2">Адрес почты</div>
			  	<!-- <div class ="span1">Номер Телефона</div> -->
			  	<div class ="span2">Дата Заказа</div>
			  	<!-- <div class ="span2">Дублирование нев. элементов</div> -->
			  	<!-- <div class ="span1">Пожелания</div> -->
			  	<!-- <div class ="span1">Файлы</div> -->
			  	<div class ="span2">Подробная Информация</div>
			  	<div class ="span2" style = "padding-left:20px;">Удалить</div>
			 </div>
			<?php
				$this->widget('zii.widgets.CListView', array(
					'dataProvider'=>$recoveries,
					'itemView'=>'_recovery',
				)); 
			?>
  	
		</div>

  	
  </div>
</div>
 
<script>
jQuery(document).ready(function ($) {
    $('.nav-tabs').tab();
});
</script>

 <div id="order-info" style = "border-radius:0px;height:500px;" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
    <div id="message_body" style = "border-radius:0px;height:800px;" class="modal-body"><div id="mail_massage"></div>
        <h2 style = "margin-top:30px;">Информация о Заказе</h2>
        <table id = "order-info-table" style = "border-radius:0px;height:800px;">
        	<thead>
        	</thead>
        	<tbody>

        	</tbody>
        </table>
         
    </div>
    <div class="modal-footer" id="message_footer">
        <button class="btn-info" data-dismiss="modal" aria-hidden="true">Close</button>
    </div>
    </div>
</div> 
