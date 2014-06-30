<?php

    //require_once JPATH_BASE.'/includes/helper.php';

class Helper extends CActiveRecord
{
    public static function ImageUpload($CtPath = '/images/references/')
    {
        if(isset($_FILES))
        {
            $ThumbSquareSize        = 200; 
            $BigImageMaxSize        = 800; 
            $ThumbPrefix            = "thumb_"; 
            $DestinationDirectory   = $CtPath;
            //var_dump($DestinationDirectory);
            $Quality                = 70;
            $imageArray = $_FILES['Images'];
            $imgCount = count($imageArray['name']['files']);
            //var_dump($imgCount);
            for($i = 0; $i < $imgCount; $i++)
            {
                       // var_dump("a");
                if(!empty($imageArray['tmp_name']['files'][$i]))
                {
                    if(!isset($imageArray) || !is_uploaded_file($imageArray['tmp_name']['files'][$i]))
                    {
                            return FALSE; 
                    }
 

                    $RandomNumber   = rand(0, 99999999);


                    $ImageType      = $imageArray['type']['files'][$i]; 
                    //$ImageName      = str_replace(' ','-',strtolower($imageArray['name']['files'][$i]));
                    $ImageName      = date('Y-m-d').'-'.$i.str_replace('/','.',strtolower($ImageType));
                    $ImageSize      = $imageArray['size']['files'][$i]; 
                    $TempSrc        = $imageArray['tmp_name']['files'][$i]; 


                    /*//var_dump($ImageType);die;
                    if($ImageType=='application/x-shockwave-flash')
                    {
                        $ranNum=rand(0,99999999);
                        $type=  strrchr($ImageName, ".");
                        $newNam=  str_ireplace($type, "", $ImageName);
                        $ImageName=$newNam."-".$ranNum.$type;
                        move_uploaded_file($imageArray["tmp_name"]["files"], "images/campaign/" . $ImageName);
                        return $ImageName;
                    }
                    */
                    switch(strtolower($ImageType))
                    {
                        case 'image/png':
                            $CreatedImage =  imagecreatefrompng($imageArray['tmp_name']['files'][$i]);
                            break;
                        case 'image/gif':
                            $CreatedImage =  imagecreatefromgif($imageArray['tmp_name']['files'][$i]);
                            break;
                        case 'image/jpeg':
                            $CreatedImage = imagecreatefromjpeg($imageArray['tmp_name']['files'][$i]);
                            break;

                        default:
                            die('Unsupported Image Format!'); 
                    }

                    list($CurWidth,$CurHeight)=getimagesize($TempSrc);

                    $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
                    $ImageExt = str_replace('.','',$ImageExt);

                    $ImageName      = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);

                    $NewImageName = $ImageName.'-'.$RandomNumber.'.'.$ImageExt;

                    $thumb_DestRandImageName    = $DestinationDirectory.$ThumbPrefix.$NewImageName; 
                    $DestRandImageName          = $DestinationDirectory.$NewImageName;
                    if(self::resizeImage($CurWidth,$CurHeight,$BigImageMaxSize,$DestRandImageName,$CreatedImage,$Quality,$ImageType))
                    {
                        if(!self::cropImage($CurWidth,$CurHeight,$ThumbSquareSize,$thumb_DestRandImageName,$CreatedImage,$Quality,$ImageType))
                            {
                                echo 'Error Creating thumbnail';
                            }
                        /*
                        At this point we have succesfully resized and created thumbnail image
                        We can render image to user's browser or store information in the database
                        For demo, we are going to output results on browser.
                        */
                       // echo '<table width="100%" border="0" cellpadding="4" cellspacing="0">';
                       // echo '<tr>';
                       // echo '<td align="center"><img src="'.Yii::app()->request->baseUrl.'/images/products/'.$ThumbPrefix.$NewImageName.'" alt="Thumbnail"></td>';
                       // echo '</tr><tr>';
                       // echo '<td align="center"><img src="'.Yii::app()->request->baseUrl.'/images/products/'.$NewImageName.'" alt="Resized Image" width="300"></td>';
                        //echo '</tr>';
                       // echo '</table>';
                        $imgName[$i] = $NewImageName;
                        /*
                        // Insert info into database table!
                        mysql_query("INSERT INTO myImageTable (ImageName, ThumbName, ImgPath)
                        VALUES ($DestRandImageName, $thumb_DestRandImageName, 'uploads/')");
                        */

                    }
                    else
                    {
                        die('Resize Error'); //output error
                    }
                }
            }
            return $imgName;
        }
    }
    
    public static function PhotoUpload($CtPath = '/images/partners/upload_logo/')
    {
        if(isset($_FILES))
        {
            $ThumbSquareSize        = 200; 
            $BigImageMaxSize        = 800; 
            $ThumbPrefix            = "thumb_"; 
            $DestinationDirectory   = $CtPath;
            //var_dump($DestinationDirectory);
            $Quality                = 70;
            $imageArray = $_FILES['Image'];
            
            if(!empty($imageArray['tmp_name']['files']))
            {
                if(!isset($imageArray) || !is_uploaded_file($imageArray['tmp_name']['files']))
                {
                
                        return FALSE; 
                }


                $RandomNumber   = rand(0, 99999999);


                $ImageType      = $imageArray['type']['files']; 
                //$ImageName      = str_replace(' ','-',strtolower($imageArray['name']['files']));
                $ImageName      = date('Y-m-d').'-'.$i.str_replace('/','.',strtolower($ImageType));
                $ImageSize      = $imageArray['size']['files']; 
                $TempSrc        = $imageArray['tmp_name']['files']; 


                /*//var_dump($ImageType);die;
                if($ImageType=='application/x-shockwave-flash')
                {
                    $ranNum=rand(0,99999999);
                    $type=  strrchr($ImageName, ".");
                    $newNam=  str_ireplace($type, "", $ImageName);
                    $ImageName=$newNam."-".$ranNum.$type;
                    move_uploaded_file($imageArray["tmp_name"]["files"], "images/campaign/" . $ImageName);
                    return $ImageName;
                }
                */
                switch(strtolower($ImageType))
                {
                    case 'image/png':
                        $CreatedImage =  imagecreatefrompng($imageArray['tmp_name']['files']);
                        break;
                    case 'image/gif':
                        $CreatedImage =  imagecreatefromgif($imageArray['tmp_name']['files']);
                        break;
                    case 'image/jpeg':
                        $CreatedImage = imagecreatefromjpeg($imageArray['tmp_name']['files']);
                        break;

                    default:
                        die('Unsupported Image Format!'); 
                }
                list($CurWidth,$CurHeight)=getimagesize($TempSrc);

                $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
                $ImageExt = str_replace('.','',$ImageExt);

                $ImageName      = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);

                $NewImageName = $ImageName.'-'.$RandomNumber.'.'.$ImageExt;

                $thumb_DestRandImageName    = $DestinationDirectory.$ThumbPrefix.$NewImageName; 
                $DestRandImageName          = $DestinationDirectory.$NewImageName;
                if(self::resizeImage($CurWidth,$CurHeight,$BigImageMaxSize,$DestRandImageName,$CreatedImage,$Quality,$ImageType))
                {
                    if(!self::cropImage($CurWidth,$CurHeight,$ThumbSquareSize,$thumb_DestRandImageName,$CreatedImage,$Quality,$ImageType))
                        {
                            echo 'Error Creating thumbnail';
                        }
                    /*
                    At this point we have succesfully resized and created thumbnail image
                    We can render image to user's browser or store information in the database
                    For demo, we are going to output results on browser.
                    */
                   // echo '<table width="100%" border="0" cellpadding="4" cellspacing="0">';
                   // echo '<tr>';
                   // echo '<td align="center"><img src="'.Yii::app()->request->baseUrl.'/images/products/'.$ThumbPrefix.$NewImageName.'" alt="Thumbnail"></td>';
                   // echo '</tr><tr>';
                   // echo '<td align="center"><img src="'.Yii::app()->request->baseUrl.'/images/products/'.$NewImageName.'" alt="Resized Image" width="300"></td>';
                    //echo '</tr>';
                   // echo '</table>';
                    return $NewImageName;
                    /*
                    // Insert info into database table!
                    mysql_query("INSERT INTO myImageTable (ImageName, ThumbName, ImgPath)
                    VALUES ($DestRandImageName, $thumb_DestRandImageName, 'uploads/')");
                    */

                }
                else
                {
                    die('Resize Error'); //output error
                }
            }
        }
    }
    
    
    public static function resizeImage($CurWidth,$CurHeight,$MaxSize,$DestFolder,$SrcImage,$Quality,$ImageType)
    {
                //Check Image size is not 0
        if($CurWidth <= 0 || $CurHeight <= 0)
        {
            return false;
        }

        //Construct a proportional size of new image
        $ImageScale         = min($MaxSize/$CurWidth, $MaxSize/$CurHeight);
        $NewWidth           = ceil($ImageScale*$CurWidth);
        $NewHeight          = ceil($ImageScale*$CurHeight);
        $NewCanves          = imagecreatetruecolor($NewWidth, $NewHeight);

        // Resize Image
        if(imagecopyresampled($NewCanves, $SrcImage,0, 0, 0, 0, $NewWidth, $NewHeight, $CurWidth, $CurHeight))
        {
            switch(strtolower($ImageType))
            {
                case 'image/png':
                    imagepng($NewCanves,$DestFolder);
                    break;
                case 'image/gif':
                    imagegif($NewCanves,$DestFolder);
                    break;
                case 'image/jpeg':
                case 'image/pjpeg':
                    imagejpeg($NewCanves,$DestFolder,$Quality);
                    break;
                default:
                    return false;
            }
            //Destroy image, frees up memory
            if(is_resource($NewCanves)) { imagedestroy($NewCanves); }
            return true;
        }
    }
    public static function cropImage($CurWidth,$CurHeight,$iSize,$DestFolder,$SrcImage,$Quality,$ImageType)
    {
                //Check Image size is not 0
        if($CurWidth <= 0 || $CurHeight <= 0)
        {
            return false;
        }

        //abeautifulsite.net has excellent article about "Cropping an Image to Make Square"
        //http://www.abeautifulsite.net/blog/2009/08/cropping-an-image-to-make-square-thumbnails-in-php/
        if($CurWidth > $CurHeight)
        {
            $y_offset = 0;
            $x_offset = ($CurWidth - $CurHeight) / 2;
            $square_size    = $CurWidth - ($x_offset * 2);
        }else{
            $x_offset = 0;
            $y_offset = ($CurHeight - $CurWidth) / 2;
            $square_size = $CurHeight - ($y_offset * 2);
        }

        $NewCanves  = imagecreatetruecolor($iSize, $iSize);
        if(imagecopyresampled($NewCanves, $SrcImage,0, 0, $x_offset, $y_offset, $iSize, $iSize, $square_size, $square_size))
        {
            switch(strtolower($ImageType))
            {
                case 'image/png':
                    imagepng($NewCanves,$DestFolder);
                    break;
                case 'image/gif':
                    imagegif($NewCanves,$DestFolder);
                    break;
                case 'image/jpeg':
                case 'image/pjpeg':
                    imagejpeg($NewCanves,$DestFolder,$Quality);
                    break;
                default:
                    return false;
            }
        //Destroy image, frees up memory
            if(is_resource($NewCanves)) { imagedestroy($NewCanves); }
        return true;

        }

    }
    public static function deleteImage($name, $path = '/images/references')
    {
        $ImagePath  = Yii::getPathOfAlias('webroot.'.$path);
//        $ImagePath  = $path;
        $fileBig    = $ImagePath.'/'.$name;
        $fileSml    = $ImagePath.'/thumb_'.$name;
//                var_dump($fileSml."++++".$fileBig);die;
        if(is_file($fileSml) && is_file($fileBig))
        {
            if(unlink($fileBig) && unlink($fileSml))
            {
                return TRUE;
            }
            else
            {
                return FALSE;
            }
        }
        else
        {
            return TRUE;
        }
    }
    
    public static function getYoutubeId($url) {
        $pattern = 
            '%^# Match any youtube URL
            (?:https?://)?  # Optional scheme. Either http or https
            (?:www\.)?      # Optional www subdomain
            (?:             # Group host alternatives
              youtu\.be/    # Either youtu.be,
            | youtube\.com  # or youtube.com
              (?:           # Group path alternatives
                /embed/     # Either /embed/
              | /v/         # or /v/
              | /watch\?v=  # or /watch\?v=
              )             # End path alternatives.
            )               # End host alternatives.
            ([\w-]{10,12})  # Allow 10-12 for 11 char youtube id.
            $%x'
            ;
        $result = preg_match($pattern, $url, $matches);
        if (false !== $result) {
            return $matches[1];
        }
        return false;
    }
    
    public static function readMore($str, $leng = 300)
    {
        $separator = '<hr id="system-readmore"';
        $intro_text = explode($separator, $str);
        if(count($intro_text) > 1)
        {
            return $intro_text[0];
        }
        else
        {
            $rest = substr($str, 0, $leng);
            return $rest;
        }
    }
    
    public static function checkYoutubeUrl($url)
    {
        $rx = '~
            ^(?:https?://)?              # Optional protocol
             (?:www\.)?                  # Optional subdomain
             (?:youtube\.com|youtu\.be)  # Mandatory domain name
             /watch\?v=([^&]+)           # URI with video id as capture group 1
             ~x';

        $has_match = preg_match($rx, $url, $matches);
        if ($has_match==0)
        {
            return FALSE;
        }
        else
        {
            return $matches[1];
        }
    }
    
    public static function VideosSave()
    {
        $videoArray = $_POST['ReferenceModel']['upload_vid'];
        $retArr=array();
        
        foreach ($videoArray as $value)
        {
            if (!empty($value))
            {
                $id=self::getYoutubeId($value);                
                if ($id!==FALSE)
                {
                    $retArr[]=$id;
                }
                else 
                {
                    die("ONLY YOUTUBE VIDEO LINKS");
                }
            }
        }
        return $retArr;
    }
}