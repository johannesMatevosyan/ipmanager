function aproveTransfer(c_id)
{
    ajaxUrl=rootLink+"/backoffice/service/approvetransfer";    
    $.ajax({
        url: ajaxUrl,
        type: 'POST',
        data: 'c_id='+c_id,
        cache: false,
        success: function(data)
        {
            $('#status_'+c_id).removeAttr('class');                   
            $('#status_'+c_id).addClass('badge');            
            $('#status_'+c_id).addClass('badge-success');            
            $('#status_'+c_id).html(data); 
        }
    });
}

function denyTransfer(c_id)
{
    ajaxUrl=rootLink+"/backoffice/service/denytransfer";
    $.ajax({
        url: ajaxUrl,
        type: 'POST',
        data: 'c_id='+c_id,
        cache: false,
        success: function(data)
        {
            $('#status_'+c_id).removeAttr('class');                
            $('#status_'+c_id).addClass('badge');            
            $('#status_'+c_id).addClass('badge-important'); 
            $('#status_'+c_id).html(data);        
        }
    });
}

function deleteTransfer(c_id)
{
    ajaxUrl=rootLink+"/backoffice/service/deletetransfer";
    $.ajax({
        url: ajaxUrl,
        type: 'POST',
        data: 'c_id='+c_id,
        cache: false,
        success: function(data)
        {
            if (data=="ok")
            {
                $('#status_'+c_id).parent().parent().css('display', 'none');
            }
        }
    });
}

function viewTrainerInvoice(c_id)
{
    ajaxUrl=rootLink+"/backoffice/service/viewtransfer?role=trainer&t_id="+c_id;
    window.open(ajaxUrl,'_blank');
}

function viewMemberInvoice(c_id)
{
    ajaxUrl=rootLink+"/backoffice/service/viewtransfer?role=member&t_id="+c_id;
    window.open(ajaxUrl,'_blank');
}

function downloadMemberInvoice(c_id)
{
    ajaxUrl=rootLink+"/backoffice/service/downloadtransfer?role=trainer&t_id="+c_id;
    window.location=ajaxUrl;
}

function downloadTrainerInvoice(c_id)
{
    ajaxUrl=rootLink+"/backoffice/service/downloadtransfer?role=member&t_id="+c_id;
    window.location=ajaxUrl;
}

function editAmount(amount, id)
{
    $('#amount-money-id').val(amount);
    $('#transfer-id-hidden').val(id);
}

function reAmount()
{
    var id=$('#transfer-id-hidden').val();
    var baseUrl=$('#rootLink').val();
    var balans=$('#amount-money-id').val();
    $.ajax({
      url: baseUrl+"/backoffice/service/editamount",
      type: "POST",
      data: ({id : id, balans: balans}),
      beforeSend : function ()
      {                         
          $('#edit-amount-btn-loader').html('<img id="theImg" src="'+baseUrl+'/themes/backoffice/img/ajax-loader.gif" />');          
      },
      success: function(data)
      {     
          $('#amount-btn-info').html(data);                                       
          $('#edit-amount-btn-loader').html("");
          if (data=="Edit amount success")
          {
              $('#amount-'+id).html(balans); 
              $('#editAmountCloseBtn').trigger('click');
              return true;
          }
      }
   });
}