function DynamicList(fieldId,fieldType)
{
	this.fieldId = fieldId;
	this.listContainer = 'listContainer'+this.fieldId;
	this.inputHintBlock = 'inputHintBlock'+this.fieldId;
	this.inputHintText = 'inputHintCenter'+this.fieldId;
	this.curText = '';
	this.currentListArray = new Array();
	this.actionItemN = 0;
	this.maxListN = 0;
	this.fieldType = fieldType;
	this.hintActive = false;
	this.requestInProccess = false;
	this.required = 0;
	this.handler = '';
	this.yesTabindex = 0;
	
	this.loadList = function(text,e)
	{
		if(this.requestInProccess) return;
		if(text.length < 3 )
		{
			document.getElementById(this.listContainer).style.display = 'none';
			document.getElementById(this.fieldId).value = '';
			if(this.hintActive)
				this.hideHint();
			return;
		}
		else if(this.curText == text) 
			return 
		else 
			this.curText = text;
		navigation.sendRequest('ViewController', this.handler, {letters:this.curText,fieldId:this.fieldId}, 'loaderAddWords', 'loaderAddWords');
		this.requestInProccess = true;
	}	
	
	this.showLoadedList = function(listArray)
	{
		this.requestInProccess = false;
		if(listArray.length == 0)
		{
			if(this.required)
				this.showHint(NO_ADDWORDS_FOUNDED);
			return false;
		}
		else if(this.hintActive)
		{
			this.hideHint();
		}
		this.currentListArray = listArray;
		document.getElementById(this.listContainer).style.top = document.getElementById('text'+this.fieldId).offsetTop+20+'px';
		document.getElementById(this.listContainer).style.left = document.getElementById('text'+this.fieldId).offsetLeft+'px';
		document.getElementById(this.listContainer).style.display = 'block';
		document.getElementById(this.listContainer).innerHTML = '';
		list = document.createElement('UL');
		
		list.className = 'dynamicList';
		for (i=0; i<listArray.length; i++)
		{
			listItem = document.createElement('LI');
			listItem.id = 'dLl'+i;
			if (i==0) 
			{
				listItem.className = 'action';
				this.actionItemN = 0;
			}
			if(this.fieldType == 30)
			{
				listItem.onclick = new Function('',"dlField"+this.fieldId+".selectListItem("+listArray[i]['id']+",'"+listArray[i]['value']+"');");
			}
			else if(this.fieldType == 31)
			{
				listItem.onclick = new Function('',"mpField"+this.fieldId+".tagToSelect("+listArray[i]['id']+",'"+listArray[i]['value']+"');");
			}
			listItem.onmouseover = new Function('',"dlField"+this.fieldId+".setActiveItem("+i+");");
			listItem.innerHTML = '<span>'+listArray[i]['value']+'</span>';
				
			list.appendChild(listItem);
			this.maxListN = i;
		}
		document.getElementById(this.listContainer).appendChild(list);
		
//		document.body.onkeydown = this.dlFieldKeyNavigation(event);
		
//		var oldonkeydown=document.body.onkeydown;
//		if(typeof oldonkeydown!='function'){
//			document.body.onkeydown = this.dlFieldKeyNavigation(event);
//		}else{
//			document.body.onkeydown = function(){
//				oldonkeydown();
//				this.dlFieldKeyNavigation(event) ;
//			}
//		}
	}
	
	this.selectListItem = function(value,text)
	{
		if(document.getElementById('text'+this.fieldId).value == '') return;
		document.getElementById('text'+this.fieldId).value = text;
		document.getElementById(this.fieldId).value = value;
		document.getElementById(this.listContainer).style.display = 'none';
	}
	
	this.setActiveItem = function(itemNumber)
	{
		document.getElementById('dLl' + this.actionItemN).className = '';
		this.actionItemN = itemNumber;
		document.getElementById('dLl' + itemNumber).className = 'action';
	}
	
	this.setNewItem = function(id,text)
	{
		if(this.fieldType == 30)
		{
			this.selectListItem(id,text);
		}
		else if(this.fieldType == 31)
		{
			this.relatedMpField.foundToSelect(id,text);
		}
	}
	
	this.dlFieldKeyNavigation = function(e)
	{
		//if(document.all)e = event;

		if(e.keyCode==38) // Up arrow
		{
			if (this.actionItemN >= 1)
			{
				this.setActiveItem(this.actionItemN-1);
			}
		}		
		if(e.keyCode==40) // Down arrow
		{
			if (this.actionItemN < this.maxListN)
			{
				this.setActiveItem(this.actionItemN+1);
			}
		}		
		if(e.keyCode==13 || e.keyCode==9) // Enter key or tab key
		{	
			this.selectListItem(this.currentListArray[this.actionItemN]['id'], this.currentListArray[this.actionItemN]['value']);
		}		
		if(e.keyCode==27) // Escape key
		{
			document.getElementById(this.listContainer).style.display = 'none';
		}
	}
	
	this.showHint = function(text)
	{
		this.hintActive = true;
		document.getElementById(this.listContainer).style.display = 'none';
		document.getElementById(this.inputHintBlock).style.top = document.getElementById('text'+this.fieldId).offsetTop+'px';
		document.getElementById(this.inputHintBlock).style.left = document.getElementById('text'+this.fieldId).offsetLeft+200+'px';
		document.getElementById(this.inputHintBlock).style.display = 'block';
		document.getElementById(this.inputHintText).innerHTML = text;
		document.getElementById(this.inputHintText).innerHTML += '<div class="buttons"><input type="button" class="button" onclick="dlField'+this.fieldId+'.addNewItem()" value="'+YES+'" tabindex="'+this.yesTabindex+'">&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" class="button" onclick="dlField'+this.fieldId+'.cancelNewItem()" value="'+NO+'"></div>';
	}
	
	this.addNewItem = function()
	{
		if(this.requestInProccess) return;
		this.curText = document.getElementById('text'+this.fieldId).value;
		navigation.sendRequest('ViewController', this.handler, {letters:this.curText,fieldId:this.fieldId,insert:1}, 'loaderAddWords', 'loaderAddWords');
		if(this.fieldType == 31)
			document.getElementById('text'+this.fieldId).value = '';
		this.hideHint();
	}
	
	this.cancelNewItem = function()
	{
		document.getElementById('text'+this.fieldId).value = '';
		this.hideHint();
	}
	
	this.hideHint = function()
	{
		document.getElementById(this.inputHintBlock).style.display = 'none';
		this.hintActive = false;
	}
	
	this.cancelInput = function()
	{
		
	}
}