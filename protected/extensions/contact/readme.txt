I) To config.main.php add: 

    1) Yii::setPathOfAlias('contact', dirname(__FILE__).'/../extensions/contact');
    2) 'import'=>array(
		...

                'ext.contact.model.*',
                'ext.contact.widgets.*',

                ...
	),

II) If "protected" folder in .htaccess have "deny from all" - delete this row.
In base folder .htaccess  add

RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule .* index.php [L]

#RewriteEngine on

#RewriteCond %{SCRIPT_FILENAME} !-f
#RewriteCond %{SCRIPT_FILENAME} !-d

#RewriteRule ^(.*)$    index.php/$1



III) Widgets calling:

        $this->Widget('ext.contact.widgets.Contact', 
            array(
            // Add your parameters
            )); 

IV) In database add:

    tbl_contacts
    tbl_contact_map
    tbl_our_contacts
    tbl_email_config

V)For captcha, add code in controller
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
                            //how many times should the same CAPTCHA be displayed.
                                'testLimit'=>1, //
                            //background color 0xFFFFFF  - transparent
				'backColor'=>0,
                            //letters interval
                                'offset'   =>1,
                            //letters color
                                'foreColor'=>0xFFFFFF,
                                
			),
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

 VI) Widgets Parameters can be TRUE or FALSE:
    1) Global:

        admin_mode (default FALSE)

    2) Show form elements:

        form_lName (default TRUE)
        form_phone (default TRUE)
        form_email (default TRUE)
        form_company (default TRUE)
