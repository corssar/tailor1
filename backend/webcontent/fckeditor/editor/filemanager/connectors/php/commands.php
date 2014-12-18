<?php
require_once(BACKEND_PATH."ajaxcontrollers/FileController.php");
/*
 * FCKeditor - The text editor for Internet - http://www.fckeditor.net
 * Copyright (C) 2003-2007 Frederico Caldeira Knabben
 *
 * == BEGIN LICENSE ==
 *
 * Licensed under the terms of any of the following licenses at your
 * choice:
 *
 *  - GNU General Public License Version 2 or later (the "GPL")
 *    http://www.gnu.org/licenses/gpl.html
 *
 *  - GNU Lesser General Public License Version 2.1 or later (the "LGPL")
 *    http://www.gnu.org/licenses/lgpl.html
 *
 *  - Mozilla Public License Version 1.1 or later (the "MPL")
 *    http://www.mozilla.org/MPL/MPL-1.1.html
 *
 * == END LICENSE ==
 *
 * This is the File Manager Connector for PHP.
 */



function GetFolders( $resourceType, $currentFolder )
{
    // Map the virtual path to the local server path.
    $sServerDir = ServerMapFolder( $resourceType, $currentFolder, 'GetFolders' ) ;
    // Array that will hold the folders names.
    $aFolders	= array() ;
    $oCurrentFolder = opendir( $sServerDir ) ;

    while ( $sFile = readdir( $oCurrentFolder ) )
    {
        if ( $sFile != '.' && $sFile != '..' && is_dir( $sServerDir . $sFile ) )
            $aFolders[] = '<Folder name="' . ConvertToXmlAttribute( $sFile ) . '" />' ;
    }

    closedir( $oCurrentFolder ) ;

    // Open the "Folders" node.
    echo "<Folders>" ;
    natcasesort( $aFolders ) ;
    foreach ( $aFolders as $sFolder )
        echo $sFolder ;

    // Close the "Folders" node.
    echo "</Folders>" ;
}

function GetFoldersAndFiles( $resourceType, $currentFolder )
{
    // Map the virtual path to the local server path.
    $sServerDir = ServerMapFolder( $resourceType, $currentFolder, 'GetFoldersAndFiles' ) ;
    // Arrays that will hold the folders and files names.
    $aFolders	= array() ;
    $aFiles		= array() ;

    $oCurrentFolder = opendir( $sServerDir ) ;

    while ( $sFile = readdir( $oCurrentFolder ) )
    {
        if ( $sFile != '.' && $sFile != '..' )
        {
            if ( is_dir( $sServerDir . $sFile ) )
                $aFolders[] = '<Folder name="' . ConvertToXmlAttribute( $sFile ) . '" />' ;
            else
            {
                $iFileSize = @filesize( $sServerDir . $sFile ) ;
                if ( !$iFileSize ) {
                    $iFileSize = 0 ;
                }
                if ( $iFileSize > 0 )
                {
                    $iFileSize = round( $iFileSize / 1024 ) ;
                    if ( $iFileSize < 1 ) $iFileSize = 1 ;
                }

                $aFiles[] = '<File name="' . ConvertToXmlAttribute( $sFile ) . '" size="' . $iFileSize . '" />' ;
            }
        }
    }

    // Send the folders
    natcasesort( $aFolders ) ;
    echo '<Folders>' ;

    foreach ( $aFolders as $sFolder )
        echo $sFolder ;

    echo '</Folders>' ;

    // Send the files
    natcasesort( $aFiles ) ;
    echo '<Files>' ;

    foreach ( $aFiles as $sFiles )
        echo $sFiles ;

    echo '</Files>' ;
}

function CreateFolder( $resourceType, $currentFolder )
{
    if (!isset($_GET)) {
        global $_GET;
    }
    $sErrorNumber	= '0' ;
    $sErrorMsg		= '' ;

    if ( isset( $_GET['NewFolderName'] ) )
    {
        $sNewFolderName = $_GET['NewFolderName'] ;
        $sNewFolderName = SanitizeFolderName( $sNewFolderName ) ;

        if ( strpos( $sNewFolderName, '..' ) !== FALSE )
            $sErrorNumber = '102' ;		// Invalid folder name.
        else
        {
            // Map the virtual path to the local server path of the current folder.
            $sServerDir = ServerMapFolder( $resourceType, $currentFolder, 'CreateFolder' ) ;

            if ( is_writable( $sServerDir ) )
            {
                $sNewFolderName = trim($sNewFolderName);
                $sNewFolderName = FileController::clearspacchars($sNewFolderName);
                if (TRANSLIT) $sNewFolderName = FileController::ruslat($sNewFolderName,true);
                $sServerDir .= $sNewFolderName ;
                if (strtolower($resourceType)=="image")
                {
                    $fp = fopen ("maxim_test.txt", "a");
                    fwrite($fp,"\nsNewFolderName=".$sNewFolderName);
                    $path_to_small_image_files= PATH_TO_SMALL_IMAGE_FILES;
                    fclose($fp);
                    $sErrorMsg = CreateServerFolder( SERVER_ROOT_PATH.PATH_TO_CMS_FOR_FILEMANAGER.$path_to_small_image_files.$currentFolder.$sNewFolderName ) ;
                }

                $sErrorMsg = CreateServerFolder( $sServerDir ) ;

                switch ( $sErrorMsg )
                {
                    case '' :
                        $sErrorNumber = '0' ;
                        break ;
                    case 'Invalid argument' :
                    case 'No such file or directory' :
                        $sErrorNumber = '102' ;		// Path too long.
                        break ;
                    default :
                        $sErrorNumber = '110' ;
                        break ;
                }
            }
            else
                $sErrorNumber = '103' ;
        }
    }
    else
        $sErrorNumber = '102' ;

    // Create the "Error" node.
    echo '<Error number="' . $sErrorNumber . '" originalDescription="' . ConvertToXmlAttribute( $sErrorMsg ) . '" />' ;
}

