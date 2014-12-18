function changeUserStatus(select)
{
	if(confirm('﻿Вы меняете статус пользователя, хотите уведомить об этом пользователя через email?'))
	{
		document.getElementById('emailText').style.display = 'block';
		document.getElementById('emailText').value = document.getElementById('emailTextVariant'+select.value).value;
		return true;
	}
	else
	{
		document.getElementById('emailText').style.display = 'none';
		document.getElementById('emailText').value = '';
		return false;
	}
}
//Language relation control
function activateRelatedControl()
{
	if($('#languageControll'))
	{
		if (document.getElementById('languageControll').getElementsByTagName('span')[0].onclick==null) {
		    document.getElementById('languageControll').getElementsByTagName('span')[0].onclick = function() {
		        this.parentNode.getElementsByTagName('ul')[0].style.display = (this.parentNode.getElementsByTagName('ul')[0].style.display=='block')?'none':'block';
		    };
		    var timerObj;
		    document.getElementById('languageControll').onmouseout = function() {
		        that = this;
		        timerObj = setTimeout(function(){
		            that.getElementsByTagName('ul')[0].style.display = 'none';
		        }, 3000);
		    }
		    document.getElementById('languageControll').onmouseover = function() {
		        clearTimeout(timerObj);
		    }
		 };
	}
}

//Copy language functionality
function requestLanguageContent()
{
    if(!($("#sourceLangId").val() && $("#createContent").is(':checked') && $("#goalLangId").val()) && !($("#goalLangId").val() && $("#deleteContent").is(':checked')))
    {
        $("#copyErrorValidation").show();
        return;
    }
    $("#copyErrorValidation").hide();

    var data = {
        sourceLangId:	    $("#sourceLangId").val(),
        goalLangId:			$("#goalLangId").val(),
        sourceSiteId:	    $("#sourceSiteId").val(),
        goalSiteId:			$("#goalSiteId").val(),
        deleteContent:		$("#deleteContent").is(':checked'),
        createContent:		$("#createContent").is(':checked')
    };

    navigation.sendRequest('LanguageController', 'CopyContent', data, 'CopyLangResult', 'CopyLangResult');
}
function activateCopyLangValidation()
{
    if ($("#sourceSiteId").length){
        // hide language selection
        $(".searchFormItem .lang").hide();

        $("#sourceSiteId, #goalSiteId").bind("change", activateLanguagesForSite);
    }
}
function activateLanguagesForSite(){
    if(!(language = getAvailableLanguagesBySiteId($(this).val())))
        return;

    activateLanguageSelection(this, language);
}
function getAvailableLanguagesBySiteId(siteId)
{
    var language = false;
    for (var k = 0; k < websites.length; ++k)
    {
        if(websites[k].id == siteId){
            language = websites[k].languages;
            break;
        }
    }
    return language;
}
function activateLanguageSelection(siteSelectObj, languageArray)
{
    $(siteSelectObj).parent().next().find('select option').attr('disabled','disabled');
    langSelect = $(siteSelectObj).parent().next().find('select');
    for(var k=0; k<languageArray.length; k++){
        $(siteSelectObj).parent().next().find("select option[value='"+languageArray[k]+"']").removeAttr('disabled');
    }

    //show select with langauges
    $(siteSelectObj).parent().next('.lang').show();

}

function runTask(id, el)
{
    if(checkParams(id, el))
    {
        var data = {
            taskId:	    id,
            export_fields:      export_fields,
            export_format:      export_format,
            export_type:        export_type
        };

        navigation.sendRequest('TasksController', 'runTask', data, 'ResultForm', 'ResultForm');
    }
}

function openParams(el)
{
    var liParams = $(el).parent().next();
    if(liParams.attr('class') == 'paramsArea')
    {
        liParams.slideToggle();
    }
}

var export_fields = "";
var export_format = "";
var export_type = "";

function checkParams(id, el)
{
    export_fields = "";
    var liParams = $(el).parent().parent().next();
    if(liParams.attr('class') == 'paramsArea')
    {
        /*liParams.slideToggle();
        var fileName = $('#' + id + '_file_name').val();
        uploadPoiFile(id, fileName);
        return false;
        */
        liParams.find('li').each(function(){
            if($(this).attr('param') == "input")
            {
                liParams.slideToggle();
            }
            if($(this).attr('param') == "export_fields")
            {
                $('.exportFormatFile input[type=radio]').each(function(){
                    if($(this).attr('checked'))
                    {
                        export_format = $(this).val();
                    }
                });

                $('.exportTypeUsers input[type=radio]').each(function(){
                    if($(this).attr('checked'))
                    {
                        export_type = $(this).val();
                    }
                });

                $('.siteContainer input[type=checkbox]').each(function(){
                    if($(this).attr('checked'))
                    {
                        var str = "" + $(this).attr('setExportFieldsId') + ",";
                        export_fields += str;

                    }
                });
            }
        });
    }
    return true;
}


