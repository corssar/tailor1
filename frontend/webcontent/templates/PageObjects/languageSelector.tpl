<ul class="languages-list">
    {foreach key=code item=language from=$languages name=foo}
        {if $language.active==1 and ($showCurrentLang==1 or ($showCurrentLang==0 and $language.code!=$currentLangCode))}
            <li{if $language.code==$currentLangCode} class="selected-language"{/if}>
                <a href="{$relatedPageUrls.$code.url}" title="{$language.name}">{$language.code|upper}</a>
            </li>
        {/if}
    {/foreach}
</ul>