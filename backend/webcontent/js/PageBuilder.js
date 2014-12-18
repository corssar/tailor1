
/*define global constants*/

var FILEMANAGER_PREVIEW_IMAGE = false;
var saveViewId = 0;
var saveItemId = 0;

function beFieldsProcess(FT) /* Bug 1: If field is not required but set validation  - check will is not working*/
{
	//Array ( 'id', 'typeId', 'vId', 'required' )
	//Array ( 'id', 'FCKE',   'vId', 'required' )
	var id       = FT[0];
	var typeId   = FT[1];
	var vId      = FT[2];
	var required = FT[3];
	var value    = '';
	var valid    = true;
	
	this.process1 = function()//text
	{
		if(vId!=0)
		{
			valid = Validator(document.getElementById(id).value, vId, required);
		}
		else
		{
			if( required && document.getElementById(id).value.length==0 )
			{
				valid = false;
			}
		}
		if(valid)
		{
			ClearMarkRequiredField(id);
			return true;
		} else {
			MarkRequiredField(id);
			return false;
		}
	}
	this.process2 = function()//textarea
	{
		if(vId!=0)
		{
			valid = Validator(document.getElementById(id).value, vId, required);
		}
		else
		{
			if(required && document.getElementById(id).value.length==0)
			{
				valid = false;
			}
		}
		if(valid)
		{
			ClearMarkRequiredField(id);
			return true;
		} else {
			MarkRequiredField(id);
			return false;
		}
	}
	this.process3 = function()//FCKeditor
	{
		//var content = FCKeditorAPI.GetInstance(form_name).GetXHTML();
		if(required && document.getElementById(id).value == '')
		{
			MarkRequiredField(id);
			return false;
		}
		ClearMarkRequiredField(id);
		return true;
	}
	this.process4 = function()//date
	{
		if(required && document.getElementById(id).value.length == 0)
		{
			MarkRequiredField(id);
			return false;
		}
		ClearMarkRequiredField(id);
		return true;
	}
	this.process5 = function()
	{
		return true;
	}
	this.process6 = function()
	{
		return true;
	}
	this.process7 = function()
	{
		if(required && document.getElementById(id).value.length == 0)
		{
			MarkRequiredField(id);
			return false;
		}
		ClearMarkRequiredField(id);
		return true;
	}
	this.process8 = function()
	{
		if(required && document.getElementById(id).value.length == 0)
		{
			MarkRequiredField(id);
			return false;
		}
		ClearMarkRequiredField(id);
		return true;
	}
	this.process9 = function()
	{
		if(required && document.getElementById(id).value.length == 0)
		{
			MarkRequiredField(id);
			return false;
		}
		ClearMarkRequiredField(id);
		return true;
	}
	this.process10 = function()
	{
        return true;
	}
	
	this.process12 = function()
	{
		document.getElementById(id).value = trim_whitespases(document.getElementById(id).value);
		if(required && (document.getElementById(id).value.length == 0 || isNumber(document.getElementById(id).value)))
		{
			MarkRequiredField(id);
			return false;
		}
		ClearMarkRequiredField(id);
		return true;
	}
	
	this.process13 = function()
    {
        langObj = document.getElementById(id);
        if(langObj.tagName.toLowerCase() == 'select')
        {
        	
        	var languageSelected = false;
	        for (i = 0; i < langObj.length; i++)
	            if(langObj.options[i].selected)
	            {
	            	 languageSelected = true;
	            	 break;
	            }
			
	        if(!languageSelected)
	        {
	        	MarkRequiredField(id);
				return false;
	        }
        }
        else if(langObj.tagNem == 'input' && langObj.value=='')
        {
        	MarkRequiredField(id);
			return false;
        }

		ClearMarkRequiredField(id);
		return true;
    }
	
	this.process29 = function()
	{
		return true;
	}
	
	this.process30 = function()
	{
		if(required==1 && !vId)
		{
			ddSelectBox = document.getElementById(id);
			for(var i=0;i<ddSelectBox.length;i++)
			{
				if(ddSelectBox[i].value==0) continue;
				if(ddSelectBox[i].selected)
					return true;
			}
			MarkRequiredField(id);			
			return false;
		}
		else if(vId == 2) //vId = 2 for required DynamicList field
		{
			if(document.getElementById(id).value == '')
			{
				MarkRequiredField(id);			
				return false;
			}
		}
		ClearMarkRequiredField(id);
		return true;
	}
	
	this.process31 = function()
	{
		//if(vId)return true;
		mpSelectBox = document.getElementById(id);
		mpLength = mpSelectBox.options.length;
		var mpSelectBoxData = '';
		if(required==1 && mpLength==0 && !vId)
		{
			MarkRequiredField(id);
			return false;
		} else {
			for(var i=0; i<mpLength; i++)
				mpSelectBox.options[i].selected = true;
		}
		ClearMarkRequiredField(id);
		return true;
	}
	
	this.process32 = function()
	{
		return true;
	}
	
	this.process33 = function()
	{
		if(required==1 && document.getElementById('listDcTable'+id).rows.length==1)
		{
			MarkRequiredField(id);
			return false;
		}

		ClearMarkRequiredField(id);
		return true;
	}

	return eval('this.process'+typeId+'();');
}