function add_photocard($image_type,$inputFilename)
{
    $imagedata = getimagesize($inputFilename);
    $w = $imagedata[0];
    $h = $imagedata[1];

    if($w==$h)
    {
        $new_height = 94;
        $new_width = 94;
    }

    if ($h>94 || $w>94)
    {
        if ( ( $h - ($h*0.1) ) > $w )
        {
            $new_height = 94;
            $per   = ($new_height/$h);
            $new_width = floor($w*$per);
        }
        else
        {
            $new_width = 94;
            $per   = ($new_width/$w);
            $new_height = floor($h*$per);
        }
    } else {
        $new_height = $h;
        $new_width = $w;
    }
    /*if ($h>800 || $w>600)
     {
         if ( ( $h - ($h*0.25) ) > $w )
         {
             $new_height = 600;
             $per   = ($new_height/$h);
             $new_width = floor($w*$per);
         }
         else
         {
             $new_width = 800;
             $per   = ($new_width/$w);
             $new_height = floor($h*$per);
         }
     }*/
    $im1 = ImageCreateTrueColor($w, $h);
    $im2 = ImageCreateTrueColor($new_width, $new_height);

    $image_type = strtolower($image_type);

    switch ($image_type)
    {
        case 'gif': $image = @imagecreatefromgif($inputFilename); break;
        case 'bmp': $image = @imagecreatefromwbmp($inputFilename); break;
        case 'png': $image = @imagecreatefrompng($inputFilename); break;
        case 'jpg': $image = @imagecreatefromjpeg($inputFilename); break;
        case 'jpeg': $image = @imagecreatefromjpeg($inputFilename); break;
    }
    imagecopyResampled ($im1, $image, 0, 0, 0, 0, $w, $h, $w, $h);
    imagecopyResampled ($im2, $image, 0, 0, 0, 0, $new_width, $new_height, $w, $h);
    $im_arr = array($im1,$im2);
    return $im_arr;

}

//function ImageUpload( $resourceType, $currentFolder, $sCommand, $isImageVersions=0, $isUseWaterMarks=0 )
function ImageUpload( $resourceType, $currentFolder, $sCommand, $isImageVersions=0)
{
    require_once(BACKEND_PATH."libs/Custom/FileUpload.php");
    require_once(FRAMEWORK_PATH."system/appUrl.php");

    $upload_handler = new UploadHandler();
    $uploadFolder = ServerMapFolder( $resourceType, $currentFolder, $sCommand );
    $url = GetUrlFromPath( $resourceType, $currentFolder, $sCommand );
    $upload_handler->setUploadPath($uploadFolder, $url);
    $sizes = json_decode(stripslashes($_POST['sizesForProcessing']));

    //    if($isImageVersions && count($sizes->sizes)>0){
    //        $fp = fopen ("maxim_test.txt", "a+");
    //        fwrite($fp,"\nRes_12: ".$sizes->wtmId);
    //        foreach($sizes->sizes as $item)
    //            fwrite($fp,"\nRes_22: ".$item->width."_".$item->height);
    //        fclose($fp);
    //    }

    $upload_handler->setImageFileName($sizes->imageFileName);

    if($isImageVersions && count($sizes->sizes)>0)
        $upload_handler->setImageVersions($uploadFolder, $sizes->sizes, $url);

    $upload_handler->setImageDescription($sizes->description);
    if($sizes->wtmId)
    {
        if(!$upload_handler->setWaterMark($sizes->wtmId)){
            Context::Log(true, 'imageCreate')->log("Error watermark settings. (be_WaterMarks OR backend/config.php-> \$imageProcessingSettings)");
        }
    }

    $result = $upload_handler->post();

    $images = array();
    foreach($result[0] as $key=>$value)
    {
        if(strpos($key, '_url'))
            $images[str_replace('_url', '', $key)] = $value;
    }



    /* use this for debugging*/
    //    $fp = fopen ("maxim_test.txt", "a+");
    //    fwrite($fp,"\nRes: ".memory_get_usage());
    //    fclose($fp);

    //    echo '<script type="text/javascript">' ;
    //    echo 'console.log('.json_encode($images).');' ;
    //    echo '</script>' ;





    if(count($images)>0)
        SendImageUploadResults($result[0]->errNo, $images);
    else
        SendUploadResults($result[0]->errNo);

    exit();
}

