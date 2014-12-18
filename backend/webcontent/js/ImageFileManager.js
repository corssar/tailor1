function IMAGE_FILE_MANAGER()
{
    this.elementId = false;
    this.visible   = 0;
    this.Type = 'Image';
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

    this.createDiv = function()
    {
        if (document.getElementById('file_manager_div_id'))
        {
            document.getElementById('file_manager_div_id').style.display = 'block';
        }
        else
        {
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


            Div.innerHTML = '<center><div style="background-color:#CCC; border: solid 1px #000; width:800px; height:20px;"><img width="15px" height="15px" src="../../img/window_close.gif" onmouseover="this.src=\'../../img/window_close_over.gif\';" onmouseout="this.src=\'../../img/window_close.gif\';" style="cursor:pointer;float:right;margin-right:3px;margin-top:3px;" alt="Close" title="Close" onclick="fileManager.hideDiv();" /></div><div style="background-color:#fff; border: solid 1px #000; width:800px; height:600px;"><iframe name="frmFileManager" style="border:none;" src="../../fckeditor/editor/filemanager/browser/default/browser.html?Type='+this.Type+'&clickaction=urltofield" width="100%" height="100%"></iframe></div></center>';
            document.body.appendChild(Div);
        }
    }

    this.imageProcessingOpen = function(id)
    {
        this.open(id);
        document.getElementById('file_manager_div_id').setAttribute('sizeNames', '');
        document.getElementById('file_manager_div_id').setAttribute('closededitor', false);
    }

    this.load = function(url)
    {
        if (url !== false){
            var imageFrame = window.top.frames['frmMain'];
            imageFrame.document.getElementById(this.elementId).value = url;
            imageFrame.UpdatePreview();
        }

        this.elementId = false;
        this.hideDiv();
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

var fileManager = new IMAGE_FILE_MANAGER();