<?php
require_once 'wideimage/WideImage.php';
class ActionsClass extends Controller
{


    public static function ImageUpload($CtPath = 'articles', $imgCount = 20)
    {       
        if(isset($_FILES))
        {
            $ThumbSquareSize        = 200; 
            $BigImageMaxSize        = 800; 
            $ThumbPrefix            = "thumb_"; 
            $DestinationDirectory   = Yii::getPathOfAlias('webroot.images.'.$CtPath).'/';
            //var_dump($DestinationDirectory); die; 
            $Quality                = 70;
            $imageArray = $_FILES['Images'];
            if($imgCount > count($imageArray['name']['files']))
            {
                $imgCount = count($imageArray['name']['files']);
            }
            //$imgCount = count($imageArray['name']['files']);
            $watermark = WideImage::load(Yii::getPathOfAlias('webroot.themes.backend.img').'/watermark.png');
            
            for($i = 0; $i < $imgCount; $i++)
            {
                if(!empty($imageArray['tmp_name']['files'][$i]))
                {
                    if(!isset($imageArray) || !is_uploaded_file($imageArray['tmp_name']['files'][$i]))
                    {
                            return FALSE; 
                    }


                    $RandomNumber   = rand(0, 99999999);


                    $ImageType      = $imageArray['type']['files'][$i]; 
                    //$ImageName      = str_replace(' ','-',strtolower($imageArray['name']['files'][$i]));
                    $ImageName = 'user-'.Yii::app()->user->id.'-'.$i.str_replace('/','.',strtolower($ImageType));
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

                        $img = WideImage::load(Yii::getPathOfAlias('webroot.images.'.$CtPath).'/'.$NewImageName);
                        $img->merge($watermark, '100%-160', '100%-124', 100)->saveToFile(Yii::getPathOfAlias('webroot.images.'.$CtPath).'/'.$NewImageName);
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
    public static function addWatermark($name,$CurWidth,$CurHeight,$MaxSize,$DestFolder,$SrcImage,$Quality,$ImageType)
    {
        $image = imagecreatefromstring(file_get_contents($DestinationDirectory.$name));
        imagealphablending($image, true);
        imagesavealpha($image, true);
        imagecopymerge($image, $watermark1);
        imagepng($image, $DestinationDirectory.$name);
        //return $name;
        echo '<img src="'.Yii::app()->request->baseUrl.'/images/'.$CtPath.'/'.$name.'" alt="Resized Image" width="300">';
        echo '<img src="'.Yii::app()->request->baseUrl.$image.'" alt="Resized Image" width="300">';
        die;//imagepng($image);die;
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
    public static function deleteImage($name,$path)
    {
        $ImagePath  = Yii::getPathOfAlias('webroot.'.$path);
        //var_dump($ImagePath);die;
        $fileBig    = $ImagePath.'/'.$name;
        $fileSml    = $ImagePath.'/thumb_'.$name;
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
    
}