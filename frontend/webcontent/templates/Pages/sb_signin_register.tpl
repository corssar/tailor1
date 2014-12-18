{literal}
<script type="text/javascript">
/*    var ajaxHandlerUrl = '{/literal}{$ajaxHandler}{literal}';
    var refererUrl = '{/literal}{$refererUrl}{literal}';*/

    var calendarImg = '';
    var dateFormat = 'dd-mm-yy';
    var langMetaTag = 'en';

    $(document).ready(function(){

        $(':password').showPassword({
            linkRightOffset: 5,
            linkTopOffset: 11
        });


        $("#signInForm2").validationEngine({
            inlineValidation: true,
            autoPositionUpdate:true,
            scroll:false
        });
    });

    function SignIn2(){
        if($('#signInForm2').validationEngine('validate')){
            var data = {
                login:		$('#signInEmail2').val(),
                password:	$('#signInPassword2').val(),
                method:		'SignIn',
                controller:	'SignInController'
            };
            $('#signInForm2 a.my-account-button').hide();
            $('#signInForm2 .ajaxLoader div').show();
                $.ajax({
                    type: 'POST',
                    url: '',
                    dataType: 'json',
                    data: data,
                    success: function(response){
                        if(response){
                            window.location.replace('{/literal}{$nextStep}{literal}');
                        }else{
                            $("#signInEmail2").validationEngine("showPrompt","'{/literal}{webtext keyword='registerPageWrongLoginTxt' value='Wrong email or password' remark='Sign in page text'}{literal}'", "error", "", true);
                        }
                    }
                })
        }
    }



</script>
{/literal}
<div class="pageContent signin-page">
    {include file='PageObjects/needHelp.tpl'}
    {include file='PageObjects/orderProgressIndicator.tpl' step=1}

    <div class="leftBlock">
        <h1>{webtext keyword='registerPageEnterTxt' value='Sign In' remark='Sign in page text'}</h1>
        <div class="registerPageBlock">
            <div class="signinregister-intro">
                {webtext keyword="signinRegisterIntroText" value="<h3>Iam already a customer</h3>Have you been at The Dream Blouses before? Fill in your email address and password and we will retrieve your registered data." remark="shopping bag sign in / register page"}
            </div>
            <form class="form" id="signInForm2" method="post" action="" onsubmit="SignIn2(); return false;">
                <div class="formRow formRowMarging">
                    <label class="labelForField" for="signInEmail2">{webtext keyword='registerPageEmailAddressTxt' value='Email address:' remark='Sign in page text'}</label><input type="text" name="loginName" id="signInEmail2" class="validate[required,custom[emailFormat,ajaxEmail]]" />
                </div>
                <div class="formRow formRowMarging" style="position:relative;">
                    <label class="labelForField" for="signInPassword2">{webtext keyword='registerPagePasswordTxt' value='Password:' remark='Sign in page text'}</label><input type="password" name="password" id="signInPassword2" class="validate[required]" />
                </div>
                <div class="formRow" style="height: 41px;">
                    <a href="#" onclick="SignIn2(); return false;" class="my-account-button align-right" >{webtext keyword='registerPageSignInBtnTxt' value='SIGN IN' remark='Sign in page text'}</a>
                    <div class="ajaxLoader"><div></div></div>
                </div>
                <input type="submit" class="hidden" />
            </form>
        </div>
    </div>

    <div class="rightBlock">
        <h1>{webtext keyword='registerPageRegisterTxt' value='Register' remark='Sign in page text'}</h1>
        <div class="registerPageBlock">
            <div class="signinregister-intro">
                {webtext keyword="registerIntroText" value="<h3>Not a customer yet?</h3>Is this your first time here? We will ask you for some data in order to make your shopping as easy and safe as possible." remark="shopping bag sign in / register page"}
            </div>
            <a href="{$registerUrl}" class="my-account-button align-right" >{webtext keyword='registerPageRegisterBtnTxt' value='REGISTER' remark='Sign in page text'}</a>
        </div>
    </div>

</div>