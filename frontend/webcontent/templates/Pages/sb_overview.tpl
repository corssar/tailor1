<div class="pageContent signin-page">
    {include file='PageObjects/needHelp.tpl'}
    {if !$isModeration}
        {include file='PageObjects/orderProgressIndicator.tpl' step=3}
    {/if}
    {if $isModeration}
        <h1>{$basket.orderId}</h1>
        <h2>{$orderStatus}</h2>
    {else}
        <h1>{$title}</h1>
    {/if}

    <div class="order-addresses clearfix">
        <div class="oa-title">{webtext keyword="basketAddressesDetailsTitle" value="Your details" remark="Order overview page"}</div>
        <div class="oa-address oa-billing">
            <div class="oa-subtitle">
                {webtext keyword="basketBillToAddressTitle" value="Bill to address" remark="Order overview page"}
                <a href="{$changeAddressesUrl}">{webtext keyword="basketAddressChangeTitle" value="(change)" remark="Order overview page"}</a>
            </div>
            <div>{$billing.name} {$billing.surname}</div>
            <div>{$billing.street} {$billing.houseNumber}</div>
            <div>{$billing.zipCode} {$billing.cityName}</div>
            <div>{$billing.countryName}</div>
            <div>{$billing.phoneNumber}</div>
        </div>
        <div class="oa-address oa-shipping">
            <div class="oa-subtitle">
                {webtext keyword="basketShipToAddressTitle" value="Ship to address" remark="Order overview page"}
                <a href="{$changeAddressesUrl}">{webtext keyword="basketAddressChangeTitle" value="(change)" remark="Order overview page"}</a>
            </div>
            <div>{$shipping.name} {$shipping.surname}</div>
            <div>{$shipping.street} {$shipping.houseNumber}</div>
            <div>{$shipping.zipCode} {$shipping.cityName}</div>
            <div>{$shipping.countryName}</div>
            <div>{$shipping.phoneNumber}</div>
        </div>
    </div>
        {include file='PageObjects/shoppingbagTable.tpl'}

    {if $basket.itemsCount > 0}
        {if $isModeration}
            {if count($paymentMethod) > 0}
                <img class="payment-methods-img" src="{$paymentMethod.icon}" />
                <span class="payment-methods-title method_title">{$paymentMethod.title}</span>
            {/if}
        {else}
            <div class="payment-methods-text">
                <span>{webtext keyword='paymentMethodsTitle' value='Choose payment method' remark='Order overview page'}</span>
                <div>{webtext keyword='paymentMethodsLabel' value='Choose one of the payment methods below.' remark='Order overview page'}</div>
            </div>
            <ul class="payment-methods">
                {foreach item=method from=$paymentMethods}
                    <li>
                        <input type="radio" id="{$method.code}" value="{$method.id}" name="paymentMethods" />
                        <label for="{$method.code}"><img class="payment-methods-img" src="{$method.icon}" /></label>
                        <span class="payment-methods-title">{$method.title}</span>
                        {*<span class="payment-methods-costs">{webtext keyword='paymentMethodsCosts' value='Payment costs:' remark='Order overview page'}</span>*}
                        {*<span class="payment-methods-price">{webtext keyword='paymentMethodsPrice' value='ˆ 0.65' remark='Order overview page'}</span>*}
                    </li>
                {/foreach}
            </ul>
            <div class="sb-button-group">
                <a href="#" onclick="ShoppingBag.createOrder(); return false;" id="shoppingbag-table" class="main-action-button my-account-button align-right">{webtext keyword='basketSubmitOrderButton' value='SUBMIT ORDER'  remark='Order overview page'}</a>
                <div class="preloader"></div>
            </div>
        {/if}
    {/if}
</div>