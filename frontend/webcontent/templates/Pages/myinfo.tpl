{literal}
<script type="text/javascript">


    var calendarImg = '';
    var dateFormat = 'dd-mm-yy';
    var langMetaTag = 'en';

    $(document).ready(function(){
/*
        $(':password').showPassword({
            linkRightOffset: 5,
            linkTopOffset: 11
        });
*/
        $.datepicker.setDefaults(
                $.extend($.datepicker.regional[langMetaTag])
        );
        $("#reg_birthdate" ).datepicker({
            showOn: "focus",
            changeYear: true,
            changeMonth: true,
            yearRange: '-100:+1',
            dateFormat: dateFormat
        });
        $("#signInForm2").validationEngine({
            inlineValidation: true,
            autoPositionUpdate:true,
            scroll:false
        });

        $("#nav-tabs li").each(function (i) {
            $("#nav-tabs li:eq("+i+")").click(function(){
                var tab_id=i+1;
                $("#nav-tabs li").removeClass("active");
                $(this).addClass("active");
                $(".tab-content > div").stop(false,false).hide();
                $("#tab"+tab_id).stop(false,false).show();
                return false;
            })
        })
        $('#signInForm2 input').keydown(function(e){
            if (e.keyCode == 13) {
                changeInfoUser();
                return false;
            }
        });
    });
