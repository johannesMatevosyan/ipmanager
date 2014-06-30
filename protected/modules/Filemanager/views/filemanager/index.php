<script type = "text/javascript">
            var base_url        = "<?php echo Yii::app()->baseUrl.'/';?>";
            window.path_to_request = "<?php echo Yii::app()->baseUrl;?>/Filemanager/filemanager";
            var textbox         = "<?php echo $this->textbox ?>";
            window.root_dir     = "<?php echo $this->root_dir;?>";
            var base_path        = "<?php echo Yii::app()->getBaseUrl(true).'/';?>";
</script>

<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
 
  <script src = "<?php echo Yii::app()->baseUrl;?>/protected/modules/Filemanager/assets/js/script_filemanager.js"></script>  
  
<script>
// overwrite TinyMCE skin setting globally
// as defined in /wire/modules/Inputfields/InputfieldTinyMCE/InputfieldTinyMCE.js
// and loaded before
if('undefined' != typeof InputfieldTinyMCEConfigDefaults) {
  InputfieldTinyMCEConfigDefaults.plugins += ",paste";
  InputfieldTinyMCEConfigDefaults.paste_text_sticky = true;
  InputfieldTinyMCEConfigDefaults.paste_text_sticky_default = true;
}
</script> 
 
<?php
if($this->textbox == 'xhEditor') {

$this->widget('application.components.widgets.XHeditor',array(
        'language'=>'en', //options are en, zh-cn, zh-tw
        'config'=>array(
            'id'=>'xh1',
            'name'=>'xh',
            'tools'=>'fill', // mini, simple, fill or from XHeditor::$_tools
            'width'=>'45%',
        ),
        'contentValue'=>'Enter your text here', // default value displayed in textarea/wysiwyg editor field
        'htmlOptions'=>array('rows'=>5, 'cols'=>10),// to be applied to textarea
    ));
} elseif($this->textbox == 'tinymce') {
 ?>
 <?php $editorHtml = $this->editorHtml?$this->editorHtml: ""; ?>

 <script type = "text/javascript">

    var editorHtml = '<?php echo stripslashes($editorHtml)?>';
console.log(editorHtml); </script>

<script type ="text/javascript">
	tinymce.init({
		selector: "textarea#elm1",
		theme: "modern",
		element_format : "html",
		width:660,
		height: 300,
		relative_urls : false,
		remove_script_host : false,
		//toolbar: 'example',
	
		setup : function(ed) {
		 	ed.on("click", function(ed) {
		 	  delete window.active_input;
		        });
			ed.on('init',function(ed, evt) {
			  tinymce.activeEditor.setContent(editorHtml,{format:  'raw'});	
			});
			ed.addButton('filemanager', {
		         title: 'Insert image',
		    //   image: '../js/tinymce/plugins/example/img/example.gif',
		         icon: 'mce-ico mce-i-image',
		         onclick: function() {
				open_dialog();
		         }
		      });
		},
		plugins:'paste', 
	      	
	      	paste_text_sticky : true,
		paste_text_sticky_default : true,
		forced_root_block : false,
		
		plugins: [
			 "advlist autolink link lists charmap print preview hr anchor pagebreak spellchecker",
			 "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
			 "save table contextmenu directionality emoticons template textcolor"
	   	],
	  	

	   
	   
	   toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview filemanager media fullpage | forecolor backcolor emoticons |", 
	   style_formats: [
			{title: 'Bold text', inline: 'b'},
			{title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
			{title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
			{title: 'Example 1', inline: 'span', classes: 'example1'},
			{title: 'Example 2', inline: 'span', classes: 'example2'},
			{title: 'Table styles'},
			{title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
		]
	 });
 
</script>
<textarea id="elm1" name = "<?php echo $this->name;?>"></textarea>
<?php } ?>

<div id="dialog" title="File Manager">
    
<ul id = "fcpanel">
        <li>
			<a href ="#image_view_popup" role="button" data-toggle="modal"  id ="view_image" onclick="return false;" href ="">View</a>
		</li>
		<li>
                <a id ="download_link" href ="" download="" target="_blank">Download</a>
				</li>
		<li>
                <a id ="delete_link"   onclick="return false;" href ="" javascript>Delete</a>
				</li>
				<li>
                <a id ="upload_link"   onclick="return false;" href ="">Insert To Content </a>
				</li>
				<li>
                <a href="#image_upload_popup" role="button" data-toggle="modal">Upload Images</a>
				</li>        
</ul>
<div class="dirsTable">
<table id ="dirs_table">
	
</table>
</div>

    <ul id ="files">	
	</ul>
</div>

<div id="image_upload_popup" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
    <div id="message_body" class="modal-body saller-form"><div id="mail_massage"></div>
        <h3>Upload Images</h3>
            <div id="upload_image"></div>
    </div>
    <div class="modal-footer" id="message_footer">
        <button class="btn-info" data-dismiss="modal" aria-hidden="true">Close</button>
    </div>
    </div>
</div>

<div id="image_view_popup" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
    <div id="message_body_2" class="modal-body"><div id="mail_massage"></div>
        <h3>View Image</h3>
         
    </div>
    <div class="modal-footer" id="message_footer">
        <button class="btn-info" data-dismiss="modal" aria-hidden="true">Close</button>
    </div>
    </div>
</div>