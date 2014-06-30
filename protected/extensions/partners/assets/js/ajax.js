$(document).ready(
    function()
    {            
        $('#uploadImgLink').click(
            function()
            {
                $('#uploadImage').trigger('click');
            }
        );        
    }
);
function showHidePartner(c_id)
{
    var url=$("#base-url").val();
    $.ajax({
        url: "",
        type: 'POST',
        data: {c_id: c_id, show_hide: 'ok'},
        cache: false,
        beforeSend : function()
        {
            $('#status_'+c_id).removeAttr('class');  
            $('#status_'+c_id).html('<img src="'+url+'/protected/extensions/partners/assets/img/ajax-loader.gif" />');
        },
        success: function(data)
        {
            var is_ok=data.split ('<!-|respons|->');
            if (is_ok[1]=="ok")
            {
                $('#show_hide_'+c_id).removeAttr('class');
                $('#show_hide_'+c_id).removeAttr('data-original-title');
                $('#show_hide_'+c_id).addClass('btn');
                $('#status_'+c_id).removeAttr('class');                   
                $('#status_'+c_id).addClass('badge');  
                
                if ($('#show_hide_'+c_id).html()=='Show')
                {                    
                    $('#show_hide_'+c_id).addClass('btn-primary');
                    $('#show_hide_'+c_id).attr('data-original-title', '.btn .btn-primary');
                    $('#show_hide_'+c_id).html('Hide');
                               
                    $('#status_'+c_id).addClass('badge-success');            
                    $('#status_'+c_id).html('Show');
                }
                else
                {
                    $('#show_hide_'+c_id).addClass('btn-success');
                    $('#show_hide_'+c_id).attr('data-original-title', '.btn .btn-success');
                    $('#show_hide_'+c_id).html('Show');                    
                              
                    $('#status_'+c_id).addClass('badge-important');            
                    $('#status_'+c_id).html('Hide');
                }
            }
        }
    });
}

function editPartner(id)
{
    var url=$("#base-url").val();
    var btn;
    $.ajax({
        url: "",
        type: 'POST',
        data: {id: id, edit: 'ok'},
        cache: false,
        beforeSend : function()
        {
            btn=$('#edit_btn_'+id).html();
            $('#edit_btn_'+id).html('<img src="'+url+'/protected/extensions/partners/assets/img/ajax-loader.gif" />');
        },
        success: function(data)
        {
            $('#edit_btn_'+id).html(btn);
            var is_ok=data.split ('<!-|respons|->');
            $('#edit').html(is_ok[1]);
            $('#editLink').trigger('click');            
        }
    });
}

function deletePartner(id)
{
    var url=$("#base-url").val();
    var btn;
    $.ajax({
        url: "",
        type: 'POST',
        data: {id: id, delete: 'ok'},
        cache: false,
        beforeSend : function()
        {
            btn=$('#delete_btn_'+id).html();
            $('#delete_btn_'+id).html('<img src="'+url+'/protected/extensions/partners/assets/img/ajax-loader.gif" />');
        },
        success: function(data)
        {
            var is_ok=data.split ('<!-|respons|->');
            if (is_ok[1]=="ok")
            {
                $('#delete_btn_'+id).html(btn); 
                $('#delete_btn_'+id).parent().parent().css('display', 'none'); 
            }
        }
    });
}

