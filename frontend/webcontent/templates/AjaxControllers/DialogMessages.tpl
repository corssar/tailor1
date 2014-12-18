<div style="float:left;width:100%;height:400px;overflow-y:scroll;">1
	<div style="float:left;width:94%;margin:0 15px;">
	{foreach item=mesaga from=$messages}
		{if $mesaga.senderId != $interlocutorId}
			<h3 style="border-top:1px solid #A8A8A8;padding-top:5px;margin-top:10px;color:#A8A8A8;">{$mesaga.name} {$mesaga.surname}<span style="float:right;font-size:11px;color:#000;">{$mesaga.date}</span></h3>
		{else}
			<h3 style="border-top:1px solid #A8A8A8;padding-top:5px;margin-top:10px;color:#E31D24;">{$mesaga.name} {$mesaga.surname}<span style="float:right;font-size:11px;color:#000;">{$mesaga.date}</span></h3>
		{/if}
		<div>{$mesaga.message}</div>
	{/foreach}
	
	<form action="#" onsubmit="personalArea.sendMessage(this); return false;" style="border-top:1px solid #A8A8A8;float:left;margin-top:20px;padding-top:20px;width:100%;">
		<input type="hidden" name="interlocutor" value="{$interlocutorId}">
		<p>{$webtext_enterMessText}{*¬ведите текст сообщени€*}:</p>
		<textarea style="border:1px solid #A8A8A8;" rows="4" cols="55" name="message"></textarea>
		<input value="" type="submit" class="sendMessage">
    </form>
    </div>
</div>