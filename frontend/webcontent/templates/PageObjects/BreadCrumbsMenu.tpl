<ul class="breadcrumbs">
    <li>
        <a href="#">HOME &gt;</a>
    </li>

    {foreach name=topmenu from=$menuItems item=curr_item_1 key=key_1}
        {if ($selectedMenuItem == 76)}
            {if (count($curr_item_1) > 1)}
                {if ($curr_item_1.me)}
                    {foreach name=menuSecondLevel from=$curr_item_1 item=curr_item_2 key=key_2}
                        {if isset($curr_item_2.me) && ($curr_item_2.me.selectedItem==1)}
                            <li>
                                <a href="#" class="current">{$curr_item_2.me.treeItemName|upper}</a>
                            </li>
                        {/if}
                    {/foreach}
                {/if}
            {/if}
        {/if}
        {if ($selectedMenuItem != 76)}
            {if !(count($curr_item_1) > 1)}
                {if ($curr_item_1.me.selectedItem==1)}
                    <li>
                        <a href="#" class="current">{$curr_item_1.me.treeItemName|upper}</a>
                    </li>
                {/if}
            {/if}
        {/if}
    {/foreach}
</ul>