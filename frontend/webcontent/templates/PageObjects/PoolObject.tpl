<div class="miniPageBlock">
	<h2>{$title}</h2>
	<div class="contentCenter">
		<div id="poolItems{$poolId}">
		{if !$voted}
		<form name="pool_answer_{$poolId}" id="pool_answer_{$poolId}" action="{$ajaxHandler}?handler=PoolAjaxController&action=voting" method="post">
		<div class="rightBlockBody">
			<div class="voteTitle"><span>{$question}</span></div>
			<div class="votePool">
				<div id="pool_answer_div_{$poolId}">
<!--							<ul style="padding:0 0 10px 5px;">-->
					{foreach name=pools key=id item=port from=$poolItems}
<!--								<li style="padding:3px 5px 3px 0;color:#000000;">-->
						<div class="votePoolRow">
							<input type="radio" name="voteitem" value="{$port.answerId}" onchange="document.getElementById('sendreport{$poolId}').disabled=false" style="margin:0 3px 0 0;">{$port.answer}
						</div>
<!--								</li>-->
					{/foreach}
<!--							</ul>-->
				</div>
			</div>
		</div>
		<div class="rightBlockBottom">
			<input name="poolId" value="{$poolId}" type="hidden">
			<input id="sendreport{$poolId}" disabled type="submit" value="" style="display:none;">
			<a href="#" class="voteLink" onclick="document.getElementById('sendreport{$poolId}').click(); return false;" >{$webtext_toVote}{*голосувати*}</a>
		</div>
		</form>
		{else}
			<div class="rightBlockBody">
			<div class="voteTitle"><span>{$question}</span></div>
				<div id="poolItems{$poolId}" class="votePool">
			<div class="pool_answer_div">		
			{foreach key=id item=port from=$poolItems}
				<div class="pool_answer_item">
					<div class="poolanswer">{$port.answer}</div>
					<div class="poolprogres">
						<div class="poolpercent" style="width:{$port.roundpercent}px;"></div>
					</div>
					<div class="poolpercenttext">{$port.pools}&nbsp;({$port.percent}%)</div>
				</div>
			{/foreach}
				<div class="poolsub">
					{$webtext_pool_total}{*Всього проголосувало*} : {$pooltotal}
				</div>
			</div>
			</div>
			</div>
			<div class="rightBlockBottom"> </div>
		{/if}
		</div>
			
	</div>
</div>

<script type="text/javascript">
	{literal}
	var	question = '{/literal}{$question}{literal}';
	function successVote(obj)
	{
		$('#poolItems'+obj.poolId).html(obj.html);
		$('#question_'+obj.poolId).html(question);
	}
	$(document).ready(function(){
			$('#pool_answer_{/literal}{$poolId}{literal}').ajaxForm({success:successVote,dataType:'json'});
		}
	);
	{/literal}
</script>