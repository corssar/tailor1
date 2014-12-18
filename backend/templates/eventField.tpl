
<select name='customField[eventId]' id="eventId" onchange="javascript:showEventMasks();">
    {foreach name=events from=$events item=event}
        <option {if $event.id eq $selected}selected="selected"{/if} value="{$event.id}">{$event.name}</option>
    {/foreach}
</select>

<div class="maskPopUp">
    {foreach name=events from=$events item=event}
        <div class="maskList" id="eventMask{$event.id}">
            <fieldset>
                <legend>{$webtext_BE_event_title}{* Групи автозамін *}</legend>
                {foreach name=masks from=$event.masks item=maskGroup}
                    <h4>{$maskGroup.groupName}: </h4>
                    {foreach key=key name=fields from=$maskGroup.groupFields item=field}
                        <a class="event-mask-btn" onclick="setMask('{$key}');" title="{$field}"><span>{$key}</span></a>
                    {/foreach}
                {/foreach}
            </fieldset>
        </div>
    {/foreach}
</div>

<input type="hidden" name="customField[posted]" value="1" />