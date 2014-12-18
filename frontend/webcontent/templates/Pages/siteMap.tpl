<div class="pageContent">
	<div class="contentPageTitleDiv">
		<h1>{$title}</h1>
	</div>
	<div class="contentPageIntro">
		{$html}
	</div>
		
		<ul>
		{foreach name=siteTree from=$treeItems item=curr_item_1 key=key_1}
		{if ($curr_item_1.me) && ($curr_item_1.me.visible==1)}
			<li>
				<a href="{if $curr_item_1.me.link=='#'}{$curr_item_1.0.me.link}{else}{$curr_item_1.me.link}{/if}">
	    			{$curr_item_1.me.treeItemName}
	    		</a>
	    		{if (count($curr_item_1) > 1)}
					<ul>
	    			{foreach name=menuSecondLevel from=$curr_item_1 item=curr_item_2 key=key_2}
	    			{if ($curr_item_2.me) && ($curr_item_2.me.visible==1)}
	    			<li>
	    				<a href="{$curr_item_2.me.link}">{$curr_item_2.me.treeItemName}</a>
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