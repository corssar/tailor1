<?
class Validate
{
	
	public function checkIllegalChars($str, $minsize = 1, $maxsize = 50)
	{
		$str = trim($str);
		if (!preg_match('/^[a-z][a-z\d\!@#\$%\^&\(\)\-\=\+_;,\{\}]+$/i', $str) )
		{
			return $str;
		}
		else return false;
	}
	
	public function checkpassword($str, $minsize = 6, $maxsize = 50)
	{
		if (strlen($str)>=$minsize && strlen($str)<=$maxsize)
		{
			return $str;
		}
		else return false;
	}
	
	function pregtrim($str)
	{
   		return preg_replace("/[^x20-xFF]/","",$str);
	}

	public function checkUserEmail($mail, $maxsize = 255)
	{
	   $mail=trim($mail);
	   if (strlen($mail)==0) return false;
	   if (strlen($mail)>$maxsize) return false;
	   if (!preg_match("/^[a-z0-9]{1}[a-z0-9\._-]{1,30}@(([a-z0-9-]+\.)+(com|net|org|mil|".
	   "edu|gov|arpa|info|biz|inc|name|[a-z]{2,4})|[0-9]{1,3}\.[0-9]{1,3}\.[0-".
	   "9]{1,3}\.[0-9]{1,3})$/is",$mail))
			return false;
	   return $mail;
	}
	
	public function checkPhoneNumber($phobeNumber, $maxsize = 17)
	{
		if (preg_match("/(?:8|\+d{1-3})? ?\(?(\d{3})\)? ?(\d{3})[ -]?(\d{2})[ -]?(\d{2})$/", $phobeNumber))
		{
			return $phobeNumber;
		}
		else return false;
	}
	
	public function notEmpty($value)
	{
		if(trim($value)!='')
			return true;
		else 
			return false;
	}
	
	function createImage($image_type, $inputFilename, $width = 135, $height = 135, $avatar = false)
	{
		$imagedata = getimagesize($inputFilename);
		$w = $imagedata[0];
		$h = $imagedata[1];
		$leftX = 0;
		if($w==$h)
		{
			$new_height = $height;
			$new_width = $width;
		}
		
		if ($avatar)
		{
			if ($w<$h)
			{
				$new_width = $width;
				$new_height = $height;
				$h = floor($height*$w/$width);
			}
			elseif ($h<$w)
			{
				$new_height = $height;
				$new_width = $width;
				$w = floor($width*$h/$height);
				$leftX = floor(($w-$width)*$height/$h/2);
			} else {
				$new_height = $h;
				$new_width = $w;
			}
		}
		else 
		{
			if ($h>$height || $w>$width)
			{
				if ( ( $h - ($h*0.1) ) > $w )
				{
					$new_height = $height;
					$per   = ($new_height/$h);  
					$new_width = floor($w*$per);
				}
				else
				{
					$new_width = $width;
					$per   = ($new_width/$w);  
					$new_height = floor($h*$per);
				}
			} else {
				$new_height = $h;
				$new_width = $w;
			}
		}
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
		imagecopyResampled ($im2, $image, 0, 0, $leftX, 0, $new_width, $new_height, $w, $h);
		$im_arr = array($im1,$im2);
		return $im_arr;
		
	}
	
	function createAvatarImage($image_type, $inputFilename, $width = 60, $height = 80)
	{
		$imagedata = getimagesize($inputFilename);
		$w = $imagedata[0];
		$h = $imagedata[1];
		$leftX	=	0;
		$topY	=	0;
		

		if ($w<$h)
		{
			$new_width = $width;
			$new_height = $height;
			$oldH	=	$h;
			$h = floor($height*$w/$width);
			$topY	=	floor(($oldH/2)-($h/2));
		}
		else
		{
			$new_height = $height;
			$new_width = $width;
			$oldW	=	$w;
			$w = floor($width*$h/$height);
			//$leftX = floor(($w-$width)*$height/$h/2);
			$leftX	=	floor(($oldW/2)-($w/2));
		}

		
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
		imagecopyResampled ($im2, $image, 0, 0, $leftX, $topY, $new_width, $new_height, $w, $h);

		$im_arr = array($im1,$im2);
		return $im_arr;
		
	}
	
}

?>