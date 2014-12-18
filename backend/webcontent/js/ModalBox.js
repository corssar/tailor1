function ModalBox()
{
	this.useShadow = 0;
	this.visible = 0;
	
	this.modalBoxNumber = 0;
	
	this.open = function(controller,action,params)
	{
		this.modalBoxNumber++;
		
		if(!shadow.visible)
		{
			this.useShadow = 1;
			shadow.createPageDiv();
		}

		if (document.getElementById('ModalBoxMain'+this.modalBoxNumber))
		{
			document.getElementById('ModalBoxMain'+this.modalBoxNumber).style.display = 'block';
		    //document.getElementById('ModalBoxMain'+this.modalBoxNumber).style.top = getClientCenterY()-360;
		}
		else
		{
			var Div = document.createElement('div');
            var DivTop = getClientCenterY()-355;
			Div.setAttribute('id', 'ModalBoxMain'+this.modalBoxNumber);
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
			Div.innerHTML = '<center><div style="background-color:#fff; border: solid 1px #000;padding:10px; width:788px; min-height:585px;height:auto;z-index:100;" id="ModalBoxContent'+this.modalBoxNumber+'"></div></center>';
			document.body.appendChild(Div);
		}
		this.visible = 1;
		navigation.sendRequest(controller, action, params, 'ModalBoxContent'+this.modalBoxNumber, 'ModalBoxContent'+this.modalBoxNumber);
	}
	
	this.hideDiv = function()
	{
		if(this.visible == 1)
		{
			document.getElementById('ModalBoxMain'+this.modalBoxNumber).style.display = 'none';
			this.modalBoxNumber--;
			if(this.modalBoxNumber == 0)
			{
				this.visible = 0;
			}
			if(shadow.visible && this.useShadow && this.modalBoxNumber == 0)
			{
				shadow.removePageDiv();
			}
		}
	}
}

var modalBox = new ModalBox();