$(document).ready(function(e) {
    
    $(".adv_pub").click(function(e){
       var a = $(this).attr('id');
       var b = $(this).parents('ul').find('li.active').removeClass('active');
       $(this).parent('li').addClass('active');
       $('.date_picker').val('');
       $('#userRole').val(a);
	})
})