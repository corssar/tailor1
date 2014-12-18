<?php
/*
 * jQuery File Upload Plugin PHP Class 5.9.2
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

class UploadHandler
{
    protected $options;

    function __construct($options=null) {
        $this->options = array(
            'script_url' => $this->getFullUrl().'/',
//            'upload_dir' => dirname($_SERVER['SCRIPT_FILENAME']).'/files/',
//            'upload_url' => $this->getFullUrl().'/files/',
            'param_name' => 'NewFile',
            'isTemp' => 0,
            'imageFileName' => '',
            // Set the following option to 'POST', if your server does not support
            // DELETE requests. This is a parameter sent to the client:
            'delete_type' => 'POST',
            // The php.ini settings upload_max_filesize and post_max_size
            // take precedence over the following max_file_size setting:
            'max_file_size' => null,
            'min_file_size' => 1,
//            'accept_file_types' => '/.+$/i',
            'accept_file_types' => '/.(?:jp(?:e?g|e|2)|gif|png|bmp)$/i',
            'max_number_of_files' => null,
            // Set the following option to false to enable resumable uploads:
            'discard_aborted_uploads' => true,
            // Set to true to rotate images based on EXIF meta data, if available:
            'orient_image' => false,
            'image_versions' => array(),
            'image_description' => array(),
            'water_mark' => array(
                'id' => 0,
                'path' => ''
            )
        );
        if ($options) {
            $this->options = array_replace_recursive($this->options, $options);
        }
    }

    protected function setNewFileName($file_name, $dir_path)
    {
        while(is_file($dir_path.$file_name)) {
            $file_name = $this->upcount_name($file_name);
        }
        return $file_name;
    }

    public function setParamName($paramName)
    {
        $this->options['param_name'] = $paramName;
    }

    public function setIsTempVar($isTemp)
    {
        $this->options['isTemp'] = $isTemp;
    }

    public function setUploadPath($uploadDir, $uploadUrl)
    {
        $this->options['upload_dir'] = $uploadDir;
        $this->options['upload_url'] = $uploadUrl;
    }

    public function setImageFileName($name)
    {
        $this->options['imageFileName'] = $name;
    }

    public function setWaterMark($waterMarkId)
    {
        $query = "  SELECT be_WaterMarks.* FROM be_WaterMarks
                    WHERE be_WaterMarks.id = $waterMarkId";
        if(!Context::DB()->query($query)){
            return false;
        }
        global $imageProcessingSettings;
        if(!isset($imageProcessingSettings))
            return false;
        $this->options['water_mark']['id'] = $waterMarkId;
        $this->options['water_mark']['path'] = appUrl::checkUrl(Context::DB()->result[0]['image']);
        return true;
    }

    public function setImageVersions($curFolder, $sizes, $url)
    {
        foreach ($sizes as $item){
            if(strlen($item->folderName) > 0){
                $uploadFolder = $curFolder.strtolower($item->folderName);
                if(!file_exists($uploadFolder))
                    mkdir($uploadFolder);
                $uploadFolder.='/';
                $uploadUrl = $url.$item->folderName.'/';
            }
            else{
                $uploadFolder = $curFolder;
                $uploadUrl = $url;
            }
            $imageVersions[$item->id]['id'] = $item->id;
            $imageVersions[$item->id]['version'] = $item->imageSizeCode;
            $imageVersions[$item->id]['upload_dir'] = $uploadFolder;
            $imageVersions[$item->id]['upload_url'] = $uploadUrl;
            $imageVersions[$item->id]['max_width'] = $item->width;
            $imageVersions[$item->id]['max_height'] = $item->height;
            $imageVersions[$item->id]['useWatermark'] = $item->useWatermark;
            $imageVersions[$item->id]['isProportion'] = $item->isProportion;
        }
        $this->options['image_versions'] = $imageVersions;
        return true;
    }

    public function setImageDescription($description)
    {
        foreach ($description as $item){
            $imageDescription[$item->langId]['langId'] = $item->langId;
            $imageDescription[$item->langId]['objectName'] = $item->objectName;
            $imageDescription[$item->langId]['workName'] = $item->workName;
            $imageDescription[$item->langId]['author'] = $item->author;
            $imageDescription[$item->langId]['authorUrl'] = $item->authorUrl;
        }
        $this->options['image_description'] = $imageDescription;
        return true;
    }

    protected function getFullUrl() {
        return
            (isset($_SERVER['HTTPS']) ? 'https://' : 'http://').
            (isset($_SERVER['REMOTE_USER']) ? $_SERVER['REMOTE_USER'].'@' : '').
            (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : ($_SERVER['SERVER_NAME'].
            (isset($_SERVER['HTTPS']) && $_SERVER['SERVER_PORT'] === 443 ||
            $_SERVER['SERVER_PORT'] === 80 ? '' : ':'.$_SERVER['SERVER_PORT']))).
            substr($_SERVER['SCRIPT_NAME'],0, strrpos($_SERVER['SCRIPT_NAME'], '/'));
    }

    protected function set_file_delete_url($file) {
        $file->delete_url = $this->options['script_url']
            .'?file='.rawurlencode($file->name);
        $file->delete_type = $this->options['delete_type'];
        if ($file->delete_type !== 'DELETE') {
            $file->delete_url .= '&_method=DELETE';
        }
    }

    protected function get_file_object($file_name) {
        $file_path = $this->options['upload_dir'].$file_name;
        if (is_file($file_path) && $file_name[0] !== '.') {
            $file = new stdClass();
            $file->name = $file_name;
            $file->size = filesize($file_path);
            $file->url = $this->options['upload_url'].rawurlencode($file->name);
            foreach($this->options['image_versions'] as $version => $options) {
                if (is_file($options['upload_dir'].$file_name)) {
                    $file->{$version.'_url'} = $options['upload_url']
                        .rawurlencode($file->name);
                }
            }
            $this->set_file_delete_url($file);
            return $file;
        }
        return null;
    }

    protected function get_file_objects() {
        return array_values(array_filter(array_map(
            array($this, 'get_file_object'),
            scandir($this->options['upload_dir'])
        )));
    }

    protected function create_scaled_image($file_name, $file_type, $options, $origImageId = false) {
        $file_path = $this->options['upload_dir'].$file_name;
        $imFileName = '';
        if(strlen($this->options['imageFileName'])>0)
            $imFileName = '_'.$this->options['imageFileName'];
        $file_name = $this->setNewFileName($origImageId.'_'.$options['max_width'].'x'.$options['max_height'].$imFileName.".".$file_type, $options['upload_dir']);
        $new_file_path = $options['upload_dir'].$file_name;
        $new_file_url = $options['upload_url'].$file_name;
        list($img_width, $img_height) = @getimagesize($file_path);
        if (!$img_width || !$img_height) {
            return false;
        }
        $scale = min(
            $options['max_width'] / $img_width,
            $options['max_height'] / $img_height
        );
        if ($scale >= 1 || !$scale) {
            $success = $this->write_scaled_image(0, 0, $img_width, $img_height, $file_path, $new_file_path, $img_width, $img_height, $options['useWatermark']);
        }
        else
        {
            if($options['isProportion']){
                $leftX = 0;
                $topY = 0;
                $new_width = $img_width * $scale;
                $new_height = $img_height * $scale;
            }
            else{
                $sizes = $this->getNewSizes($options['max_width'], $options['max_height'], $img_width, $img_height);
                $leftX = $sizes['leftX'];
                $topY = $sizes['topY'];
                $new_width = $options['max_width'];
                $new_height = $options['max_height'];
                $img_width = $sizes['w'];
                $img_height = $sizes['h'];
            }
            $success = $this->write_scaled_image($leftX, $topY, $new_width, $new_height, $file_path, $new_file_path, $img_width, $img_height, $options['useWatermark']);
        }
        if($success && $origImageId){
            $this->saveScaledImage($origImageId, $options['id'], $new_file_path, $new_file_url);
        }
        return $success;
    }

    protected function write_scaled_image($leftX, $topY, $width, $height, $srcFile, $file, $src_width,  $src_height, $useWatermark)
    {
        $new_img = @imagecreatetruecolor($width, $height);
        switch (strtolower(substr(strrchr(basename($srcFile), '.'), 1))) {
            case 'jpg':
            case 'jpeg':
                $src_img = @imagecreatefromjpeg($srcFile);
                $write_image = 'imagejpeg';
                $image_quality = 100;
                break;
            case 'gif':
                @imagecolortransparent($new_img, @imagecolorallocate($new_img, 0, 0, 0));
                $src_img = @imagecreatefromgif($srcFile);
                $write_image = 'imagegif';
                $image_quality = null;
                break;
            case 'png':
                @imagecolortransparent($new_img, @imagecolorallocate($new_img, 0, 0, 0));
                @imagealphablending($new_img, false);
                @imagesavealpha($new_img, true);
                $src_img = @imagecreatefrompng($srcFile);
                $write_image = 'imagepng';
                $image_quality = 0;
                break;
            default:
                $src_img = null;
        }
        if($useWatermark && $this->options['water_mark']['id']){
            global $imageProcessingSettings;
            $watermark = imagecreatefrompng($this->options['water_mark']['path']);
            list($w_width, $w_height) = getimagesize($this->options['water_mark']['path']);

            $im_w_width = $imageProcessingSettings['waterMarksFactor']*$width;
            $im_w_height = $w_height*$im_w_width/$w_width;

            $pos_x = $width - $im_w_width;
            $pos_y = $height - $im_w_height;
            $new_img_tmp = @imagecreatetruecolor($width, $height);
            $new_watermark = @imagecreatetruecolor($im_w_width, $im_w_height);
            @imagealphablending($new_watermark, false);
            $success = $src_img && $watermark
                && @imagecopyresampled($new_img, $src_img, 0, 0, $leftX, $topY, $width, $height, $src_width, $src_height)
                    && @imagecopyresampled($new_img_tmp, $src_img, 0, 0, $leftX, $topY, $width, $height, $src_width, $src_height)
                        && @imagecopyresampled($new_watermark, $watermark, 0, 0, 0, 0, $im_w_width, $im_w_height, $w_width, $w_height)
                            && imagecopy($new_img_tmp, $new_watermark, $pos_x, $pos_y, 0, 0, $im_w_width, $im_w_height)
                            && imagecopymerge($new_img, $new_img_tmp, 0, 0, 0, 0, $width, $height, $imageProcessingSettings['waterMarksTransparency'])
                            && $write_image($new_img, $file, $image_quality);
            @imagedestroy($new_img_tmp);
            @imagedestroy($new_watermark);
            @imagedestroy($watermark);
        }
        else{
            $success = $src_img
                && @imagecopyresampled( $new_img, $src_img, 0, 0, $leftX, $topY, $width, $height, $src_width, $src_height)
                    && $write_image($new_img, $file, $image_quality);
        }
        @imagedestroy($src_img);
        @imagedestroy($new_img);
        return $success;
    }

    protected function getNewSizes($width, $height, $w, $h)
    {
        $leftX	=	0;
        $topY	=	0;

        if ($width/$w > $height/$h){
            $oldH	=	$h;
            $h = floor($height*$w/$width);
            $topY	=	floor(($oldH/2)-($h/2));
        }
        else{
            $oldW	=	$w;
            $w = floor($width*$h/$height);
            $leftX	=	floor(($oldW/2)-($w/2));
        }
        $sizes['w'] = $w;
        $sizes['h'] = $h;
        $sizes['leftX'] = $leftX;
        $sizes['topY'] = $topY;
        return $sizes;
    }

    protected function has_error($uploaded_file, $file, $error) {
        if ($error) {
            return $error;
        }
        if (!preg_match($this->options['accept_file_types'], $file->name)) {
            return 202;
        }
        if ($uploaded_file && is_uploaded_file($uploaded_file)) {
            $file_size = filesize($uploaded_file);
        } else {
            $file_size = $_SERVER['CONTENT_LENGTH'];
        }
        if ($this->options['max_file_size'] && (
            $file_size > $this->options['max_file_size'] ||
                $file->size > $this->options['max_file_size'])
        ) {
            return 'maxFileSize';
        }
        if ($this->options['min_file_size'] &&
            $file_size < $this->options['min_file_size']) {
            return 'minFileSize';
        }
        if (is_int($this->options['max_number_of_files']) && (
            count($this->get_file_objects()) >= $this->options['max_number_of_files'])
        ) {
            return 'maxNumberOfFiles';
        }
        return $error;
    }

    protected function upcount_name_callback($matches) {
        $index = isset($matches[1]) ? intval($matches[1]) + 1 : 1;
        $ext = isset($matches[2]) ? $matches[2] : '';
        return ' ('.$index.')'.$ext;
    }

    protected function upcount_name($name) {
        return preg_replace_callback(
            '/(?:(?: \(([\d]+)\))?(\.[^.]+))?$/',
            array($this, 'upcount_name_callback'),
            $name,
            1
        );
    }

    protected function trim_file_name($name, $type) {
        // Remove path information and dots around the filename, to prevent uploading
        // into different directories or replacing hidden system files.
        // Also remove control characters and spaces (\x00..\x20) around the filename:
        $file_name = trim(basename(stripslashes($name)), ".\x00..\x20");
        // Add missing file extension for known image types:
        if (strpos($file_name, '.') === false &&
            preg_match('/^image\/(gif|jpe?g|png)/', $type, $matches)) {
            $file_name .= '.'.$matches[1];
        }
        //        if ($this->options['discard_aborted_uploads']) {
        //            while(is_file($this->options['upload_dir'].$file_name)) {
        //                $file_name = $this->upcount_name($file_name);
        //            }
        //        }
        return $file_name;
    }

    protected function orient_image($file_path) {
        $exif = @exif_read_data($file_path);
        if ($exif === false) {
            return false;
        }
        $orientation = intval(@$exif['Orientation']);
        if (!in_array($orientation, array(3, 6, 8))) {
            return false;
        }
        $image = @imagecreatefromjpeg($file_path);
        switch ($orientation) {
            case 3:
                $image = @imagerotate($image, 180, 0);
                break;
            case 6:
                $image = @imagerotate($image, 270, 0);
                break;
            case 8:
                $image = @imagerotate($image, 90, 0);
                break;
            default:
                return false;
        }
        $success = imagejpeg($image, $file_path);
        // Free up memory (imagedestroy does not delete files):
        @imagedestroy($image);
        return $success;
    }

    protected function handle_file_upload($uploaded_file, $name, $size, $type, $error) {
        global $imageProcessingSettings;
        $file = new stdClass();
        $file->ext = strtolower(substr(strrchr(basename($name), '.'), 1));
        if(strlen($this->options['imageFileName'])>0){
            $name = $this->options['imageFileName'];
            $fileName = $this->trim_file_name($name.'.'.$file->ext, $type);
        }
        else{
            $fileName = FileController::ruslat($this->trim_file_name($name, $type));
        }
        if(count($this->options['image_versions'])>0){
            $file->name = $this->setNewFileName($this->setNewFileName($fileName, $imageProcessingSettings['originalImagesPath'].'/')
                , $this->options['upload_dir']);
        }
        else{
            $file->name = $this->setNewFileName($fileName, $this->options['upload_dir']);
        }
        $file->size = intval($size);
        $file->type = $type;
        $file->errNo = '0';
        $error = $this->has_error($uploaded_file, $file, $error);
        if (!$error && $file->name) {
            $file_path = $this->options['upload_dir'].$file->name;
            $append_file = !$this->options['discard_aborted_uploads'] &&
                is_file($file_path) && $file->size > filesize($file_path);
            clearstatcache();
            if ($uploaded_file && is_uploaded_file($uploaded_file)) {
                // multipart/formdata uploads (POST method uploads)
                if ($append_file) {
                    file_put_contents(
                        $file_path,
                        fopen($uploaded_file, 'r'),
                        FILE_APPEND
                    );
                } else {
                    move_uploaded_file($uploaded_file, $file_path);
                }
            } else {
                // Non-multipart uploads (PUT method support)
                file_put_contents(
                    $file_path,
                    fopen('php://input', 'r'),
                    $append_file ? FILE_APPEND : 0
                );
            }
            $file_size = filesize($file_path);
            if ($file_size === $file->size) {
                if ($this->options['orient_image']) {
                    $this->orient_image($file_path);
                }
                $file->url = $this->options['upload_url'].rawurlencode($file->name);
                if(count($this->options['image_versions'])>0)
                {
                    if(!$imageProcessingSettings['deleteOriginalImage']){
                        $origImageId = $this->saveOriginalImage($file->name, $this->options['water_mark']['id']);
                        $file->origImageId = $origImageId;
                        $this->saveDescription($origImageId);
                    }
                    foreach($this->options['image_versions'] as $version => $options) {
                        //if ($this->create_scaled_image($file->name, $options, $origImageId)) {
                        if ($this->create_scaled_image($file->name, $file->ext, $options, $origImageId)) {
                            //                            if ($this->options['upload_dir'] !== $options['upload_dir']) {
                            //$file->{$version.'_url'} = $options['upload_url'].rawurlencode($file->name);
                            $imFileName = '';
                            if(strlen($this->options['imageFileName'])>0)
                                $imFileName = '_'.$this->options['imageFileName'];
                            $file->{$options['version'].'_url'} = $options['upload_url'].rawurlencode($origImageId.'_'.$options['max_width'].'x'.$options['max_height'].$imFileName.".".$file->ext);
                            //                            } else {
                            //                                clearstatcache();
                            //                                $file_size = filesize($file_path);
                            //                            }
                        }
                        else{
                            Context::Log(true, 'imageCreate')->log("Error to create image file ".$this->options['imageFileName']);
                        }
                    }
                    if($imageProcessingSettings['deleteOriginalImage']){
                        unlink($file_path);
                    }
                    else{
                        if(!file_exists($imageProcessingSettings['originalImagesPath']))
                            mkdir($imageProcessingSettings['originalImagesPath']);
                        copy($file_path, $imageProcessingSettings['originalImagesPath'].'/'.$file->name);
                        unlink($file_path);
                    }
                }
            } else if ($this->options['discard_aborted_uploads']) {
                unlink($file_path);
                $file->error = 'abort';
                $file->errNo = '8';
            }
            $file->size = $file_size;
            //by iwan
            //$this->set_file_delete_url($file);
        } else {
            $file->error = $error;
            $file->errNo = $error;
        }
        return $file;
    }

    public function get() {
        $file_name = isset($_REQUEST['file']) ?
            basename(stripslashes($_REQUEST['file'])) : null;
        if ($file_name) {
            $info = $this->get_file_object($file_name);
        } else {
            $info = $this->get_file_objects();
        }
        header('Content-type: application/json');
        echo json_encode($info);
    }

    public function post() {
        if (isset($_REQUEST['_method']) && $_REQUEST['_method'] === 'DELETE') {
            return $this->delete();
        }
        $upload = isset($_FILES[$this->options['param_name']]) ?
            $_FILES[$this->options['param_name']] : null;
        $info = array();
        if ($upload && is_array($upload['tmp_name'])) {
            // param_name is an array identifier like "files[]",
            // $_FILES is a multi-dimensional array:
            foreach ($upload['tmp_name'] as $index => $value) {
                $info[] = $this->handle_file_upload(
                    $upload['tmp_name'][$index],
                    isset($_SERVER['HTTP_X_FILE_NAME']) ?
                        $_SERVER['HTTP_X_FILE_NAME'] : $upload['name'][$index],
                    isset($_SERVER['HTTP_X_FILE_SIZE']) ?
                        $_SERVER['HTTP_X_FILE_SIZE'] : $upload['size'][$index],
                    isset($_SERVER['HTTP_X_FILE_TYPE']) ?
                        $_SERVER['HTTP_X_FILE_TYPE'] : $upload['type'][$index],
                    $upload['error'][$index]
                );
            }
        } elseif ($upload || isset($_SERVER['HTTP_X_FILE_NAME'])) {
            // param_name is a single object identifier like "file",
            // $_FILES is a one-dimensional array:
            $info[] = $this->handle_file_upload(
                isset($upload['tmp_name']) ? $upload['tmp_name'] : null,
                isset($_SERVER['HTTP_X_FILE_NAME']) ?
                    $_SERVER['HTTP_X_FILE_NAME'] : (isset($upload['name']) ?
                    $upload['name'] : null),
                isset($_SERVER['HTTP_X_FILE_SIZE']) ?
                    $_SERVER['HTTP_X_FILE_SIZE'] : (isset($upload['size']) ?
                    $upload['size'] : null),
                isset($_SERVER['HTTP_X_FILE_TYPE']) ?
                    $_SERVER['HTTP_X_FILE_TYPE'] : (isset($upload['type']) ?
                    $upload['type'] : null),
                isset($upload['error']) ? $upload['error'] : null
            );
        }
        //        header('Vary: Accept');
        //        $json = json_encode($info);
        //        $redirect = isset($_REQUEST['redirect']) ?
        //            stripslashes($_REQUEST['redirect']) : null;
        //        if ($redirect) {
        //            header('Location: '.sprintf($redirect, rawurlencode($json)));
        //            return;
        //        }
        //        if (isset($_SERVER['HTTP_ACCEPT']) &&
        //            (strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false)) {
        //            header('Content-type: application/json');
        //        } else {
        //            header('Content-type: text/plain');
        //        }
        //        echo $json;
        return $info;
    }

    public function delete() {
        $file_name = isset($_REQUEST['file']) ?
            basename(stripslashes($_REQUEST['file'])) : null;
        $file_path = $this->options['upload_dir'].$file_name;
        $success = is_file($file_path) && $file_name[0] !== '.' && unlink($file_path);
        if ($success) {
            foreach($this->options['image_versions'] as $version => $options) {
                $file = $options['upload_dir'].$file_name;
                if (is_file($file)) {
                    unlink($file);
                }
            }
        }
        header('Content-type: application/json');
        echo json_encode($success);
    }

    protected function saveOriginalImage($name, $watermarkId)
    {
        $query = "INSERT INTO be_Images (viewId, title, waterMarkId) VALUES ('130', '".$name."', '".$watermarkId."')";
        if(!Context::DB()->query($query))
            return false;
        return Context::DB()->LIID;
    }

    protected function saveDescription($imageId)
    {
        $query = "  INSERT INTO be_ImageDescription (viewId, imageId, langId, objectName, workName, author, authorUrl) VALUES";
        $queryValues = '';
        $k = 0;
        foreach ($this->options['image_description'] as $item){
            if(!$this->validateDescription($item))
                continue;
            if($k > 0)
                $queryValues .= ',';
            $queryValues .= '("132", "'.$imageId.'", "'.$item['langId'].'", "'.$item['objectName'].'", "'.$item['workName'].'", "'.$item['author'].'", "'.$item['authorUrl'].'")';
            $k++;
        }
        if(strlen($queryValues) > 0){
            $query.= $queryValues;
            if(Context::DB()->query($query))
                return true;
            else
                return false;
        }
        return true;
    }

    protected function validateDescription($data)
    {
        if(strlen(trim($data['objectName'])) > 0 || strlen(trim($data['workName'])) > 0 || strlen(trim($data['author'])) > 0)
            return true;
        return false;
    }

    protected function saveScaledImage($origImageId, $sizeId, $path, $url)
    {
        $query = "INSERT INTO be_ImageSizeRelations (imageId, sizeCode, path, url) VALUES ('".$origImageId."', '".$sizeId."', '".appUrl::ValueToSitePathConstant($path)."', '".appUrl::ValuesToCMSConstants($url)."')";
        if(Context::DB()->query($query))
            return true;
        return false;
    }
}
