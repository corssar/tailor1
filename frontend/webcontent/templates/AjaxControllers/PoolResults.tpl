<div class="rightBlockBody">
	<div class="voteTitle"><span id="question_{$poolId}"></span></div>
	<div id="poolItems{$poolId}" class="votePool">
		<div class="pool_answer_div">		
		{foreach key=id item=port from=$aPoolList}
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