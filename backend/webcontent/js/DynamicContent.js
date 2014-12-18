function DcFieldManager(viewId,fieldId,fieldsArray,displayType)
{
	this.viewId      = viewId;
	this.fieldId     = fieldId;
	this.fieldsArray = fieldsArray;
	this.displayType = displayType; /*	1 - new row inserts to the end of the list
										2 - new row inserts to first position of the list*/
	this.parentViewId= null;
	this.rFieldName  = '';
	
	this.oTable = document.getElementById('listDcTable'+this.fieldId);
	
	this.itemId		 		= 0;
	this.selectedRowIndex 	= 0;
	this.selectedRowObject 	= null;
	
	this.selectItem = function(rowObj,itemId)
	{
		this.selectedRowObject = rowObj;
		this.itemId = itemId;
		for (var i = 1; i < this.oTable.rows.length; i++)
		{
			var oRow = this.oTable.rows[i];
			if(i == rowObj.rowIndex && this.selectedRowIndex != rowObj.rowIndex)
			{
				for (iCell = 0; iCell < oRow.cells.length; iCell++)
				{
					oRow.cells[iCell].style.color = "#FFF";
					oRow.cells[iCell].style.backgroundColor = "#0A246A";
				}
				this.selectedRowIndex = rowObj.rowIndex;
				continue;
			}
			for (iCell = 0; iCell < oRow.cells.length; iCell++)
			{
				oRow.cells[iCell].style.color = "#000";
				oRow.cells[iCell].style.backgroundColor = "#FFF";
			}
			if(i == rowObj.rowIndex && this.selectedRowIndex == rowObj.rowIndex)
			{
				this.selectedRowIndex = 0;
				return;	
			}
		}
	}
	
	this.deselectItem = function()
	{
		this.selectedRowObject = null;
		this.itemId = null;
		this.selectedRowIndex = 0;
		for (var i = 1; i < this.oTable.rows.length; i++)
		{
			var oRow = this.oTable.rows[i];
			for (iCell = 0; iCell < oRow.cells.length; iCell++)
			{
				oRow.cells[iCell].style.color = "#000";
				oRow.cells[iCell].style.backgroundColor = "#FFF";
			}
		}
	}
	
	this.openEditItem = function()
	{
		if(this.selectedRowIndex == 0)
		{
			alert(SELECT_ITEM_PLEASE);
			return;
		}
		
		var data = {
	        viewId:	this.viewId,
	        itemId:	this.itemId,
	        
	    };
		
		if(this.rFieldName)
		{
			var data = {
		        viewId:	this.viewId,
		        itemId:	this.itemId,
		        parentItemId: $('input[parentId'+this.parentViewId+']').val(),
		        rFieldName: this.rFieldName,
		    };
		}
		
		modalBox.open('ViewController', 'viewBuild', data);
	}
	
	this.openAddItem = function()
	{
		this.deselectItem();
		
		var data = {
	        viewId:	this.viewId,	        
	    };
	    
		if(this.rFieldName)
		{
			var parentItemId = $('input[parentId'+this.parentViewId+']').val();
			if(!parentItemId)
			{
				
				var error = 0;
				array = eval('beFields_'+this.parentViewId);
				for(var i=0;i<array.length; i++)
				{
					if(array[i][1] > 30)
						continue ;
					if(false == beFieldsProcess(array[i]))
					{
						error = 1;
					}
				}
				if(error == 1)
				{
					alert(PRELIMINARY_SAWE_FIELDS_REQUIRED);		
					return false;
				}
				
				navigation.sendRequest('ViewController', 'preliminarySaveViewData', {viewId:this.parentViewId,relatedFieldId:this.fieldId, addDcItem:true}, 'preliminarySaveResult', 'preliminarySaveResult',xajax.getFormValues(this.parentViewId+'viewForm'));
				return ;
			}
			
			var data = {
		        viewId:	this.viewId,
		        parentItemId: parentItemId,
		        rFieldName: this.rFieldName,
		    };
		}
		modalBox.open('ViewController', 'viewBuild', data);
	}
	
	this.addItem = function(insertedId)
	{
		var lastRow = this.oTable.rows.length;
		var iteration = lastRow;

		if(this.displayType==1)
		{
			var row = this.oTable.insertRow(lastRow);
		} else {
			var row = this.oTable.insertRow(1);
		}
		
		this.itemId = insertedId;		
		row.className = 'cursor';
		row.onclick = new Function('', "dcField"+this.fieldId+".selectItem(this,"+insertedId+");");
		
		var cellLeft;
		var textNode;
		for(i=0;i<this.fieldsArray.length;i++)
		{
			cellLeft = row.insertCell(i);
			if(document.getElementById(this.fieldsArray[i]).type == 'checkbox')
			{
//				text = document.getElementById(this.fieldsArray[i]).checked?ACTIVE:NOT_ACTIVE;
				text = document.getElementById(this.fieldsArray[i]).checked?YES:NO;
				textNode = document.createTextNode(text);
			} 
			else if(document.getElementById(this.fieldsArray[i]).type == 'select-one')
			{
				var text = document.getElementById(this.fieldsArray[i]).options[document.getElementById(this.fieldsArray[i]).selectedIndex].text;
				textNode = document.createTextNode(text);
			}
			else if(document.getElementById(this.fieldsArray[i]).type == 'hidden')
			{
				var text = document.getElementById('text'+this.fieldsArray[i]).value;
				textNode = document.createTextNode(text);
			} else {
				textNode = document.createTextNode(document.getElementById(this.fieldsArray[i]).value);
			}
			cellLeft.appendChild(textNode);
		}
		input = document.createElement('input');
		input.type = 'hidden';
		input.name = 'view['+this.fieldId+'][]';
		input.value = insertedId;
		cellLeft = row.insertCell(i);
		cellLeft.appendChild(input);
		
		this.selectItem(row,insertedId);
	}
	
	this.addItemsList = function(items)
	{
		for(i=0;i<items.length;i++)
		{
			var lastRow = this.oTable.rows.length;
			var iteration = lastRow;
			var row = this.oTable.insertRow(lastRow);
			
			this.itemId = items[i]['insertedId'];		
			row.className = 'cursor';
			row.onclick = new Function('', "dcField"+this.fieldId+".selectItem(this,"+items[i]['insertedId']+");");
			var cellLeft;
			var textNode;
			
			for(j=0;j<this.fieldsArray.length;j++)
			{
				cellLeft = row.insertCell(j);
				if(items[i][this.fieldsArray[j]])
				{
					textNode = document.createTextNode(items[i][this.fieldsArray[j]]);					
				}
				else
				{
					textNode = document.createTextNode("\u00A0");
				}
				cellLeft.appendChild(textNode);
			}
			input = document.createElement('input');
			input.type = 'hidden';
			input.name = 'view['+this.fieldId+'][]';
			input.value = items[i]['insertedId'];
			cellLeft = row.insertCell(j);
			cellLeft.appendChild(input);
		}
	}
	
	this.editItem = function(editedId)
	{
		if(this.selectedRowIndex == 0)
			return this.addItem(editedId);
		
		this.oTable.deleteRow(this.selectedRowIndex);
		var row = this.oTable.insertRow(this.selectedRowIndex);
		row.className = 'cursor';
		row.onclick = new Function('', "dcField"+this.fieldId+".selectItem(this,"+editedId+");");
		var cellLeft;
		var textNode;
		for(i=0;i<this.fieldsArray.length;i++)
		{
			cellLeft = row.insertCell(i);
            console.log(document.getElementById(this.fieldsArray[i]).type);
			if(document.getElementById(this.fieldsArray[i]).type == 'checkbox')
			{
//				var text = document.getElementById(this.fieldsArray[i]).checked?ACTIVE:NOT_ACTIVE;
				var text = document.getElementById(this.fieldsArray[i]).checked?YES:NO;
				textNode = document.createTextNode(text);
			}
			else if(document.getElementById(this.fieldsArray[i]).type == 'select-one')
			{
				var text = document.getElementById(this.fieldsArray[i]).options[document.getElementById(this.fieldsArray[i]).selectedIndex].text;
				textNode = document.createTextNode(text);
			}
			else if(document.getElementById(this.fieldsArray[i]).type == 'hidden')
			{
                console.log('text'+this.fieldsArray[i]);
                console.log(document.getElementById('text'+this.fieldsArray[i]).value);
                var text = document.getElementById('text'+this.fieldsArray[i]).value;
				textNode = document.createTextNode(text);
			} else {
				textNode = document.createTextNode(document.getElementById(this.fieldsArray[i]).value);
			}
			cellLeft.appendChild(textNode);
		}
		input = document.createElement('input');
		input.type = 'hidden';
		input.name = 'view['+this.fieldId+'][]';
		input.value = editedId;
		cellLeft = row.insertCell(i);
		cellLeft.appendChild(input);
		
		this.selectedRowIndex = 0;
		this.selectItem(row,editedId);
	}

	this.moveItem = function( x )
	{
		if(this.selectedRowIndex == 0)
		{
			alert(SELECT_ITEM_PLEASE);
			return;
		}
		el = this.selectedRowObject;
		while ( el.parentNode && 'tr' != el.nodeName.toLowerCase() )
		{
			el = el.parentNode;
		}
		var t = el.parentNode;
		var i = el.rowIndex + x;
		
		if(i==0) return;
		if(i==t.rows.length) return;
		
		t.removeChild(el);
		var nRow = t.insertRow( i );
		t.replaceChild(el, nRow);
		this.selectedRowIndex = i;
	}

	this.deleteItem = function(iteration)
	{
		if(this.selectedRowIndex == 0)
		{
			alert(SELECT_ITEM_PLEASE);
			return;
		}
		if(confirm(DELETE_CONFIRM))
		{
			if(this.selectedRowIndex>0)
			{
				this.oTable.deleteRow(this.selectedRowIndex);
				this.selectedRowIndex = 0;
				this.itemId = 0;
			}
		}
	}
	
	this.deleteItems = function()
	{
		for (var i = this.oTable.rows.length-1; i > 0; i--)
			this.oTable.deleteRow(i);
		
		this.selectedRowIndex = 0;
		this.itemId = 0;
	}
}