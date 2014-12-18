{if !$logined}
    <div class="username-and-loguot">
        <a class="registration" onclick="Page.openStaticPopup('#signInPopUp')">
            <i></i>
            {$webtext_enter}{*Вход*}
        </a>
        <span class="or">{$webtext_or}{*или*}</span>
        <a href="{$registerPage}" class="my-account-button brown">
            <i></i>
            {$webtext_signIn}{*Регистрация*}
        </a>
    </div>
{else}
    <form id="signInForm" method="post" action="">
        <input type="submit" id="logOutId" value="{webtext keyword='user-logout' value='Выход' remark='Sign In object'}" style="display: none" />
        <input type="hidden" name="signOut" value="1"/>
        <div class="username-and-loguot">
            <a href="{$privateOfficeUrl}" class="user-profile-menu-title">{webtext keyword="user-profile-menu-title" value="Личный кабинет" remark="Sign In object"}
                <i class="icon_enter"></i>
            </a>
            <a href="#" onclick="$('#logOutId').click();return false;" class="button btn-logout">{$webtext_logOut}{*Выход*}
                <i class="icon_exit"></i>
            </a>
        </div>
    </form>
{/if}
<div id="signInPopUp" class="popup">
    <div class="header">
        <div class="title">{webtext keyword="sign_in_popup_title" value="Авторизация" remark="Sign In object"}</div>
        <button class="close" onclick="Page.closeStaticPopup();"></button>
    </div>
    <div class="content">
        <form id="signInForm" method="POST">
            <table>
                <tr>
                    <td>{webtext keyword="sign_in_popup_email" value="Почта" remark="Sign In object"}</td>
                    <td><input id="email" type="text" class="validate[required,custom[emailFormat]]" name="email"></td>
                    <td><span>*</span></td>
                </tr>
                <tr>
                    <td>{webtext keyword="sign_in_popup_password" value="Пароль" remark="Sign In object"}</td>
                    <td><input id="password" type="password" class="validate[required]" name="password"></td>
                    <td><span>*</span></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button id="signInBtn"
                                type="submit">{webtext keyword="sign_in_popup_signin_btn" value="Войти" remark="Sign In object"}</button>
                    </td>
                    <td><a href="#"
                           onclick="Page.closeStaticPopup();Page.openStaticPopup('#reminderPassword');return false;"
                           id="forgotPassword">{webtext keyword="sign_in_popup_forgot_password" value="Забыли Пароль?" remark="Sign In object"}</a>
                    </td>
                </tr>
            </table>
        </form>
        <div class="regBlock">
            <span>{webtext keyword="sign_in_popup_not_registered" value="Я еще не зарегистрирован" remark="Sign In object"}</span>
            <a href="{$registerPage}"
               class="goToReg">{webtext keyword="sign_in_popup_go_to_register" value="Перейти к регистрации" remark="Sign In object"}</a>
        </div>
    </div>
</div>
<div id="reminderPassword" class="popup">
    <div class="header">
        <div class="title">{webtext keyword="reminder_password_popup_title" value="Забыли Пароль?" remark="Sign In object"}</div>
        <button class="close" onclick="Page.closeStaticPopup();"></button>
    </div>
    <div class="content">
        <div class="before">
            <form id="reminderPWForm" method="POST">
                <input type="hidden" name="controller" value="SignInController"/>
                <input type="hidden" name="method" value="remindPassword"/>
                <table>
                    <tr>
                        <td>{webtext keyword="reminder_password_popup_email" value="E-mail" remark="Sign In object"}</td>
                        <td><input id="remEmail" type="text" class="validate[required,custom[emailFormat]]" name="email">
                        </td>
                        <td><span>*</span></td>
                        <td id="titleInput">
                            <span>{webtext keyword="reminder_password_popup_send_title" value="Пароль будет выслан на e-mail" remark="Sign In object"}</span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <a href="#" id="remindPassword"
                               onclick="remindPassword();return false;">{webtext keyword="reminder_password_popup_send_btn" value="Отправить" remark="Sign In object"}</a>
                        </td>
                    </tr>
                </table>
            </form>
            <div class="regBlock">
                <span>{webtext keyword="sign_in_popup_not_registered" value="Я еще не зарегистрирован" remark="Sign In object"}</span>
                <a href="{$registerPage}"
                   class="goToReg">{webtext keyword="sign_in_popup_go_to_register" value="Перейти к регистрации" remark="Sign In object"}</a>
            </div>
        </div>
        <div class="after" style="display: none;">
            <div id="closeRemindPopUp">{webtext keyword="reminder_password_popup_mail_send" value="Письмо с подтверждением о смене пароля отправленно на указанный email." remark="Sign In object"}</div>
            <button onclick="Page.closeStaticPopup();">{webtext keyword="sign_in_popup_signin_btn_ok" value="ОК" remark="Sign In object"}</button>
        </div>
    </div>
</div>
{literal}
<script>
    var vErrors = {/literal}{if $validationErrors}{$validationErrors};
    {else}'';
    {/if}{literal}
    $(document).ready(function () {

        $("#signInForm").validationEngine({
            inlineValidation: true,
            autoPositionUpdate: true,
            scroll: false
        });
        $("#reminderPWForm").validationEngine({
            inlineValidation: true,
            autoPositionUpdate: true,
            scroll: false
        });

        if (vErrors && vErrors.length > 0) {
            var validationErrors = eval('{/literal}{$validationErrors}{literal}');
            var errorPopupFormId = 'signInPopUp';
            Page.openStaticPopup('#signInPopUp')

            if (typeof validationErrors != 'undefined') {
                //show error prompt
                $('#signInForm').validationEngine();
                for (var key in validationErrors) {
                    $("#" + validationErrors[key].field).validationEngine("showPrompt", validationErrors[key].value, "error", "", true);
                }
            }
        }
    });

    var User = (function () {
        var profileMenu = function () {
            if ($('#usersLinks').hasClass('displayNone')) {
                $('#usersLinks').removeClass('displayNone');
                setTimeout(function () {
                    $("body").one('click', function (e) {
                        if ($(e.target).closest("#usersLinks").length == 0) $("#usersLinks").addClass("displayNone");
                    });
                }, 50);
            } else {
                $('#usersLinks').addClass('displayNone');
            }
        };

        return {
            profileMenu: profileMenu
        }
    })();

    function remindPassword() {
        var formOptions = {
            success: function (response) {
                if (response.success) {
                    var content = $('#reminderPassword .content');
                    $('div.before', content).css('display', 'none');
                    $('div.after', content).css('display', 'block');
                }
            },
            dataType: 'json'
        }
        $('#reminderPWForm').ajaxForm(formOptions).submit();
        return false;
    }


</script>
{/literal}