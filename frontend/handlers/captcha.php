<?php
include('../../config.php');
session_start();

$getparam = (isset($_GET['sesparam']) && $_GET['sesparam']!='')?$_GET['sesparam']:0;

if ($getparam=='') die;
get_checkcode_picture($_SESSION[$getparam]);

header("Content-Type: image/jpeg");
die;

function get_checkcode_picture($code)
{
	$img=imagecreatetruecolor(86, 34);
	//$img = @imagecreatefromjpeg(FRONTEND_PATH.'webcontent/system_images/captcha_bg.jpg');
//
	$fon = imagecolorallocate($img, 115, 177, 228);
	imagefill($img,0,0,$fon); 

	$textcolor = imagecolorallocate ( $img , 255, 255, 255);
	
	$dL = drawLine('x');
	imageline($img, $dL['x1'], $dL['y1'], $dL['x2'], $dL['y2'], $textcolor);
	$dL = drawLine('x');
	imageline($img, $dL['x1'], $dL['y1'], $dL['x2'], $dL['y2'], $textcolor);
	$dL = drawLine('y');
	imageline($img, $dL['x1'], $dL['y1'], $dL['x2'], $dL['y2'], $textcolor);
	$dL = drawLine('y');
	imageline($img, $dL['x1'], $dL['y1'], $dL['x2'], $dL['y2'], $textcolor);
	
	imagestring($img, 5, 30, 10, $code, $textcolor);
	imagejpeg($img);
}
function drawLine($cord)
{
	$sizeX = 86;
	$sizeY = 34;
	if ($cord == 'x')
		{
		$x1=0;
		$x2=$sizeX;
		$y1=rand(0, $sizeY);
		$y2=rand(0, $sizeY);
	}
	else
	{
		$x1=rand(0, $sizeX);
		$x2=rand(0, $sizeX);
		$y1=0;
		$y2=$sizeY;
	}
	return array('x1'=>$x1, 'y1'=>$y1, 'x2'=>$x2, 'y2'=>$y2);
}
?>