function Validator(value, vId, required) // return --> true | false
{
	switch (vId)
	{
		case 1:		// INTEGEER 
			if(required && (trim(value)==' ' || trim(value)==''))
			{
				return false;
			}
			return is_numeric(value);
			break;
		case 2:		// FLOAT
			if(required && (trim(value)==' ' || trim(value)==''))
			{
				return false;
			}
			return is_numeric(value);
			break;
		case 3:		// EMAIL
			if(required && (trim(value)==' ' || trim(value)==''))
			{
				return false;
			}
			var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
			if (filter.test(value))
				return true;
			else
				return false;	
			break;
		case 4:		// STRING allowed ( [a-zA-Z9-0_] )
			if(required && (trim(value)==' ' || trim(value)==''))
				return false;
			break;
	}
}

function MarkRequiredField(id)
{
	document.getElementById(id+'FieldContainer').style.backgroundColor = '#FFAA00';
}
function ClearMarkRequiredField(id)
{
	if(document.getElementById(id+'FieldContainer'))
		document.getElementById(id+'FieldContainer').style.backgroundColor = 'transparent';
}

function SaveData(viewId, accept)
{
//	if(document.body.style.cursor == 'progress')
//		return;
//
//	document.body.style.cursor = 'progress';
	
	if (typeof relatedContentPopUpObj !== "undefined" && relatedContentPopUpObj.isOpen)
		relatedContentPopUpObj.close();

//	viewDropDownSelectBoxesData[viewId] = {};
	
	var error = 0;
	array = eval('beFields_'+viewId);
	for(var i=0;i<array.length; i++)
	{
		if(false == beFieldsProcess(array[i]))
		{
			error = 1;
		}
	}
	if(error == 1)
	{
		alert(FILL_REQUIRED);		
		return;
	}

	dialogMessageBox.open('startSaving');
	navigation.sendRequest('ViewController', 'saveViewData', {websiteId: $('#multiSiteSelect :selected').val(), accept: accept}, '', 'popup', xajax.getFormValues(viewId+'viewForm'));
	
//	if(modalBox.visible == 1)
//	{
//		modalBox.hideDiv();
//		return;
//	}
//	else if(treeModalBox.visible == 1)
//	{
//		treeModalBox.hideDiv();
//		return;		
//	}
	//document.getElementById('multiSiteSelect').disabled = false;
}


function Cancel(viewId, itemId)
{
	if(!itemId && $('input[primaryIdfield'+viewId+']').val())
	{
		var data = {
			viewId: viewId, 
			itemId: $('input[primaryIdfield'+viewId+']').val()
		}
		navigation.sendRequest('ViewController', 'deletePreliminarySavedData', data, 'hiddenLoaderContainer', 'hiddenLoaderContainer');
	}
	
	if($('input[treeField'+viewId+']').val())
	{
		var data = {
			viewId: viewId, 
			treeId: $('input[treeField'+viewId+']').val(),
			treeTable: $('input[treeTableField'+viewId+']').val(),
			treeClass: $('input[treeClassField'+viewId+']').val()
		}
		navigation.sendRequest('ViewController', 'deleteTempTreeNodes', data, 'hiddenLoaderContainer', 'hiddenLoaderContainer');
	}
	
	if (typeof relatedContentPopUpObj !== "undefined" && relatedContentPopUpObj.isOpen)
		relatedContentPopUpObj.close();
		
	if(typeof languagesObj !== "undefined" && languagesObj.itemLanguages.length>0)
		languagesObj.itemLanguages = {};
	
	if(modalBox.visible == 1)
	{
		modalBox.hideDiv();
		return;
	}
	else if(treeModalBox.visible == 1)
	{
		treeModalBox.hideDiv();
		return;		
	} else {
		document.getElementById('main_content_container').innerHTML = '<div class="admin_ajax_loading"><div class="inner"><img src="webcontent/img/admin_ajax_loading.gif" align="center" /><br /><b>'+LOADING+'...</b></div></div>';
		xajax_goBack();
	}
	
	document.getElementById('multiSiteSelect').disabled = false;
}

