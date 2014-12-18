<div class="footer_menu">
    <ul>
        {foreach name=topmenu from=$menuItems item=curr_item_1 key=key_1}
            {if ($curr_item_1.me) && ($curr_item_1.me.visible==1)}
                <li id="mainmenu_{$key_1}" class="{if (count($curr_item_1) > 1)}hasSubMenu{/if}{if $curr_item_1.me.selectedItem==='1'} active{/if}">
                    <a {if (count($curr_item_1) > 1)}id="sub_{$key_1}"{/if} href="{if $curr_item_1.me.link=='#'}{$curr_item_1.0.me.link}{else}{$curr_item_1.me.link}{/if}">
                        {if strlen($curr_item_1.me.imageActive)>0}<img width="32" height="37" alt="" src="{$curr_item_1.me.imageActive}">{/if}{$curr_item_1.me.treeItemName}
                    </a>
                </li>
            {/if}
        {/foreach}
    </ul>
</div>