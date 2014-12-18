<div class="searchFormContainer copyContentForm">
	<div class="searchViewTitle">{$title}</div>
	<div class="viewHeadButtons">
		<input type="button" onclick="copySiteSettings();" value="{$webtext_BE_LangCopyNextBtn}{*Продовжити*}" class="button" id="copyWebsiteButton">
	</div>
    <div class="clear">&nbsp;</div>
	<div class="searchFormBlock">
		<div class="searchFormItem" style="width:96%">
            <fieldset>
                <legend>{$webtext_BE_SiteCopyFromTitle}{*Створити копію сайту:*}</legend>
                {if $multiSite}
                <div class="column" style="width:25%">
                    {$webtext_BE_CopySiteTitle}{*Сайт джерело:*}<br/>
                    <select name="sourceSiteId" id="sourceSiteId" style="width:160px;">
                    {foreach key=key item=website from=$websites}
                    	<option value="{$website.id}" {if $curSiteId==$website.id}selected{/if}>{$website.name}</option>
                    {/foreach}
                    </select>
                </div>
                <div class="column" style="width:25%">
                    {$webtext_BE_SiteCopyNewSiteTitle}{*Назва нового сайту:*}<br/>
                    <input name="newSiteTitle" id="newSiteTitle" size="20"/>
                </div>
                <div class="column" style="width:25%">
                    {$webtext_BE_SiteCopyNewSiteURL}{*Домен (без http://):*}<br/>
                    <input name="newSiteURL" id="newSiteURL" size="20"/>
                </div>
                <div class="column" style="width:25%">
                    {$webtext_BE_CopySiteCountry}{*Країна:*}<br/>
                    <select name="newSiteCountryId" id="newSiteCountryId" style="width:160px;">
                    {foreach key=key item=country from=$countries}
                    	<option value="{$country.id}">{$country.name}</option>
                    {/foreach}
                    </select>
                </div>
                <div class="column" id="newSiteLangsContainer" style="width:100%">
                    {$webtext_BE_CopySiteLangs}{*Мови:*}<br/>
                    {foreach key=key item=lang from=$langs}
                    <input type="checkbox" value="{$lang.id}" title="{$lang.name}">{$lang.name}&nbsp;&nbsp;
                    {/foreach}
                    </select>
                </div>
			    {/if}
            </fieldset>
		</div>
        <div class="searchFormItem" >
            <span id="copyErrorValidation" style="color: #ff0000; display:none">{$webtext_BE_LangCopyError}{*Дану операцію не можна виконати*}</span>
            {if $params}
                {$params}
            {/if}
        </div>

        <div class="clear">&nbsp;</div>
	</div>
</div>

<div id="CopySiteResult"></div>
<div id="CopyLanguagesAfterCopySite" class="searchResultTable"></div>