<!--<div class="moduleBar">
    <a class="moduleActionEdit" href={*"{$editProfileUrl}">{$webtext_changeData}{*«м≥нити данн≥*}</a>*}
</div>
<div class="moduleRecordCount">{*{$recordCountTitle}{$recordCount}</div>*}
<div class="clear"></div>
{*{foreach key=id item=userDataItem from=$userData}
<div class="privateOfficeRow{if ($id+1)%2 == 0} backgroundWhite{/if}">
    <div class="leftRowPart">{$userDataItem.label}</div>
    <div class="rightRowPart">
        {if $userDataItem.name == 'phone'}
            {foreach item=userPhone from=$userDataItem.value}
                <div class="phoneRow">
                    {$userPhone.code}&nbsp;{$userPhone.number}{if strlen($userPhone.description) > 0}&nbsp;({$userPhone.description}){/if}
                </div>
            {/foreach}
            {else}
            {$userDataItem.value}
        {/if}
    </div>
</div>
{/foreach}
*}
-->