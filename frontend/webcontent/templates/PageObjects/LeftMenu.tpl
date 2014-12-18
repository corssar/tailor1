{if (count( $menuItems ) > 0 )}
    {foreach name=topmenu from=$menuItems item=curr_item_1 key=key_1}
    	{if $curr_item_1.me.visible==1 && (count($curr_item_1) > 1 && $curr_item_1.me.selectedItem==='1')}
    	<div class="leftMenu">
    		<ul>
            {foreach from=$curr_item_1 item=curr_item_2 key=key_2}
                {if !$smarty.foreach.menuSecondLevel.first && ($curr_item_2.me.visible==1)}
	        		<li {if (count($curr_item_2) > 1)} class="slide" {/if}>
	            		<a class="level_1{if $curr_item_2.me.selectedItem} selected{/if}"{if !$curr_item_2.me.selectedItem} href="{$curr_item_2.me.link}"{/if}>{$curr_item_2.me.treeItemName}</a>
	            		{if (count($curr_item_2) > 1)}
		            	<ul class="level_1{if $curr_item_2.me.selectedItem} selected{/if}">
			            	{foreach from=$curr_item_2 item=curr_item_3 key=key_3}
			            		{if ($curr_item_3.me) && ($curr_item_3.me.visible==1)}
			            		<li {if (count($curr_item_3) > 1)} class="slide" {/if}>
			            			<a class="level_2{if $curr_item_3.me.selectedItem} selected{/if}"{if !$curr_item_3.me.selectedItem} href="{$curr_item_3.me.link}"{/if}>{$curr_item_3.me.treeItemName}</a>
	            					{if (count($curr_item_3) > 1)}
		            				<ul class="level_2">
						            	{foreach from=$curr_item_3 item=curr_item_4 key=key_4}
					            		{if ($curr_item_4.me) && ($curr_item_4.me.visible==1)}
					            		<li>
			            					<a class="{if $curr_item_4.me.selectedItem=='1'}activeMenu{else}links{/if}"{if $curr_item_4.me.selectedItem==='1'} id="currentLevel2_ItemA"{/if} href="{$curr_item_4.me.link}">{$curr_item_4.me.treeItemName}</a>
					            		</li>
					            		{/if}
				                		{/foreach}
		            				</ul>
		            				{/if}
		                    	</li>
		                    	{/if}
			                {/foreach}
	                    </ul>
		            	{/if}
	            	</li>
	            {/if}
    		{/foreach}
    		</ul>
		</div>
        {/if}
    {/foreach}
{/if}