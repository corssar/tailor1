<div class="privateOfficePage">
    <div class="privateOfficeHeader userData">
        <h1>{$title},&nbsp;<span>{$loginName}!</span></h1>
        <a href="#" class="logout" onclick="$('#signInForm').submit();return false;">{$webtext_exit}{*Вийти*}</a>
        <a href="{$editProfileUrl}" class="editProfileUrl">{$webtext_changeData}{*Змінити дані*}</a>
        <a href="{$privateOfficeUrl}" class="privateOfficeUrl">{$webtext_privateOfficeTxt}{*Особистий кабінет*}</a>
    </div>
    <br clear="both" />
    <hr>
    <div class="privateOfficeBody userDataBody">
        {foreach key=id item=userDataItem from=$userData}
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
    </div>

    {*{if $isJuridicalPerson}*}
        {*<div class="privateOfficeBody userDataBody">*}
        {*{foreach key=id item=userDataItem from=$jPersonData}*}
            {*<div class="privateOfficeRow{if ($id+1)%2 == 0} backgroundWhite{/if}">*}
                {*<div class="leftRowPart">{$userDataItem.label}</div>*}
                {*<div class="rightRowPart">*}
                    {*{if $userDataItem.name == 'phone'}*}
                        {*{foreach item=userPhone from=$userDataItem.value}*}
                            {*<div class="phoneRow">*}
                                {*{$userPhone.code}&nbsp;{$userPhone.number}{if strlen($userPhone.description) > 0}&nbsp;({$userPhone.description}){/if}*}
                            {*</div>*}
                        {*{/foreach}*}
                        {*{else}*}
                        {*{$userDataItem.value}*}
                    {*{/if}*}
                {*</div>*}
            {*</div>*}
        {*{/foreach}*}
        {*</div>*}
    {*{/if}*}

</div>