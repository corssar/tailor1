{literal}
<script type="text/javascript">
    /*var ajaxHandlerUrl = '{/literal}{$ajaxHandler}{literal}';
    var refererUrl = '{/literal}{$refererUrl}{literal}';*/

    var calendarImg = '';
    var dateFormat = 'dd-mm-yy';
    var langMetaTag = 'en';

    $(document).ready(function(){

        $.datepicker.setDefaults(
            $.extend($.datepicker.regional[langMetaTag])
        );

        $(".sb-birthdate" ).datepicker({
            showOn: "focus",
            changeYear: true,
            changeMonth: true,
            yearRange: '-100:+1',
            dateFormat: dateFormat
        });

        $("#billingShippingForm").validationEngine({
            inlineValidation: true,
            autoPositionUpdate: true,
            scroll: false,
            promptPosition: "registerForm"
        });

        Address.init();

    });

    var Address = {
        $shipping: null,
        $billing: null,
        $shippingLock: null,
        $submit: null,
        $submitPreloader: null,

        init: function(){
            var base = this;

            base.$billing = $("[name ^= 'billing']");
            base.$shipping = $("[name ^= 'shipping']");
            base.$shippingLock = $('.shipping-form-block .lock');
            base.$submit = $('a.my-account-button');
            base.$submitPreloader = $('.preloader');

            /** hide shipping address form */
            if($("[name='address-copy']:checked").val() == 1)
            {
                base.$shippingLock.show();
                base.$shipping.attr('disabled', 'disabled');
            }

            $('#same-address').click(function(){
                base.$shippingLock.show();
                base.$shipping.attr('disabled', 'disabled');
            });

            $('#different-address').click(function(){
                base.$shippingLock.hide();
                base.$shipping.removeAttr('disabled');
            });

            base.$billing.change(function(){
                base.$billing.find("[name='billing[isChanged]']").val(true);
            });

            base.$shipping.change(function(){
                base.$billing.find("[name='shipping[isChanged]']").val(true);
            });
        },

        post: function(){
            var base = this;
            var formOptions = {
                success: function(response)
                {
                    if(response.success){
                        base.$submit.show();
                        base.$submitPreloader.hide();
                        document.location.href = response.url;
                    }
                    else{
                        if(response.validationErrors.length){
                            for(var i=0;i < response.validationErrors.length; i++)
                            {
                                $("#reg_"+response.validationErrors[i]['field']).validationEngine("showPrompt",response.validationErrors[i]['value'], "error", "", false);
                            }
                        }
                    }
                },
                beforeSubmit: function() {
                    base.$submit.hide();
                    base.$submitPreloader.show();
                },
                dataType:	'json',
                timeOut:	5000
            }
            $('#billing-shipping').ajaxForm(formOptions).submit();

            return false;
        }
    }

</script>
{/literal}

