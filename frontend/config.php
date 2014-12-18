<?php
require_once(FRAMEWORK_PATH."system/Context.php");
@define("FRONTEND_TEMPL_PATH",FRONTEND_PATH."webcontent/templates/");

// Prefix if true, false - postfix
@define("USE_TITLE_PREFIX", false);
@define("USE_USER_ONLINE", true);

//@define("DEFAULT_SITE_MAIL","iproaction@gmail.com");
/*@define("PAYMENT_COPY_EMAIL","andrewdukati@gmail.com, uadev_max@yahoo.com");*/

@define("ERRORPAGE_URL",Context::SiteSettings()->getSiteUrl()."/500.htm");

//this variable turn on logining
@define("DEBUG_MODE", true);
@define("FRIENDLY_ERROR",false);//false - will show errors on web
		
//Code for Google Analytics Account, if empty do not used
@define("GA_CODE",'');// 'UA-16639195-1'

@define("AJAX_HANDLER", SITE_PROTOCOL.Context::SiteSettings()->getSiteUrl().'/frontend/pages/ajaxHandler.php');

@define("USE_PHPBB",false);
@define("PHPBB_PATH", SITE_PATH."forum/");