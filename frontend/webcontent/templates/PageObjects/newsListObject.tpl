<div class="homePageBlock">
	<h2>{$title}</h2>
	<div class="mainBlockBody">
	{foreach key=id item=news from=$news_list}
		<div class="newsBlockRow">
		{if strlen($news.image)>0}
			<div class="newImage">
					<img alt="" src="{$news.image}" width="105px" height="65px" />
			</div>
			<a href="{$news.URL}">
				<div class="serviceImgHolder">
					<div class="serviceImgBorder">
					</div>
				</div>
			</a>
			<div class="newRightPart">
		{else}
			<div class="newRightPart" style="width: 550px;">
		{/if}
				<a href="{$news.URL}">
					<div class="newTitle"><span>{$news.title}</span></div>
				</a>
				<div class="newDescription"><span>{$news.shortDescription}</span></div>
				<div class="newDate"><span>{$news.date|date_format:"%d"} {$news.monthTitle} {$news.date|date_format:"%Y, %H:%M"}</span></div>
			</div>
		</div>
	{/foreach}
	<div class="mainBlockBottomButton"><a class="allNewsLink" href="{$newsListUrl}">{$webtext_allNewsText}{*всі новини*}</a></div>
	</div>
	<div class="mainBlockBottom"></div>
</div>