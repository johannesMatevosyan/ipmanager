<?php

class AdminController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='main';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
/*	public function accessRules()
	{
		return array(
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index'),
				'users'=>array('@'),
                'expression'=>"Yii::app()->user->role.' == admin'",
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
*/
    public function actionIndex()
    {
        $this->render('index');

    }
    public function actionOrders()
    {
        $orders     = new CActiveDataProvider('OrderModel');
        $recoveries = new CActiveDataProvider('RecoveryModel'); 
        $this->render('orders', array('orders'=>$orders, 'recoveries'=>$recoveries));
    }

    public function actionShtamps()
    {
       
        $shtampCategories = ShtampCategoryModel::model()->findAll();
        $this->render('shtamps', array('shtampCategories' => $shtampCategories));
    }

    public function actionDeleteItem()
    {
        if(isset($_GET['deleteShtampId'])) {
            ShtampsModel::model()->deleteByPk($_GET['deleteShtampId']);        
        } elseif(isset($_GET['deleteOsnastkiId']))   {
            OsnastkiModel::model()->deleteByPk($_GET['deleteOsnastkiId']);        
        }   
       $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionGetShtampData($category)
    {
        if(isset($_POST['page'])) {
          Yii::app()->db
                   ->createCommand("UPDATE tbl_shtamp_category SET name =:name, link =:link, description =:description, title =:title, metaKey =:metaKey, metaDesc = :metaDesc WHERE (Id=:id)")
                   ->bindValues(array(':id'=>$_POST['page']['page_id'],':name'=>$_POST['page']['name'],':link'=>$_POST['page']['link'], ':description'=>$_POST['page']['description'], ':title'=>$_POST['page']['title'], ':metaKey'=>$_POST['page']['metaKey'],  ':metaDesc'=>$_POST['page']['metaDesc']))
                   ->execute(); 
   
        }

        if(isset($_POST['ShtampsModel'])) {
            $postData = $_POST['ShtampsModel'];
            $alts   = $postData['alt'];
            $titles = $postData['title'];
            $price  = $postData['price'];
            foreach ($alts as $key => $value) {
                Yii::app()->db
                   ->createCommand("UPDATE `tbl_shtamps` SET alt =:alt, title =:title, price =:price WHERE (id=:id)")
                   ->bindValues(array(':id'=>$key,':alt'=>$value,':title'=>$titles[$key], ':price'=>$price[$key]))
                   ->execute();         

            }
        }

        if(isset($_POST['OsnastkiModel'])) {
            $postData = $_POST['OsnastkiModel'];
            $alts   = $postData['alt'];
            $titles = $postData['title'];
            $price  = $postData['price'];
            foreach ($alts as $key => $value) {
                Yii::app()->db
                   ->createCommand("UPDATE `tbl_osnastki` SET alt =:alt, title =:title, price =:price WHERE (id=:id)")
                   ->bindValues(array(':id'=>$key,':alt'=>$value,':title'=>$titles[$key], ':price'=>$price[$key]))
                   ->execute();         

            }
        }


        $pageInfo = ShtampCategoryModel::model()->findByAttributes(array('Id'=>$category));
        $shtamps  = ShtampsModel::model()->findAllByAttributes(array('category_id'=>$pageInfo->Id));
        $osnastki = OsnastkiModel::model()->findAllByAttributes(array('category_id'=>$pageInfo->Id));
        $this->render('pechat_list', array('pageInfo'=>$pageInfo, 'shtamps'=>$shtamps, 'osnastki'=>$osnastki));
    }

    public function actionArticles()
	{
		
		//$this->render('test');
	
        $model = new Articles('search');
        $model->unsetAttributes();

        if(isset($_POST['Articles']))
        {
            $postArticles = $_POST['Articles'];
            $model->attributes = $postArticles;
        }
        
        $this->render('articles',array(
            'dataProvider'=>$model->search(),
            'model'=>$model,
        ));
	}

    public function actionDeleteOrder()
    {
        if(isset($_GET['deleteOrder'])) {
            OrderModel::model()->deleteByPk($_GET['deleteOrder']);
            $this->redirect(Yii::app()->request->urlReferrer);
        
        } elseif(isset($_GET['deleteRecovery'])) {
            RecoveryModel::model()->deleteByPk($_GET['deleteRecovery']);
            $this->redirect(Yii::app()->request->urlReferrer);
        }

    }
    public function actionGetOrderData()
    {
        if(isset($_POST['id'])) {
            $id = $_POST['id'];
            $orderInfo    = OrderModel::model()->findByPk($id);
            $pechatInfo   = ShtampsModel::model()->findByPk($orderInfo->pechat_id);
            $osnastkaInfo = OsnastkiModel::model()->findByPk($orderInfo->osnastka_id);    

            $images = array('pechat'=>$pechatInfo->image_path, 'osnastka'=>$osnastkaInfo->image_path);
            $info   = array('orderInfo'=>$orderInfo->attributes, 'images'=>$images);
            echo json_encode($info); die(); 
        }
    }

    public function actionGetRecoveryData()
    {
        if(isset($_POST['id'])) {
            $id = $_POST['id'];
            $info = RecoveryModel::model()->findByPk($id);
            echo json_encode(array('info'=>$info->attributes)); die();

        }
    }
    
	public function actionViewGallery($deleteId = NULL)
	{
        if(isset($_POST['SliderImages'])){
            $postData = $_POST['SliderImages'];
            $alts   = $postData['alt'];
            $titles = $postData['title'];
            foreach ($alts as $key => $value) {
                Yii::app()->db
                   ->createCommand("UPDATE stbl_slider_images SET alt =:alt, title =:title WHERE (id=:id)")
                   ->bindValues(array(':id'=>$key,':alt'=>$value,':title'=>$titles[$key]))
                   ->execute();         

            }
        }
        if($deleteId) {
            SliderImages::model()->deleteByPk($deleteId);
        }
        $sliderImages = new CActiveDataProvider('SliderImages');
        $this->render('view_gallery', array('sliderImages'=>$sliderImages));
	}

    public function actionDeleteLetter($letter){
        ContContacts::model()->deleteByPk($letter);
         $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionAddOsnastka($category)
    {
        $osnastka = new OsnastkiModel();
       
        if(isset($_FILES['OsnastkiModel'])){
            $file['type'] = $_FILES['OsnastkiModel']['name'][0];
            $file['type'] = end(explode('.',$file['type']));
            $file['name'] = uniqid().'.'.$file['type'];
            if(move_uploaded_file($_FILES['OsnastkiModel']['tmp_name'][0], Yii::getPathOfAlias('webroot').'/images/osnastki/'.$file['name'])) {
                $osnastka->image_path = $file['name'];
                if(isset($_POST['OsnastkiModel']['alt'])){
                    $osnastka->alt = $_POST['OsnastkiModel']['alt'];
                }
                if(isset($_POST['OsnastkiModel']['title'])){
                    $osnastka->title = $_POST['OsnastkiModel']['title'];
                }
                if(isset($_POST['OsnastkiModel']['name'])){
                    $osnastka->name = $_POST['OsnastkiModel']['name'];
                }
                if(isset($_POST['OsnastkiModel']['price'])){
                    $osnastka->price = $_POST['OsnastkiModel']['price'];
                }
                $osnastka->category_id = $_POST['OsnastkiModel']['category_id'];
              //  echo '<pre>'; print_r($_POST['OsnastkiModel']); die;
                $osnastka->insert();
        $this->redirect(Yii::app()->createUrl('/admin/admin/getShtampData', array('category'=>$_POST['ShtampsModel']['category_id'])));
                //$this->redirect(Yii::app()->createUrl('/admin/admin/viewGallery'));
            }
        }
        $this->render('new_osnastka_form', array('osnastka'=>$osnastka, 'category'=>$category));
    }

    public function actionAddShtamp($category)
    {
        $shtamp = new ShtampsModel();
       
        if(isset($_FILES['ShtampsModel'])) {
            $file['type'] = $_FILES['ShtampsModel']['name'][0];
            $file['type'] = end(explode('.',$file['type']));
            $file['name'] = uniqid().'.'.$file['type'];
            if(move_uploaded_file($_FILES['ShtampsModel']['tmp_name'][0], Yii::getPathOfAlias('webroot').'/images/pechati/'.$file['name'])) {
                $shtamp->image_path = $file['name'];
                if(isset($_POST['ShtampsModel']['alt'])){
                    $shtamp->alt = $_POST['ShtampsModel']['alt'];
                }
                if(isset($_POST['ShtampsModel']['title'])){
                    $shtamp->title = $_POST['ShtampsModel']['title'];
                }
                if(isset($_POST['ShtampsModel']['name'])){
                    $shtamp->name = $_POST['ShtampsModel']['name'];
                }
                if(isset($_POST['ShtampsModel']['price'])){
                    $shtamp->price = $_POST['ShtampsModel']['price'];
                }
                $shtamp->category_id = $_POST['ShtampsModel']['category_id'];
              //  echo '<pre>'; print_r($_POST['OsnastkiModel']); die;
                $shtamp->insert();
                $this->redirect(Yii::app()->createUrl('/admin/admin/getShtampData', array('category'=>$_POST['ShtampsModel']['category_id'])));
            }
        }
        $this->render('new_shtamp_form', array('shtamp'=>$shtamp, 'category'=>$category));
    }


    public function actionAddShtampCategory()
    {
        $shtampCategory = new ShtampCategoryModel();
        if(isset($_POST['ShtampCategoryModel'])){
            $shtampCategory->attributes = $_POST['ShtampCategoryModel'];
            $shtampCategory->description = addslashes($shtampCategory->description);
            $shtampCategory->insert();
            $this->redirect(Yii::app()->createUrl('admin/admin/shtamps'));
        }
        $this->render('shtamp_category_form', array('shtampCategory'=>$shtampCategory));
    }
    
    public function actionAddImage()
    {
        $sliderImage = new SliderImages();
        
        if(isset($_FILES['GalleryImages'])){
            $file['type'] = $_FILES['GalleryImages']['name'][0];
            $file['type'] = end(explode('.',$file['type']));
            $file['name'] = uniqid().'.'.$file['type'];
            if(move_uploaded_file($_FILES['GalleryImages']['tmp_name'][0], Yii::getPathOfAlias('webroot').'/images/slider/'.$file['name'])) {
                $sliderImage->imagePath = $file['name'];
                if(isset($_POST['SliderImages']['alt'])){
                    $sliderImage->alt = $_POST['SliderImages']['alt'];
                }
                if(isset($_POST['SliderImages']['title'])){
                    $sliderImage->title = $_POST['SliderImages']['title'];
                }
                $sliderImage->insert();
                $this->redirect(Yii::app()->createUrl('/admin/admin/viewGallery'));
            }
        }
        //die();
        $this->render('addimage', array('sliderImage'=>$sliderImage));
    }

    public function actionDeleteArticle()
    {
        $ok = 1;
        $massage = '';
        
        if(Yii::app()->request->isAjaxRequest && isset($_GET['id']))
        {
            $id = $_GET['id'];
            $model=$this->loadArticleModel($id);
            ActionsClass::deleteImage($model->articleImageName, $model->articleImagePath);
            
            if($model->delete())
            {
                $ok = 1;
                $massage = 'Մեքենան ջնջված է';
            }
            else
            {
                $ok = 2;
                $massage = 'Սխալ!!! Մեքենան չի ջնջվել';
            }
            $result = array('ok'=>$ok, 'massage'=>$massage);
            echo json_encode($result);die;
        }
        else throw new CHttpException(400,'Հաաաաաաաաաայ, հաաաաաաաաաաաա՜՜՜՜՜՜յ');
    }

    public function actionPages($page_id = 1)
    {
       $pageModel = new Pages();
       if(isset($_POST['Pages'])) {
            $pageModel->attributes = $_POST['Pages'];
            if($pageModel->validate())
               Yii::app()->db
                   ->createCommand("UPDATE stbl_pages SET metaKey =:metaKey, metaDesc =:metaDesc, PageContent =:PageContent, PageName = :PageName,  PageTitle =:PageTitle WHERE (id=:id)")
                   ->bindValues(array(':id'=>$pageModel->Id,':metaKey'=>$pageModel->metaKey,':metaDesc'=>$pageModel->metaDesc,':PageName'=>$pageModel->PageName, ':PageContent'=>addslashes($pageModel->PageContent),':PageTitle'=>$pageModel->PageTitle,))
                   ->execute();
       }

       $pageData = Pages::model()->findByPk($page_id);
       $this->render('pages', array('pageModel'=>$pageModel,'page_id'=>$page_id, 'pageData'=>$pageData));
    }
    
    public function actionDeleteImage()
	{
        $ok = 1;
        $massage = '';
        if(Yii::app()->request->isAjaxRequest && isset($_GET['name']))
        {
            $name = $_GET['name'];
                        
            if(ActionsClass::deleteImage($name, 'images.gallery'))
            {
                $ok = 1;
                $massage = 'image deleted';
            }
            else
            {
                $ok = 2;
                $massage = 'Սխալ!!! Մեքենան չի ջնջվել';
            }
            $result = array('ok'=>$ok, 'massage'=>$massage);
            echo json_encode($result);die;
        }
        else throw new CHttpException(400,'Հաաաաաաաաաայ, հաաաաաաաաաաաա՜՜՜՜՜՜յ');
	}
	    
    public function actionActivateArticle()
    {
        if(Yii::app()->request->isAjaxRequest && isset($_GET['id']))
        {
            $id = $_GET['id'];
            $ok = 0;
            $massage = '';
            
            $connection = Yii::app()->db;
            $sql = "UPDATE `stbl_articles`
                    SET `articleActive`=IF(`articleActive`='1','0',IF(`articleActive`='0','1',`articleActive`))
                    WHERE `IdArticles`='".$id."'";
            
            if($connection->createCommand($sql)->execute())
            {
                $ok = 1;
                $massage = 'Գովազդատույի կարգավիճակը փոխված է';
            }
            else
            {
                $ok = 2;
                $massage = 'Սխալ!!! Գովազդատուի կարգավիճակը չի փոխվել';
            }
            $result = array('ok'=>$ok, 'massage'=>$massage);
            echo json_encode($result);
        }
        else throw new CHttpException(400,'Հաաաաաաաաաայ, հաաաաաաաաաաաա՜՜՜՜՜՜յ');
    }
    
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadArticleModel($id),
		));
	}

	public function actionCreateArticle()
	{
		$model=new Articles;		

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Articles']))
		{
			$arrayFileNamePath = array();
            $postArray = $_POST['Articles'];
            
            if(isset($_FILES['Images']) && !empty($_FILES['Images']['name']['files'][0]))
            {
                $imgNameArray = ActionsClass::ImageUpload('articles', 1);
                $postArray['articleImageName'] = $imgNameArray[0];
                $postArray['articleImagePath']  = 'images/articles';
            }
			
			if(isset($_FILES['Articles']) && !empty($_FILES['Articles']['name']['priceList'][0])) 
			{	
				for ($i = 0; $i < count($_FILES['Articles']['tmp_name']['priceList']); $i++) {
							
							$file['tmp_name']  = $_FILES['Articles']['tmp_name']['priceList'][$i];
							$file['new_name'] = uniqid();
					
							$file['type'] = $_FILES['Articles']['name']['priceList'][$i];
							$file['type'] =  explode('.',$file['type']);
							$file['type'] =  end($file['type']);
							$arrayFileNamePath[$_POST['filenameArr'][$i]] = Yii::app()->baseUrl.'/images/pricelist/' .$file['new_name'] . '.' . $file['type'];
															
							if($file['type']  == 'txt' || $file['type'] == 'pdf' || $file['type'] == 'doc' || $file['type'] == 'docx' || $file['type'] == 'xlsx' || $file['type'] == 'xls' || $file['type'] == 'jpg' || $file['type'] == 'png' || $file['type'] == 'jpeg') {					
								$price_path = Yii::getPathOfAlias('webroot'). '/images/pricelist/' . $file['new_name'] . '.' . $file['type'];
							
								move_uploaded_file($file['tmp_name'], $price_path);
							}
				}
			}

            $model->attributes		= $postArray;
			$model->articleDesc 	= addslashes($model->articleDesc);
			if($arrayFileNamePath) {
				$model->articlePricelist = serialize($arrayFileNamePath);
			} else {
				$model->articlePricelist = '';
			}
		
			if($model->save())
            {
                $lastId = Yii::app()->db->lastInsertID;
				$this->redirect(array('updateArticle','id'=>$lastId));
            }
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionUpdateArticle($id)
	{
		$model=$this->loadArticleModel($id);
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Articles']))
		{
			$articlePricelist = '';
			$arrayFileNamePath = array();
			
			if(isset($_POST['existPriceListName'])) {
				for($i = 0; $i < count($_POST['existPriceListName']); $i++) {
					if(!empty($_POST['existPriceListName'][$i])) {
						$arrayFileNamePath[$_POST['existPriceListName'][$i]] = $_POST['existPriceListPath'][$i];
					}
				}
			}
            $postArray = $_POST['Articles'];
	
				//$postArray['IdArticles'] = $model->IdArticles;
            
            if(isset($_FILES['Images']) && !empty($_FILES['Images']['name']['files'][0]))
            {
                ActionsClass::deleteImage($model->articleImageName, $model->articleImagePath);
                $imgNameArray = ActionsClass::ImageUpload('articles', 1);
                $postArray['articleImageName'] = $imgNameArray[0];
                $postArray['articleImagePath'] = 'images/articles';
            }
            elseif(isset($_FILES['Images']) && empty($_FILES['Images']['name']['files'][0]) && $postArray['ImageClear'] == 1)
            {
                ActionsClass::deleteImage($model->articleImageName, $model->articleImagePath);
                $postArray['articleImageName'] = '';
                $postArray['articleImagePath'] = '';
            }
			
			if(isset($_FILES['Articles']) && !empty($_FILES['Articles']['name']['priceList'][0])) 
			{
				for ($i = 0; $i < count($_FILES['Articles']['tmp_name']['priceList']); $i++) {
							
					$file['tmp_name']  = $_FILES['Articles']['tmp_name']['priceList'][$i];
					$file['new_name'] = uniqid();
			
					$file['type'] = $_FILES['Articles']['name']['priceList'][$i];
					$file['type'] =  explode('.',$file['type']);
					$file['type'] =  end($file['type']);
					$arrayFileNamePath[$_POST['filenameArr'][$i]] = Yii::app()->baseUrl.'/images/pricelist/' .$file['new_name'] . '.' . $file['type'];

					if($file['type']  == 'txt' || $file['type'] == 'pdf' || $file['type'] == 'doc' || $file['type'] == 'docx' || $file['type'] == 'xlsx' || $file['type'] == 'xls' || $file['type'] == 'jpg' || $file['type'] == 'png' || $file['type'] == 'jpeg') {					
						$price_path = Yii::getPathOfAlias('webroot'). '/images/pricelist/' . $file['new_name'] . '.' . $file['type'];
						move_uploaded_file($file['tmp_name'], $price_path);
					}
				}
			}
			
			$model->attributes=$postArray;
			$model->articleDesc = addslashes($model->articleDesc);
			if($arrayFileNamePath) {
				$model->articlePricelist = serialize($arrayFileNamePath);
			} else {
				$model->articlePricelist = '';
			}
            if($model->save())
            {
                $this->redirect(array('updateArticle','id'=>$id));
            }
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionPartners()
	{
		$this->render('partners');
	}
	public function actionContacts()
	{
		$this->render('contacts');
	}

	public function actionAdmin()
	{
		$model=new Articles('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Articles']))
			$model->attributes=$_GET['Articles'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function loadArticleModel($id)
	{
		$model=Articles::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
    
	public function loadGalleryModel($id)
	{
		$model=Gallery::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='articles-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    public function actionUpdateSitemap()
	{
		$connection = Yii::app()->db;
        $articlesUrlArray = $connection->createCommand()
            ->select('link')
            ->from('tbl_shtamp_category')
            ->queryColumn();
    //var_dump($articlesUrlArray); die;
        $fileLocation = Yii::getPathOfAlias('webroot')."/sitemap.xml";
        $file = fopen($fileLocation,"w");
        $content = "";
        $content .= '<?xml version="1.0" encoding="UTF-8"?>
        <urlset
            xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
            xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
            xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
              http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
        ';
        
        $content .= '
        <url>
            <loc>'.Yii::app()->createAbsoluteUrl('site/index').'</loc>
            <lastmod>'.date('Y-m-d').'</lastmod>
            <changefreq>hourly</changefreq>
        </url>
        <url>
            <loc>'.Yii::app()->createAbsoluteUrl('shtamp/recovery').'</loc>
            <lastmod>'.date('Y-m-d').'</lastmod>
            <changefreq>hourly</changefreq>
        </url>
        <url>
            <loc>'.Yii::app()->createAbsoluteUrl('site/products').'</loc>
            <lastmod>'.date('Y-m-d').'</lastmod>
            <changefreq>hourly</changefreq>
        </url>
		 <url>
            <loc>'.Yii::app()->createAbsoluteUrl('site/discounts').'</loc>
            <lastmod>'.date('Y-m-d').'</lastmod>
            <changefreq>hourly</changefreq>
        </url>
		 <url>
            <loc>'.Yii::app()->createAbsoluteUrl('site/delivery').'</loc>
            <lastmod>'.date('Y-m-d').'</lastmod>
            <changefreq>hourly</changefreq>
        </url>
        <url>
            <loc>'.Yii::app()->createAbsoluteUrl('site/about').'</loc>
            <lastmod>'.date('Y-m-d').'</lastmod>
            <changefreq>hourly</changefreq>
        </url>
        <url>
            <loc>'.Yii::app()->createAbsoluteUrl('site/contacts').'</loc>
            <lastmod>'.date('Y-m-d').'</lastmod>
            <changefreq>hourly</changefreq>
        </url>';
        //<loc>'.Yii::app()->createAbsoluteUrl('site/readMore', array('link'=>$articleUrl)).'</loc>
        foreach ($articlesUrlArray as $articleUrl){
		
		//echo $articleUrl; die();
        $content .= '
        <url>
            <loc>'.rawurldecode(Yii::app()->createAbsoluteUrl('shtamp/getshtampsbycategory',array('category'=>$articleUrl))).'</loc>
            <lastmod>'.date('Y-m-d').'</lastmod>
            <changefreq>hourly</changefreq>
        </url>';
        }
        $content .= '
        </urlset>';
        if(fwrite($file,$content)){
            fclose($file);
            echo 1;
        }
        else{
            echo 0;
        }
	}
    
    public function actionViewSitemap(){
        $this->render('view_sitemap');
    }
}
