<?php

class FileController {

	var $response = array('HTML'=>'', 'JS' => '');	

	public function renameResource($resourceInfo)
	{
		global $filemanagertypes;
		$error = 0;
		$resourcePath = trim($resourceInfo['resourcePath']);
		$resourceType = trim($resourceInfo['resourceType']);
		$resourceName = trim($resourceInfo['resourceName']);
		$resourceName = $this->clearspacchars($resourceName);
		$type = strtolower($resourceInfo['type']);
		if ($resourceName=="" && $resourceType=="file")
		{
			$this->response['JS'].="alert(FILEMANAGER_ALERT_8);";/*Enter please filename !!!*/
			return $this->response;
		}
		if ($resourceName=="" && $resourceType=="folder")
		{
			$this->response['JS'].="alert(FILEMANAGER_ALERT_9);";/*Enter please dirname !!!*/
			return $this->response;;
		}
		if ($resourceType == 'file')
		{
			if (TRANSLIT) $resourceName = $this->ruslat($resourceName, false, true);
			if (strstr($resourcePath, "http://")) $resourcePath = $this->strfirstreplace($resourcePath,SITE_PROTOCOL.SITE_URL."/",SITE_PATH);
			if (!$this->rename_file($resourcePath,$resourceName))
			{
				$this->response['JS'].="alert(ERROR + ':' + ' ' + FILE + '\'".$resourcePath."\' ' + FILEMANAGER_ALERT_11_1 + ' \'".$resourceName."\', ' + MAYBE + ' ' + FILE + ' ' +  FILEMANAGER_ALERT_11_2  + ' ' + OR + ' ' + FILE + ' ' + FILEMANAGER_ALERT_11_3 );";/*Error: file ".$resourcePath." not can rename as ".$resourceName.", maybe file was rename earn or file is exits*/
				return $this->response;
			}
			if ($type=="image" && FILEMANAGER_PREVIEW_IMAGE) 
			{
				$file_small = $resourcePath;
				$file_small = $this->strfirstreplace($file_small, PATH_TO_NORMAL_IMAGE_FILES, PATH_TO_SMALL_IMAGE_FILES);
				if (!$this->rename_file($file_small,$resourceName)) $this->response['JS'].="alert(ERROR + ':' + ' ' + FILE + ' ' + FILEMANAGER_ALERT_12_1 + ' ' + '\'".$file_small."\' ' + FILEMANAGER_ALERT_11_1 + ' \'".$resourceName."\', ' + MAYBE + ' ' + FILE + ' ' +  FILEMANAGER_ALERT_11_2  + ' ' + OR + ' ' + FILE + ' ' + FILEMANAGER_ALERT_11_3 );";/*Error: file (copy) ".$file_small." not can rename as ".$resourceName.", maybe file was rename earn or file is exits*/
			}
		}
		elseif($resourceType == 'folder')
		{
			$resourcePath = SITE_PATH.DIR_FOR_FILEMANAGER_PATH.$filemanagertypes[$type].$resourcePath;
			if (TRANSLIT) $resourceName = $this->ruslat($resourceName,true,true);
			if (!$this->rename_directory($resourcePath,$resourceName))
			{
				$this->response['JS'].="alert(ERROR + ':' + ' ' + FOLDER + '\'".$resourcePath."\' ' + FILEMANAGER_ALERT_11_1 + ' \'".$resourceName."\', ' + MAYBE + FOLDER + ' ' +  FILEMANAGER_ALERT_11_2  + ' ' + OR + ' ' + FOLDER + ' ' + FILEMANAGER_ALERT_11_3 );";/*Error: folder ".$resourcePath." not can rename as ".$resourceName.", maybe folder was rename earn or folder is exits*/
				return $this->response;
			}
			if ($type=="image" && FILEMANAGER_PREVIEW_IMAGE) 
			{
				$folder_small = $resourcePath;
				$folder_small = $this->strfirstreplace($folder_small, PATH_TO_NORMAL_IMAGE_FILES, PATH_TO_SMALL_IMAGE_FILES);
				if (!$this->rename_directory($folder_small,$resourceName)) $this->response['JS'].="alert(ERROR + ':' + ' ' + FOLDER + ' ' + FILEMANAGER_ALERT_12_1 + ' ' + '\'".$resourcePath."\' ' + FILEMANAGER_ALERT_11_1 + ' \'".$resourceName."\', ' + MAYBE + FOLDER + ' ' +  FILEMANAGER_ALERT_11_2  + ' ' + OR + ' ' + FOLDER + ' ' + FILEMANAGER_ALERT_11_3 );";/*Error: folder ".$resourcePath." not can rename as ".$resourceName.", maybe folder was rename earn or folder is exits*/
			}
		}
		else $this->response['JS'].="alert(FILEMANAGER_ALERT_10)";/*Fatal error: Do not know, what resourse must be edit(file or folder)*/
		$this->response['JS'].="window.frames['frmFileManager'].frames['frmResourcesList'].Refresh();";
		return $this->response;
	}

