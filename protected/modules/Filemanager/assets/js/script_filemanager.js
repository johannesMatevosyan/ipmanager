   window.textboxObject = '';    
  
   window.iframe_id     = '';
   //if(textbox == 'xhEditor') {
        window.textboxObject = $("#xhEdt0_iframe").contents().find("#editModeTextarea");
        window.iframe_id = 'xhEdt0_iframe';
   //} else if(textbox == 'tinymce') {
        window.textboxObject = $("#elm1_ifr").contents().find("#tinymce");
        window.iframe_id = 'elm1_ifr';
  // }

$(function(){
   $('input.filemanager_box, textarea.filemanager_box').live('click',function(){
        window.active_input = $(this).attr('id');
   });
    // tinymceFunc(function(){
	//alert("aaa")
		//tinymce.activeEditor.setContent('123456');
   //});
	  /* $('#elm1_ifr').onload(function(){
				tinymce.activeEditor.setContent('123456');
		});*/
      
});

function open_dialog()
{
    window.textboxObject.focus();    
    $("#dialog").dialog();
    getDirsAndFiles(window.root_dir);
	//tinymce.activeEditor.setContent('123456');
}

function clear_list()
{
    $('#img-list').html('');
}

function getCaret(el) { 
  if (el.selectionStart) { 
    return el.selectionStart; 
  } else if (document.selection) { 
    el.focus(); 
 
    var r = document.selection.createRange(); 
    if (r == null) { 
      return 0; 
    } 
 
    var re = el.createTextRange(), 
        rc = re.duplicate(); 
    re.moveToBookmark(r.getBookmark()); 
    rc.setEndPoint('EndToStart', re); 
 
    return rc.text.length; 
  }  
  return 0; 
}

function getDirsAndFiles(url)
{
       $.ajax({
       'type':'post',
       'url':window.path_to_request + '/get_dirs_and_files',
       'data':{'path':url},
       success: function(data) {
        // get and parse json array of directories and files
           var obj   = jQuery.parseJSON(data); 
           var dirs  = obj.directories; 
           var files = obj.files;
           //path - dirs(if exist, else filepath) use in data-path attribute of each files and dirs.
           var path  = '';
                if(typeof dirs[0] != 'undefined'){
                    if(typeof dirs[0].path != 'undefined') {
                        path  = dirs[0].path;
                    }
                } else if(typeof files[0] != 'undefined') { 
                            if( typeof files[0].path != 'undefined'){    
                                path  = files[0].path;
                            }
                  }
                var count = 0;
                if(path) {
                     for(var i = 0; i < path.length; i++) {
                          if(path[i] == '\\') {
                              count++;
                          }
                     }
                     for(var i = 0; i < count; i++) {
                      //make path standart, replacing double backslash on standart.
                          path = path.replace('\\','/');
                     }
                    path = path.split('/'); 
                
              // take the last elemenet of root dir path, which is the root folder of filemanager. 
               var root_directory = window.root_dir.split('/');
               //insert on filemanager(first position) root directory folder.
               $('#dirs_table').html('<tr class = "directory" data-path ="' + window.root_dir + '" ><td><input type ="image"  src = "' + base_url + 'protected/modules/Filemanager/assets/images/rsz_1folder.png">' + root_directory[root_directory.length-2] +'</td></tr>');
              //parent_fldr all folders, whish is the parents of current folder.
			 var parent_fldr = '';
                for (var i = 1; i < path.length - 1; i++) {
                   for (var j = 1; j < i; j++) { 
                        if( path[j] !== root_directory[root_directory.length-1] && parent_fldr.indexOf(path[j]) == -1 ) {
                           parent_fldr += path[j];
                           parent_fldr += '/';
                        }
                   }
                    
                  $('#dirs_table').append('<tr class = "directory" data-path ="' + root_dir + parent_fldr + path[i] + '"><td style = "padding-left:' + i*10 + 'px"><input type ="image"   src = "' + base_url + 'protected/modules/Filemanager/assets/images/rsz_1folder.png">' + path[i] + '</td></tr>');
               }
   	
                for(key in dirs) {
                  //padding - folder td content distance of left border, use to the visual perception of a folder tree
                    var padding = path.length - 1;
                     $('#dirs_table').append('<tr class = "directory"  data-path = "' + dirs[key].path + '" ><td style ="padding-left:' + padding*10 + 'px"><input type ="image"  src = "' + base_url + 'protected/modules/Filemanager/assets/images/rsz_1folder.png">' + dirs[key].name + '</td></tr>');
                 }

                 //clear all former files.
                $('#files').html('');
                var path_to_file = '/';
                for(var i = 0; i < path.length - 1; i++) { 
                    path_to_file += path[i];
                    path_to_file += '/';
                }
              
                for(key in files) {
                    
                     var exploded  = files[key].name.split('.');
                     var arr_length = exploded.length;
                     var extension = exploded[arr_length - 1];
                     var image_src = 'jjj';
                     var type = 0;
                     if(extension == 'jpeg' || extension == 'jpg' || extension == 'png' || extension == 'gif') {
                        image_src = path_to_file + files[key].name ;
                        type = 1;
                     } else {
                        image_src = base_url +  "protected/modules/Filemanager/assets/images/file.png";
                     }
                   $('#files').append('<li class = "file_item" data-file-type = "' + type + '" data-file-path = "' + path_to_file + files[key].name + '"><input type ="image"  width ="140" height ="90" src = "' + image_src + '"><br>' + files[key].name + '</li>');
                }
       }
     }
    });
 }
 
