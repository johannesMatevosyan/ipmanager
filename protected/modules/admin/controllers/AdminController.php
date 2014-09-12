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
        //$this->render('articles');  // not working
        //$this->render('pages');  // works with errors
        //$this->render('view');  // not working
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
