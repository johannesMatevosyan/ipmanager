$(document).ready(function(e) {
    $('.set-admin').click(function() {
        var userId   = $(this).attr('data-user-id');
        var userRole = $(this).is(':checked') ? 'admin' : 'user';
        $.ajax({
            'data':{'userId':userId, 'userRole':userRole},
            'url' : $('#base_url').val() + '/admin/users/changeUserRole',
            'type':'post',
            success: function(data)
            {
                alert(data);
            }
        });
	$(".ip-change-element").change(function() {
	 	var ip   = $("#SubnetModel_ip").val();
		var mask = $("#SubnetModel_subnet").val();

	 	if ( ip.length )
			$.ajax({
				'data':{'ip':ip,'mask':mask},
	 			'url' : $('#base_url').val() + '/admin/subnet/isSubnetValid',
				'type':'post',
	 			success: function(data)
	 			{
	 				alert(data);
				}
	 		});
	 });
	
});
// /	getSuitableSubnetMask();
	
	$(document).on( 'click', '#available-subnet li', function() {
		$('#SubnetModel_subnet').val($(this).attr('data-subnet-value'));
	});

	$('#SubnetModel_ip').change(function() {
		getSuitableSubnetMask();
	});
	
	$('#SubnetModel_ip').keyup(function() {
		getSuitableSubnetMask();
	});

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
		$('#admin_gallery .uplodDiv .uploadUl').html("");
		var i=0;
		for(i=0; i<input_count; i++){
			$('#admin_gallery .uplodDiv .uploadUl').append(file_input);
		}
    });
})


function getSuitableSubnetMask()
{
	var ip    = $('#SubnetModel_ip').val();
	$.ajax({
		'data':{'ip':ip},
		'url' : $('#base_url').val() + '/admin/subnet/getSuitableNetwork',
		'type':'post',
		'dataType':'json',
		success: function(data)
		{
			setAvailableHosts(data);
		}
	});
}

function setAvailableHosts(subnetInfo)
{				
	$("#available-used").html("");
	$('#available-used').append('<br><span style = "color:#0DD413">Available Subnet - ' + subnetInfo.available_subnet + '</span>');
	for ( subnet in subnetInfo.exist_subnet ) {
		$('#available-used').append('<br><span style = "color:#ED1909">Used Subnet - ' + subnetInfo.exist_subnet[subnet] + '</span>');
	}
}