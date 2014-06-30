Thank you for using Filemanager Extension.

For use:

step 1. Add module/Filemanager folder in your modules directory, extension/filemanager in your project extensions directory

step 2. Add follow code in your main.php config file

	Yii::setPathOfAlias('filemanager', dirname(__FILE__).'/../extensions/flemanager');

return array(
	...
	
	'import'=>array(
	         'ext.filemanager.widgets.*'
	),

	
	'modules'=>array(
		...

               'Filemanager'=>array('defaultController' => 'filemanager'),
	 )

step 3. For use, call in your view
	
    $this->Widget('ext.filemanager.widgets.FManager', 
            array(
                ));    

accepted values - $root_dir, default value - 'themes/frontend/images/';
		 
		   * Path to your files directory, which will root directory in filemanager
		
		 $textbox,  default value - 'tinymce';
      		 
        	   * Takes the following values - xhEditor, tinymce
         	   * using xhEditor, "xhEditor extension" must be connected
       		   * TinyMce upplied with the FileManager extension

Additional 
	You can use filemanager to work with '<input type = "text">' AND <textarea></textarea>
	place them in <div id = "inputs_content"></div>, and add unique id for each of them.

