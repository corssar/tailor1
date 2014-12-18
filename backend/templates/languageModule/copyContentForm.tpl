<div class="searchFormContainer copyContentForm">
	<div class="searchViewTitle">{$title}</div>
	<div class="viewHeadButtons">
		<input type="button" onclick="requestLanguageContent();" value="{$webtext_BE_LangCopyNextBtn}{*Продовжити*}" class="button" id="viewButton3">
	</div>
    <div class="clear">&nbsp;</div>
	<div class="searchFormBlock">
		<div class="searchFormItem">
            <fieldset>
                <legend>{$webtext_BE_LangCopyFromTitle}{*Копіювати контент з:*}</legend>

                <div class="column" style="width:50%">
                    {$webtext_BE_LangCopySiteTitle}{*Сайт:*}<br/>
                    <select name="sourceSiteId" id="sourceSiteId">
                        <option></option>
                    {foreach key=key item=website from=$websites}
                        <option value="{$website.id}">{$website.name}</option>
                    {/foreach}
                    </select>
                </div>

                <div class="column lang">
                {$webtext_BE_LangCopyLangTitle}{*Мова:*}<br/>
                    <select name="sourceLangId" id="sourceLangId">
                        <option></option>
                    {foreach key=langCode item=item from=$languages}
                        <option value="{$item.id}">{$item.name}</option>
                    {/foreach}
                    </select>
                </div>
            </fieldset>
		</div>
        <div class="searchFormItem" >
            <span id="copyErrorValidation" style="color: #ff0000; display:none">{$webtext_BE_LangCopyError}{*Дану операцію не можна виконати*}</span>
            {if $params}
                {$params}
            {/if}
        </div>

        <div class="clear">&nbsp;</div>
		<div class="searchFormItem">
            <fieldset>
                <legend>{$webtext_BE_LangCopyToTitle}{*Копіювати контент на:*}</legend>

                    <div class="column" style="width:50%">
                        {$webtext_BE_LangCopySiteTitle}{*Сайт:*}<br/>
                        <select name="goalSiteId" id="goalSiteId">
                            <option></option>
                            {foreach key=key item=website from=$websites}
                                <option value="{$website.id}">{$website.name}</option>
                            {/foreach}
                        </select>
                    </div>

                <div class="column lang">
                {$webtext_BE_LangCopyLangTitle}{*Мова:*}<br/>
                    <select name="goalLangId" id="goalLangId">
                        <option></option>
                    {foreach key=langCode item=item from=$languages}
                        <option value="{$item.id}">{$item.name}</option>
                    {/foreach}
                    </select>
                </div>
            </fieldset>
		</div>
		<div class="searchFormItem">
            <fieldset>
                <legend>{$webtext_BE_LangCopySettingsTitle}{*Налаштування:*}</legend>
                <input type="checkbox" checked id="createContent"/>
                <label>{$webtext_BE_LangCopyCopyTitle}{*Створити контент*}</label>
                <br/>
                <input type="checkbox" id="deleteContent"/>
                <label>{$webtext_BE_LangCopyDeleteTitle}{*Видалити існуючий контент*}</label>
            </fieldset>
		</div>
	</div>

</div>
<div id="CopyLangResult" class="searchResultTable">
{if $tryDelete==true}
	{if $isContentDeleted==true}
		Language with id={$deletedLanguage} deleted succesfully
	{else}
		Error during delete of language id={$deletedLanguage}. Check log for more detail.
	{/if}
{/if}
{if $tryCreate==true}
    {if $isContentCreated==true}
        Language with id={$createdLanguage} created succesfully
        {else}
        Error during create content for language id={$createdLanguage}. Check log for more detail.
    {/if}
{/if}
</div>