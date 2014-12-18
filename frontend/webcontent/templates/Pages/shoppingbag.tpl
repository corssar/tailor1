<div class="frame-inside page-category">
    <div class="container">
        {*{include file='PageObjects/needHelp.tpl'}*}
        <h1 style="margin-bottom: 14px;">{$title}</h1>

        <div  id="shoppingBagContainer">
            {include file='PageObjects/shoppingbagTable.tpl'}
        </div>

        {*<div class="sb-button-group">
            {if $basket.itemsCount > 0}
                <a href="{$checkoutUrl}" id="shoppingbag-table"
                   class="main-action-button my-account-button align-right">{webtext keyword='basketProceedToCheckoutButton' value='PROCEED TO CHECKOUT'  remark='Shopping bag page'}</a>
            {/if}
            <a href="#" onclick="window.history.go(-1); return false;"
               class="button align-right">{webtext keyword='basketContinueShoppingButton' value='Continue shopping'  remark='Shopping bag page'}</a>
        </div>*}
    </div>
</div>