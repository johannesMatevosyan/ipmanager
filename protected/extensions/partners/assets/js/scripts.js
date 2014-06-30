/**************************
**************8************
************8**************
***********8***************
************8**************
**************8************
***************8***********
****************8**********
***************8***********
*************8*************
***************************
*******LIVING STONES******* 
***************************
WEBSITE: 	 WWW.LSTONES.EU
MAIL: 		INFO@LSTONES.EU
PHONE: 		   +37495540454
**************************/


$(function(){
	triggerImg(".addYourPhoto img");
	triggerImg(".addreRerencesContent a");
	
	$('#addVideoBtn').click(function(){
		$('.addVideo').append('<div> \n\
				<input type="text" name="ReferenceModel[upload_vid][]" placeholder="video link">\n\
				<a>x</a>\n\
			</div>');
		removeLinkItem();
		
	});
        $("label[for='PartnersModel_path']" ).css('display', 'none');        
});

function triggerImg(arg){
	$(arg).click(function(){
		$(this).next("input").trigger("click");
	});
}
function removeLinkItem(){
	$('.addVideo div a').click(function(){
		$(this).parent('div').remove();
	});
}

$(document).ready(function(){
    $('.image-class').click(function(e){
        showPop(e.target.id, "img");
    });
    $('.video-class').click(function(e){
        showPop(e.target.id, "vid");
    });
});

function showPop(id, type)
{
    var url=$("#base-url").val();
    if (type=="img")
    {
        showPopUp("<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>\n\
<div id='popup_body' class='modal-body getCode'>\n\
<h3>Image</h3>\n\
<div>\n\
<img src='"+url+"/protected/extensions/reference/assets/upload_images/"+$('#'+id).attr('show-pop')+"' />\n\
</div>\n\
</div>\n\
<div class='modal-footer getCode'>\n\
<button class='btn' data-dismiss='modal' aria-hidden='true'>Close</button>\n\
</div>", "");
    }
    else if (type=="vid")
    {
        showPopUp("<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>\n\
<div id='popup_body' class='modal-body getCode'>\n\
<h3>Video</h3>\n\
<div>\n\
<iframe width='420' height='315' src='//www.youtube.com/embed/"+$('#'+id).attr('show-pop')+"' frameborder='0' allowfullscreen></iframe>\n\
</div>\n\
</div>\n\
<div class='modal-footer getCode'>\n\
<button class='btn' data-dismiss='modal' aria-hidden='true'>Close</button>\n\
</div>", "width='420' height='315'");
    }
}

function existKeyInArray(a,k)
{
    var OutPut = false;
    for (var key in a)
    {
        if(key == k)
        {
            OutPut = true;
            break;
        }
    }
    return OutPut;
}
function countArray(a)
{
    var count = 0;
    for (var k in a)
    {
        if(existKeyInArray(a,k))
            count++;
    }
    return parseInt(count);
}
function empty (mixedValue)
{
     return (mixedValue === undefined ||
          mixedValue === null || mixedValue === ""
          || mixedValue === "0" || mixedValue === 0 
          || mixedValue === false || (Array.isArray(mixedValue)
          && mixedValue.length == 0));
}

function showPopUp(popupBody,style)
{
    $("#universalPopup").trigger("click");
    $("#myModal").html(popupBody);
    $('.modal').attr('style',style);
}

$(document).ready(function() {
	var p = $("#uploadPreview");
	

	// prepare instant preview
	$("#uploadImage").change(function(){
                $('.partner_path').val('valid');
		// fadeOut or hide preview
		p.fadeOut();

		// prepare HTML5 FileReader
		var oFReader = new FileReader();
		oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);
                
		oFReader.onload = function (oFREvent) 
                {
                    p.attr('src', oFREvent.target.result).fadeIn();                
		};     
	});
});