function FileUpload( $resourceType, $currentFolder, $sCommand )
{
    if (!isset($_FILES)) {
        global $_FILES;
    }
    $sErrorNumber = '0' ;
    $sFileName = '' ;

    if ( isset( $_FILES['NewFile'] ) && !is_null( $_FILES['NewFile']['tmp_name'] ) )
    {
        global $Config ;

        $oFile = $_FILES['NewFile'] ;

        // Map the virtual path to the local server path.
        $sServerDir = ServerMapFolder( $resourceType, $currentFolder, $sCommand ) ;

        // Get the uploaded file name.
        $sFileName = $oFile['name'] ;

        //*************************************************
        //Upload file with name time() edit by Max Melnychuk 06.08.2008
        $sFileName = trim($sFileName);
        $sFileName = FileController::clearspacchars($sFileName,false);
        if (TRANSLIT) $sFileName = FileController::ruslat($sFileName);
        else if (!eregi("^[[:print:]]+$", $sFileName))
        {
            $sErrorNumber = '205';
            $sFileUrl = CombinePaths( GetResourceTypePath( $resourceType, $sCommand ) , $currentFolder ) ;
            $sFileUrl = CombinePaths( $sFileUrl, $sFileName ) ;

            SendUploadResults( $sErrorNumber, $sFileUrl, $sFileName ) ;
            exit();
        };
        $mas = explode("/",$sFileName);
        $oldfile2 = $mas[count($mas)-1];
        $mas2 = explode(".",$oldfile2);
        $typename= $mas2[count($mas2)-1];

        //**************************************************
        if ( !$sErrorNumber)
        {
            $sFileName = SanitizeFileName( $sFileName ) ;

            $sOriginalFileName = $sFileName ;

            // Get the extension.
            $sExtension = substr( $sFileName, ( strrpos($sFileName, '.') + 1 ) ) ;
            $sExtension = strtolower( $sExtension ) ;

            if ( isset( $Config['SecureImageUploads'] ) )
            {
                if ( !IsImageValid( $oFile['tmp_name'], $sExtension ) )
                {
                    $sErrorNumber = '202' ;
                }
            }

            if ( isset( $Config['HtmlExtensions'] ) )
            {
                if ( !IsHtmlExtension( $sExtension, $Config['HtmlExtensions'] ) && DetectHtml( $oFile['tmp_name'] ) )
                {
                    $sErrorNumber = '202' ;
                }
            }
        }
        // Check if it is an allowed extension.
        if ( !$sErrorNumber && IsAllowedExt( $sExtension, $resourceType ) )
        {
            $iCounter = 0 ;

            while ( true )
            {
                $sFilePath = $sServerDir . $sFileName ;

                if ( is_file( $sFilePath ) )
                {
                    $iCounter++ ;
                    $sFileName = RemoveExtension( $sOriginalFileName ) . '(' . $iCounter . ').' . $sExtension ;
                    $sErrorNumber = '201' ;
                }
                else
                {
                    move_uploaded_file( $oFile['tmp_name'], $sFilePath ) ;
                    if (strtolower($resourceType)=="image" && FILEMANAGER_PREVIEW_IMAGE)
                    {

                        //$fp = fopen ("maxim_test.txt", "w");
                        $sFilePath2 = SERVER_ROOT_PATH.PATH_TO_CMS_FOR_FILEMANAGER.PATH_TO_SMALL_IMAGE_FILES.$currentFolder.$sFileName;
                        if (copy($sFilePath,$sFilePath2))
                            $im = add_photocard(strtolower($typename),$sFilePath2);
                        if(imagejpeg($im[1],$sFilePath2)) $err=1;
                        /*fwrite($fp,"\nFile1=".$sFilePath."\nFile2=".FileController::ruslat($sFilePath2));
                          fwrite($fp,"\ncurrentFolder=".$currentFolder."\nresourceType=".$resourceType);
                          fwrite($fp,"\nsCommand=".$sCommand."User_agent=".$_SERVER['HTTP_USER_AGENT']);
                          fclose($fp); */
                    }

                    if ( is_file( $sFilePath ) )
                    {
                        $oldumask = umask(0) ;
                        chmod( $sFilePath, 0777 ) ;
                        umask( $oldumask ) ;
                    }

                    break ;
                }
            }
        }
        else
            $sErrorNumber = '202' ;
    }
    else
        $sErrorNumber = '202' ;


    $sFileUrl = CombinePaths( GetResourceTypePath( $resourceType, $sCommand ) , $currentFolder ) ;
    $sFileUrl = CombinePaths( $sFileUrl, $sFileName ) ;

    SendUploadResults( $sErrorNumber, $sFileUrl, $sFileName ) ;

    exit ;
}
?>