<div class="pageContent signin-page">
    {include file='PageObjects/needHelp.tpl'}
    {include file='PageObjects/orderProgressIndicator.tpl' step=2}
    <div class="leftBlock">
        <h1>{webtext keyword='BillingAddressTitle' value='Billing address' remark='Billing / Shipping page text'}</h1>
        <div class="registerPageBlock">
            <form class="form" name="billingShippingForm" id="billing-shipping" method="POST" action="">
                <input type="hidden" name="controller" value="webshopController" />
                <input type="hidden" name="method" value="addBillingShippingAddresses" />
                <input type="hidden" name="billing[id]" value="{$billing.id}" />
                <input type="hidden" name="billing[isChanged]" value="false" />
                <input type="hidden" name="shipping[id]" value="{$shipping.id}" />
                <input type="hidden" name="shipping[isChanged]" value="false" />
                <div class="formRow formRowMarging signinregister-intro">
                    {webtext keyword="BillingAddressIntro" value="When you are new can create your account here. Enter your details below" remark="Billing / Shipping page"}
                </div>
                <div class="formRow formRowMarging gender-field">
                    <!--  Gender: 1 - Mr, 2 - Mrs -->
                    <label class="labelForField" style="margin:1px 8px 0 0;">{webtext keyword='registerPageUserTitleTxt' value='Title:' remark='Sign in page text'}</label>
                    <input type="radio" {if $billing.gender eq 1}checked="checked"{/if} name="billing[gender]" id="billing_gender1" value="1" tabindex="1" /><label for="billing_gender1">{webtext keyword='registerPageUserTitleMrTxt' value='Mr.' remark='Sign in page text'}</label>
                    <input type="radio" {if $billing.gender eq 2}checked="checked"{/if} name="billing[gender]" id="billing_gender2" value="2"  tabindex="2" /><label for="billing_gender2">{webtext keyword='registerPageUserTitleMrsTxt' value='Mrs.' remark='Sign in page text'}</label>
                </div>

                <div class="formRow formRowMarging">
                    <label class="labelForField" for="billing_reg_name">{webtext keyword='registerPageFirstNameTxt' value='First Name:' remark='Sign in page text'}</label>
                    <input type="text" name="billing[regName]" id="billing_reg_name" value="{$billing.name}" class="validate[required]" tabindex="3" />
                </div>
                <div class="formRow formRowMarging">
                    <label class="labelForField" for="billing_reg_surname">{webtext keyword='registerPageLastNameTxt' value='Last Name:' remark='Sign in page text'}</label>
                    <input type="text" name="billing[regSurname]" id="billing_reg_surname" value="{$billing.surname}" class="validate[required]" tabindex="4" />
                </div>
                <div class="formRow formRowMarging">
                    <label class="labelForField" for="billing_reg_street">{webtext keyword='registerPageStreetTxt' value='Street / nr.:' remark='Sign in page text'}</label>
                    <input type="text" name="billing[regStreet]" id="billing_reg_street" value="{$billing.street}" class="shortInput" tabindex="5" />
                    <input type="text" name="billing[regStreetNr]" id="billing_reg_houseNumber" value="{$billing.houseNumber}" class="shortInput2" tabindex="6" />
                </div>
                <div class="formRow formRowMarging">
                    <label class="labelForField" for="billing_reg_zipCode">{webtext keyword='registerPageZipCodeTxt' value='Zip code:' remark='Sign in page text'}</label>
                    <input type="text" name="billing[regZipCode]" id="billing_reg_zipCode" value="{$billing.zipCode}" class="shortInput" tabindex="7" />
                    <label class="zipCodeExample">{webtext keyword='registerPageZipCodeExampleTxt' value='(i.e. 3354VL)' remark='Sign in page text'}</label>
                </div>
                <div class="formRow formRowMarging">
                    <label class="labelForField" for="billing_reg_cityName">{webtext keyword='registerPageCityTxt' value='City:' remark='Sign in page text'}</label>
                    <input type="text" name="billing[regCity]" id="billing_reg_cityName" value="{$billing.cityName}" tabindex="8" />
                </div>
                <div class="formRow formRowMarging">
                    <label class="labelForField" for="billing_reg_countryName">{webtext keyword='registerPageCountryTxt' value='Country:' remark='Sign in page text'}</label>
                    <input type="text" name="billing[regCountry]" id="billing_reg_countryName" value="{$billing.countryName}" tabindex="9" />
                </div>

                <div class="formRow formRowMarging">
                    <label class="labelForField" for="billing_reg_phoneNumber">{webtext keyword='registerPagePhoneNumberTxt' value='Phone number:' remark='Sign in page text'}</label>
                    <input type="text" name="billing[regPhone]" id="billing_reg_phoneNumber" value="{$billing.phoneNumber}" tabindex="11" />
                </div>

        </div>
    </div>

    <div class="rightBlock">
        <h1>{webtext keyword='ShippingAddressTitle' value='Shipping address' remark='Billing / Shipping page text'}</h1>
        <div class="registerPageBlock">
                <div class="formRow formRowMarging">
                    <div class="shipping-address-copy">
                        <input type="radio" value="1" name="address-copy" id="same-address" {if $billing.id eq $shipping.id}checked="checked"{/if}  tabindex="12"><label for="same-address">{webtext keyword="ShippingAddressEqBilling" value="Shipping address is the same as my billing address." remark="Billing / Shipping page"}</label>
                    </div>
                    <div class="shipping-address-copy">
                        <input type="radio" value="0" name="address-copy" id="different-address" {if $billing.id neq $shipping.id}checked="checked"{/if} tabindex="13"><label for="different-address">{webtext keyword="ShippingAddressDifferentBilling" value="Deliver my order to a different address." remark="Billing / Shipping page"}</label>
                    </div>
                </div>
                <div class="shipping-form-block">
                    <div class="lock"></div>
                    <div class="formRow formRowMarging gender-field">
                        <!--  Gender: 1 - Mr, 2 - Mrs -->
                        <label class="labelForField" >{webtext keyword='registerPageUserTitleTxt' value='Title:' remark='Sign in page text'}</label>
                        <input type="radio" {if $shipping.gender eq 1}checked="checked"{/if} name="shipping[gender]" id="shipping_gender1" value="1"  tabindex="14"/><label for="shipping_gender1">{webtext keyword='registerPageUserTitleMrTxt' value='Mr.' remark='Sign in page text'}</label>
                        <input type="radio" {if $shipping.gender eq 2}checked="checked"{/if} name="shipping[gender]" id="shipping_gender2" value="2"  tabindex="15" /><label for="shipping_gender2">{webtext keyword='registerPageUserTitleMrsTxt' value='Mrs.' remark='Sign in page text'}</label>
                    </div>
                    <div class="formRow formRowMarging">
                        <label class="labelForField" for="shipping_reg_name">{webtext keyword='registerPageFirstNameTxt' value='First Name:' remark='Sign in page text'}</label>
                        <input type="text" name="shipping[regName]" id="shipping_reg_name" value="{$shipping.name}" class="validate[required]" tabindex="16" />
                    </div>
                    <div class="formRow formRowMarging">
                        <label class="labelForField" for="shipping_reg_surname">{webtext keyword='registerPageLastNameTxt' value='Last Name:' remark='Sign in page text'}</label>
                        <input type="text" name="shipping[regSurname]" id="shipping_reg_surname" value="{$shipping.surname}" class="validate[required]" tabindex="17" />
                    </div>
                    <div class="formRow formRowMarging">
                        <label class="labelForField" for="shipping_reg_street">{webtext keyword='registerPageStreetTxt' value='Street / nr.:' remark='Sign in page text'}</label>
                        <input type="text" name="shipping[regStreet]" id="shipping_reg_street" value="{$shipping.street}" class="shortInput" tabindex="18" />
                        <input type="text" name="shipping[regStreetNr]" id="shipping_reg_houseNumber" value="{$shipping.houseNumber}" class="shortInput2" tabindex="19" />
                    </div>
                    <div class="formRow formRowMarging">
                        <label class="labelForField" for="shipping_reg_zipCode">{webtext keyword='registerPageZipCodeTxt' value='Zip code:' remark='Sign in page text'}</label>
                        <input type="text" name="shipping[regZipCode]" id="shipping_reg_zipCode"value="{$shipping.zipCode}"  class="shortInput" tabindex="20" />
                        <label class="zipCodeExample">{webtext keyword='registerPageZipCodeExampleTxt' value='(i.e. 3354VL)' remark='Sign in page text'}</label>
                    </div>
                    <div class="formRow formRowMarging">
                        <label class="labelForField" for="shipping_reg_cityName">{webtext keyword='registerPageCityTxt' value='City:' remark='Sign in page text'}</label>
                        <input type="text" name="shipping[regCity]" id="shipping_reg_cityName" value="{$shipping.cityName}" tabindex="21" />
                    </div>
                    <div class="formRow formRowMarging">
                        <label class="labelForField" for="shipping_reg_countryName">{webtext keyword='registerPageCountryTxt' value='Country:' remark='Sign in page text'}</label>
                        <input type="text" name="shipping[regCountry]" id="shipping_reg_countryName" value="{$shipping.countryName}" tabindex="22" />
                    </div>
                    <div class="formRow formRowMarging">
                        <label class="labelForField" for="shipping_reg_phoneNumber">{webtext keyword='registerPagePhoneNumberTxt' value='Phone number:' remark='Sign in page text'}</label>
                        <input type="text" name="shipping[regPhone]" id="shipping_reg_phoneNumber" value="{$shipping.phoneNumber}" tabindex="24" />
                    </div>
                </div>
                <div class="sb-button-group">
                    <a href="#" onclick="Address.post(); return false;" class="my-account-button align-right" >{webtext keyword='ShoppingBagProceedToOverview' value='PROCEED TO OVERVIEW' remark='Shipping / Billing page'}</a>
                    <div class="preloader"></div>
                </div>
                <input type="submit" style="display: none;" value="OK" />
            </form>
        </div>
    </div>

</div>