	private function rename_directory($olddir, $newdirname)
	{
		$mas = explode("/",$olddir);
		$olddir2 = $mas[count($mas)-2];
		$mas[count($mas)-2]=$newdirname;
		$newdirname=implode("/",$mas);
		//$this->response['JS'].="alert('Max say oldpath=".$olddir."; newname=".$newdirname."');";
		if ($olddir==$newdirname) return false;
		if (file_exists($olddir) && rename($olddir,$newdirname)) return true; else return false;
	}

	//$oldfile содержит в себе путь к файлу и само название файла с расширением,
	//а $newfile содержит только новое имя файла, без расширения.
	//Пример:	rename_file("../dir1/dir2/info.jpg","logo")
	private function rename_file($oldfile, $newfilename)
	{
		$mas = explode("/",$oldfile);
		$oldfile2 = $mas[count($mas)-1];
		$mas2 = explode(".",$oldfile2);
		$typename= $mas2[count($mas2)-1];
		$mas[count($mas)-1]=$newfilename.".".$typename;
		$newfilename=implode("/",$mas);	
		//$this->response['JS'].="alert('oldfile=".$oldfile."; newfile=".$newfilename."');";
		if ($newfilename==$oldfile) return false;
		if (file_exists($oldfile) && rename($oldfile,$newfilename)) return true; else return false;
	}

	public function deleteResource($resourceInfo)
	{
		global $filemanagertypes;
		$objPath=$resourceInfo['objPath'];
		$objType=$resourceInfo['objType'];
		$type = strtolower($resourceInfo['type']);
		if (strstr($objPath, "http://")) $objPath = "/".$this->strfirstreplace($objPath,SITE_PROTOCOL.SITE_URL."/",SITE_PATH);
		//$this->response['JS'].="alert('".SITE_PATH.DIR_FOR_FILEMANAGER_PATH.$filemanagertypes[$type].$objPath."');";
		if ($objType=="folder")
		{
			if (!$this->delete_directory(SITE_PATH.DIR_FOR_FILEMANAGER_PATH.$filemanagertypes[$type].$objPath))
			{
				$this->response['JS'].="alert( ERROR + FILEMANAGER_ALERT_13_1 + FOLDER + ' \'".SITE_PATH.DIR_FOR_FILEMANAGER_PATH.$filemanagertypes[$type].$objPath."\'' + ' ' + FILEMANAGER_ALERT_13_3);";/*Error: Don\'t delete folder (copy) or one of her components(file or files) or folder was already delete earn*/
				return $this->response;
			}
			if ($type=="image" && FILEMANAGER_PREVIEW_IMAGE) 
			{
				$folder_small = SITE_PATH.DIR_FOR_FILEMANAGER_PATH.$filemanagertypes[$type].$objPath;
				$folder_small = $this->strfirstreplace($folder_small, PATH_TO_NORMAL_IMAGE_FILES, PATH_TO_SMALL_IMAGE_FILES);
				if (!$this->delete_directory($folder_small))$this->response['JS'].="alert( ERROR + FILEMANAGER_ALERT_13_1 + FOLDER + ' ' + FILEMANAGER_ALERT_12_1 + ' \'".$folder_small."\'' + ' ' + FILEMANAGER_ALERT_13_3);";/*Error: Don\'t delete folder (copy) or one of her components(file or files) or folder was already delete earn*/
			}
		}
		elseif ($objType=="file")
		{
			if (!$this->delete_file($objPath))
			{
				$this->response['JS'].="alert( ERROR + ': ' + FILEMANAGER_ALERT_13_1 + ' ' + FILE + '\'".$objPath."\', ' + MAYBE + ' ' + FILE + ' ' + FILEMANAGER_ALERT_13_2);";/*Error: Don\'t delete file \'".$objPath."\', maybe file was already delete earn*/
				return $this->response;
			}
			if ($type=="image"  && FILEMANAGER_PREVIEW_IMAGE) 
			{
				$file_small = $objPath;
				$file_small = $this->strfirstreplace($file_small, PATH_TO_NORMAL_IMAGE_FILES, PATH_TO_SMALL_IMAGE_FILES);
				if (!$this->delete_file($file_small)) $this->response['JS'].="alert( ERROR + ': ' + FILEMANAGER_ALERT_13_1 + ' ' + FILE + ' ' + FILEMANAGER_ALERT_12_1 + ' \'".$file_small."\', ' + MAYBE + ' ' + FILE + ' ' + FILEMANAGER_ALERT_13_2);";/*Error: Don\'t delete file (copy) \'".$small_file."\', maybe file was already delete earn*/
			}
			if ($type=="image"){
                		$this->deleteImageSizeRelation($resourceInfo['objPath']);
	                }
		}
		else $this->response['JS'].="alert(FILEMANAGER_ALERT_10)";/*Fatal error: Do not know, what resourse must be edit(file or folder)*/
		$this->response['JS'].="window.frames['frmFileManager'].frames['frmResourcesList'].Refresh();";
		return $this->response;
	}

