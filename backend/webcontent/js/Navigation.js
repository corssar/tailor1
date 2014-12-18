function Navigation()
{
	this.sendRequest = function(ajaxController,action,aParams,resultContainerId,loadingIndicatorContainerId,addArray)
	{
		if (typeof ajaxController !== "string") 
		{
			return;
		}
		if(!window.navigator.onLine)
		{
			alert(NO_CONNECTION);return;
		}
		if(!loadingIndicatorContainerId)
		{
			loadingIndicatorContainerId = 'main_content_container';
		}
		if(loadingIndicatorContainerId != 'popup')
		{
			document.getElementById(loadingIndicatorContainerId).innerHTML = '<div class="admin_ajax_loading"><img src="webcontent/img/admin_ajax_loading.gif" align="center" /><br /><b>'+LOADING+'...</b></div>';
		}		
		xajax_processRequest(ajaxController,action,aParams,resultContainerId,loadingIndicatorContainerId,addArray);
	}
}

function TabsNavigation()
{
	this.viewId    = 0;
	this.tabsCount = 0;
	this.initTabs = function(viewId,tabsCount)
	{
		this.viewId    = viewId;
		this.tabsCount = tabsCount;
	
		/*document.getElementById('tabHead'+this.viewId+'_0').className = 'tabHeadActive';
		document.getElementById('tabContainer'+this.viewId+'_0').className = 'tabContainerActive';
		for(var i=1;i<this.tabsCount;i++)
		{
			document.getElementById('tabHead'+this.viewId+'_'+i).className = 'tabHeadInactive';
			document.getElementById('tabContainer'+this.viewId+'_'+i).className = 'tabContainerInactive';
		}*/
	}
	
	this.switchTab = function(n)
	{
		for(var i=0;i<this.tabsCount;i++)
		{
			if(i==n)
			{
				document.getElementById('tabHead'+this.viewId+'_'+i).className = 'tabHeadActive';
				document.getElementById('tabContainer'+this.viewId+'_'+i).className = 'tabContainerActive';
				continue;
			}
			document.getElementById('tabHead'+this.viewId+'_'+i).className = 'tabHeadInactive';
			document.getElementById('tabContainer'+this.viewId+'_'+i).className = 'tabContainerInactive';
		}
	}
}

function Menu()
{
	
	this.menuItemClicked = false;
	this.currentMenuItem = 0;
	this.lmItemClick = function(controller,method,params,obj)
	{
        if (typeof copyContentPopUpObj !== "undefined" && copyContentPopUpObj.isOpen)
            copyContentPopUpObj.close();

		if (typeof relatedContentPopUpObj !== "undefined" && relatedContentPopUpObj.isOpen)
			relatedContentPopUpObj.close();

		    if(document.getElementById('multiSiteSelect') && document.getElementById('multiSiteSelect').disabled == true)
			    document.getElementById('multiSiteSelect').disabled = false;
		
		if(!this.menuItemClicked)
		{
			this.menuItemClicked = true;
			if (this.currentMenuItem)
			{
				this.currentMenuItem.style.color = "";
			}
			this.currentMenuItem = obj;
			obj.style.color = "#FFF";
			navigation.sendRequest(controller,method,params);
		}
		return false;
	}
    this.menuItemClickPopupResult = function(controller,method,params)
    {
        navigation.sendRequest(controller,method,params,'','popup');
        return false;
    }
	this.leftenable = function()
	{
		this.menuItemClicked = false;
	}
}

var Menu = new Menu();
var navigation = new Navigation();