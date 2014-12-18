<div class="rightBlockItem" style="background-color:#FFF;">
	<h2>{$title}</h2>
	<div style="float:left;">
		<p id="player{$videoId}">
			<a href=http://www.adobe.com/go/getflashplayer>
				<img src=http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif alt="Get Adobe Flash player" />
			</a>
		</p>
	</div>
	{if $videoItems|@count > 1}
	<div id="videolist{$videoId}" style="float:left;border:1px solid #A8A8A8;border-top:none;">
		{foreach key=id item=video from=$videoItems}
			{if fmod($id+1,2) != 0}
				<a class="videoListRow" onclick="loadvideo('{$video.file}', '{$video.bigimage}')" title="{$video.altText}" style="cursor: pointer">
			{else}
				<a class="videoListRowRed" onclick="loadvideo('{$video.file}', '{$video.bigimage}')" title="{$video.altText}" style="cursor: pointer">			
			{/if}
					{$video.title}
				</a>
			{assign var="linki" value=$linki+1}
		{/foreach}
	</div>
	{/if}
	<script type="text/javascript">
	{literal}
		var flashvars = {};
	{/literal}
		flashvars.height = "{$playerheight}";
		flashvars.width = "{$playerwidth}";
		flashvars.file = "{$firstVideo}";
		flashvars.image = "{$firstImage}";
		flashvars.repeat = "true";
	{literal}
		var params = {};
		params.allowscriptaccess = "always"
		params.allowfullscreen =  "true";
		var attributes = {};
	{/literal}
		swfobject.embedSWF("{$playercod}", "player{$videoId}", "{$playerwidth}", "{$playerheight}", "9.0.0", "expressInstall.swf", flashvars, params, attributes);
	{literal}
		function loadvideo(url, picture)
		{
			var obj = {file:url,image:picture};
			swfobject.getObjectById('player{/literal}{$videoId}{literal}').sendEvent("LOAD",obj);
		}
	{/literal}
	</script>
	<div class="offset"></div>
</div>