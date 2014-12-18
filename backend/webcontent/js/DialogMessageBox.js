function DialogMessageBox()
{
	this.visible = 0;
	this.open = function(action)
	{
		if(!shadow.visible)
		{
			shadow.createPageDiv();
			this.visible = 1;
		}
		if (document.getElementById('DialogMessageBox'))
		{
			document.getElementById('DialogMessageBox').style.display = 'block';
			document.getElementById('DialogMessageBox').style.top = getClientCenterY()-300;
		}
		else
		{
			var Div = document.createElement('div');
			Div.setAttribute('id', 'DialogMessageBox');
			Div.style.position = 'absolute';
			Div.style.display  = 'block';
			Div.style.zIndex = 101;
//			Div.style.top = '0px';
			Div.style.top = getClientCenterY()-300;
			Div.style.left = '0px';
			Div.style.width = '100%';
			Div.style.height = '100%';
			Div.style.paddingTop = '200px';

			Div.innerHTML = '<center><div id="DialogMessageBoxContainer"></div></center>';
			document.body.appendChild(Div);
		}
		this.putContent(action);

		document.getElementById('DialogMessageBoxContainer').innerHTML = text;
//		document.body.style.cursor = 'default';
	}

	this.putContent = function(action)
	{
		switch(action)
		{
			case 'startSaving' 		: text = SAVING+'...<br/><br/><img src="webcontent/img/loading-bar.gif" border="0" /><br/><br/><br/>';
								 	break;
			case 'endSavingPopUp'	: text = SAVED+'<br/><br/><br/><br/><br/><input type="button" class="button" value="Ok" onclick="dialogMessageBox.hideDiv();modalBox.hideDiv();">';
								 	break;
			case 'endSavingGeneral' : text = SAVED+'<br/><br/><br/><br/><br/><input type="button" class="button" value="Ok" onclick="endSavingGeneral();">';
								 	break;
            case 'continueSaving'   : text = SAVED+'<br/><br/><br/><br/><br/><input type="button" class="button" value="Ok" onclick="dialogMessageBox.hideDiv();">';
                                    break;
			case 'endSavingMultiLang' : text = SAVED+'<br/>'+NEXT_LANG_CONTENT_ADD+'<br/><br/><input type="button" class="button" value="Ok" onclick="endSavingMultiLang();">';
								 	break;
			case 'endSavingTreePopUp': text = SAVED+'<br/><br/><br/><br/><br/><input type="button" class="button" value="Ok" onclick="dialogMessageBox.hideDiv();treeModalBox.hideDiv();">';
								 	break;
		}

		document.getElementById('DialogMessageBoxContainer').innerHTML = text;
	}

	this.hideDiv = function()
	{
		document.getElementById('DialogMessageBox').style.display = 'none';
		if(shadow.visible && this.visible == 1)
		{
			shadow.removePageDiv();
			this.visible = 0;
		}
	}
}

var dialogMessageBox = new DialogMessageBox();

function endSavingGeneral()
{
	dialogMessageBox.hideDiv();
	document.getElementById('main_content_container').innerHTML = '<div class="admin_ajax_loading"><div class="inner"><img src="webcontent/img/admin_ajax_loading.gif" align="center" /><br /><b>'+LOADING+'...</b></div></div>';
	xajax_goBack(0);
}

function endSavingMultiLang()
{
	dialogMessageBox.hideDiv();
	document.getElementById('main_content_container').innerHTML = '<div class="admin_ajax_loading"><div class="inner"><img src="webcontent/img/admin_ajax_loading.gif" align="center" /><br /><b>'+LOADING+'...</b></div></div>';
	eval("viewDataObject"+languagesObj.itemLanguages[languagesObj.currentElement][0]+" = new ViewDataObject("+languagesObj.itemLanguages[languagesObj.currentElement][0]+",'general')");
	navigation.sendRequest(	'ViewController',
							'viewBuild',
							{	viewId:languagesObj.itemLanguages[languagesObj.currentElement][0],
								itemId:languagesObj.itemLanguages[languagesObj.currentElement][1],
								copyRelatedContent:1,
								nextLangId:languagesObj.itemLanguages[languagesObj.currentElement][2]
							}
						);
	languagesObj.itemLanguages.shift();
}