function SaveTreeData(viewId)
{
	navigation.sendRequest('ViewController', 'saveViewData', { websiteId: $('#multiSiteSelect :selected').val()}, '', 'popup', xajax.getFormValues(viewId+'viewForm'));
}

function CancelTreeChange(cancelTreeMenuId,cancelTreeNodes)
{
	xajax_cancelCatalogChanges(cancelTreeMenuId,cancelTreeNodes);
}

function ViewDataObject(viewId,viewType,fieldId)
{
	this.viewId   = viewId;
	this.viewType = viewType;/*	availableValues:
									general
									dcItem
									treeItem */
	this.copyLanguageContent = false;
	
	if (typeof relatedContentPopUpObj !== "undefined" && relatedContentPopUpObj.isOpen)
		relatedContentPopUpObj.close();
	
	if(fieldId != 'undefined')
	{
		this.fieldResultRecipient = fieldId;/*Uses for put of results to the DynamicContant field and for TreeItem*/
	}

	this.objUpdateDestroy = function(itemId,text,visible)
	{
		switch (this.viewType)
		{
			case 'dcItem'   : eval("dcField"+this.fieldResultRecipient+".editItem("+itemId+");");dialogMessageBox.open('endSavingPopUp'); break;
			case 'treeItem' : saveEditedTreeItem(itemId,text,visible,this.fieldResultRecipient);dialogMessageBox.open('endSavingTreePopUp'); break;
			case 'general'  : dialogMessageBox.open('endSavingGeneral'); break;
		}
	}
	
	this.objAddDestroy = function(itemId,text,visible)
	{
		switch (this.viewType)
		{
			case 'dcItem'   : eval("dcField"+this.fieldResultRecipient+".addItem("+itemId+");");dialogMessageBox.open('endSavingPopUp'); break;
			case 'treeItem' : saveAddedTreeItem(itemId,text,visible,this.fieldResultRecipient); dialogMessageBox.open('endSavingTreePopUp'); break;
			case 'general'  :
							if(typeof languagesObj !== "undefined" && languagesObj.itemLanguages.length>0)
								dialogMessageBox.open('endSavingMultiLang');
							else
								dialogMessageBox.open('endSavingGeneral');
							break;
		}
	}
}

function languagesToCopy()
{
	this.itemLanguages = new Array();
	this.currentElement = 0;
	this.addLanguageToList = function(viewId, itemId, langId)
	{
		this.itemLanguages.push([viewId,itemId,langId]);
	}
}

