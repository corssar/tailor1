<?php
ob_start();
require_once ('../config.php');
require_once(BACKEND_PATH.'config.php');
require_once(BACKEND_PATH.'libs/MenuNavigation.php');
require_once(FRAMEWORK_PATH.'system/MultiSites.php');
include(BACKEND_PATH.'inc/BackendInit.inc.php');

if (!$admin->auth_ok)
{
	header('Location: Access.php');
}

?>
<html>
	<head>
		<meta http-equiv=content-type content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=8" />
		<link rel="stylesheet" media="all" type="text/css" href="webcontent/css/PageBuilder.css" />
		<link rel="stylesheet" media="all" type="text/css" href="webcontent/css/General.css" />
		<link rel="stylesheet" media="all" type="text/css" href="webcontent/css/MenuStyle.css" />
		<link rel="stylesheet" media="all" type="text/css" href="webcontent/css/Tabs.css" />
		<link rel="stylesheet" media="all" type="text/css" href="webcontent/css/Calendar.css" />
		<link rel="stylesheet" media="all" type="text/css" href="webcontent/css/drag-drop-folder-tree.css" />
		<link rel="stylesheet" media="all" type="text/css" href="webcontent/css/DynamicList.css" />
		<link rel="stylesheet" media="all" type="text/css" href="webcontent/css/custom.css" />
		<link rel="stylesheet" media="all" type="text/css" href="webcontent/css/context-menu.css" type="text/css"/>
		<link rel="stylesheet" media="all" type="text/css" href="webcontent/css/jquery-ui-dialog-1.8.css" rel="stylesheet" type="text/css"/>
		<link rel="stylesheet" media="all" type="text/css" href="webcontent/css/jquery.ui.tabs.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" media="all" type="text/css" href="webcontent/css/imageConfiguration.css" />
        <link rel="stylesheet" media="all" type="text/css" href="webcontent/css/datepicker.css" />

		
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
		<script type="text/javascript" src="webcontent/js/Calendar.js"></script>
		<script type="text/javascript" src="webcontent/js/Shadow.js"></script>
		<script type="text/javascript" src="webcontent/js/ScreenCenter.js"></script>
		<script type="text/javascript" src="webcontent/js/ModalBox.js"></script>
		<script type="text/javascript" src="webcontent/js/TreeModalBox.js"></script>
		<script type="text/javascript" src="webcontent/js/DialogMessageBox.js"></script>
		<script type="text/javascript" src="webcontent/js/Search.js"></script>
		<script type="text/javascript" src="webcontent/js/FckEditor.js"></script>
		<script type="text/javascript" src="webcontent/js/DynamicContent.js"></script>
		<script type="text/javascript" src="webcontent/js/FileManager.js"></script> 
		<script type="text/javascript" src="webcontent/js/ContextMenu.js"></script>
		<script type="text/javascript" src="webcontent/js/DragDropFolderTree.js"></script>
		<script type="text/javascript" src="webcontent/js/Tree.js"></script>
		<script type="text/javascript" src="webcontent/js/DynamicList.js"></script>
		<script type="text/javascript" src="webcontent/js/DropDownList.js"></script>
		<script type="text/javascript" src="webcontent/fckeditor/fckeditor.js"></script>
		<script type="text/javascript" src="webcontent/js/jquery-1.6.1.js"></script>
		<script type="text/javascript" src="webcontent/js/jquery-ui.min.1.8.js"></script>
		<script type="text/javascript" src="webcontent/js/jQueryFormPlugin.js"></script>
		<script type="text/javascript" src="webcontent/js/jQueryEx.js"></script>
        <script type="text/javascript" src="webcontent/js/Custom.js"></script>
        <script type="text/javascript" src="webcontent/js/ajaxfileupload.js"></script>
        <script type="text/javascript" src="webcontent/js/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="webcontent/js/jquery.fullscreen-min.js"></script>

		<?
		if(Context::SiteSettings()->multiLanguage())
		{
			?>
			<script>
                languagesObj = new languagesToCopy();
                relatedContentPopUpObj = new relatedContentPopUp();
                copyContentPopUpObj = new copyContentPopUp();
            </script>
			<?
		}
		?>
	</head>
	<body oncontextmenu="return false">
    <?php echo "<script> var adminUrl = '" . SITE_PROTOCOL.Context::SiteSettings()->getSiteUrl() . $_SERVER['REQUEST_URI'] . "'; </script>" ?>
	<center>
	  <table class="table">
	  		<tr>
	  			<td colspan="2" valign="middle" height="51px" style="background-image:url(webcontent/img/admin-head-bg.jpg);background-repeat:repeat-x;">
	  				<div id="headLogo"></div>
	  				<div id="headMessages"></div>
                      <div class="logout">
                          <a href="Access.php?logout=1"><?php echo $lang['LOGOUT'] ?></a>
                      </div>
                    

                        <div class='multiSites' <? if(!MULTI_SITE) { echo 'style="display:none;"'; }?>>
                            <div><?echo $lang['CURRENT_WEBSITE']?></div>
                                <? echo MultiSites::GetSitesSelect(); ?>
                        </div>

	  		</tr>
            <tr>
                <? $buildMenu = new MenuNavigation();
                echo $buildMenu->buildMenu(); ?>
            </tr>
	  		<tr>
	  			<td class="table_foot" colspan="2">
	  				<div class="footer_left"><?=$lang['SUPPORT_TEAM']?>: <b>ICQ</b> 255 174 772 <b>email</b>: team@iproaction.com</div>
	  				<div class="footer_right"><a href="http://www.iproaction.com/" target="_blank">iProAction <?echo date('Y');?></a></div>
	  			</td>
	  		</tr>
            <div id="hiddenLoaderContainer" style="display:none;"></div>
	  </table>	
	</center>
    <div id="imgConfWizard" title="<?echo $lang['FILEMANAGER_12']?>"></div>
	</body>
</html>
<?ob_end_flush();?>