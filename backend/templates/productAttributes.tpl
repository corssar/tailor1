<div id="productAttributes">
    {foreach item=attribute name="attributes" from=$attributes}
    <div style="float: left; width: 200px;">
        <span style="color: red;">{$attribute.attributeTitle}</span>
        <input type="hidden" id="attribute{$attribute.attributeId}" class="attributeId" value="{$attribute.attributeId}" />
        {foreach item=attributeItem name="attributeItems" from=$attribute.attributeItems}
            <div>
                <input type="checkbox" value="{$attributeItem.attributeItemId}" id="attribute{$attribute.attributeId}item{$attributeItem.attributeItemId}"/>
                <label for="attribute{$attribute.attributeId}item{$attributeItem.attributeItemId}" style="cursor: pointer;font-size: 12px;">{$attributeItem.attributeItemTitle}</label>
            </div>
        {/foreach}
    </div>
    {/foreach}
    <input type="button" value="Generate!" onclick="generateProductVariations('{$variationsListFieldId}','{$productViewId}');" class="button" />
    <div id="genVariationsContainer" style="display:none"></div>
</div>