	private function deleteImageSizeRelation($url)
	{
        $query = "SELECT imageId FROM be_ImageSizeRelations WHERE url = '".appUrl::ValuesToCMSConstants($url)."'";
        if(Context::DB()->query($query)){
            $imageId = Context::DB()->result[0]['imageId'];
            $query = "DELETE FROM be_ImageSizeRelations WHERE url = '".appUrl::ValuesToCMSConstants($url)."'";
            Context::DB()->query($query);
            $query = "SELECT count(id) count FROM be_ImageSizeRelations WHERE imageId = $imageId";
            Context::DB()->query($query);
            if(Context::DB()->result[0]['count'] == 0){
                $query = "DELETE FROM be_Images WHERE id = $imageId";
                Context::DB()->query($query);
            }
            return true;
        }
        return false;
	}
	
	private function delete_directory($dirname)  {
	        if  (is_dir($dirname))
	                $dir_handle  =  opendir($dirname);
	        if  (!$dir_handle)
	                return  false;
	        while($file  =  readdir($dir_handle))  {
	                if  ($file  !=  "."  &&  $file  !=  "..")  {
	                        if  (!is_dir($dirname."/".$file))
	                                unlink($dirname."/".$file);
	                        else
	                                $this->delete_directory($dirname.'/'.$file);                       
	                }
	        }
	        closedir($dir_handle);
	        if (file_exists($dirname) && rmdir($dirname)) return true; else return false;
	}

	private function delete_file($filename)
	{
		if (file_exists($filename) && unlink($filename)) return true; else return false;
	}
	
	private function strfirstreplace($str, $findstr, $replacestr)
	{
		$i = strpos($str,$findstr);
		$length = strlen($str);
		$findlength = strlen($findstr);
		$str1 = substr($str,0,$i+$findlength);
		$str2 = substr($str,$i+$findlength,$length);
		$str1 = str_replace($findstr,$replacestr,$str1);
		return $str1.$str2;
	}

	public function clearspacchars($string,$pointer=true)
	{
		$string = str_replace("/","_slash_",$string);
		$string = str_replace("\\","_unslash_",$string);
		$string = str_replace("\"","_quot_",$string);
		$string = str_replace("'","_aol_",$string);
		$string = str_replace("&","_ampercent_",$string);
		if ($pointer) $string = str_replace(".","_point_",$string);
		$string = str_replace(",","_koma_",$string);
		return $string;
	}

