$(document).ready(function(e) {

	$('.info-button').click(function(){
		var ident = $(this).attr('data-id');
		$('#order-info').modal('show');
		$.ajax({
			url:$('#base_url').val() + '/admin/admin/getorderdata',
			data:{'id':ident},
			type:'POST',
			dataType:'json',
			success: function(data){
				$('#order-info-table tbody').html('');
				$('#order-info-table tbody').append('<tr><td>Полное наименование юр. лица</td><td>'+data.orderInfo.fullname+'</td></tr>')
				$('#order-info-table tbody').append('<tr><td>Местонахождение юр.лица</td><td>'+data.orderInfo.fullname+'</td></tr>')
				$('#order-info-table tbody').append('<tr><td>ОГРН</td><td>'+data.orderInfo.oggrn+'</td></tr>')
				$('#order-info-table tbody').append('<tr><td>ИНН</td><td>'+data.orderInfo.inn+'</td></tr>')
				$('#order-info-table tbody').append('<tr><td>ФИО</td><td>'+data.orderInfo.phone+'</td></tr>')
				$('#order-info-table tbody').append('<tr><td>Контактный телефон</td><td>'+data.orderInfo.info+'</td></tr>')
				$('#order-info-table tbody').append('<tr><td>Дополнительная информация</td><td>'+data.orderInfo.fullname+'</td></tr>')
				$('#order-info-table tbody').append('<tr><td>Печать</td><td><img height = "100" width = "100"  src = "' + $('#base_url').val()+'/images/pechati/'+data.images.pechat+'""></td></tr>')
				$('#order-info-table tbody').append('<tr><td>Оснастка</td><td><img height = "100" width = "100"  src = "' + $('#base_url').val()+'/images/osnastki/'+data.images.osnastka+'"></td></tr>')
				
				if( data.orderInfo.mainfile_path )
					$('#order-info-table tbody').append('<tr><td><b>Прикрепленный Файл</b></td><td><b><a style = "color:black" href = "'+ $('#base_url').val()+'/images/orders/mainfiles/'+data.orderInfo.mainfile_path+'">Просмотреть</b></a></td></tr>')
				if( data.orderInfo.file_path )
					$('#order-info-table tbody').append('<tr><td><b>Дополнительный Файл</b></td><td><b><a style = "color:black" href = "'+ $('#base_url').val() +'/images/orders/additionalfiles/'+data.orderInfo.file_path+'">Просмотреть</a></b></td></tr>')
				
			

				if(data.orderInfo.payment_method == 0) {
					payment_text = 'Наличные';
				} else {
					payment_text = 'Безналичный Расчет';
				}
					$('#order-info-table tbody').append('<tr><td>Способ Оплаты</td><td>'+payment_text+'</td></tr>')
				

			}
		});
	});

	$('.info-button-recovery').click(function(){
		ident = $(this).attr('data-id');
		$('#order-info').modal('show');
		base_url = $('#base_url').val();
		$.ajax({
			url:$('#base_url').val() + '/admin/admin/getrecoverydata',
			data:{'id':ident},
			type:'POST',
			dataType:'json',
			success: function(data){
				$('#order-info-table tbody').html('');
				$('#order-info-table tbody').append('<tr><td><b>ФИО Заказчика</b></td><td>'+data.info.fio+'</td></tr>')
				$('#order-info-table tbody').append('<tr><td><b>Номер Телефона</b></td><td>'+data.info.phone+'</td></tr>')
				$('#order-info-table tbody').append('<tr><td><b>Дублирование нев. элементов</b></td><td>'+data.info.info+'</td></tr>')
				$('#order-info-table tbody').append('<tr><td><b>Пожелания</b></td><td>'+data.info.wishes+'</td></tr>')
				$('#order-info-table tbody').append('<tr><td><b>Файл с оттисками</b></td><td><b><a style = "color:black" href = "'+base_url+'/images/recovery/ottisk/'+data.info.mainfile_path+'">Просмотреть</b></a></td></tr>')//<a href = "'+$('#base_url').val()+'/images/ottisk/'+data.info.mainfile_path+'>Скачать</a>
				$('#order-info-table tbody').append('<tr><td><b>Файл копия свидетельства</b></td><td><b><a style = "color:black" href = "'+ base_url +'/images/recovery/certificate/'+data.info.certificate_path+'">Просмотреть</a></b></td></tr>')
			}
		});
	});

	/*
	$('#articles-form #Images_file img').click(function() {
		$('#Articles_files').trigger('click');
	});
	*/
	$('#clear_article_image').click(function(e) {
        $('#article_image_input').val('');
		$('#Articles_ImageClear').val('1');
		var empty_img = $('.articleImage #empty_image').html();
		$('.articleImage #article_image').html(empty_img);
    });
	$('#admin_gallery .uplodDiv #uploadImageCount').keyup(function(e) {
		
        var input_count = parseInt($(this).val());
		if(input_count == 0 || isNaN(input_count)){
			input_count = 1;
		}
		var file_input = '<li><input type="file" name="Images[files][]"></li>';
		//alert(file_input);
		//alert(input_count);
		$('#admin_gallery .uplodDiv .uploadUl').html("");
		var i=0;
		for(i=0; i<input_count; i++){
			$('#admin_gallery .uplodDiv .uploadUl').append(file_input);
		}
    });
})



/********************* file oploader *************************************************/
oFReader = new FileReader(),
oFReader.onload = function (oFREvent)
{
	var a = oFREvent.target.result;
	//alert(a);
	var img = '<img name="" src = '+a+' />';
	$('.articleImage #article_image').html(img);
};

function loadImageFile(object)
{
	var object_id = object.getAttribute('id');
	//alert(object_id);
	var oFile = document.getElementById(object_id).files[0];
	
	oFReader.readAsDataURL(oFile);
}
//)
/************************************************************************************/
function loader(id)
{
	$(id).html('<div id="loader" style="clear: both; text-align: center;"><img style="margin: auto;" src="'+$('#base_url').val()+'/themes/backend/img/loader.gif" ></div>');
}