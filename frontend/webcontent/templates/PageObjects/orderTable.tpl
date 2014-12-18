{if $basket.itemsCount > 0}
<div id="shoppingbag-table">
<table class="shopping-bag-items">
    <thead>
    <tr>
        <td style="width: 210px; text-align:left; padding-left: 17px;">{webtext keyword='basketTableItemDescription' value='Item description' remark='Shopping bag page'}</td>
        <td style="width: 50px;">{webtext keyword='basketTableSize' value='Size' remark='Shopping bag page'}</td>
        <td style="width: 85px;">{webtext keyword='basketTablePrice' value='Price' remark='Shopping bag page'}</td>
        <td style="width: 100px;">{webtext keyword='basketTableQTY' value='QTY' remark='Shopping bag page'}</td>
        <td style="width: 85px;">{webtext keyword='basketTableTotal' value='Total' remark='Shopping bag page'}</td>
    </tr>
    </thead>
    <tbody>
    {foreach item=item from=$basket.items}
        <tr {if $item.product.visible eq 0} class="sb-product-not-for-sale" {/if}>
            <td>
                <img src="{$item.photos[0].imageSmall}" class="sb-product-photo">
                <div class="sb-product-info">
                    <div class="sb-product-title">{$item.product.title}</div>
                    <div class="sb-product-color">{$item.product.color}</div>
                    <div class="sb-product-color">{$item.product.itemNumber}</div>
                    <a href="{$item.product.url}" class="sb-product-edit">Edit</a>
                </div>
            </td>
            <td>{$item.product.size}</td>
            <td>{price_format price = $item.pricePerProduct}</td>
            <td>{$item.quantity}</td>
            <td>{price_format price = $item.amount}</td>
        </tr>
    {/foreach}
    </tbody>
</table>
<div class="sb-footer">
    <div class="sb-subtotal">
        <span>{webtext keyword='basketSubTotalLabel' value='Sub-total (incl. BTW):' remark='Shopping bag page'}</span>
        <ins>{price_format price = $basket.totalPrice}</ins>
    </div>
    <div class="sb-delivery">
        <span>{webtext keyword='basketDeliveryLabel' value='Delivery:' remark='Shopping bag page'}</span>
        <ins>{price_format price = $deliveryPrice}</ins>
    </div>
    <div class="sb-total">
        <span>{webtext keyword='basketTotalLabel' value='Total (incl. BTW):' remark='Shopping bag page'}</span>
        <ins>{price_format price = $totalSum}</ins>
    </div>
</div>
<div class="clear"></div>
</div>
{/if}