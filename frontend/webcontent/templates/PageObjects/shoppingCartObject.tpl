{*<div class="shopping-cart-box">
    <a href="{$shoppingbagUrl}" class="shopping-cart-link">
        <i></i>
        {$cartTitle}
        <span class="products-amount-label">{$productsAmount}</span>
    </a>
    <div class="shopping-cart-popup displayNone shadow">
        <div class="popup-arrow"></div>
        <div class="shopping-cart-content">
            <div class="shopping-cart-header">
                {webtext keyword="shopping-cart-new-product-added" value="NEW PRODUCT ADDED" remark="Shopping cart popup header text"}
            </div>
            <img class="shopping-cart-product-photo" src="#" alt="">
            <div class="shopping-cart-info">
                <div class="shopping-cart-product-title"></div>
                <div class="shopping-cart-product-title">
                    <span>{webtext keyword="shopping-cart-product-title" value="Size: " remark="Shopping cart popup text for size label"}</span>
                    <ins></ins>
                </div>
                <div class="shopping-cart-product-price">
                    <span>{webtext keyword="shopping-cart-product-price" value="Color: " remark="Shopping cart popup text for color label"}</span>
                    <div class="product_color shadow">
                        <div class="color" style="" title=""></div>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
            <div class="shopping-cart-button">
                <a class="primary-button shadow" href="{$shoppingbagUrl}">
                    {webtext keyword="shopping-cart-proceed-to-checkout" value="PROCEED TO CHECKOUT" remark="Shopping cart popup checkout button text"}
                </a>
            </div>
        </div>
    </div>
</div>*}


