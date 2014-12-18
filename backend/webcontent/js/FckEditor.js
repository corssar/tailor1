function FckPopUp()
{
	this.fieldId = null;
	this.width 	 = 760;
	this.height  = 570;
	this.FckEditorObj = null;
	this.visible   = 0;
	
	this.open = function(fieldId,width,height)
	{		
		this.fieldId = fieldId;
		//this.width 	 = width;
		//this.height  = height;

		if(!shadow.visible)
		{
			shadow.createPageDiv();
			this.visible = 1;
		}
		if (document.getElementById('FckModalBoxMain'))
		{
			document.getElementById('FckModalBoxMain').style.display = 'block';
		}
		else
		{
			var Div = document.createElement('div');
			Div.setAttribute('id', 'FckModalBoxMain');
			Div.style.position = 'absolute';
			Div.style.display  = 'block';
			Div.style.zIndex = 100;
			Div.style.top = '0px';
			Div.style.left = '0px';
			Div.style.width = '100%';
			Div.style.height = '100%';
			Div.innerHTML = '<center><div style="background-color:#fff; border: solid 1px #000; width:770px; height:600px;padding:5px;" id="FckModalBoxContent"></div></center>';
			document.body.appendChild(Div);
			
			var div = document.getElementById("FckModalBoxContent");
			var fck = new FCKeditor("FckEditor");
			fck.Width  = this.width;
			fck.Height = this.height;
			div.innerHTML = fck.CreateHtml()+'<div style="padding-top:6px"><input type="button" value="'+SAVE+'" onclick="fckPopUp.SaveContent();"  class="button">&nbsp;&nbsp;&nbsp;<input type="button" value="'+CANCEL+'" onclick="fckPopUp.hideDiv();" class="button"></div>';
		}
		if(this.FckEditorObj)
		{
			this.FckEditorObj.SetHTML(document.getElementById(fckPopUp.fieldId).value);
		}
	}
	
	this.SaveContent = function()
	{
		fckText = this.FckEditorObj.GetXHTML(true);
//		document.getElementById(this.fieldId+'div').innerHTML = fckText;
		document.getElementById(this.fieldId).value = fckText;
		fckPopUp.hideDiv();
	}
	
	this.hideDiv = function()
	{
		document.getElementById('FckModalBoxMain').style.display = 'none';
		if(shadow.visible && this.visible == 1)
		{
			shadow.removePageDiv();
			this.visible = 0;
		}
	}
}

var fckPopUp = new FckPopUp();

function FCKeditor_OnComplete( editorInstance )
{
	if(document.getElementById(fckPopUp.fieldId).value)
	{
//		editorInstance.InsertHtml(document.getElementById(fckPopUp.fieldId).value);
		editorInstance.SetHTML(document.getElementById(fckPopUp.fieldId).value);
	}
	fckPopUp.FckEditorObj = editorInstance;
}