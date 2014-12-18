{literal}
<script>
    $(document).ready(function(){
        {/literal}
        {if $validationErrors|@count>0}
            {foreach item=error from=$validationErrors}
            {literal}
                var fieldId		= '{/literal}{$error.field}{literal}';
                var errorText	= '{/literal}{$error.value}{literal}';
                $("#"+fieldId+"Id").validationEngine("showPrompt","*"+errorText+"<br/>","pass","",true);
            {/literal}
            {/foreach}
        {/if}
        {literal}
    });

</script>
{/literal}
<div class="registerPage">
<h1>{$title}</h1>
    <hr>
	{if $registered == 1}
        <div class="formResultMessage">
            {$registerText}
        </div>
	{elseif $registered == -1}
        <div class="formResultMessage">
            {$registerText}
        </div>
	{else}
        {if strlen($introHtml)>0}
            <div class="registerIntro">
                {$introHtml}
            </div>
        {/if}
        <form id="reg_form" class="reg_form" method="POST">
            <div class="regFormRow">
                <label id="emailLabelId" for="emailId"><span style="color:#FF0000;">*</span>{$webtext_email}{*E-mail:*}</label>
                <input type="text" name="ud[email]" id="emailId" value="{$email}" validationTick="emailIdPass" tabindex="1" class="reg_edit validate[required,custom[emailFormat],ajax[ajaxEmail]]">
                <span id="emailIdPass" class="formValidationPass">&nbsp;</span>
            </div>
            <div class="regFormRow">
                <label id="passwordLabelId" for="passwordId"><span style="color:#FF0000;">*</span>{$webtext_passwordText}{*Пароль:*}</label>
                <input type="password" name="ud[password]" id="passwordId" value="" validationTick="passwordIdPass" tabindex="2" class="reg_edit validate[required]" autocomplete="off">
                <span id="passwordIdPass" class="formValidationPass">&nbsp;</span>
            </div>
            <div class="regFormRow">
                <label id="confirmPasswordLabelId" for="confirmPasswordId"><span style="color:#FF0000;">*</span>{$webtext_repeatPasswordText}{*Повторіть пароль:*}</label>
                <input type="password" name="ud[confirmPassword]" id="confirmPasswordId" value="" validationTick="confirmPasswordIdPass" tabindex="3" class="reg_edit validate[required,equals[passwordId]]" autocomplete="off">
                <span id="confirmPasswordIdPass" class="formValidationPass">&nbsp;</span>
            </div>
            <div class="regFormRow">
                <label id="loginNameLabelId" for="loginNameId"><span style="color:#FF0000;">*</span>{$webtext_nickName}{*Нікнейм:*}</label>
                <input type="text" name="ud[loginName]" id="loginNameId" value="{$loginName}" validationTick="loginNameIdPass" tabindex="4" class="reg_edit validate[required,ajax[ajaxName]]">
                <span id="loginNameIdPass" class="formValidationPass">&nbsp;</span>
            </div>
            <div class="checkBoxesBlock">
                <div>
                    <input type="checkbox" id="isAccept1" name="isAccept1" tabindex="5" value="0" class="isAcceptClass validate[required]" onclick="openNewWindow(this,'User Agreement','{$userAgreementPageUrl}',1000,700);">
                    <label id="isAccept1LabelId" for="isAccept1" class="checkBoxLabel">{$webtext_acceptUserAgreement}{*Я принимаю условия пользовательского соглашения*}<span style="color:#FF0000;"> *</span></label>
                </div>
                <div>
                    <input type="checkbox" id="isAccept2" name="isAccept2" tabindex="6" value="0" class="isAcceptClass validate[required]" onclick="openNewWindow(this,'Site Rules','{$siteRulesPageUrl}',1000,700);">
                    <label id="isAccept2LabelId" for="isAccept2" class="checkBoxLabel">{$webtext_acceptResourceRules}{*Я принимаю правила пользования ресурсом*}<span style="color:#FF0000;"> *</span></label>
                </div>
            </div>
            <div class="regButtonsRow">
                <input type="hidden" name="registration" value="1">
                <div class="sendBtn"><a id="reg_form_submit" href="javascript:void(0)" tabindex="7" class="sendButtonController">{$webtext_send}{*Отправить*}</a></div>
                <a href="#" tabindex="7" class="cancelLink">{$webtext_cancel}{*Отмена*}</a>
            </div>
            <br clear="both" />
        </form>
	{/if}
</div>