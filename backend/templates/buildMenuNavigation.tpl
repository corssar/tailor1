<tr valign="middle">
    <td colspan="2">
        <div id="stylelast">
            <ul class="topmenu" id="topmenu">
            {foreach name=topMenu from=$menuList item=item}
                <li id="tli_menu{$smarty.foreach.topMenu.iteration}">
                    <a class="{$item.class}" id="ta_menu{$smarty.foreach.topMenu.iteration}" href="{if $item.href != null}{$item.href}{else}#{/if}" onclick="{if $item.click != null}{$item.click}{else}javascript:void(0){/if}">
                        {$item.title}
                    </a>
                </li>
            {/foreach}
            </ul>
        </div>
    </td>
</tr>
<tr valign="top" style="height:100%">
    <td class="table_left">
        <ul id="menu" class="menu">
        {foreach name=leftMenu from=$menuList[$selected].child item=item}
            <li id="tli_menu{$smarty.foreach.leftMenu.iteration}">
                <a id="ta_menu{$smarty.foreach.leftMenu.iteration}" href="{if $item.href != null}{$item.href}{else}#{/if}" onclick="{if $item.click != null}{$item.click}{/if}">
                    {$item.title}
                </a>
            </li>
        {/foreach}
        </ul>
    </td>
    {if $selected eq '1'}
    <td class="table_right">
        {if $buildRelatedContentPopUp}<div id="relatedContentPopUp" title="{$relatedContentPopUpTitle}"></div><div id="relatedContentAjaxLoading"></div><div id="copyContentPopUpObj"></div><div id="relatedContentAjaxLoading"></div>{/if}
        <div id="main_content_container">
            &nbsp;
        </div>
    </td>
    {elseif $selected eq '2'}
    <td class="table_right">
        {if $buildRelatedContentPopUp}<div id="relatedContentPopUp" title="{$relatedContentPopUpTitle}"></div><div id="relatedContentAjaxLoading"></div><div id="copyContentPopUpObj"></div><div id="relatedContentAjaxLoading"></div>{/if}
        <div id="main_content_container">
            &nbsp;
        </div>
    </td>
    {elseif $selected eq '3'}
    <td class="table_right">
        <div id="main_content_container">
            &nbsp;
        </div>
    </td>
    {elseif $selected eq '4'}
    <td class="table_right">
        <div id="main_content_container" style="height:100%;padding:0px;">
            <iframe name="frmFileManager" style="border:none;" src="webcontent/fckeditor/editor/filemanager/browser/default/browser.html?clickaction=noaction" width="100%" height="100%"></iframe>
        </div>
    </td>
    {elseif $selected eq '5'}
    <td class="table_right">
        <div id="main_content_container">
            &nbsp;
        </div>
    </td>
    {elseif $selected eq '21'}
    <td class="table_right">
        <div id="main_content_container">
            &nbsp;
        </div>
    </td>
    {elseif $selected eq '15'}
    <td class="table_right">
        <div id="main_content_container">
            &nbsp;
        </div>
    </td>
{/if}
</tr>