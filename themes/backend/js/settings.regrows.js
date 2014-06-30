function editStaticData(id, type, name)
{
    ajaxUrl=rootLink+"/backoffice/service/editstaticdatamodal";
    $.ajax({
        url: ajaxUrl,
        type: 'POST',
        data: 'sd_id='+id+'&sd_type='+type+'sd_name='+name,
        cache: false,
        success: function(data)
        {
            if (data!="error")
            {
                $('#status_'+id).html(data);  
            }
        }
    });
}

function editData()
{
    var id=$('#transfer-id-hidden').val();
    var type=$('#transfer-type-hidden').val();    
    var name=$('#edit-name').val();
    var baseUrl=$('#rootLink').val();
    $.ajax({
      url: baseUrl+"/backoffice/service/editstaticdata",
      type: "POST",
      data: ({sd_id : id, sd_type: type, sd_name: name}),
      beforeSend : function ()
      {
          $('#edit-btn-loader').html('<img id="theImg" src="'+baseUrl+'/themes/backoffice/img/ajax-loader.gif" />');          
      },
      success: function(data)
      {
          var pos=data.indexOf('Edit success');
          if (pos!=-1)
          {
              document.getElementById(type+"_"+id).parentNode.parentNode.children[1].innerHTML=name;
              $('#edit-btn-info').html("Edit success");   
              $('#closeBtn').trigger('click');
              return true;
          }
          else
          {
                $('#edit-btn-info').html(data);                                       
          }
          $('#edit-btn-loader').html("");          
      }
   });
}

function addStaticData()
{
    var type=$('#transfer-type-hidden').val();    
    var name=$('#add-name').val();
    var baseUrl=$('#rootLink').val();
    $.ajax({
      url: baseUrl+"/backoffice/service/addstaticdata",
      type: "POST",
      data: ({sd_type: type, sd_name: name}),
      beforeSend : function ()
      {
          $('#add-btn-loader').html('<img id="theImg" src="'+baseUrl+'/themes/backoffice/img/ajax-loader.gif" />');          
      },
      success: function(data)
      {
          var pos=data.indexOf('Added success');
          if (pos!=-1)
          {
              $('#add-btn-info').html("Added success");  
              $('#closeBtn').trigger('click');   
              window.location.href=window.location;
              return true;
          }
          else
          {
                $('#add-btn-info').html(data);                                       
          }
          $('#add-btn-loader').html("");          
      }
   });
}
