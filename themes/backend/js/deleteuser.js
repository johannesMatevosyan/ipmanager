function deleteUserSure(c_id)
{
    ajaxUrl=rootLink+"/backoffice/service/showDeletePopup";    
    $.ajax({
        url: ajaxUrl,
        type: 'POST',
        data: 'u_id='+c_id,
        cache: false,
        success: function(data)
        {
            showPopUp(data,"");
        }
    });  
}

function deleteUser(c_id)
{
    ajaxUrl=rootLink+"/backoffice/service/deleteuser";    
    $.ajax({
        url: ajaxUrl,
        type: 'POST',
        data: 'u_id='+c_id,
        cache: false,
        success: function(data)
        {
//            if (data=="ok")
//            {
//                $('#thisId_'+c_id).parent().parent().css('display', 'none');  
//            }
        }
    });   
}