<div id="tinyBask" onclick="Basket.show();" class="shopping-cart-box">
    <div class="btn-bask {if $productsAmount} pointer{/if}">
        <button class="shopping-cart-link">
            <span class="frame-icon">
                <span class="helper"></span>
                <span class="icon_cleaner">
                    <svg height="25" version="1.1" width="28" xmlns="http://www.w3.org/2000/svg"
                         style="overflow: hidden; position: relative; left: -0.5px;top: 5px;">
                        <desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with Rapha?l 2.1.0</desc>
                        <defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs>
                        <path fill="#999999" stroke="none"
                              d="M29.02,11.754L8.416,9.473L7.16,4.716C7.071,4.389,6.772,4.158,6.433,4.158H3.341C3.114,3.866,2.775,3.667,2.377,3.667C1.6909999999999998,3.667,1.1349999999999998,4.223,1.1349999999999998,4.909C1.1349999999999998,5.595,1.6909999999999998,6.151,2.377,6.151C2.776,6.151,3.1149999999999998,5.95,3.3419999999999996,5.6579999999999995H5.853999999999999L11.084,25.458C10.536,26.046999999999997,10.193,26.831,10.193,27.7C10.193,29.521,11.666,30.993,13.486,30.993C15.306000000000001,30.993,16.78,29.520999999999997,16.783,27.7C16.783,27.442999999999998,16.747,27.195999999999998,16.69,26.957H22.223000000000003C22.167,27.196,22.131000000000004,27.443,22.131000000000004,27.7C22.131000000000004,29.521,23.606000000000005,30.993,25.426000000000002,30.993S28.721000000000004,29.520999999999997,28.721000000000004,27.7C28.721000000000004,25.88,27.248000000000005,24.405,25.426000000000002,24.403C24.475,24.404,23.625000000000004,24.811999999999998,23.024,25.456H15.888000000000002C15.287000000000003,24.812,14.437000000000001,24.404,13.486,24.403C13.107000000000001,24.403,12.748000000000001,24.480999999999998,12.409,24.599L12.228000000000002,23.914H26.81C27.967,23.887,28.948,23.084000000000003,29.201,21.955000000000002L30.775000000000002,14.156000000000002C30.803,14.011000000000003,30.816000000000003,13.874000000000002,30.814000000000004,13.742000000000003C30.823,12.733,30.051,11.86,29.02,11.754ZM25.428,27.994C25.265,27.994,25.133,27.862,25.131,27.698999999999998C25.133,27.534,25.265,27.401999999999997,25.428,27.401999999999997S25.723000000000003,27.534,25.725,27.698999999999998C25.723,27.862,25.591,27.994,25.428,27.994ZM27.208,20.499L28.156,19.551L27.837999999999997,21.128999999999998L27.208,20.499ZM12.755,11.463L13.791,12.498999999999999L12.499,13.790999999999999L11.207,12.498999999999999L12.294,11.411999999999999L12.755,11.463ZM17.253,11.961L17.791,12.499L16.499,13.791L15.206999999999999,12.499L15.895,11.811L17.253,11.961ZM9.631,14.075L10.499,13.206999999999999L11.791,14.498999999999999L10.499,15.790999999999999L9.935,15.226999999999999L9.631,14.075ZM9.335,12.956L9.007000000000001,11.716L9.792,12.5L9.335,12.956ZM21.791,16.499L20.499,17.791L19.206999999999997,16.499L20.499,15.206999999999999L21.791,16.499ZM21.207,14.5L22.499000000000002,13.208L23.791000000000004,14.5L22.499000000000002,15.792L21.207,14.5ZM18.5,15.791L17.207,14.499L18.499000000000002,13.207L19.791000000000004,14.499L18.5,15.791ZM17.791,16.499L16.5,17.791L15.208,16.499L16.5,15.206999999999999L17.791,16.499ZM14.499,15.791L13.207,14.499L14.499,13.207L15.791,14.499L14.499,15.791ZM13.791,16.499L12.499,17.79L11.207,16.499L12.499,15.206999999999999L13.791,16.499ZM10.499,17.207L11.791,18.499000000000002L11.006,19.283L10.466000000000001,17.239L10.499,17.207ZM11.302,20.404L12.498999999999999,19.207L13.790999999999999,20.499000000000002L12.5,21.791L11.369,20.661L11.302,20.404ZM13.208,18.499L14.499,17.206999999999997L15.791,18.499L14.5,19.791L13.208,18.499ZM16.5,19.207L17.792,20.499000000000002L16.5,21.79L15.208,20.499L16.5,19.207ZM17.208,18.499L18.5,17.206999999999997L19.791,18.499L18.5,19.79L17.208,18.499ZM20.499,19.207L21.791,20.499000000000002L20.5,21.79L19.208,20.497999999999998L20.499,19.207ZM21.207,18.499L22.499000000000002,17.206999999999997L23.791000000000004,18.499L22.499000000000002,19.791L21.207,18.499ZM23.207,16.499L24.499000000000002,15.206999999999999L25.791000000000004,16.499L24.499000000000002,17.791L23.207,16.499ZM25.207,14.499L26.499000000000002,13.207L27.79,14.5L26.499,15.792L25.207,14.499ZM24.499,13.792L23.343,12.636L25.425,12.866L24.499,13.792ZM21.791,12.5L20.499,13.792L19.207,12.5L19.497,12.21L21.75,12.46L21.791,12.5ZM14.5,11.791L14.348,11.639000000000001L14.621,11.669L14.5,11.791ZM10.5,11.792L9.85,11.142L11.020999999999999,11.270999999999999L10.5,11.792ZM14.5,21.207L15.705,22.412H13.296L14.5,21.207ZM18.499,21.207L19.705,22.413H17.293L18.499,21.207ZM22.499,21.207L23.706999999999997,22.414L21.292999999999996,22.413L22.499,21.207ZM23.207,20.499L24.499000000000002,19.206999999999997L25.791000000000004,20.499L24.499000000000002,21.791L23.207,20.499ZM25.207,18.499L26.499000000000002,17.208L27.790000000000003,18.499L26.499000000000002,19.791L25.207,18.499ZM28.499,17.791L27.208,16.499L28.499,15.207999999999998L28.942999999999998,15.652L28.514,17.776L28.499,17.791ZM29.001,13.289L28.499000000000002,13.791L27.841,13.133000000000001L28.857,13.245000000000001C28.911,13.253,28.956,13.271,29.001,13.289ZM13.487,27.994C13.326,27.994,13.192,27.862,13.192,27.698999999999998C13.192,27.534,13.326,27.401999999999997,13.487,27.401999999999997C13.65,27.401999999999997,13.783,27.534,13.783,27.698999999999998C13.783,27.862,13.651,27.994,13.487,27.994ZM26.81,22.414H25.293L26.5,21.207L27.43,22.137C27.243,22.306,27.007,22.428,26.81,22.414Z"
                              transform="matrix(0.9097,0,0,0.9097,-1.2871,-2.9842)" stroke-width="1.0992296295430926"
                              style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
                    </svg>
                </span>
            </span>
            <span class="text-cleaner">
                <span class="helper"></span>
                <span>
                    {if $productsAmount}
                        <span class="text-el">{$productsAmount} </span>
                        <span class="text-el">{webtext keyword="shopping-cart-product_count" value="товар " remark=""}</span>
                        <span class="divider text-el">{webtext keyword="shopping-cart-product_icon" value=" • " remark=""}</span>
                    <span class="d_i-b">
                        <span class="text-el">180.70</span>
                        <span class="text-el">&nbsp;<span class="curr">{webtext keyword="shopping-cart-product_symbol" value="руб" remark=""}</span></span>
                    </span>
                    {else}
                        <span class="text-el">{webtext keyword="shopping-cart-is_empty" value="Корзина пуста" remark=""}</span>
                    {/if}
                </span>
            </span>
        </button>

