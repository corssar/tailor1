<div class="centralBox">
	<div class="centralHeadBox">
		<h1>
			{$title}
		</h1>
		<div id="photoContainer">
			{$html}
			{foreach key=id item=photo from=$photos}
				{if fmod($id+1,4) == 0}
				<div class="photoItemContainer" style="margin-right:0;">
				{else}
				<div class="photoItemContainer">
				{/if}
					<a href="{$photo.image}">
						<img src="{$photo.imageSmall}" alt="{$photo.description}" />
					</a>
				</div>
			{/foreach}
		</div>
	</div>
</div>
{literal}
<script>
	$(document).ready(function()
	{
	    $('#photoContainer a').lightBox();
	});
</script>
{/literal}