function relatedItems(pageId,fieldId,relationId)
{
	this.pageId = pageId;
	this.fieldId = fieldId;
	this.relationId = relationId;

	this.oTable = document.getElementById('relatedContentList');
	
	this.languagesVariations = function(langId)
	{
		var fieldId = this.fieldId;
		
		$(".languageCheckBox").each(function(){
  			if(this.id == fieldId+'_'+langId)
			{
				this.checked = false;
				this.disabled = "disabled";
				$("#item_"+this.id).addClass('hidden');
				$("#item_"+this.id).removeClass('visible');
			}
			else
			{
				this.checked = true;
				this.disabled = "";
				$("#item_"+this.id).addClass('visible');
				$("#item_"+this.id).removeClass('hidden');
			}
		});
	}

	this.openSearchForm = function(rSearchViewId)
	{
		if(!this.pageId)
		{
			langObj = document.getElementById(this.fieldId);
			
	        for (i = 0; i < langObj.length; i++)
	            if(langObj.options[i].selected)
	            {
	            	
	            	this.langId = langObj.options[i].value;
					break;
	            }

			if(!this.langId)
			{
				alert('No lang selected');
				return false;
			}
		}
		searchBox.open('ViewController', 'viewBuild', {viewId:rSearchViewId,searchType:'relatedItems',open:1});
	}
	
	this.addNewRelation = function(pageId,pageViewId)
	{	
		navigation.sendRequest(	'ViewController',
								'addNewRelation',
								{
									langId: 			this.langId,
									pageId: 			this.pageId,
									foundPageId:		pageId,
									foundPageViewId: 	pageViewId,
									relationId:			this.relationId
								},
								'SearchBoxContent', 
								'SearchBoxContent'
							);
	}
	
	this.foundPageCantBeRelated = function()
	{
		alert(FOUND_PAGE_NOT_MERGABLE);
		searchBox.hideDiv();
	}
	
	this.updateFoundPageRelation = function(pageId,pageViewId)
	{
		if(confirm(PAGES_ARE_NOT_MERGABLE))
		{
			navigation.sendRequest(	'ViewController',
									'updateFoundPageRelation',
									{
										pageId: 			this.pageId,
										pageViewId:			this.pageViewId,
										foundPageId:		pageId, //¯Ó Á‡ ÍÛ‰‡ ÔÂÈ‰Ê ‡È‰Ë ˇ ıÛÈ Â„Ó ÁÌ‡ÂÚ
										relationId: 		this.relationId
									},
									'SearchBoxContent', 
									'SearchBoxContent'
								);
		}
		else
		{
			searchBox.hideDiv();
		}
	}
	
	this.addRowToRelationList = function(relatedItems)
	{
		var lastRow = this.oTable.rows.length;
		
		for(var i=lastRow-1; i>0; i--)
		{
			this.oTable.deleteRow(i);
		}
		
		for(var i=0;i<relatedItems.length;i++)
		{
			var row = this.oTable.insertRow(i+1);
			var cellLeft;
			var textNode;
			
			var itemId 	= relatedItems[i][0];
			var viewId 	= relatedItems[i][1];
			var langName= relatedItems[i][2];
			var title	= relatedItems[i][3];
			
			var cellLeft = row.insertCell(0);
			var editImage = document.createElement("img");
			editImage.setAttribute('src', 'webcontent/img/reply.gif');
			editImage.setAttribute('alt', EDIT);
			editImage.setAttribute('class', 'cursor');
			editImage.onclick = new Function('', "relatedItemsObj.relatedContentItemEdit("+itemId+","+viewId+");");
			cellLeft.appendChild(editImage);

			var deleteImage = document.createElement("img");
			deleteImage.setAttribute('src', 'webcontent/img/item_delete.gif');
			deleteImage.setAttribute('alt', DELETE);
			deleteImage.setAttribute('class', 'cursor');
			deleteImage.onclick = new Function('',"relatedItemsObj.deletePageRelation("+itemId+","+viewId+",this.parentNode.parentNode.rowIndex);");			
			cellLeft.appendChild(deleteImage);

			var cellLeft = row.insertCell(1);
			textNode = document.createTextNode(langName);
			cellLeft.appendChild(textNode);
			
			var cellLeft = row.insertCell(2);
			textNode = document.createTextNode(title);
			cellLeft.appendChild(textNode);
		}
		searchBox.hideDiv();
	}
	
	this.relatedContentItemEdit = function(itemId,viewId)
	{
		if(confirm(SAVE_EDITED_CONTENT))
		{
			eval("viewDataObject"+viewId+" = new ViewDataObject("+viewId+",'general')");
			navigation.sendRequest('ViewController', 'saveViewData', {viewId: viewId, itemId: itemId, websiteId: $('#multiSiteSelect :selected').val()}, '', 'popup', xajax.getFormValues(viewId+'viewForm'));
		}
	}
	
	this.deletePageRelation = function(pageId,pageViewId,rowIndex)
	{
		if(confirm(DELETE_PAGE_RELATION))
		{
			navigation.sendRequest(	'ViewController',
									'deletePageRelation',
									{
										pageId: 			pageId,
										pageViewId:			pageViewId,
										rowIndex:			rowIndex
									},
									'relatedContentAjaxLoading', 
									'relatedContentAjaxLoading'
								);
		}
		else
		{
			searchBox.hideDiv();
		}
	}
	
	this.deletePageRelationRow = function(rowIndex)
	{
		this.oTable.deleteRow(rowIndex);
	}
}

