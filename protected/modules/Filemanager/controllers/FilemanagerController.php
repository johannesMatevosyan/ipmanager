<?php

class FilemanagerController extends Controller
{
//	public function actionIndex()
//	{
//            $this->renderPartial('index');
//            if(isset($_POST['xh'])) {
//            }
//	}
        
        public function actionGet_dirs_and_files()
        {
             if(isset($_POST['path'])) {
                $path = $_POST['path'];
                $directories = explode('/',$path);
                $directories = array();
                $files       = array();
                $directory   = new DirectoryIterator($path);
                if($directory) {
                    $i = $j = 0;
                    foreach ($directory as $file) {
                        if($file->isDot()) {
                            continue;
                        }
                        elseif($file->isDir()) {
                            $directories[$j]['name'] = $file->getFilename();
                            $directories[$j]['path'] = $file->getPathname();
                            $j++;
                        }
                        elseif($file->isFile()) {
                            $files[$i]['name'] = $file->getFilename();
                            $files[$i]['path'] = $file->getPathname();
                            $i++;
                        }
                    }
                }
                $json_array = array('directories'=>$directories,'files'=>$files);
                print_r(json_encode($json_array));
                die();
            }
        }
        
        publiC function actionFile_uploader()
        {
            if(isset($_FILES['file'])) { 
                $i = 0;
               $dir = $_POST['file']['dir'];
               $dir = Yii::getPathOfAlias('webroot'). '/' .$dir .'/';
                foreach($_FILES['file']['name'] as $k => $f) {
                   if (!$_FILES['file']['error'][$k]) {
                        if (is_uploaded_file($_FILES['file']['tmp_name'][$k])) {
                            $file_type = explode('.',$_FILES['file']['name'][$k]);
                            $file_type = end($file_type);
                            $file_path = $dir . uniqid() . '.' . $file_type;
                            if(!move_uploaded_file($_FILES['file']['tmp_name'][$k], $file_path))
                                die();
                            else 
                             echo 1;  
                        }
                    }
                }
            }
            echo $i;
        }
        
        public function actionDelete_file()
        {
            if(isset($_POST['delete']))
               unlink(Yii::getPathOfAlias('webroot').$_POST['delete']);
        }
}