{*        <div class="shopping-cart-popup displayNone shadow">
            <div class="popup-arrow"></div>
            <div class="shopping-cart-content">
                <div class="shopping-cart-header">
                    {webtext keyword="shopping-cart-new-product-added" value="NEW PRODUCT ADDED" remark="Shopping cart popup header text"}
                </div>
                <img class="shopping-cart-product-photo" src="#" alt="">

                <div class="shopping-cart-info">
                    <div class="shopping-cart-product-title"></div>
                    <div class="shopping-cart-product-title">
                        <span>{webtext keyword="shopping-cart-product-title" value="Size: " remark="Shopping cart popup text for size label"}</span>
                        <ins></ins>
                    </div>
                    <div class="shopping-cart-product-price">
                        <span>{webtext keyword="shopping-cart-product-price" value="Color: " remark="Shopping cart popup text for color label"}</span>

                        <div class="product_color shadow">
                            <div class="color" style="" title=""></div>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="shopping-cart-button">
                    <a class="primary-button shadow" href="{$shoppingbagUrl}">
                        {webtext keyword="shopping-cart-proceed-to-checkout" value="PROCEED TO CHECKOUT" remark="Shopping cart popup checkout button text"}
                    </a>
                </div>
            </div>

        </div>
        *}
    </div>
</div>
{if $basket.itemsCount > 0}
<div id="popup-shoppingbag-table" class="hidden drop-style">
        <button class="icon_times_drop" type="button" style="margin-top: 0px; margin-left: 0px; position: relative;"><svg height="10" version="1.1" width="10" xmlns="http://www.w3.org/2000/svg" style="overflow: hidden; position: relative;"><desc>Created with Rapha?l 2.1.0</desc><defs/><path style="" fill="#ffffff" stroke="none" d="M24.778,21.419L19.276,15.917L24.777,10.415L21.949,7.585L16.447,13.087L10.945,7.585L8.117,10.415L13.618,15.917L8.116,21.419L10.946,24.248L16.447,18.746L21.948,24.248Z" transform="matrix(0.5402,0,0,0.5402,-3.2399,-3.4838)" stroke-width="1.8513333333333333"/></svg></button>
        <div class="drop-header">
            {foreach item=item from=$basket.items}
                <div class="title bask">
                    <span>{webtext keyword='basketItemTitleLabel' value='В корзине' remark='Shopping bag page'}</span>
                    <span class="topCartCount">{$productsAmount}</span>
                    <span class="plurProd">{webtext keyword="shopping-cart-product_count" value="товар " remark=""}</span>
                    <span>{webtext keyword='basketItemTitleLabel2' value='Сумма' remark='Shopping bag page'}</span>
                    <span class="topCartTotalPrice">{price_format price = $item.pricePerProduct}</span>
                    <span class="curr">{webtext keyword="shopping-cart-product_symbol" value="руб" remark=""}</span>
                </div>
        </div>
        <div class="drop-content">
        <table class="shopping-bag-items">
        <tbody>
            <tr {if $item.product.visible eq 0} class="sb-product-not-for-sale" {/if}>
                <td class="frame-remove-bask-btn"><a class="icon-remove" href="#" onclick="ShoppingBag.removeItem({$item.id}); return false;"><svg height="9" version="1.1" width="9" xmlns="http://www.w3.org/2000/svg" style="overflow: hidden; position: relative;"><desc>Created with Rapha?l 2.1.0</desc><defs/><path style="" fill="#999999" stroke="none" d="M24.778,21.419L19.276,15.917L24.777,10.415L21.949,7.585L16.447,13.087L10.945,7.585L8.117,10.415L13.618,15.917L8.116,21.419L10.946,24.248L16.447,18.746L21.948,24.248Z" transform="matrix(0.4801,0,0,0.4801,-2.4929,-3.7289)" stroke-width="2.08275"/></svg></a></td>
                <td class="frame-items">
                    <a class="frame-photo-title" title="Мобильный телефон Fly DS106 Dual Sim Black" href="http://demoshop.imagecms.net/shop/product/mobilnyi-telefon-fly-ds106-dual-sim-black">
                        <span class="photo-block">
                            <img alt="{$item.product.title}" src="{$item.photos[0].imageSmall}">
                        </span>
                        <span class="title">Мобильный телефон Fly DS106 Dual Sim Black</span>
                    </a>
                    <div class="description">
                        <span class="code">(200212)</span>
                    </div>
                </td>
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
                <td>
                    {if $item.inStock}
                    {webtext keyword='basketTableInStock' value='In stock' remark='Shopping bag page'}
                {else}
                    {webtext keyword='basketTableOutStock' value='Out stock' remark='Shopping bag page'}
                {/if}
                </td>
                <td>{price_format price = $item.pricePerProduct}</td>
                <td>
                    <div class="quantity-minus" onclick="ShoppingBag.minusQty({$item.id})"></div>
                    <input type="text" onchange="ShoppingBag.changeQty({$item.id})" value="{$item.quantity}" class="input sb-quantity-input sb-quantity-{$item.id}" >
                    <div class="quantity-plus"  onclick="ShoppingBag.plusQty({$item.id})"></div></td>
                <td>{price_format price = $item.amount}</td>
            </tr>
            {/foreach}
        </tbody>
    </table>
    </div>
    <div class="sb-footer">
        <div class="sb-subtotal">
            <span>{webtext keyword='basketSubTotalLabel' value='Sub-total (incl. BTW):' remark='Shopping bag page'}</span>
            <ins>{price_format price = $basket.totalPrice}</ins>
        </div>
        <div class="sb-delivery">
            <span>{webtext keyword='basketDeliveryLabel' value='Delivery:' remark='Shopping bag page'}</span>
            <ins>{price_format price = $deliveryPrice}</ins>
        </div>
        <div class="sb-promotional">
            <span>{webtext keyword='basketPromotionalLabel' value='Promotional code:' remark='Shopping bag page'}</span>
            <ins><input type="text" value="" id="promotional-cod" class="input"></ins>
        </div>
        <div class="sb-total">
            <span>{webtext keyword='basketTotalLabel' value='Total (incl. BTW):' remark='Shopping bag page'}</span>
            <ins>{price_format price = $totalSum}</ins>
        </div>
    </div>
    <div class="clear"></div>
    <div id="shopping-table-loader" class="modal"><div class="loader"></div></div>
