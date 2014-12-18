 <div class="menu">
    <ul class="navigation">
        {foreach name=topmenu from=$menuItems item=curr_item_1 key=key_1}
            {if ($curr_item_1.me) && ($curr_item_1.me.visible==1 && (!$curr_item_1.me.moduleclass neq null && !$curr_item_1.me.moduleId neq '0'))}
                {if !(count($curr_item_1) > 3)}
                    {if $curr_item_1.me.selectedItem}
                        <li class="active">
                            <a href="{$curr_item_1.me.link}">
                                {$curr_item_1.me.treeItemName|upper}
                            </a>
                        </li>
                    {else}
                        <li>
                            <a class="navigation-link" {if $curr_item_1.me.openLinkInNewWindow==1} target="_blank"{/if} href="{$curr_item_1.me.link}">
                                {$curr_item_1.me.treeItemName|upper}
                            </a>
                        </li>
                    {/if}
                {/if}
                {foreach name=menuSecondLevel from=$curr_item_1 item=curr_item_2 key=key_2}
                    {if !$smarty.foreach.menuSecondLevel.first && ($curr_item_2.me.visible==1)}
                        <li>
                            <a class="navigation-link" href="{if $curr_item_2.me.link=='#'}{else}{$curr_item_2.me.link}{/if}">
                                {$curr_item_2.me.treeItemName|upper}
                            </a>
                        </li>
                    {/if}
                {/foreach}
            {/if}
        {/foreach}
    </ul>
</div>