{literal}
<script type="text/javascript">
    var refererUrl = '{/literal}{$refererUrl}{literal}';

    var calendarImg = '';
    var dateFormat = 'dd-mm-yy';
    var langMetaTag = 'en';

    $(document).ready(function(){

        /*$(':password').showPassword({
            linkRightOffset: 5,
            linkTopOffset: 11
        });*/

        /*$.datepicker.setDefaults(
                $.extend($.datepicker.regional[langMetaTag])
        );*/
        /*$("#reg_birthdate" ).datepicker({
            showOn: "focus",
            changeYear: true,
            changeMonth: true,
            yearRange: '-100:+1',
            dateFormat: dateFormat
        });*/

//        $('.signInBtn').hide();
        $("#registerForm").validationEngine({
            inlineValidation: true,
            autoPositionUpdate: true,
            scroll: false
        });
        $("#signInForm").validationEngine({
            inlineValidation: true,
            autoPositionUpdate:true,
            scroll:false
        });

        $('#registerForm input').keydown(function(e){
            if (e.keyCode == 13) {
                registerUser();
                return false;
            }
        });
    });

    function registerUser()
    {
        var formOptions = {
            success: function(response)
            {
                if(response.success){
                    $('#registerForm').hide();
                    var html = "{/literal}{$successRegistrationTxt}{literal}";
                    $('#message').show();
                    $(".text-message").html(html);
                    $('body,html').animate({scrollTop: 0}, 200);
                    setTimeout( 'location=refererUrl', 4000 );
                }
                else{
                    if(response.validationErrors.length){
                        for(var i=0;i < response.validationErrors.length; i++)
                        {
                            $("#reg_"+response.validationErrors[i]['field']).validationEngine("showPrompt",response.validationErrors[i]['value'], "error", "", true);
                        }
                    }
                }
                $('#registerForm .preloader').hide();
              /*  $('#registerForm a.my-account-button').show(); */
            },
            beforeSubmit: function() {
               /* $('#registerForm a.my-account-button').hide(); */
                $('#registerForm .preloader').show();
            },
            dataType:	'json',
            timeOut:	5000
        }
        $('#registerForm').ajaxForm(formOptions).submit();
        return false;
    }

</script>
{/literal}
<div class="shell">
    <h1>{$title}</h1>
    <div id="message">
        <span class="icon-info"></span>
        <div class="text-message"></div>
    </div>

    {*        {if strlen($confirmTxt) > 0}
    <div id="message">{$confirmTxt}</div>
    {else}*}

    <form class="form" name="regForm" id="registerForm" method="POST" action="">
        {*<input type="hidden" name="confirmPage" value="{$confirmPage}" />*}
        <input type="hidden" name="controller" value="SignInController" />
        <input type="hidden" name="method" value="createUser" />

        <label class="labelForField" for="reg_name">{webtext keyword='registerPageNameTxt' value='Ваше имя:' remark='Sign in page text'}</label>
        <div class="registerFormField">
            <input type="text" name="regName" id="reg_name" class="validate[required]" tabindex="1" />
            <span class="reg">*</span>
        </div>
        <label class="labelForField" for="reg_email">{webtext keyword='registerPageEmailAddressTxt' value='E-mail:' remark='Sign in page text'}</label>
        <div class="registerFormField">
            <input type="text" name="regEmail" id="reg_email" class="validate[required,custom[emailFormat]]" tabindex="2" />
            <span class="reg">*</span>
        </div>
        <label class="labelForField" for="reg_password">{webtext keyword='registerPagePasswordTxt' value='Пароль:' remark='Sign in page text'}</label>
        <div class="registerFormField">
            <input type="password" name="regPassword" id="reg_password" class="validate[required]" tabindex="3" autocomplete="off" />
            <span class="reg">*</span>
        </div>
        <label class="labelForField" for="reg_password_confirm">{webtext keyword='registerPageRepeatPasswordTxt' value='Повторите:' remark='Sign in page text'}</label>
        <div class="registerFormField">
            <input type="password" name="regPasswordConfirm" id="reg_password_confirm" class="validate[required,equals[reg_password]]" tabindex="4" />
            <span class="reg">*</span>
        </div>
        <label class="labelForField" for="reg_delivery_city">{webtext keyword='registerPageDeliveryCityTxt' value='Город доставки:' remark='Sign in page text'}</label>
        <div class="registerFormField">
            <input type="text" name="regDeliveryCity" id="reg_delivery_city" class="" tabindex="5" />
        </div>
        <label class="labelForField"></label>
        <div class="registerFormField">
            <input type="hidden" name="registration" value="1">
            <a href="#" class="submitForm" onclick="registerUser(); return false;" >{webtext keyword='registerPageRegisterBtnTxt' value='Зарегистрироваться' remark='Sign in page text'}</a>
            <div class="preloader"></div>
            <div class="help-block">{webtext keyword='registerPageRegisterHelpBlock' value='Я уже зарегистрирован' remark='Sign in page text'}</div>
            <ul class="signInFormLink">
                <li>
                    <a href="#" class="loginLink" onclick="Page.openStaticPopup('#signInPopUp');" >{webtext keyword='registerPageSignInBtnLink' value='Войти' remark='Sign in page text'}</a>
                </li>
                <li>
                    <span class="divider">{webtext keyword='registerPageSignInDivider' value='|' remark='Sign in page text'}</span>
                    <a href="#" class="remindPasswordLink" onclick="SignIn2(); return false;" >{webtext keyword='registerPageSignInRemindPasswordLink' value='Напомнить пароль' remark='Sign in page text'}</a>
                </li>
            </ul>
        </div>
    </form>
    {*        {/if}



    <form class="form" id="signInForm" method="post" action="">
        <label for="signInEmail2">{webtext keyword='registerPageEmailAddressTxt' value='Email address:' remark='Sign in page text'}</label>
        <input type="text" name="loginName" id="signInEmail2" class="validate[required,custom[emailFormat,ajaxEmail]]" />

        <label class="labelForField" for="signInPassword2">{webtext keyword='registerPagePasswordTxt' value='Password:' remark='Sign in page text'}</label>
        <input type="password" name="password" id="signInPassword2" class="validate[required]" autocomplete="off" />

        <a href="#" onclick="SignIn2(); return false;" class="my-account-button align-right" >{webtext keyword='registerPageSignInBtnTxt' value='SIGN IN' remark='Sign in page text'}</a>

        <div class="preloader"></div>
        <a class="remindPasswordLink" href="{$remindPassword}">{$webtext_remindPassword}{*Forgot password?*}</a>
    {*</form>*}

</div>