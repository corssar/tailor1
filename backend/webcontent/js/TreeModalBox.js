function TreeModalBox()
{
	this.useShadow = 0;
	this.visible = 0;
	this.open = function(controller,action,params)
	{
		if(!shadow.visible)
		{
			this.useShadow = 1;
			shadow.createPageDiv();
		}
		
		if (document.getElementById('TreeModalBoxMain'))
		{
			document.getElementById('TreeModalBoxMain').style.display = 'block';
			//document.getElementById('TreeModalBoxMain').style.top = getClientCenterY()-360;
		}
		else
		{
			var Div = document.createElement('div');
            var DivTop = getClientCenterY()-360;
			Div.setAttribute('id', 'TreeModalBoxMain');
			Div.style.position = 'absolute';
			Div.style.display  = 'block';
			Div.style.zIndex = 100;
//			Div.style.top = '0px';
            if (DivTop<0){
                Div.style.top = '0px';
            }else{
                Div.style.top = DivTop;
            }
			Div.style.left = '0px';
			Div.style.width = '100%';
			Div.style.height = '100%';
			Div.innerHTML = '<center><div id="TreeModalBoxContent"></div></center>';
			document.body.appendChild(Div);
		}
		this.visible = 1;
		navigation.sendRequest(controller, action, params, 'TreeModalBoxContent', 'TreeModalBoxContent');
	}
	
	this.hideDiv = function()
	{
		if(shadow.visible && this.visible == 1)
		{
			document.getElementById('TreeModalBoxMain').style.display = 'none';
			this.visible = 0;
			if(shadow.visible && this.useShadow)
			{
				shadow.removePageDiv();
			}
		}
	}
}

var treeModalBox = new TreeModalBox();