	public function ruslat($string, $folder = false, $rename = false)
	{
		/*if ($folder || $rename) $string = FileController::ruslat1($string);
		else if (eregi("MSIE 6", $_SERVER['HTTP_USER_AGENT']))
			$string = FileController::ruslat2($string);
		else if (eregi("MSIE 7", $_SERVER['HTTP_USER_AGENT']))
			$string = FileController::ruslat1($string);
		else
			$string = FileController::ruslat2($string);*/
			$string = FileController::ruslat1($string);
			$string = FileController::ruslat2($string);
		return $string;
	}
	
	public function ruslat1($string) # Задаём функцию перекодировки кириллицы в транслит.
	{
		//$string = iconv("cp-1251","UTF-8",$string);
		//$string = $this->ruslat2($string);
		$string = str_replace("Рђ","A",$string);//А
		$string = str_replace("Р‘","B",$string);//Б
		$string = str_replace("Р’","V",$string);//В
		$string = str_replace("Р“","G",$string);//Г
		$string = str_replace("Р”","D",$string);//Д
		$string = str_replace("Р•","E",$string);//Е
		$string = str_replace("РЃ","Jo",$string);//Ё
		$string = str_replace("Р–","Zh",$string);//Ж
		$string = str_replace("Р—","Z",$string);//З
		$string = str_replace("Р","I",$string);//И
		$string = str_replace("Р™","J",$string);//Й
		$string = str_replace("Рљ","K",$string);//К
		$string = str_replace("Р›","L",$string);//Л
		$string = str_replace("Рњ","M",$string);//М
		$string = str_replace("Рќ","N",$string);//Н
		$string = str_replace("Рћ","O",$string);//О
		$string = str_replace("Рџ","P",$string);//П
		$string = str_replace("Р ","R",$string);//Р
		$string = str_replace("РЎ","S",$string);//С
		$string = str_replace("Рў","T",$string);//Т
		$string = str_replace("РЈ","U",$string);//У
		$string = str_replace("Р¤","F",$string);//Ф
		$string = str_replace("РҐ","H",$string);//Х
		$string = str_replace("Р¦","C",$string);//Ц
		$string = str_replace("Р§","Ch",$string);//Ч
		$string = str_replace("РЁ","Sh",$string);//Ш
		$string = str_replace("Р©","Shh",$string);//Щ
		$string = str_replace("РЄ","IYY",$string);//Ъ
		$string = str_replace("Р«","Y",$string);//Ы
		$string = str_replace("Р¬","IY",$string);//Ь
		$string = str_replace("Р­","E",$string);//Э
		$string = str_replace("Р®","Ju",$string);//Ю
		$string = str_replace("РЇ","Ja",$string);//Я
		$string = str_replace("Р‡","Ji",$string);//Ї
		$string = str_replace("Р†","I",$string);//І
		$string = str_replace("Р„","Je",$string);//Є
		$string = str_replace("Р°","a",$string);//а
		$string = str_replace("Р±","b",$string);//б
		$string = str_replace("РІ","v",$string);//в
		$string = str_replace("Рі","g",$string);//г
		$string = str_replace("Рґ","d",$string);//д
		$string = str_replace("Рµ","e",$string);//е
		$string = str_replace("С‘","jo",$string);//ё
		$string = str_replace("Р¶","zh",$string);//ж
		$string = str_replace("Р·","z",$string);//з
		$string = str_replace("Рё","i",$string);//и
		$string = str_replace("Р№","j",$string);//й
		$string = str_replace("Рє","k",$string);//к
		$string = str_replace("Р»","l",$string);//л
		$string = str_replace("Рј","m",$string);//м
		$string = str_replace("РЅ","n",$string);//н
		$string = str_replace("Рѕ","o",$string);//о
		$string = str_replace("Рї","p",$string);//п
		$string = str_replace("СЂ","r",$string);//р
		$string = str_replace("СЃ","s",$string);//с
		$string = str_replace("С‚","t",$string);//т
		$string = str_replace("Сѓ","u",$string);//у
		$string = str_replace("С„","f",$string);//ф
		$string = str_replace("С…","h",$string);//х
		$string = str_replace("С†","c",$string);//ц
		$string = str_replace("С‡","ch",$string);//ч
		$string = str_replace("С€","sh",$string);//ш
		$string = str_replace("С‰","shh",$string);//щ
		$string = str_replace("СЉ","iyy",$string);//ъ
		$string = str_replace("С‹","y",$string);//ы
		$string = str_replace("СЊ","iy",$string);//ь
		$string = str_replace("СЌ","e",$string);//э
		$string = str_replace("СЋ","ju",$string);//ю
		$string = str_replace("СЏ","ja",$string);//я
		$string = str_replace("С—","ji",$string);//ї
		$string = str_replace("С–","i",$string);//і
		$string = str_replace("С”","je",$string);//є
		return $string;
	}
	
