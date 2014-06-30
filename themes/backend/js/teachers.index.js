function sendMail(email)
{
    var email=$('#email-hidden').val();
    var baseUrl=$('#rootLink').val();
    var msg=$('#email-msg-id').val();
    $.ajax({
      url: baseUrl+"/backoffice/service/sendmail",
      type: "POST",
      data: ({email : email, msg: msg}),
      beforeSend : function ()
      {
          $('#email-btn-loader').html('<img id="theImg" src="'+baseUrl+'/themes/backoffice/img/ajax-loader.gif" />');          
      },
      success: function(data)
      {
          var pos=data.indexOf('Sended Success');
          if (pos!=-1)
          {
              $('#email-btn-info').html("Sended Success");   
              $('#closeBtn').trigger('click');
              return true;
          }
          else
          {
                $('#email-btn-info').html(data);                                       
          }
          $('#email-btn-loader').html("");          
      }
   });
}

function showUser(id)
{
    ajaxUrl=rootLink+"/profile/profile/"+id;
    window.open(ajaxUrl,'_blank');    
}

function deleteUser(id)
{
    ajaxUrl=rootLink+"/backoffice/service/deleteuser";
    $.ajax({
        url: ajaxUrl,
        type: 'POST',
        data: 'u_id='+id,
        cache: false,
        success: function(data)
        {
            if (data=="ok")
            {
                $('#email_status_'+id).html('Deleted');
                $('#email_status_'+id).removeAttr('class');   
                $('#email_status_'+id).addClass('badge');    
                $('#email_status_'+id).addClass('badge-important');   
            }
        }
    });
}
