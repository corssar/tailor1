{*{literal}
<script type="text/javascript" language="javascript">
    var  SizeAndColorJsonParse = $.parseJSON('{/literal}{$SizeAndColorJson}{literal}');
    var notStock = '{/literal}({webtext keyword='out_of_stock' value='OUT OF STOCK'}){literal}';
</script>
    {/literal}
<div class="product">
    <a href="{$photoUrl[0].imageBig}" class="cloud-zoom product-item shadow" rel="position: 'inside', adjustX: 2, adjustY:2">
        <img id="product_item_photo" src="{$photoUrl[0].image}" alt="" />
    </a>
    <div class="product_info_all">
        <div class="product_info_block shadow">
            <form id="" class="" action="" method="POST">
                <input type="hidden" name="productId" id="productId" value="{$productId}">
                <input id="variationsId" type="hidden" name="variationsId" value="">
                <div id="request_product_name"class="product_name">{$title}</div>
                <div class="horizontal-line brown"></div>
                <div class="product_price">
                    {if {price_format price = $oldPrice} != ''}
                        <span class="price-label new-price">{price_format price = $price}</span>
                        <span class="old-price">{price_format price = $oldPrice}<span class="slash-line"></span></span>
                    {else}
                        <span class="price-label">{price_format price = $price}</span>
                    {/if}
                </div>
                <div class="product_made">
                    <span>{webtext keyword='product_made' value='Manufactured by:'}</span>
                    <span>{$brand}</span>
                </div>
                <div class="product_model">
                    <span>{webtext keyword='product_model' value='Model:'}</span>
                    <span>{$model}</span>
                </div>
                {if strlen($material)>0}
                    <div class="product_model">
                        <span>{webtext keyword='product_material' value='Material:'}</span>
                        <span>{$material}</span>
                    </div>
                {/if}
                <div class="product_size">
                    <label for="size_product">{webtext keyword='product_size' value='Size:'}</label>
                    <div class="select">
                        <select  class="inner_shadow" name="" id="size_product">
                        <option id="size_product_id" value="choose_size">{webtext keyword='choose_size' value='Choose size'}</option>
                            {foreach item=massiv from=$SizeAndColor}
                                {foreach item=size from=$massiv.data}
                                    {if $size.stock < 1}
                                        <option class="choise_size notStockSize" disabled value="{$size.size}">{$size.size} ({webtext keyword='out_of_stock' value='OUT OF STOCK'})</option>
                                    {else}
                                        <option class="choise_size" value="{$size.size}">{$size.size}</option>
                                    {/if}
                                {/foreach}
                                {break}
                            {/foreach}
                        </select>
                    </div>
                    <div class="product_size_table">
                        <span id="open_popup_product_size">{webtext keyword='size_table' value='Size table'}</span>
                        <div id="product_size_table_popup" class="shadow">
                            <div class="popup-arrow size_table_popup_arrow"></div>
                            <div class="product_size_table_content">{webtext keyword='product_size_table' value='Size table'}</div>
                        </div>
                    </div>
                </div>
                <div class="product_color">
                    <div class="product_color_title">{webtext keyword='product_color' value='Color:'}</div>
                    <div class="product_color_box">
                        {foreach $SizeAndColor as $color => $massiv}
                            <div class="product_color_check shadow">
                                <input value="" type="reset" class="color" title="{$color}" style="background-color:{$massiv.color}">
                            </div>
                        {/foreach}
                    </div>
                </div>
                <div class="product-quantity">
                <label>{webtext keyword='product-quantity' value='Quantity:'}</label>
                    <span class="">
                        <input class="inner_shadow" type="text" maxlength="3" name="" id="product_quantity"
                               onblur="if (this.value == '')this.value='1';"
                               onfocus="if (this.value == '1')this.value='';"
                               value="1*}{*{if $form.experience != ''}{$form.experience}{/if}*}{*"
                    </span>
                </div>
                <div id="product_button">
                    <a href="javascript:void(0);" id="product_to_cart" class="product_to_cart shadow">{webtext keyword='add_to_cart' value='ADD TO CART'}</a>
                    <ins class="product_not_stock">{webtext keyword='out_of_stock' value='OUT OF STOCK'}</ins>
                </div>
                <div class="horizontal-line brown"></div>
                <div class="product_short_description">{$html}</div>
            </form>
        </div>
        <div class="product_info_social">
                <a onclick="Share.facebook('{$link}','{$title}','{$photoUrl[0].image}')"><img src="{$smarty.const.SITE_PROTOCOL}{$smarty.const.SITE_URL}/frontend/webcontent/system_images/facebook-icon.png"></a>
                <a onclick="Share.twitter('{$link}','{$title}')"><img src="{$smarty.const.SITE_PROTOCOL}{$smarty.const.SITE_URL}/frontend/webcontent/system_images/twitter-icon.png"></a>
                <a onclick="Share.google('{$link}')"><img src="{$smarty.const.SITE_PROTOCOL}{$smarty.const.SITE_URL}/frontend/webcontent/system_images/google-icon.png"></a>
                <a onclick="Share.pinterest('{$link}','{$title}')"><img src="{$smarty.const.SITE_PROTOCOL}{$smarty.const.SITE_URL}/frontend/webcontent/system_images/pinterest-icon.png"></a>
        </div>
        <div class="product_info_image">
            {section name=i loop=$photoUrl}
            <div class="product_info_small_images shadow">
                <img src="{$photoUrl[i].imageSmall}" data-url="{$photoUrl[i].image}" data-url-bigImage="{$photoUrl[i].imageBig}">
            </div>
            {/section}
        </div>
    </div>
</div>
*}
{*<div id="product_size_popup_body_all"></div>*}
{*
<div id="product_size_popup_body">
    <div id="product_size_popup_body_all"></div>
    <div id="product_size_popup">
        <div>
            <p id="close_popup_product_size">{webtext keyword='close_popup_product_size' value='Close'}</p>
        </div>
    </div>
</div>*}
<div class="frame-inside page-category">
    <div class="container">
        <div class="clearfix item-product globalFrameProduct to-cart">
            <div class="f-s_0 title-product">
                <div class="frame-title">
                    <h1 class="title">{$title}</h1>
                </div>
                <span class="frame-variant-name-code">
                    <span class="frame-variant-code frameVariantCode">
                        {webtext value="Артикуль: " keyword="product-article-text"}<span
                                class="code js-code">{$model}</span>
                    </span>
                </span>
            </div>
            <div class="right-product">
                <div id="xBlock"></div>
                <div class="right-product-left">
                    <div class="f-s_0 buy-block">
                        <div class="frame-prices-buy-wish-compare">
                            <div class="frame-prices-buy f-s_0">
                                <div class="frame-prices f-s_0">
                                    {if {price_format price = $oldPrice} != ''}
                                        <span class="price-discount">
                                            <span>
                                                <span class="price priceOrigVariant">{$oldPrice}&nbsp;<span class="curr">{webtext value="ГРН." keyword="grn_currency"}</span></span>
                                            </span>
                                        </span>
                                        <span class="current-prices f-s_0">
                                            <span class="price-new">
                                                <span>
                                                    <span class="price priceVariant">{$price}&nbsp;<span class="curr">{webtext value="ГРН." keyword="grn_currency"}</span></span>
                                                </span>
                                            </span>
                                        </span>
                                        {else}
                                        <span class="price-new">
                                            <span>
                                                <span class="price priceVariant">{$price}&nbsp;<span class="curr">{webtext value="ГРН." keyword="grn_currency"}</span></span>
                                            </span>
                                        </span>
                                    {/if}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="short-desc">
                        <div>
                            <span style="font-weight:normal">
                                {$html}
                            </span>
                            <br><br>
                        </div>
                    </div>
                    <div class="product_info_social">
                        <a onclick="Share.facebook('{$link}','{$title}','{$photoUrl[0].image}')"><img src="{$smarty.const.SITE_PROTOCOL}{$smarty.const.SITE_URL}/frontend/webcontent/system_images/facebook-icon.png"></a>
                        <a onclick="Share.twitter('{$link}','{$title}')"><img src="{$smarty.const.SITE_PROTOCOL}{$smarty.const.SITE_URL}/frontend/webcontent/system_images/twitter-icon.png"></a>
                        <a onclick="Share.google('{$link}')"><img src="{$smarty.const.SITE_PROTOCOL}{$smarty.const.SITE_URL}/frontend/webcontent/system_images/google-icon.png"></a>
                    </div>
                </div>
                <div class="right-product-right">
                    <!--Start. Payments method form -->
                    <div class="frame-delivery-payment">
                        <dl>
                            <dt class="title f-s_0">
                                <span class="icon_delivery" style="margin-top: 0px; margin-left: 0px; position: relative;">
                                    <svg height="15" version="1.1" width="17" xmlns="http://www.w3.org/2000/svg" style="overflow: hidden; position: relative; left: -0.640625px;">
                                        <desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with Rapha?l 2.1.0</desc>
                                        <defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs>
                                        <path fill="#0c9acb" stroke="none" d="M17.078,22.004L15.32,17.875L13.313,22.627L5.7940000000000005,19.337999999999997L5.968000000000001,23.243L15.405000000000001,27.616999999999997L26.314,22.251999999999995L26.165,17.262999999999995L17.078,22.004ZM29.454,6.619L18.521,3.383L15.515,6.054L12.424,3.6950000000000003L1.546,8.199L5.341,11.247L1.9080000000000004,16.549L12.786999999999999,21.305999999999997L15.316999999999998,15.307999999999996L17.573999999999998,20.615999999999996L28.967,14.673999999999996L25.862,9.964999999999996L29.454,6.619ZM15.277,14.579L6.218,10.749L15.493,6.648000000000001L25.101,9.903L15.277,14.579Z" transform="matrix(0.5733,0,0,0.5733,-0.8394,-1.4127)" stroke-width="1.7442499999999999" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
                                    </svg>
                                    &nbsp;
                                </span>
                                <span class="text-el">{webtext value="Доставка" keyword="product_shipment_title"}</span>
                            </dt>
                            <dd class="frame-list-delivery">
                                <ul class="list-style-1">
                                    <li>{webtext value="Новая Почта" keyword="product_shipment_text1"}</li>
                                    <li>{webtext value="Самовывоз" keyword="product_shipment_text2"}</li>
                                </ul>
                            </dd>
                            <dt class="title f-s_0">
                                <span class="icon_payment" style="margin-top: 0px; margin-left: 0px; position: relative;">
                                    <svg height="15" version="1.1" width="15" xmlns="http://www.w3.org/2000/svg" style="overflow: hidden; position: relative; left: -0.640625px;">
                                        <desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with Rapha?l 2.1.0</desc>
                                        <defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs>
                                        <path fill="#0c9acb" stroke="none" d="M16,1.466C7.973,1.466,1.466,7.973,1.466,16C1.466,24.027,7.973,30.534,16,30.534C24.027,30.534,30.534,24.027,30.534,15.999999999999998C30.534,7.973,24.027,1.466,16,1.466ZM17.255,23.88V25.927H15.296999999999999V23.903C12.084,23.462999999999997,10.675999999999998,20.823,10.675999999999998,20.823L12.677999999999997,19.15C12.677999999999997,19.15,13.953999999999997,21.372999999999998,16.263999999999996,21.372999999999998C17.539999999999996,21.372999999999998,18.507999999999996,20.689999999999998,18.507999999999996,19.523999999999997C18.507999999999996,16.794999999999998,11.158999999999995,17.125999999999998,11.158999999999995,12.064999999999998C11.158999999999995,9.864999999999998,12.896999999999995,8.279999999999998,15.295999999999996,7.905999999999998V5.859H17.253999999999994V7.904999999999999C18.925999999999995,8.125,20.905999999999995,9.004999999999999,20.905999999999995,10.898V12.35H18.309999999999995V11.645999999999999C18.309999999999995,10.919999999999998,17.384999999999994,10.436,16.350999999999996,10.436C15.030999999999995,10.436,14.062999999999995,11.096,14.062999999999995,12.02C14.062999999999995,14.814,21.411999999999995,14.132,21.411999999999995,19.435C21.413,21.614,19.785,23.506,17.255,23.88Z" transform="matrix(0.4816,0,0,0.4816,0.1062,0.1062)" stroke-width="2.076285714285714" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
                                    </svg>
                                    &nbsp;
                                </span>
                                <span class="text-el">{webtext value="Оплата" keyword="product_payment_title"}</span>
                            </dt>
                            <dd class="frame-list-payment">
                                <ul class="list-style-1">
                                    <li>{webtext value="Наличными при получении" keyword="product_payment_text1"}</li>
                                    <li>{webtext value="Безналичный перевод" keyword="product_payment_text2"}</li>
                                    <li>{webtext value="Приват 24" keyword="product_payment_text3"}</li>
                                </ul>
                            </dd>
                        </dl>
                    </div>
                    <div class="frame-phone-product">
                        <div class="title f-s_0">
                            <span class="icon_phone_product" style="margin-top: 0px; margin-left: 0px; position: relative;">
                                <svg height="14" version="1.1" width="13" xmlns="http://www.w3.org/2000/svg" style="overflow: hidden; position: relative; left: -0.640625px;">
                                    <desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with Rapha?l 2.1.0</desc>
                                    <defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs>
                                    <path fill="#0c9acb" stroke="none" d="M22.065,18.53C21.598000000000003,18.240000000000002,20.898,18.32,20.509,18.709L17.416,21.801C17.027,22.189999999999998,16.391000000000002,22.189999999999998,16.002,21.801L9.05,14.848C8.661000000000001,14.459000000000001,8.661000000000001,13.823,9.05,13.434000000000001L11.963000000000001,10.522000000000002C12.352,10.133000000000003,12.41,9.447000000000003,12.094000000000001,8.998000000000001L6.792,1.485C6.476,1.036,5.863,0.948,5.433,1.29C5.433,1.29,1.2989999999999995,4.571,1.2989999999999995,7.585C1.2989999999999995,19.92,11.299,29.919,23.633,29.919C26.648,29.919,29.581,24.386,29.581,24.386C29.839,23.9,29.668,23.264,29.201,22.974L22.065,18.53Z" transform="matrix(0.4225,0,0,0.4225,0.5013,-0.7662)" stroke-width="2.36685551010404" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
                                </svg>
                                &nbsp;
                            </span>
                            <span class="text-el">{webtext value="Заказы по телефонах" keyword="product_phones_title"}</span>
                        </div>
                        <ul class="list-style-1">
                            <li>(097) <span class="d_n">- </span>567-43-21</li>
                            <li>(097) <span class="d_n">- </span>567-43-22</li>
                        </ul>
                    </div>                    <!--End. Payments method form -->
                </div>
            </div>
            <div class="left-product leftProduct">
                <a href="{$photoUrl[0].imageBig}" class="cloud-zoom product-item shadow" rel="position: 'inside', adjustX: 2, adjustY:2">
                    <span class="photo-block">
                        <img id="product_item_photo" src="{$photoUrl[0].image}" alt="" />
                    </span>
                </a>

                <div class="horizontal-carousel">
                    <div class="frame-thumbs carousel-js-css">
                        <div class="content-carousel">
                            <ul>
                                {section name=i loop=$photoUrl}
                                    <li class="product_info_small_images shadow">
                                        <img src="{$photoUrl[i].imageSmall}" data-url="{$photoUrl[i].image}" data-url-bigImage="{$photoUrl[i].imageBig}">
                                    </li>
                                {/section}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{literal}
    <script type="text/javascript">
        Share = {
            facebook: function(purl, ptitle, pimg) {
                url  = 'https://www.facebook.com/sharer/sharer.php?';
                url += 'u='       + encodeURIComponent(purl);
                url += '&t='      + encodeURIComponent(ptitle);
                url += '&src='    + "sp";
                Share.popup(url);
            },
            twitter: function(purl, ptitle) {
                url  = 'http://twitter.com/share?';
                url += 'text='      + encodeURIComponent(ptitle);
                url += '&url='      + encodeURIComponent(purl);
                url += '&counturl=' + encodeURIComponent(purl);
                Share.popup(url);
            },
            google: function(purl) {
                url  = 'https://plus.google.com/share?';
                url += 'url={' + encodeURIComponent(purl) + '}';
                Share.popup(url);
            },
            pinterest: function(purl, ptitle) {
                url  = 'https:/pinterest.com/share?';
                url += 'text='      + encodeURIComponent(ptitle);
                url += '&url='      + encodeURIComponent(purl);
                url += '&counturl=' + encodeURIComponent(purl);
                Share.popup(url);
            },
            popup: function(url) {window.open(url,'','toolbar=0,status=0,width=626,height=436');

            }
        }
    </script>
{/literal}