</div>
    {*{else}*}
{*<div>{webtext keyword='ShoppingBagEmptyText' value='No items in your basket' remark='Shopping bag page'}</div>*}
<div id="opaco" class="hidden"></div>
{/if}
    {literal}
    <script>
        var Basket = {
            timerId: null,
            alertTime: 3000, /* 3 seconds */
            $cart: $('.shopping-cart-popup'),
            amount: 0,
            $amount: $('.products-amount-label'),
            $productPhoto: $('.shopping-cart-product-photo'),
            $productTitle: $('.shopping-cart-product-title'),
            $productSize: $('.shopping-cart-product-title ins'),
            $productColor: $('.shopping-cart-product-price .color'),


            init: function (amount) {
                var base = this;
                base.amount = amount || 0;

                base.$cart.on('mouseover', function () {
                    clearTimeout(Basket.timerId);
                });

                base.$cart.on('mouseleave', function () {
                    base.$cart.fadeOut();
                });
            },

            show: function () {
                var base = this;

                console.log(base);

                base.$productPhoto.attr('src', $('#product_item_photo').attr('src'));
                base.$productTitle.html($('#request_product_name').text());
                base.$productSize.html($("#size_product").val());

                base.$productColor.attr('style', $('.product_color_check .selected_color').attr('style'));
                base.$productColor.attr($('.product_color_check .selected_color').attr('title'));

                base.$cart.fadeIn();
                base.timerId = setTimeout(function () {
                    base.$cart.fadeOut();
                }, base.alertTime);
            },

            add: function (btn) {
                var base = this;
                /** disable button during sending ajax */
                var $btn = $(btn);
                if ($btn.attr('disabled') == 'disabled') return;

                $btn.attr('disabled', 'disabled');

                var params = {};
                params.controller = 'webshopController';
                params.method = 'addToBasket';
                params.productId = $btn.attr('data-productId');
                params.variationId = $btn.attr('data-variantId');

                $.ajax({
                    type: 'POST',
                    url: '',
                    dataType: 'json',
                    data: params,
                    success: function (data) {
                        if (data.success) {
                            base.amount = base.amount + parseInt(params.quantity);
                            base.refresh(base.amount);
                            base.show();
                        }

                        $btn.removeAttr('disabled');
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        $btn.removeAttr('disabled');
                        alert(jqXHR + '   |   ' + textStatus + '   |   ' + errorThrown);
                    }
                });

            },

            /** refresh basket items count */
            refresh: function (amount) {
                var base = this;
                base.amount = amount || 0;

                base.$amount.text(base.amount);
            }
        }

        $(document).ready(function () {
            Basket.init({/literal}{$productsAmount}{literal});
        });
        $(".shopping-cart-link").click(function(){
            $('#opaco').show();
            $('#popup-shoppingbag-table').show();
        });
        $(".icon_times_drop").click(function(){
            $('#opaco').hide();
            $('#popup-shoppingbag-table').hide();
        });

    </script>
{/literal}