//Copy site functionality
function copySiteSettings()
{
    if(!($("#newSiteTitle").val()) || !($("#newSiteURL").val()))
    {
        $("#copyErrorValidation").show();
        return;
    }
    $("#copyErrorValidation").hide();
    
    var newSiteLangs = [];
    $("#newSiteLangsContainer input[type=checkbox]:checked").each(function(){
    	newSiteLangs.push($(this).val());
    });

    var data = {
        sourceSiteId:	    $("#sourceSiteId").val(),
        newSiteURL:	   		$("#newSiteURL").val(),
        newSiteTitle:	    $("#newSiteTitle").val(),
        newSiteLangs:		newSiteLangs
    };

    navigation.sendRequest('SiteController', 'CopySettings', data, 'CopySiteResult', 'CopySiteResult');
}

function copySiteSettingsDone(websiteId,websiteName)
{
	$("#multiSiteSelect").append("<option value="+websiteId+">"+websiteName+"</option>");
	$("#copyWebsiteButton").attr("disabled","disabled");
	
	var data = {};

    navigation.sendRequest('LanguageController', 'buildCopyContentForm', data, 'CopyLanguagesAfterCopySite', 'CopyLanguagesAfterCopySite');
}

function generateProductVariations(variationsListFieldId,productViewId)
{
//    if (!new Function( '', "dcField"+variationsListFieldId+".openAddItem();" )())
//        return ;

    var attributes = {};
    $("#productAttributes").find('input[class = "attributeId"]').each(function(){
        var attributeId = $(this).val();
        attributes[attributeId] = [];
        $('input[id ^= "attribute'+attributeId+'"]').each(function(){
            if($(this).is(':checked'))
                attributes[attributeId].push($(this).val());
        });
    });

    var relatedFieldId = $("[fieldAttributeUnique='"+variationsListFieldId+"']").attr("id")
    var productId = $('input[parentId'+productViewId+']').val();
    if(productId)
    {
        navigation.sendRequest( 'ViewController', 'generateProductVariations',
                                {viewId:productViewId,productId:productId,relatedFieldId:relatedFieldId,attributes:JSON.stringify(attributes)},
                                'genVariationsContainer', 'genVariationsContainer');
    }
    else
    {
        var error = 0;
        array = eval('beFields_'+productViewId);
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

        navigation.sendRequest( 'ViewController','preliminarySaveViewData',
                                {viewId:productViewId, relatedFieldId:relatedFieldId, addProductVariations:true, attributes:JSON.stringify(attributes)},
                                'genVariationsContainer', 'genVariationsContainer',
                                xajax.getFormValues(productViewId+'viewForm'));
        return ;
    }
}

function basename(path, suffix)
{
    var b = path.replace(/^.*[\/\\]/g, '');
    if (typeof(suffix) == 'string' && b.substr(b.length-suffix.length) == suffix) {
        b = b.substr(0, b.length-suffix.length);
    }
    return b;
}
function setImageSizeCodeField()
{
    if($('#isNewSize').val() == 1){
        var width =  $("#2474");
        var height =  $("#2475");
        var sizeCode = $('#imageSizeCode');
        width.change(function () {
            sizeCode.val(width.val()+'x'+height.val());
        });
        $("#2475").change(function () {
            sizeCode.val(width.val()+'x'+height.val());
        });
    }
}

function showEventMasks()
{
    $('.maskPopUp .maskList').hide();
    $('.maskPopUp #eventMask'+$('#eventId :selected').val()).show();
}

var fieldId;
function setMask(val)
{
    if(fieldId != "eventId" && $('#'+fieldId).attr("class") != "multiLangSelect")
        $('#'+fieldId).insertAtCaret(val);return false;
}

function sendTestMail()
{
    $('.eventLoader').show();
    var body = $('.eventBody').html();
    var userId = $('.eventUser').val();
    var email = $('.adminEmail').val();
    var eventId = $('#eventId :selected').val();

    var data = {
        body:	    body,
        userId:	    userId,
        email:	    email,
        eventId:	eventId
    };

    navigation.sendRequest('ViewController', 'sendTestMail', data, 'eventResult', 'eventResult');
}