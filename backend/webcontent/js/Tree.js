function addTreeItem(parentNodeId,viewIdParam,menuIdParam)
{
	parentNodeIdParam = trim(parentNodeId,'node');
	eval("viewDataObject"+viewIdParam+" = new ViewDataObject("+viewIdParam+",'treeItem',"+trim(parentNodeId,'node')+");");
	
	treeModalBox.open('ViewController','viewBuild',{viewId:viewIdParam,itemId:0,parentNodeId:parentNodeIdParam,menuId:menuIdParam});
}

function editTreeItem(itemIdParam,viewIdParam)
{
	itemIdParam = trim(itemIdParam,'node');
	eval("viewDataObject"+viewIdParam+" = new ViewDataObject("+viewIdParam+",'treeItem');");

	treeModalBox.open('ViewController','viewBuild',{viewId:viewIdParam,itemId:itemIdParam,parentNodeId:0});
}

function saveEditedTreeItem(id,text,visible,parentNodeId)
{
	if(!document.getElementById('nodeATag' + id))
		return this.saveAddedTreeItem(id,text,visible,parentNodeId);
	
	var aTag = document.getElementById('nodeATag' + id);
	if(!visible)
	{
		aTag.style.color = '#CCC';
	}
	aTag.innerHTML = text;
}

function saveAddedTreeItem(id,text,visible,parentNodeId)
{
	var parentNode = document.getElementById('node'+parentNodeId);
	
	/* 2. Find the last chald element of the list to know if <ul> have to be pasted or just add the new <li>*/
	if(parentNode.lastChild.tagName!='UL' && parentNode.lastChild.tagName!='LI' && parentNode.lastChild.tagName!='A')
	{
		lastLiElement = parentNode.childNodes[parentNode.childNodes.length-2];
	}
	else
	{
		lastLiElement = parentNode.lastChild;
	}
	/* 2.end */
	if(lastLiElement.tagName=='UL')
	{
		var li = document.createElement('LI');
		li.id = 'node' + id;
		
		var aTag = document.createElement('A');
		aTag.href = '#';
		aTag.id = 'nodeATag' + id;
		if(!visible)
			aTag.style.color = '#CCC';
		aTag.innerHTML = text;
		li.appendChild(aTag);
		
		lastLiElement.appendChild(li);	
	}
	else
	{
		var ul = document.createElement('UL');
		ul.id = 'tree_ul_' + parentNodeId;
		
		var li = document.createElement('LI');
		li.id = 'node' + id;
		
		var aTag = document.createElement('A');
		aTag.id = 'nodeATag' + id;
		aTag.href = '#';
		if(!visible)
			aTag.style.color = '#CCC';
		aTag.innerHTML = text;
		li.appendChild(aTag);
		ul.appendChild(li);
		parentNode.appendChild(ul);
	}
	treeObj.addTreeNode(id,parentNodeId);
	
	/* 4. Saving a nodes order into input field*/
	document.getElementById(treeObj.fieldId+'nodeOrders').value=treeObj.getNodeOrders();
}