function changeInfoUser()
{
    var formOptions = {
    success: function(response)
    {
        if(response.success){
            var html = "{/literal}{$passTxt}{literal}";
            $('#message').show();
            setTimeout(function(){
                $('#message').hide()
            }, 2000);
            $(".text-message").html(html);
            $('body,html').animate({scrollTop: 0}, 200);
        }
    else{
        var html = "{/literal}{$errorTxt}{literal}";
        $('#message').show();
            setTimeout(function(){
                $('#message').hide()
            }, 2000);
        $(".text-message").html(html);
        if(response.validationErrors.length){
            for(var i=0;i < response.validationErrors.length; i++)
            {
                $("#reg_"+response.validationErrors[i]['field']).validationEngine("showPrompt",response.validationErrors[i]['value'], "error", "", true);
            }
        }
    }
    $('#signInForm2 .preloader').hide();
    /*  $('#registerForm a.my-account-button').show(); */
},
    beforeSubmit: function() {
        /* $('#registerForm a.my-account-button').hide(); */
        $('#signInForm2 .preloader').show();
    },
    dataType:	'json',
    timeOut:	5000
    }
    $('#signInForm2').ajaxForm(formOptions).submit();
    return false;
}
/*
    function SignIn2(){
        if($('#signInForm2').validationEngine('validate')){
            var data = {
                login:		$('#signInEmail2').val(),
                password:	$('#signInPassword2').val(),
                method:		'SignIn',
                controller:	'SignInController'
            };

            $.ajax({
                type: 'POST',
                url: '',
                dataType: 'json',
                data: data,
                beforeSend: function(){
                    $('#signInForm2 a.my-account-button').hide();
                    $('#signInForm2 .ajaxLoader div').show();
                }
            })
                    .done(function(response) {
                        if(response.success){
                            window.location.href = refererUrl;
                        }else{
                            $("#signInEmail2").validationEngine("showPrompt","'{/literal}{webtext keyword='registerPageWrongLoginTxt' value='Wrong email or password' remark='Sign in page text'}{literal}'", "error", "", true);
                        }
                    })
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        alert(jqXHR + '   |   ' + textStatus + '   |   ' + errorThrown);
                    })
                    .always(function() {
                        $('#signInForm2 .preloader').hide();
                        $('#signInForm2 a.my-account-button').show();
                    });
        }
    }
*/
</script>
{/literal}
<div class="shell">
    <h1 class="profilePageTitle">{$name}{webtext keyword='EditProfilePage' value=', Добро пожаловать!' remark='Sign in page text'}</h1>
        <div class="profilePageBlock">
                <ul id="nav-tabs" class="tabs">
                    <li class="active"><a href="#">{webtext keyword="add_message_tab_data" value="Основные данные" remark="Add message page"}</a></li>
                    <li><a href="#">{webtext keyword="add_message_tab_change_pass" value="Изменить пароль" remark="Add message page"}</a></li>
                    <li><a href="#">{webtext keyword="add_message_tab_history_order" value="История заказа" remark="Add message page"}</a></li>
                </ul>
                <div class="inside-padd">
                    <div class="tab-content">
                        <div id="tab1" style="display: block">
                            <div id="message">
                                <span class="icon-info"></span>
                                <div class="text-message"></div>
                            </div>
                            <form class="form" id="signInForm2" method="POST">
                                <input type="hidden" name="controller" value="SignInController" />
                                <input type="hidden" name="method" value="changeProfileUser" />
                                <label class="labelForField" for="reg_name">{webtext keyword='registerPageFirstNameTxt' value='Ваше имя:' remark='Sign in page text'}</label>
                                <div class="formRow formRowMarging">
                                    <input type="text" name="regName" id="reg_name" class="validate[required]" tabindex="1" value="{$name}"/>
                                    <div class="help-block">{webtext keyword='registerPageNameHelpBlock' value='Не меньше 4-х символов' remark='Sign in page text'}</div>
                                </div>
                                <label class="labelForField" for="reg_phoneNumber">{webtext keyword='registerPagePhoneNumberTxt' value='Телефон:' remark='Sign in page text'}</label>
                                <div class="formRow formRowMarging">
                                    <input type="text" name="regPhone" id="reg_phoneNumber" tabindex="2" value="{$phoneNumber}"/>
                                </div>
                                <label class="labelForField" for="reg_email">{webtext keyword='registerPageEmailAddressTxt' value='Email:' remark='Sign in page text'}</label>
                                <div class="formRow formRowMarging">
                                    <input type="text" name="regEmail" id="reg_email" class="validate[required,custom[emailFormat]]" disabled="disabled" tabindex="2" value="{$email}" />
                                    <div class="help-block">{webtext keyword='registerPageEmailHelpBlock' value='E-mail является логином' remark='Sign in page text'}</div>
                                </div>
                                <label class="labelForField" for="reg_delivery_city">{webtext keyword='registerPageDeliveryCityTxt' value='Город доставки:' remark='Sign in page text'}</label>
                                <div class="formRow formRowMarging" style="margin-bottom: 24px">
                                    <input type="text" name="regDeliveryCity" id="reg_delivery_city" tabindex="3" value="{$regDeliveryCity}"/>
                                </div>
                                <label class="labelForField" for="reg_street">{webtext keyword='registerPageStreetTxt' value='Адрес:' remark='Sign in page text'}</label>
                                <div class="formRow formRowMarging">
                                    <input type="text" name="regStreet" id="reg_street" class="shortInput" tabindex="4" value="{$street}" />
                                </div>
                                <label class="labelForField"></label>
                                <div class="formRow">
                                    <input type="hidden" name="form_submitted" value="1">
                                    <div class="sendBtn">
                                        <a id="profile_form_submit" href="#" onclick="changeInfoUser(); return false;" class="my-account-button align-right">{$webtext_send}{*Сохранить данные*}</a>
                                        <div class="preloader"></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div id="tab2">
                            <form class="form" id="changePassForm" method="POST">
                                <label class="labelForField" for="old_reg_password">{webtext keyword='OldPagePasswordTxt' value='Старый пароль:' remark='Sign in page text'}</label>
                                <div class="formRow formRowMarging">
                                    <input type="password" name="oldRegPassword" id="old_reg_password"  tabindex="5"/>
                                </div>
                                <label class="labelForField" for="reg_password">{webtext keyword='NewPagePasswordTxt' value='Новый пароль:' remark='Sign in page text'}</label>
                                <div class="formRow formRowMarging">
                                    <input type="password" name="regPassword" id="reg_password" {*class="validate[required]"*} tabindex="6"/>
                                </div>
                                <label class="labelForField" for="reg_password_confirm">{webtext keyword='registerPageRepeatPasswordTxt' value='Повторите пароль:' remark='Sign in page text'}</label>
                                <div class="formRow formRowMarging">
                                    <input type="password" name="regPasswordConfirm" id="reg_password_confirm" tabindex="7"/>
                                </div>
                                <label class="labelForField"></label>
                                <div class="formRow">
                                    <input type="hidden" name="form_submitted_change_pass" value="1">
                                    <div class="sendBtn">
                                        <a id="profile_form_change_pass_submit" href="#" onclick="document.getElementById('submitformchangepass').click(); return false;" class="my-account-button align-right">{$webtext_send_change_pass}{*Изменить пароль*}</a>
                                    </div>
                                    <input type="submit" id="submitformchangepass" value="OK" style="display: none" />
                                </div>
                            </form>
                        </div>
                        <div id="tab3">
                            <span class="icon-info"></span>
                            <div class="text-message">{webtext keyword="add_message_tab_history_text" value="Вы еще не совершали покупки" remark="Add message page"}</div>
                        </div>
                    </div>
                </div>
        </div>
</div>