$(function(){
//alert(base_url);
    window.href = '';
    window.dir_path = window.root_dir;
  
    $("#upload_image").imageUpload(window.path_to_request + '/file_uploader', {
        uploadButtonText: "Upload",
        previewImageSize: 50,
        onSuccess: function (response) {
          //you can add your code here, image upload success callback
        }
    });
	

   
    $('.directory').live('click', function(){
        url = $(this).data('path');
        getDirsAndFiles(url);
    });
 
     $("#view_image").live('click', function(){
         
         if(window.href == '') {
             $('#message_body_2').html('Please Select Image');
         } else {
            var image_name = window.href.split('/');
            image_name = image_name[image_name.length-1];
            var base_path = base_url.slice(0,-1);

             $('#message_body_2').html('<img src ="' + base_path + window.href + '"><span>' + image_name + '</span>');
         }
   });

   $('.directory').live('click', function(){
        window.dir_path = $(this).data('path');
    });
    $('.file_item').live('click', function(){
        $('.file_item').css('background-color', 'inherit');
        $(this).css('background-color', '#B3E3FC');
        window.type = $(this).data('fileType');
        window.href = $(this).data('filePath');      
        $('#download_link').attr('href',base_url + window.href);
        $('#download_link').attr('download',$(this).text());
        $('#delete_link').attr('href',window.href);
        $('#upload_link').attr('href',base_path+window.href);
    });
    
    $('#delete_link').live('click',function(){
      if(confirm('This image use in textbox, are you sure delete it?')) {
                $.ajax({
           'type':'post',
           'url':window.path_to_request + '/delete_file',
           'data':{'delete':window.href},
           success:function(data){
               getDirsAndFiles(window.dir_path);
               window.href = '';
           }
         });
        }
     });
        /*tinyMCE.execCommand;
       tinymce.RemoveNode('<img src="'+ base_url + window.href +'" alt="" />');
      break;

          bool = true;
        if(typeof(window.active_input) != 'undefined') { 
            var exist_val = $('#' + window.active_input).val();
          if(exist_val.indexOf(window.href) != -1)
             if(confirm('This image use in textbox, are you sure delete it?')) {

            while(exist_val.indexOf(window.href) != -1) {
                  //cut all copy of selected( must be deleted) image
                    var image_url    = base_url + window.href;
                    var cut_start    = exist_val.indexOf(image_url);
                    var cut_end      = cut_start + image_url.length;
                    var end_text     = exist_val.substr(cut_end ,exist_val.length);
                    var start_text   = exist_val.substr(0,cut_start);
                    var ended_value  = start_text + end_text;
                    alert(ended_value);
                  $('#' + window.active_input).val( start_text + end_text);
                  exist_val = $('#' + window.active_input).val();
           }
          } else bool = false;
          
        } else {
        
        var editor_text = window.textboxObject.html();
        if(typeof(editor_text) != 'undefined')
          //check availability image in editor
        if(editor_text.indexOf(window.href) != -1) {
             if(confirm('This image use in editor, are you sure delete it?')) {
                     bool = true;
             
                while(editor_text.indexOf(window.href) != -1) {
                  //cut all copy of selected( must be deleted) image
                    var cut_start    = editor_text.indexOf(base_url) - 10;
                    var cut_end      = cut_start + window.href.length + base_url.length + 14;
                    var end_text     = editor_text.substr(cut_end + 1,editor_text.length);
                    var start_text   = editor_text.substr(0,cut_start);
                    var editor_value = start_text + end_text;
                    window.textboxObject.html(editor_value);
                    editor_text = window.textboxObject.html();
                }
            } else bool = false;
        }
      }
        if(bool) {

        }*/

    $('#upload_link').live('click', function(){ 
       
        var current_position = 0;
        //in the case where .filemanager_box is selected
         if(typeof(window.active_input) != 'undefined') {
            var exist_val = $('#' + window.active_input).val();
          
          var input_value = $('#' + window.active_input).val();
          //caret position in .filemanager_box
          var current_position = getCaret(document.getElementById(window.active_input));

          var end_text     = exist_val.substr(current_position,exist_val.length);
          var start_text   = exist_val.substr(0,current_position);
          $('#' + window.active_input).val( start_text + base_url + window.href + end_text);
        } else 
          //work with editor, .filemanager_box not selected, or not exists
          {
            window.textboxObject = '';
            window.iframe_id     = '';
            if(textbox == 'xhEditor') {
                   window.textboxObject = $("#xhEdt0_iframe").contents().find("#editModeTextarea");
                   window.iframe_id = 'xhEdt0_iframe';
            } else if(textbox == 'tinymce') {
                   window.textboxObject = $("#elm1_ifr").contents().find("#tinymce");
                   window.iframe_id = 'elm1_ifr';
              }       


          if(typeof(window.textboxObject.html()) != 'undefined') 
          var editor_length    = window.textboxObject.html().length;
          var current_position = 0;
          if(window.type) {
            if(textbox == 'tinymce') {
            //insert image in cursor pisition
			//alert(base_url);
			//alert(window.href);
			
            tinyMCE.execCommand('mceInsertRawHTML',false, '<img src="'+  base_path + window.href +'" alt=""/>');
          
          } else {
              var framecontent = '';
              //get caret position in editor
             if( typeof(document.getElementById(window.iframe_id).contentWindow.getSelection()) != 'undefined') { 
                  if( typeof(document.getElementById(window.iframe_id).contentWindow.getSelection().getRangeAt(0)) != 'undefined') {
                      var range = document.getElementById(window.iframe_id).contentWindow.getSelection().getRangeAt(0);
                      current_position = range.startOffset;
                      if(textbox == 'tinymce') 
                        framecontent = tinymce.activeEditor.getContent();
                      else  
                        framecontent = window.textboxObject.html();
                  }
             }
              var value_textarea = framecontent.substr(0, current_position);
              value_textarea += '<img src = "' + base_url + window.href +'">';
              value_textarea += framecontent.substr(current_position, framecontent.length);
              window.textboxObject.html(value_textarea);
          } 
            } else {
              alert('Files such extensions are not allowed to use in the editor');
          }
        }
    });
});