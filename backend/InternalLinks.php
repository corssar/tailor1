<?php
include_once('../config.php');
include_once(BACKEND_PATH.'/config.php');
include(BACKEND_PATH.'inc/BackendInit.inc.php');


if (!$admin->auth_ok)
{
	header('Location: Access.php');
}
?>

<?php
if (isset($_GET['content']) && $_GET['content']=="filemanager")
{
?>
<html>
<head>
<meta http-equiv=content-type content="text/html; charset=UTF-8">
</head>
<?=$xajax_js?>
	  	<script>
	  	<?
	  		foreach ($lang as $key=>$value)
	  		{
	  			echo 'var '.$key.' = \''.addslashes($value).'\';';
	  		}
	  	
	  	?>
	  	</script>
<body>
<iframe name="frmFileManager" style="border:none;" src="webcontent/fckeditor/editor/filemanager/browser/default/browser.html?clickaction=addlink" width="100%" height="100%"></iframe>
</body>
</html>
<?php
}
else 
{
?>
<html>
	<head>
		<meta http-equiv=content-type content="text/html; charset=UTF-8">
		<link rel="stylesheet" media="all" type="text/css" type="text/css" href="webcontent/css/PageBuilder.css" />
		<link rel="stylesheet" media="all" type="text/css" type="text/css" href="webcontent/css/General.css" />
	  	<?=$xajax_js?>
	  	<script>
	  	<?
	  		foreach ($lang as $key=>$value)
	  		{
	  			echo 'var '.$key.' = \''.addslashes($value).'\';';
	  		}
	  	
	  	?>
	  	</script>
	  	
		<script type="text/javascript" src="webcontent/js/Navigation.js"></script>
		<script type="text/javascript" src="webcontent/js/PageBuilder.js"></script>
		<script type="text/javascript" src="webcontent/js/DialogMessageBox.js"></script>
		<script type="text/javascript" src="webcontent/js/Search.js"></script>
	</head>
	<body oncontextmenu="return false" style="background-image:none;background-color:#FFF;">
	<div id="main_content_container" style="background-color:#FFF;height: 97%;">
		&nbsp;	  			  		
	</div>
	<script>
		navigation.sendRequest('ViewController','viewBuild',{viewId:1,searchType:'internalLinks'});
	</script>
	</body>
</html>
<?php
};
?>