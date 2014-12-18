<div class="pageContent signin-page">
    {include file='PageObjects/needHelp.tpl'}
    {include file='PageObjects/orderProgressIndicator.tpl' step=4}
    <h1>{$title}</h1>
    <div>
        {$text}
    </div>

    <div class="sb-confirm-button-holder">
        <a href="{$homeUrl}" class="my-account-button" >{webtext keyword='confirmationBackButton' value='BACK TO HOMEPAGE' remark='Confirmation page'}</a>
    </div>

</div>