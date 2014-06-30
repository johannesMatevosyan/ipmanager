<?php
    class FManager extends CWidget
    {
        public $root_dir  = 'images/';
        /*
         * Path to your files directory, which will root directory in filemanager
         */
        public $textbox   = 'tinymce';
		
		public $editorHtml = '';    
        public $name       = 'Articles[metaDesc]';
        
        /* textbox property
         * takes the following values - xhEditor, tinymce
         * using xhEditor, "xhEditor extension" must be connected
         * TinyMce upplied with the FileManager(our) extension
         */
        
        public function init()
        {
		$base_url = Yii::app()->baseUrl;
            Yii::app()->clientScript->registerScriptFile($base_url.'/protected/extensions/filemanager/tinymce/js/tinymce.min.js');
            Yii::app()->clientScript->registerScriptFile($base_url.'/protected/modules/Filemanager/assets/js/imageupload.js');
            Yii::app()->clientScript->registerCssFile($base_url.'/protected/modules/Filemanager/assets/css/file_manager_style.css');   
        }
        public function run()
        {
		     $base_path = Yii::getPathOfAlias('webroot');
             $this->renderInternal($base_path.'/protected/modules/Filemanager/views/filemanager/index.php',array('root_dir'=>$this->root_dir));
        }
    }
?> 