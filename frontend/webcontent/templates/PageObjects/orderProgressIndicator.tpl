<div class="order-progress-indicator">
    <div>{webtext keyword='OrderProgressIndicatorSignInRegisterText' value='Sign in / Register' remark='Pages with checkout steps'}</div>
    <div {if $step < 2} class="noactive" {/if}>{webtext keyword='OrderProgressIndicatorBillingShippingText' value='Billing / Shipping' remark='Pages with checkout steps'}</div>
    <div {if $step < 3} class="noactive" {/if}>{webtext keyword='OrderProgressIndicatorOrderOverviewText' value='Order overview' remark='Pages with checkout steps'}</div>
    <div {if $step < 4} class="noactive" {/if}>{webtext keyword='OrderProgressIndicatorConfirmationText' value='Confirmation' remark='Pages with checkout steps'}</div>
</div>