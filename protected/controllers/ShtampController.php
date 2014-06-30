<?php

class ShtampController extends Controller
{
    /**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		//$this->render('index');
	}

	public function actionGetShtampsByCategory($category)
	{
		$message = NULL;
		if(isset($_POST['OrderModel'])) {
			$model = new OrderModel();

			$model->attributes = $_POST['OrderModel'];
			$model->date =  new CDbExpression('NOW()');
			if($model->validate()) {
				 if(isset($_FILES['OrderModel']['name']['mainfile_path']))  {
	             	$file['type'] = $_FILES['OrderModel']['name']['mainfile_path'];
	        		$file['type'] = end(explode('.',$file['type']));
					if($file['type'] == 'php' || $file['type'] == 'htaccess' || $file['type'] == 'exe' || $file['type'] == 'js') {
            			echo 'Ваши действия не законны, в случае повторения ваши данные будут отправленны в спецотдел'; die;
            		}

	        		$file['name'] = uniqid().'.'.$file['type'];
	            	if(move_uploaded_file($_FILES['OrderModel']['tmp_name']['mainfile_path'], Yii::getPathOfAlias('webroot').'/images/orders/mainfiles/'.$file['name'])) {
	                	$model->mainfile_path = $file['name'];
	             	}
		        }
		        
		        if(isset($_FILES['OrderModel']['name']['file_path']))  {
	             	$file['type'] = $_FILES['OrderModel']['name']['file_path'];
	        		$file['type'] = end(explode('.',$file['type']));
	        		if($file['type'] == 'php' || $file['type'] == 'htaccess' || $file['type'] == 'exe' || $file['type'] == 'js') {
            			echo 'Ваши действия не законны, в случае повторения ваши данные будут отправленны в спецотдел'; die;
            		}	
	        		$file['name'] = uniqid().'.'.$file['type'];
	            	
	            	if(move_uploaded_file($_FILES['OrderModel']['tmp_name']['file_path'], Yii::getPathOfAlias('webroot').'/images/orders/additionalfiles/'.$file['name'])) {
	                	$model->file_path = $file['name'];
	             	}
		        }
		        $model->insert();
				$pechat_info    = ShtampsModel::model()->findByPk($model->pechat_id);
				$osnastka_info = OsnastkiModel::model()->findByPk($model->osnastka_id);
				$massage = '<html><head></head>
				<body><table style = "width:700px;"><tbody>
						<tr><td>ФИО</td><td>'.$model->fio.'</td></tr>
						<tr><td>Печать</td><td><img  width = 100px; height = 100px; src = "'.Yii::app()->getBaseUrl(true).'/images/pechati/'.$pechat_info->image_path.'"></td></tr>
						<tr><td>Оснастка</td><td><img width = 100px; height = 100px; src = "'.Yii::app()->getBaseUrl(true).'/images/osnastki/'.$osnastka_info->image_path.'"></td></tr>
						<tr><td>Телефон</td><td>'.$model->phone.'</td></tr>
						<tr><td>Дата</td><td>'.date('Y-m-d H:i:s').'</td></tr>';
						if($model->mainfile_path) {
							$massage .= '<tr><td>Прикрепленный Файл</td><td><a href = "'.Yii::app()->getBaseUrl(true).'/images/orders/mainfiles/'.$model->mainfile_path.'">Скачать</a></td></tr>';
						}
						if($model->file_path) {
							$massage .= '<tr><td>Дополнительный Файл</td><td><a href = "'.Yii::app()->getBaseUrl(true).'/images/orders/additionalfiles/'.$model->file_path.'">Скачать</a></td></tr>';
						}
					$massage .'</tbody>
				</table></body>';
				$headers ="MIME-Version: 1.0 \r\n";
				$headers.="Content-type: text/html; charset=\"UTF-8\" \r\n";
				mail(ADMIN_MAIL_ADDRESS, 'Заказ печати на сайте', $massage, $headers);
					
				$message = 1;
			} else {
				$message = $model->getErrors();
			}		
		}
		$pageInfo = ShtampCategoryModel::model()->findByAttributes(array('link'=>$category));
		$shtamps  = ShtampsModel::model()->findAllByAttributes(array('category_id'=>$pageInfo->Id));
		$osnastki = OsnastkiModel::model()->findAllByAttributes(array('category_id'=>$pageInfo->Id));
		$this->render('pechati_list', array('pageInfo'=>$pageInfo, 'shtamps'=>$shtamps, 'osnastki'=>$osnastki, 'message'=>$message));
	}

	public function actionRecovery()
	{
		$message = NULL;
		$model 	 = new RecoveryModel();

		if(isset($_POST['RecoveryModel'])) {
			$model->attributes = $_POST['RecoveryModel'];
			$model->date 	   = new CDbExpression('NOW()');
			if($model->validate()) {
				$file['type'] = $_FILES['RecoveryModel']['name']['mainfile_path'];
            	$file['type'] = end(explode('.',$file['type']));
            	if($file['type'] == 'php' || $file['type'] == 'htaccess' || $file['type'] == 'exe' || $file['type'] == 'js') {
            		echo 'Ваши действия не законны, в случае повторения ваши данные будут отправленны в спецотдел'; die;
            	}

            	$file['name'] = uniqid().'.'.$file['type'];
	            if(move_uploaded_file($_FILES['RecoveryModel']['tmp_name']['mainfile_path'], Yii::getPathOfAlias('webroot').'/images/recovery/ottisk/'.$file['name'])) {
	                $model->mainfile_path = $file['name'];
				}	          

	            if(isset($_FILES['RecoveryModel']['name']['certificate_path']))  {
	             	$file['type'] = $_FILES['RecoveryModel']['name']['certificate_path'];
            		$file['type'] = end(explode('.',$file['type']));
            		if($file['type'] == 'php' || $file['type'] == 'htaccess' || $file['type'] == 'exe' || $file['type'] == 'js') {
            			echo 'Ваши действия не законны, в случае повторения ваши данные будут отправленны в спецотдел'; die;
            		}
            		$file['name'] = uniqid().'.'.$file['type'];
	            	if(move_uploaded_file($_FILES['RecoveryModel']['tmp_name']['certificate_path'], Yii::getPathOfAlias('webroot').'/images/recovery/certificate/'.$file['name'])) {
	                	$model->certificate_path = $file['name'];
	             	}
	         	}
                $model->insert();

				$massage = '<html><head></head>
				<body><table style = "width:700px;"><tbody>
						<tr><td>ФИО</td><td>'.$model->fio.'</td></tr>
						<tr><td>Эл. Почта</td><td>'.$model->email.'</td></tr>
						<tr><td>Телефон</td><td>'.$model->phone.'</td></tr>
						<tr><td>Дата</td><td>'.date('Y-m-d H:i:s').'</td></tr>';
						if($model->mainfile_path) {
							$massage .= '<tr><td>Файл с Оттисками</td><td><a href = "'.Yii::app()->getBaseUrl(true).'/images/recovery/ottisk/'.$model->mainfile_path.'">Скачать</a></td></tr>';
						}
						if($model->certificate_path) {
							$massage .= '<tr><td>Копия Сертификата</td><td><a href = "'.Yii::app()->getBaseUrl(true).'/images/recovery/certificate/'.$model->certificate_path.'">Скачать</a></td></tr>';
						}
					$massage .'</tbody>
				</table></body>';
				$headers ="MIME-Version: 1.0 \r\n";
				$headers.="Content-type: text/html; charset=\"UTF-8\" \r\n";
				mail(ADMIN_MAIL_ADDRESS, 'Заказ печати на сайте', $massage, $headers);
				
				$message = 1;
			} else {
				$message = $model->getErrors();
			}
		}

		$this->render('recovery', array('model'=>$model, 'message'=>$message));
	}
	
}