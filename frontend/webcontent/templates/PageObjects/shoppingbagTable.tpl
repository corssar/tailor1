{if $basket.itemsCount > 0}
    <div id="shoppingbag-table">
        <table class="shopping-bag-items">
            <thead>
            <tr>
                <td style="width: 210px; text-align:left; padding-left: 17px;">{webtext keyword='basketTableProductDescription' value='Описание' remark='Shopping bag page'}</td>
                <td style="width: 85px;">{webtext keyword='basketTableProductBrend' value='Бренд' remark='Shopping bag page'}</td>
                <td style="width: 85px;">{webtext keyword='basketTableProductPrice' value='Цена' remark='Shopping bag page'}</td>
                <td style="width: 100px;">{webtext keyword='basketTableProductQTY' value='Количество' remark='Shopping bag page'}</td>
                <td style="width: 40px;">{webtext keyword='basketTableProductDelete' value='Удалить' remark='Shopping bag page'}</td>
                <td style="width: 85px;">{webtext keyword='basketTableProductTotal' value='Итого' remark='Shopping bag page'}</td>
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
                    <td>Brand</td>
                    <td>{price_format price = $item.pricePerProduct}</td>
                    <td>
                        <div class="quantity-minus" onclick="ShoppingBag.minusQty({$item.id})"></div>
                        <input type="text" onchange="ShoppingBag.changeQty({$item.id})" value="{$item.quantity}"
                               class="input sb-quantity-input sb-quantity-{$item.id}" style="width: 35px;text-align: center;">

                        <div class="quantity-plus" onclick="ShoppingBag.plusQty({$item.id})"></div>
                    </td>
                    <td>
                        <a href="#"
                           onclick="ShoppingBag.removeItem({$item.id}); return false;">{webtext keyword='basketItemRemoveTitle' value='Remove' remark='Shopping bag page'}</a>
                    </td>
                    <td>{price_format price = $item.amount}</td>
                </tr>
            {/foreach}
            </tbody>
        </table>
        <div class="sb-footer">
            <div class="sb-subtotal">
                <span>{webtext keyword='basketSubPoductTotalLabel' value='Цена товаров:' remark='Shopping bag page'}</span>
                <ins>{price_format price = $basket.totalPrice}</ins>
            </div>
            <div class="sb-delivery">
                <span>{webtext keyword='basketDeliveryPoductLabel' value='Доставка:' remark='Shopping bag page'}</span>
                <ins>{price_format price = $deliveryPrice}</ins>
            </div>
            <div class="sb-promotional">
                <span>{webtext keyword='basketPromotionalPoductLabel' value='Промо-код:' remark='Shopping bag page'}</span>
                <ins><input type="text" value="" id="promotional-cod" class="input"></ins>
            </div>
            <div class="sb-total">
                <span>{webtext keyword='basketTotalPoductLabel' value='Всего:' remark='Shopping bag page'}</span>
                <ins>{price_format price = $totalSum}</ins>
            </div>
        </div>
        <div class="clear"></div>
        <div id="shopping-table-loader" class="modal">
            <div class="loader"></div>
        </div>
    </div>
{else}
    <div>{webtext keyword='ShoppingBagEmptyText' value='No items in your basket' remark='Shopping bag page'}</div>
{/if}