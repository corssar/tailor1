{literal}
<script type="text/javascript">
	function shiftleft()
	{
		//$('#lGameBlock').animate({width:0,padding:0},"slow");
		$('#wGameBlock').animate({left:"-350px"},"slow");
		$('#lGameTitle').attr("class","");
		$('#rGameTitle').attr("class","futureGamesTitleActive");
	}
	function shiftright()
	{
		//$('#lGameBlock').animate({width:'+=340px',padding:"0 5px"},"slow");
		$('#wGameBlock').animate({left:"0px"},"slow");
		$('#lGameTitle').attr("class","lastGamesTitleActive");
		$('#rGameTitle').attr("class","");
	}
</script>
{/literal}
{if count($lastGames)>0 or count($futureGames)>0}
	<div class="miniPageBlock">
		<h2 class="games">
		{if count($lastGames)>0 && !count($futureGames)}
			<a id="lGameTitle" href="#" onclick="return false;" style="color:#FFFFFF;">{$webtext_lastGames}{*Минулі ігри*}</a>
		{elseif count($lastGames)>0}
			<a id="lGameTitle" href="#" class="lastGamesTitleActive" onclick="shiftright(); return false;">{$webtext_lastGames}{*Минулі ігри*}</a>
		{/if}
		{if count($futureGames)>0 && !count($lastGames)}
			<a id="rGameTitle" href="#" onclick="return false;" style="color:#FFFFFF;">{$webtext_futureGames}{*Майбутні ігри*}</a>
		{elseif count($futureGames)>0}
			<a id="rGameTitle" href="#" onclick="shiftleft(); return false;">{$webtext_futureGames}{*Майбутні ігри*}</a>
		{/if}
		</h2>
		<div class="wGameBlockHolder">
			<div id="wGameBlock" class="rightWideBlockBody">
				<div id="lGameBlock" class="rightBlockBody">
					{foreach key=id item=lastGame from=$lastGames}
					<div class="rightBlockBodyRow">
						<div class="rightBlockteamTitle"><a href="{$lastGame.TeamNameUrl1}">{$lastGame.TeamName1}</a></div>
						<div class="rightBlockMatchDateScore"><a href="#">{$lastGame.TeamScore1}:{$lastGame.TeamScore2}</a></div>
						<div class="rightBlockteamTitle"><a href="{$lastGame.TeamNameUrl2}">{$lastGame.TeamName2}</a></div>
					</div>
					{/foreach}
				</div>
				<div id="rGameBlock" class="rightBlockBody">
					{foreach key=id item=futureGame from=$futureGames}
					<div class="rightBlockBodyRow">
						<div class="rightBlockteamTitle"><a href="{$futureGame.TeamNameUrl1}">{$futureGame.TeamName1}</a></div>
						<div class="rightBlockMatchDate">
							<a href="#">
							{if $futureGame.date|date_format:"%H" != '00' }
								{$futureGame.date|date_format:"%d.%m.%Y %H:%M"}
							{else}
								{$futureGame.date|date_format:"%d.%m.%Y"}
							{/if}
							</a>
						</div>
						<div class="rightBlockteamTitle"><a href="{$futureGame.TeamNameUrl2}">{$futureGame.TeamName2}</a></div>
					</div>
					{/foreach}
				</div>
			</div>
		</div>
		<div class="rightBlockBottom">
			<a class="gamesCalendarLink" href="{$calendarUrl}">{$webtext_gamesCalendar}{*календар ігор*}</a>
		</div>
	</div>
{/if}
<!--{if count($futureGames)>0}
	<div class="miniPageBlock">
		<h2>{$webtext_futureGames}{*Майбутні ігри*}</h2>
		<div class="rightBlockBody">
			{foreach key=id item=futureGame from=$futureGames}
			<div class="rightBlockBodyRow">
				<div class="rightBlockteamTitle"><a href="{$futureGame.TeamNameUrl1}">{$futureGame.TeamName1}</a></div>
				<div class="rightBlockMatchDate">
					<a href="#">
					{if $futureGame.date|date_format:"%H" != '00' }
						{$futureGame.date|date_format:"%d.%m.%Y %H:%M"}
					{else}
						{$futureGame.date|date_format:"%d.%m.%Y"}
					{/if}
					</a>
				</div>
				<div class="rightBlockteamTitle"><a href="{$futureGame.TeamNameUrl2}">{$futureGame.TeamName2}</a></div>
			</div>
			{/foreach}
		</div>
		<div class="rightBlockBottom">
			<a class="gamesCalendarLink" href="#">{$webtext_gamesCalendar}{*календар ігор*}</a>
		</div>
	</div>
{/if}-->