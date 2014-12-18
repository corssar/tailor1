<div id="flashobjcontainer{$objectid}" style="float:left;width:{$width}px;height:{$height}px;">
	<div style="float: left" id="pflashobjcontainer{$objectid}">
		<a href=http://www.adobe.com/go/getflashplayer>
			<img src=http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif alt="Get Adobe Flash player" />
		</a>
	</div>
</div>
{literal}
<script type="text/javascript">
			var flashobjcontainer = "";
			if (navigator.userAgent.indexOf('MSIE 6')>0)
			{
{/literal}
				flashobjcontainer = 'pflashobjcontainer{$objectid}';
{literal}
			}
			else
			{
{/literal}
				flashobjcontainer = 'flashobjcontainer{$objectid}';
				document.getElementById('flashobjcontainer{$objectid}').innerHTML = document.getElementById('pflashobjcontainer{$objectid}').innerHTML;
{literal}
			}
			var flashvars = {};
			
			flashvars.xmlFile = "{/literal}{$xmlfile}{literal}";
			/*flashvars.refreshTimer = 30;*/
			{/literal}
			{if $bgcolor!='null' && $bgcolor!=''}
				{literal}
				var params = {bgcolor:"#{/literal}{$bgcolor}"{literal},wmode:"opaque"};
				{/literal}
			{/if}
			{literal}
			var attributes = {};
			swfobject.embedSWF(	"{/literal}{$swffile}{literal}", 
								flashobjcontainer, 
								"{/literal}{$width}{literal}", 
								"{/literal}{$height}{literal}", 
								"{/literal}{$version}{literal}", 
								false, flashvars, params, attributes);
</script>
{/literal}