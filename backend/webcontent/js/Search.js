function SearchBox()
{
	this.useShadow = 0;
	this.open = function(controller,action,params)
	{
		if(!shadow.visible)
		{
			this.useShadow = 1;
			shadow.createPageDiv();
		}
		if (document.getElementById('SearchBoxMain'))
		{
			document.getElementById('SearchBoxMain').style.display = 'block';
            document.getElementById('SearchBoxMain'+this.modalBoxNumber).style.top = getClientCenterY()-338;
		}
		else
		{
			var Div = document.createElement('div');
            var DivTop = getClientCenterY()-338;
			Div.setAttribute('id', 'SearchBoxMain');
			Div.style.position = 'absolute';
			Div.style.display  = 'block';
			Div.style.zIndex = 100;
			//Div.style.top = '0px';
            if (DivTop<0){
                Div.style.top = '10px';
            }else{
                Div.style.top = DivTop;
            }
			Div.style.left = '0px';
			Div.style.width = '100%';
			Div.style.height = '100%';
			Div.innerHTML = '<center><div id="SearchBoxContent" style="background-color:#fff; border: solid 1px #000; width:788px;min-height:585px;height:auto; padding:5px;z-index:101;"></div></center>';
			document.body.appendChild(Div);
		}
		navigation.sendRequest(controller, action, params, 'SearchBoxContent', 'SearchBoxContent');
	}
	
	this.hideDiv = function()
	{
		document.getElementById('SearchBoxMain').style.display = 'none';
		if(shadow.visible && this.useShadow == 1)
		{
			this.useShadow = 0;
			shadow.removePageDiv();
		}
	}
}

var searchBox = new SearchBox();

function SearchData(viewId,searchTypeStr,container,pageParam,fieldIdParam)
{
	navigation.sendRequest('ViewController','viewBuild',{viewId:viewId,searchType:searchTypeStr,page:pageParam,fieldId:fieldIdParam},container,container,xajax.getFormValues(viewId+'searchForm'));
}

function copySearchResult(srcId,destId)
{
	document.getElementById(destId).value = document.getElementById(srcId).value;
}

function MpFieldManager(viewId,fieldId,maxItemsCount)
{
	if(viewId)
	{
		this.viewId = viewId;
	}
	this.fieldId 		= fieldId;
	this.maxItemsCount 	= maxItemsCount;
	
	this.oSelect = document.getElementById(this.fieldId);
	
	this.addItem = function()
	{
		searchBox.open('ViewController', 'viewBuild', {viewId:this.viewId,fieldId:this.fieldId,searchType:'multipleField',open:1});
	}
	
	this.copyListItems = function (srcId, destId)
	{
		mpSrcSelectBox  = document.getElementById(srcId);
		mpDestSelectBox = document.getElementById(destId);
		mpSrcLength     = mpSrcSelectBox.length;
		mpDestLength    = mpDestSelectBox.length;
		var i;
		var oOption;
		for(i=0; i<mpDestLength; i++)
		{
			mpDestSelectBox.remove(mpDestSelectBox.options[i]);
		}
		for(i=0; i<mpSrcLength; i++)
		{
			oOption = document.createElement("OPTION");
			oOption.value = mpSrcSelectBox.options[i].value;
			oOption.text  = mpSrcSelectBox.options[i].text;
			mpDestSelectBox.options.add(oOption);
			mpDestSelectBox.options[i].value = mpSrcSelectBox.options[i].value;
			mpDestSelectBox.options[i].text  = mpSrcSelectBox.options[i].text;
		}
	}
	
	this.upOption = function()
	{
		var idSelect = this.oSelect.selectedIndex;
		if(idSelect!=-1 && idSelect!=0)
		{
			var value = this.oSelect.options[idSelect-1].value;
			this.oSelect.options[idSelect-1].value = this.oSelect.options[idSelect].value;
			this.oSelect.options[idSelect].value = value;
			
			var text = this.oSelect.options[idSelect-1].text;
			this.oSelect.options[idSelect-1].text = this.oSelect.options[idSelect].text;
			this.oSelect.options[idSelect].text = text;
			
			this.oSelect.options[idSelect-1].selected=true;
			this.oSelect.options[idSelect].selected=false;
			/*	oSelect.options[oSelect.selectedIndex].text);	*/
		}
	}
	this.downOption = function()
	{
		var idSelect = this.oSelect.selectedIndex;
		if(idSelect!=-1 && idSelect!=(this.oSelect.options.length-1))
		{
			var value = this.oSelect.options[(idSelect+1)].value;
			this.oSelect.options[(idSelect+1)].value = this.oSelect.options[idSelect].value;
			this.oSelect.options[idSelect].value = value;
			
			var text = this.oSelect.options[(idSelect+1)].text;
			this.oSelect.options[(idSelect+1)].text = this.oSelect.options[idSelect].text;
			this.oSelect.options[idSelect].text = text;
			
			this.oSelect.options[(idSelect+1)].selected=true;
			this.oSelect.options[idSelect].selected=false;
		}
	}
	
	this.removeItem = function()
	{
		if(this.oSelect.selectedIndex!= -1)
		{
			this.oSelect.remove(this.oSelect.selectedIndex);
		}
	}
	
	this.foundToSelect = function(itemValue, itemText)
	{
		var count = this.oSelect.options.length;
		if(count <= this.maxItemsCount)
		{
			for(var i=0; i < count; i++)
			{			
				if(this.oSelect.options[i].value == itemValue)
				{
					alert(ITEM_IN_LIST);
					return false;
				}
			}
			var oOption = document.createElement("OPTION");
			oOption.value = itemValue;
			oOption.text  = itemText;
			this.oSelect.options.add(oOption);
		}
		else
		{
			alert(LIST_IS_FULL);
			return false;
		}
	}
	
	this.tagToSelect = function(itemValue, itemText)
	{
		var count = this.oSelect.options.length;
		if(count <= this.maxItemsCount)
		{
			for(var i=0; i < count; i++)
			{			
				if(this.oSelect.options[i].value == itemValue)
				{
					alert(ITEM_IN_LIST);
					return false;
				}
			}
			var oOption = document.createElement("OPTION");
			oOption.value = itemValue;
			oOption.text  = itemText;
			this.oSelect.options.add(oOption);
			
			document.getElementById('listContainer'+this.fieldId).style.display = 'none';
			document.getElementById('text'+this.fieldId).value = '';
		}
		else
		{
			alert(LIST_IS_FULL);
			return false;
		}
	}
}

function getParameterByName(name)
{
    name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
    var regexS = "[\\?&]" + name + "=([^&#]*)";
    var regex = new RegExp(regexS);
    var results = regex.exec(window.location.search);
    if(results == null)
        return "";
    else
        return decodeURIComponent(results[1].replace(/\+/g, " "));
}