function copyContentPopUp()
{
    this.isOpen = false;
    this.initialized = false;
    this.init = function()
    {
        $("#copyContentPopUpObj").dialog({ autoOpen: false });
        $( "#copyContentPopUpObj" ).dialog({
            beforeClose: function(event, ui) { copyContentPopUpObj.onClose(); }
        });

        $("#copyContentPopUpObj").dialog( "option", "position", ['center',120] );
        $("#copyContentPopUpObj").dialog( "option", "minWidth", 500 );
        $("#copyContentPopUpObj").dialog( "option", "minHeight", 80 );
        $("#copyContentPopUpObj").dialog( "option", "resizable", false );
        $("#copyContentPopUpObj").dialog({ zIndex: 50 });

        $("#copyContentPopUpObj").dialog();
        this.initialized = true;
    }

    this.open = function()
    {
        if(!this.initialized)
            this.init();

        $("#copyContentPopUpObj").dialog("open");

        this.isOpen = true;
    }

    this.onClose = function()
    {
        this.isOpen = false;
    }

    this.close = function()
    {
        $("#copyContentPopUpObj").dialog("close");
        this.isOpen = false;
    }
}

function changeCopyOption()
{
    $('input[name=siteMode]').change(function(){
        if($(this).val() == 1) $('.copyContent div.siteContainer').show();
        else $('.copyContent div.siteContainer').hide();
    });
}

function relatedContentPopUp()
{
	this.isOpen = false;
	this.initialized = false;
	
	this.init = function()
	{
		$("#relatedContentPopUp").dialog({ autoOpen: false }); 
		$( "#relatedContentPopUp" ).dialog({
   			beforeClose: function(event, ui) { relatedContentPopUpObj.onClose(); }
		});
//		$("#relatedContentPopUp").dialog({ resizable: false });
		$("#relatedContentPopUp").dialog( "option", "position", ['center',20] );
		$("#relatedContentPopUp").dialog( "option", "minWidth", 440 );
		$("#relatedContentPopUp").dialog( "option", "minHeight", 140 );
		$("#relatedContentPopUp").dialog({ zIndex: 50 });
		
		$("#relatedContentPopUp").dialog();
		this.initialized = true;
	}
	
	this.open = function()
	{
		if(!this.initialized)
			this.init();
		
		$("#relatedContentPopUp").dialog("open");
		
		this.isOpen = true;
	}
	
	this.onClose = function()
	{
		this.isOpen = false;
	}
	
	this.close = function()
	{
		$("#relatedContentPopUp").dialog("close");
		this.isOpen = false;
	}
}

function ImagePreloader(imgsArray)
{
	if(imgsArray.length>0)
	{
		var imgsCache = new Array();
		for (var i=0; i<imgsArray.length; i++)
		{
			imgsCache[i] 		= new Image();			
			imgsCache[i].src	= imgsArray[i];
		}
	}
}

ImagePreloader(['webcontent/img/admin_ajax_loading.gif','webcontent/img/menu_bg.jpg', 'webcontent/img/menu_bgr.jpg', 'webcontent/img/reply.gif',
				'webcontent/img/copy.gif','webcontent/img/item_delete.gif','webcontent/img/item_add.gif','webcontent/img/item_up.gif','webcontent/img/item_down.gif',
				'webcontent/img/admin_g.jpg'] );

var viewStack = Array();

function SetOnKeyDown( targetDocument )
{
	targetDocument.onkeydown = function ( e )
	{
		e = e || event || this.parentWindow.event ;
		switch ( e.keyCode )
		{
			case 13 :		// ENTER
				var oTarget = e.srcElement || e.target ;
				if ( oTarget.tagName == 'TEXTAREA' || oTarget.className == 'button')
				{
					return true ;
				}
				
				EnterPressed();
				return false ;
			case 27 :		// ESC
				//Cancel() ;
				return false ;
				break ;
		}
		return true ;
	}
}

function EnterPressed()
{
	if(viewStack[0]>0)
	{
		document.getElementById('viewButton'+viewStack[0]).click();
	}
	return false ;
}


