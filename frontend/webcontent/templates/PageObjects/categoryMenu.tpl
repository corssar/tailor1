<div class="another_menu">
    <nav>
        <table>
            <tbody>
            <tr>
                {foreach name=topmenu from=$menuItems item=curr_item_1 key=key_1}
                    {if ($curr_item_1.me) && ($curr_item_1.me.visible==1)}
                        <td style="height: 47px;">
                            <div class="another_menu_item first_menu_level">
                                <div class="heder_menu_item">
                                    <a href="{$curr_item_1.me.link}" class="">
                                        <span class="giglet"></span>
                                        <span class="menu_item_text">{$curr_item_1.me.treeItemName|upper}</span>
                                    </a>
                                </div>
                                {if (count($curr_item_1) > 1)}
                                    <div class="frame-drop-menu second_menu_level">
                                        <ul>
                                            {foreach name=menuSecondLevel from=$curr_item_1 item=curr_item_2 key=key_2}
                                                {if !$smarty.foreach.menuSecondLevel.first && ($curr_item_2.me.visible==1)}
                                                    <li>
                                                        <a href="{if $curr_item_2.me.link=='#'}{else}{$curr_item_2.me.link}{/if}">
                                                            {$curr_item_2.me.treeItemName|upper}
                                                        </a>
                                                    </li>
                                                {/if}
                                            {/foreach}
                                        </ul>
                                    </div>
                                {/if}
                            </div>
                        </td>
                    {/if}
                {/foreach}
            </tr>
            </tbody>
        </table>
    </nav>
</div>