	public function ruslat2($string) # Задаём функцию перекодировки кириллицы в транслит.
	{
		$string = str_replace("ж","zh",$string);
		$string = str_replace("ё","yo",$string);
		$string = str_replace("й","i",$string);
		$string = str_replace("ю","yu",$string);
		$string = str_replace("ь","y",$string);
		$string = str_replace("ч","ch",$string);
		$string = str_replace("щ","sh",$string);
		$string = str_replace("ц","c",$string);
		$string = str_replace("у","u",$string);
		$string = str_replace("к","k",$string);
		$string = str_replace("е","e",$string);
		$string = str_replace("н","n",$string);
		$string = str_replace("г","g",$string);
		$string = str_replace("ш","sh",$string);
		$string = str_replace("з","z",$string);
		$string = str_replace("х","h",$string);
		$string = str_replace("ъ","yy",$string);
		$string = str_replace("ф","f",$string);
		$string = str_replace("ы","y",$string);
		$string = str_replace("в","v",$string);
		$string = str_replace("а","a",$string);
		$string = str_replace("п","p",$string);
		$string = str_replace("р","r",$string);
		$string = str_replace("о","o",$string);
		$string = str_replace("л","l",$string);
		$string = str_replace("д","d",$string);
		$string = str_replace("э","yе",$string);
		$string = str_replace("я","ja",$string);
		$string = str_replace("с","s",$string);
		$string = str_replace("м","m",$string);
		$string = str_replace("и","i",$string);
		$string = str_replace("т","t",$string);
		$string = str_replace("б","b",$string);
		$string = str_replace("Ё","yo",$string);
		$string = str_replace("Й","I",$string);
		$string = str_replace("Ю","YU",$string);
		$string = str_replace("Ч","CH",$string);
		$string = str_replace("Ь","Y",$string);
		$string = str_replace("Щ","SH'",$string);
		$string = str_replace("Ц","C",$string);
		$string = str_replace("У","U",$string);
		$string = str_replace("К","K",$string);
		$string = str_replace("Е","E",$string);
		$string = str_replace("Н","N",$string);
		$string = str_replace("Г","G",$string);
		$string = str_replace("Ш","SH",$string);
		$string = str_replace("З","Z",$string);
		$string = str_replace("Х","H",$string);
		$string = str_replace("Ъ","YY",$string);
		$string = str_replace("Ф","F",$string);
		$string = str_replace("Ы","Y",$string);
		$string = str_replace("В","V",$string);
		$string = str_replace("А","A",$string);
		$string = str_replace("П","P",$string);
		$string = str_replace("Р","R",$string);
		$string = str_replace("О","O",$string);
		$string = str_replace("Л","L",$string);
		$string = str_replace("Д","D",$string);
		$string = str_replace("Ж","Zh",$string);
		$string = str_replace("Э","Ye",$string);
		$string = str_replace("Я","Ja",$string);
		$string = str_replace("С","S",$string);
		$string = str_replace("М","M",$string);
		$string = str_replace("И","I",$string);
		$string = str_replace("Т","T",$string);
		$string = str_replace("Б","B",$string);
		$string = str_replace("Ї","Ji",$string);
		$string = str_replace("Є","Je",$string);
		$string = str_replace("І","I",$string);
		$string = str_replace("ї","ji",$string);
		$string = str_replace("є","je",$string);
		$string = str_replace("і","i",$string);
		return $string;
	}
}

?>