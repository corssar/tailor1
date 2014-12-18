function FILE_MANAGER()
{
    var OldStartType = '';
    var StartType = '';
    var Type = '';
	this.elementId = false;
	this.visible   = 0;
	this.open = function(id)
	{
		this.elementId = id;
		if(!shadow.visible)
		{
			shadow.createPageDiv();
			this.visible = 1;
		}
		this.createDiv();
	}

    this.imageProcessingOpen = function(id, closedEditor, starttype)
    {
        StartType = starttype;
        if (document.getElementById('file_manager_div_id') && OldStartType !== StartType)
        {
            document.getElementById('file_manager_div_id').remove();
            //var dv;
            //dv = document.getElementById('file_manager_div_id');
            //dv.parentNode.removeChild(dv);
        }
        if(closedEditor)
        {
            var sizeNames = [];
            var sizeNamesStr = '';
            $('#'+id).parents('div.tabContainerActive').find('input[imgsize]').each(function(indx){
                if($(this).attr('imgsize')){
                    sizeNames.push($(this).attr('imgsize'));
                }
            });
            sizeNamesStr = sizeNames.toString();
        }
        this.open(id);
        document.getElementById('file_manager_div_id').setAttribute('sizeNames', sizeNamesStr);
        document.getElementById('file_manager_div_id').setAttribute('closededitor', closedEditor);
    }

	this.load = function(url)
	{
		if (url !== false)
		document.getElementById(this.elementId).value = url;
        $('#'+this.elementId+'_viewAttached').css('visibility', 'visible');
        $('#'+this.elementId).change();
		this.elementId = false;
		this.hideDiv();
	}

    this.loadImages = function(data)
	{
        for (var key in data){
            $('input[imgsize=\''+key+'\']').val(data[key]);
            $('#'+$('input[imgsize=\''+key+'\']').attr('id')+'_viewAttached').css('visibility', 'visible');
        }
        $('#'+this.elementId).change();
        this.elementId = false;
		this.hideDiv();
	}

    this.createDiv = function()
    {
        if (document.getElementById('file_manager_div_id') && OldStartType == StartType)
        {
            document.getElementById('file_manager_div_id').style.display = 'block';
        }
        else
        {
            OldStartType = StartType;
            var Div = document.createElement('div');
            Div.setAttribute('id', 'file_manager_div_id');
            Div.style.position = 'absolute';
            Div.style.display  = 'block';
            Div.style.zIndex = 200;
            Div.style.top = '0px';
            Div.style.left = '0px';
            Div.style.width = '100%';
            Div.style.height = '100%';
            isOpenedFromFileManager = 1;

            Div.innerHTML = '<center><div style="background-color:#CCC; border: solid 1px #000; width:800px; height:20px;"><img width="15px" height="15px" src="webcontent/img/window_close.gif" onmouseover="this.src=\'webcontent/img/window_close_over.gif\';" onmouseout="this.src=\'webcontent/img/window_close.gif\';" style="cursor:pointer;float:right;margin-right:3px;margin-top:3px;" alt="Close" title="Close" onclick="fileManager.hideDiv();" /></div><div style="background-color:#fff; border: solid 1px #000; width:800px; height:600px;"><iframe name="frmFileManager" style="border:none;" src="webcontent/fckeditor/editor/filemanager/browser/default/browser.html?Type='+Type+'&clickaction=urltofield&StartType='+StartType+'" width="100%" height="100%"></iframe></div></center>';
            document.body.appendChild(Div);
        }
    }

	this.hideDiv = function()
	{
		document.getElementById('file_manager_div_id').style.display = 'none';
		if(shadow.visible && this.visible == 1)
		{
			shadow.removePageDiv();
			this.visible = 0;
		}
	}
}

var fileManager = new FILE_MANAGER();