// {{{ trim
function trim( str, charlist ) {
    // Strip whitespace (or other characters) from the beginning and end of a string
    // 
    // +    discuss at: http://kevin.vanzonneveld.net/techblog/article/javascript_equivalent_for_phps_trim/
    // +       version: 802.2112
    // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   improved by: mdsjack (http://www.mdsjack.bo.it)
    // +   improved by: Alexander Ermolaev (http://snippets.dzone.com/user/AlexanderErmolaev)
    // +      input by: Erkekjetter
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // *     example 1: trim('    Kevin van Zonneveld    ');
    // *     returns 1: 'Kevin van Zonneveld'
    // *     example 2: trim('Hello World', 'Hdle');
    // *     returns 2: 'o Wor'

    charlist = !charlist ? ' \s\xA0' : charlist.replace(/([\[\]\(\)\.\?\/\*\{\}\+\$\^\:])/g, '\$1');
    var re = new RegExp('^[' + charlist + ']+|[' + charlist + ']+$', 'g');
    return str.replace(re, '');
}// }}}
function is_numeric( mixed_var ) {
    // Finds whether a variable is a number or a numeric string
    // 
    // +    discuss at: http://kevin.vanzonneveld.net/techblog/article/javascript_equivalent_for_phps_is_numeric/
    // +       version: 801.3120
    // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   improved by: David
    // *     example 1: is_numeric(186.31);
    // *     returns 1: true
    // *     example 2: is_numeric('Kevin van Zonneveld');
    // *     returns 2: false
    // *     example 3: is_numeric('+186.31e2');
    // *     returns 3: true

    return !isNaN( mixed_var );
}

var arr =
	{
        '–∞':'a',
        '–±':'b',
        '–≤':'v',
        '–≥':'g',
        '–¥':'d',
        '–µ':'e',
        '—ë':'e',
        '–∂':'zh',
        '–∑':'z',
        '–∏':'i',
        '–π':'y',
        '–∫':'k',
        '–ª':'l',
        '–º':'m',
        '–Ω':'n',
        '–æ':'o',
        '–ø':'p',
        '—Ä':'r',
        '—Å':'s',
        '—Ç':'t',
        '—É':'u',
        '—Ñ':'f',
        '—Ö':'h',
        '—á':'ch',
        '—Ü':'c',
        '—à':'sh',
        '—â':'sch',
        '—ç':'e',
        '—é':'yu',
        '—è':'ya',
        '—ã':'y',
        '—ä':'',
        '—å':'',
        '—ñ':'i',
        '—ó':'yi',
        '—î':'ye',
        ' ':'-'
    };
    
function trim_whitespases( str ) {	return str.replace(/^\s+|[^-_—ñ—ó—î—ë\sa-z–∞-—è0-9]|\s+$/g, "");}

function translitPageName2PageCode(txtVal, pageCodeFieldId)
{	
	var ereg = '';

	var field2 = document.getElementById(pageCodeFieldId);
	
	var txtvar = trim_whitespases(txtVal.toLowerCase());

	for (var k in arr)
	{
		eval('ereg = /'+k+'/g;');
		txtvar = txtvar.replace(ereg, arr[k]);
	}

	field2.value	= txtvar;
}

function setTransilt2PageTitleField(pageCodeFieldId)
{
	$('.pageTitleField').attr('onkeyup','translitPageName2PageCode(this.value, '+pageCodeFieldId+');');
}

function isNumber(s)
{
	var re = /^[0-9]*$/;
    return re.test(s)?true:false;
}

function pageCodeFieldAccess(a, pageCodeFieldId)
{
	if(a.className == "locked")
	{
		$('#'+pageCodeFieldId).removeAttr('readonly');
		a.className="opened";
		alert(ATTENTION+"\n"+PAGE_CODE_ALERT_TEXT);
	}
	else
	{
		$('#'+pageCodeFieldId).attr('readonly','readonly');
		a.className="locked";
	}
	return false;
}

function getElementsByClassNameCustomized(classList)
{
	if(document.getElementsByClassName) {
	 
	    getElementsByClass = function(classList, node) {   
	        return (node || document).getElementsByClassName(classList)
	    }
	 
	} else {
	 
	    getElementsByClass = function(classList, node) {           
	        var node = node || document,
	        list = node.getElementsByTagName('*'),
	        length = list.length, 
	        classArray = classList.split(/\s+/),
	        classes = classArray.length,
	        result = [], i,j
	        for(i = 0; i < length; i++) {
	            for(j = 0; j < classes; j++)  {
	                if(list[i].className.search('\\b' + classArray[j] + '\\b') != -1) {
	                    result.push(list[i])
	                    break
	                }
	            }
	        }
	     
	        return result
	    }
	}
}

SetOnKeyDown( document ) ;

function ChangeWebsiteId()
{
    var websiteId = $('#multiSiteSelect :selected').val();
    navigation.sendRequest('ViewController','setWebsiteId',{websiteId:websiteId},'hiddenLoaderContainer','hiddenLoaderContainer');
}