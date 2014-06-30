function loader(id)
{
	$(id).html('<div id="loader" style="clear: both; text-align: center;"><img style="margin: auto;" src="'+$('#base_url').val()+'/themes/frontend/img/loader.gif" ></div>');
}
function modalTrigger()
{
	$('#btnSuperModal').trigger('click');
}

function modalText(msg)
{
	$('#superModal .modal-body p').html(msg);
}

function modalStyle(ok)
{
	if(parseInt(ok) == 1){
		$('#superModal .modal-body p').addClass('green').removeClass('red');
	};
	if(parseInt(ok) == 2){
		$('#superModal .modal-body p').addClass('red').removeClass('green');
	};
	if(parseInt(ok) == 0){
		$('#superModal .modal-body p').removeClass('red').removeClass('green');
	};
}