<?

session_start();

echo $_SESSION['name'];
die();

	if($admin->name == 'moscov') die;



	switch ($_GET['action'])
	{
		case 'contentmanager':	?>
			<td id="td_menu" width="160" class="table_left">
			<div>
				<ul id="menu" class="menu">
				<li id="li_menu1"><a onclick="Menu.lmItemClick('ViewController','viewBrowse',{viewType:{0:1},searchType:'general'},this);">&nbsp;<?=$lang['LM_PAGE_ADD_PAGE']?></a></li>
				<li id="li_menu2"><a onclick="Menu.lmItemClick('ViewController','viewBuild',{viewId:1,searchType:'general'},this);">&nbsp;<?=$lang['LM_PAGE_VIEW_PAGE']?></a></li>
				<li id="li_menu3"><a onclick="Menu.lmItemClick('ViewController','viewBrowse',{viewType:{0:3},searchType:'general'},this);">&nbsp;<?=$lang['LM_PAGE_ADD_PO']?></a></li>
				<li id="li_menu4"><a onclick="Menu.lmItemClick('ViewController','viewBuild',{viewId:2,searchType:'general'},this);">&nbsp;<?=$lang['LM_PAGE_VIEW_PO']?></a></li>
				<li id="li_menu5"><a onclick="Menu.lmItemClick('ViewController','viewBuild',{viewId:5,searchType:'general'},this);">&nbsp;<?=$lang['LM_LIST_MASTER_PAGE']?></a></li>
				<li id="li_menu6"><a onclick="Menu.lmItemClick('CacheController','deleteAllCache',{group:'false'},this);">&nbsp;<?=$lang['LM_CLEAR_CACHE']?></a></li>
			</ul>
			<div style="position:relative;top:0px;background-color:#CCC;display:none;z-index:10000;" id="testik">&nbsp;</div>
			</div>
			</td>
			<td class="table_right" height="100%" width="790">
				<div id="main_content_container">	  			  
				&nbsp;	  			  		
			</div>
			</td>
			<?  break;

		case 'filemanager': ?>
			<td class="table_content" height="100%">
				<div id="main_content_container" style="height:100%;padding:0px;">
				<iframe name="frmFileManager" style="border:none;" src="webcontent/fckeditor/editor/filemanager/browser/default/browser.html?clickaction=noaction" width="100%" height="100%"></iframe>
			</div>
			</td>
		<? break;
		case 'preferances': ?>
			<td width="160" class="table_left">
			<ul id="menu" class="menu">
				<li id="li_menu1"><a onclick="Menu.lmItemClick('ViewController','viewBuild',{viewId:3,searchType:'general'},this);">&nbsp;<?=$lang['DYNAMIC_LISTS']?></a></li>
			</ul>
			</td>
			<td class="table_right" height="100%" width="790">
				<div id="main_content_container">	  			  
				&nbsp;	  			  		
			</div>
			</td>
		<? break;
		case 'users': ?>
			<td width="160" class="table_left">
			<ul id="menu" class="menu">
				<li id="li_menu1"><a onclick="Menu.lmItemClick('ViewController','viewBuild',{viewId:35,searchType:'general'},this);">&nbsp;<?=$lang['LM_USERS']?></a></li>
			</ul>
			</td>
			<td class="table_right" height="100%" width="790">
				<div id="main_content_container">	  			  
				&nbsp;	  			  		
			</div>
			</td>
		<? break;
		case 'products': ?>
			<td width="160" class="table_left">
			<ul id="menu" class="menu">
				<li id="li_menu1"><a onclick="Menu.lmItemClick('ViewController','viewBrowse',{viewType:{0:10},searchType:'general'},this);">&nbsp;<?=$lang['LM_ADD_PRODUCT']?></a></li>
				<li id="li_menu2"><a onclick="Menu.lmItemClick('ViewController','viewBuild',{viewId:44,searchType:'general'},this);">&nbsp;<?=$lang['LM_PRODUCT_MANAGER']?></a></li>
				<!--<li id="li_menu3"><a onclick="Menu.lmItemClick('ViewController','viewBuild',{viewId:42,searchType:'general'},this);">&nbsp;<?=$lang['LM_AD']?></a></li>-->
				<!--<li id="li_menu4"><a onclick="viewDataObject18 = new ViewDataObject(7,'general'); navigation.sendRequest('ViewController','viewBuild',{viewId:7,itemId:78});">&nbsp;<?=$lang['PRODUCTS_CATEGORIES']?></a></li>-->
				<!--<li id="li_menu5"><a onclick="Menu.lmItemClick('ViewController','viewBuild',{viewId:85,searchType:'general'},this);">&nbsp;<?=$lang['PRODUCTS_ATTRIBUTES']?></a></li>-->
			</ul>
			</td>
			<td class="table_right" height="100%" width="790">
				<div id="main_content_container">	  			  
				&nbsp;	  			  		
			</div>
			</td>
		<? break;
		case 'orders': ?>
			<td width="160" class="table_left">
			<ul id="menu" class="menu">
				<li id="li_menu1"><a onclick="Menu.lmItemClick('ViewController','viewBuild',{viewId:45,searchType:'general'},this);">&nbsp;<?=$lang['LM_ORDER_MANAGER']?></a></li>
				<li id="li_menu2"><a onclick="return false;Menu.lmItemClick('ViewController','viewBrowse',{viewType:{0:11},searchType:'general'},this);">&nbsp;<?=$lang['ADD']?></a></li>
			</ul>
			</td>
			<td class="table_right" height="100%" width="790">
				<div id="main_content_container">	  			  
				&nbsp;	  			  		
			</div>
			</td>
		<? break;
		default: ?>
			<td class="table_content" height="100%">
				<div id="main_content_container">	  			  
				&nbsp;	  			  		
			</div>
			</td>
<?	}?>