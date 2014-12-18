{literal}
<script type="text/javascript">
        $(document).ready(function(){
var fmd	=	eval('{/literal}{$fieldModelData}{literal}');
    for (var key in fmd)
    {
        var className	=	'';
        if(fmd[key].required)
            className+='validate[required';
        else
            className+='validate[optional';
        if(fmd[key].rule)
            className+=',custom['+fmd[key].rule+']]';
        else
            className+=']';
        $("#"+fmd[key].field).addClass(className);
    }

    $('#contactForm').bind('submit', function() {
        $("#"+this.id+" .inp_edit").each(function(n,element){
            if($(element).attr('startText') == $(element).val())
                $(element).val('');
        });
    });

    $("#contactForm").validationEngine
            ({
                failure : function() {
                    $("#contactForm .inp_edit").each(function(n,element){
                        if($(element).val() == '')
                            $(element).val($(element).attr('startText'));
                    });
                }
            });

var vErrors	=	eval('{/literal}{$validationErrors}{literal}');
    for (var key in vErrors)
    {
        $.validationEngine.buildPrompt("#"+vErrors[key].field,"*"+vErrors[key].value+"<br/>","error");
    }

});
/*
function clearField(elem)
{
    if(elem.value == elem.getAttribute('startText'))
        elem.value = '';
}
function fillField(elem)
{
    if(elem.value == '')
        elem.value = elem.getAttribute('startText');
}
*/
</script>
{/literal}

<div class="shell">
    <h1>{$title}</h1>
	{*<div class="contactIntroDiv">
        {$introHtml}
    </div>*}
	<div class="contactFormDiv">
        {if $mailSentText!=''}
            <div class="contactFormSentText">
                <div id="mailSentText">
                    {$mailSentText}
                 </div>
            </div>
        {else}
            <form class="contactForm" id="contactForm" name="contactForm" method="post">
            {* {if $captchaErrText}
                    <div class="captchaErrText">
                        {$captchaErrText}
                    </div>
                {/if}
            *}
                <label class="labelForField" for="name">{webtext keyword='contactPageNameTxt' value='Ваше имя:' remark='Contact page text'}</label>
                <div class="contactFormBlock">
                    <input tabindex="1" type="text" name="cf[name]" id="name" value="{if $form.name!= ''}{$form.name}{/if}" tabindex="1" class="inp_edit">
                    <span class="reg reg-contact-input">*</span>
                </div>
                <label class="labelForField" for="email">{webtext keyword='contactPageEmailTxt' value='E-mail:' remark='Contact page text'}</label>
                <div class="contactFormBlock">
                    <input tabindex="2" type="text" name="cf[email]" id="email" value="{if $form.email != ''}{$form.email}{/if}" tabindex="2" class="inp_edit">
                    <span class="reg reg-contact-input">*</span>
                </div>
                <label class="labelForField" for="contactMessage">{webtext keyword='contactPageMessageTxt' value='Текст сообщения:' remark='Contact page text'}</label>
                <div class="contactFormBlock">
                    <textarea tabindex="3" name="cf[contactMessage]" id="contactMessage" cols="51" rows="10" tabindex="3" class="inp_edit txt_area_edit">{if $form.message != ''}{$form.message}{/if}</textarea>
                    <span class="reg">*</span>
                </div>
                <div class="contactFormBlock">
                    <a href="#" onclick="$('#sendForm').click();return false;" class="my-contact-btn">{webtext keyword='contactFormSend' value='Отправить' remark='Contact page text'}</a>
                    <input type="submit" id="sendForm" style="display: none;" value="OK" />
                    <input type="hidden" name="postdata" value="1">
                </div>
            </form>
        {/if}
    </div>
</div>
