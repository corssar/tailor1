<?php
@define('ENVIRONMENT', 'live');

switch(ENVIRONMENT)
{
    case 'dev':
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        break;
    case 'beta':
        error_reporting(0);
        ini_set('display_errors', 0);
        break;
    case 'live':
        error_reporting(0);
        ini_set('display_errors', 0);
}

$dbConnect['default'] = array("DB_HOST"=>"194.28.172.183",
                              "DB_NAME"=>"iproaction_tailor",
                              "DB_USER"=>"iproaction_ta",
                              "DB_PASS"=>"tailor");

@define("USE_REWRITE", true);
@define("MULTI_LANGUAGE", true);
@define("EN_LANGUAGE_ID", 3);
@define("MULTI_SITE", false);

// Идентификатор MasterPage(МастерСтраницы) по умолчанию для всех Page (Страниц)
@define("APPLICATION_MASTER_PAGE_ID",1);
// Кол-во ОбластейСтраницы, в которых располагаются ОбъектыСтраницы (PageObject)
@define("APPLICATION_MASTER_PAGE_AREAS_COUNT",9);

@define("SITE_PROTOCOL", "http://");

@define('COOKIE_DOMAIN','');
@define('COOKIE_AUTH_LIFETIME', 3600);
@define('ENCRYPT_KEY','BXcfTTYewQ');

@define("SITE_DIR", "" );// dannaja constanta ispolzuetsja v backend/config/config.php
@define("SITE_URL", $_SERVER['HTTP_HOST'].SITE_DIR);
@define("DEFAULT_SITE_URL_FROM_DB", 'tailor.local');
@define("SITE_PATH", $_SERVER['DOCUMENT_ROOT'].SITE_DIR."/");
@define("FRAMEWORK_PATH", SITE_PATH.'framework/');
@define("FRONTEND_PATH",SITE_PATH."frontend/");
@define("FRONTEND_CONTENT_PATH","webcontent/");
@define("FRONTEND_TEMPL_PATH", FRONTEND_PATH.FRONTEND_CONTENT_PATH."templates/");
@define("BACKEND_PATH",SITE_PATH."backend/");
@define("PAGES_PATH", '/frontend/pages/');

@define("MYSQLI_LOG_FILE",SITE_PATH."/logs/be_mysqli.log");
@define("MYSQL_LOG_FILE",SITE_PATH."/logs/be_mysql.log");

@define("SMARTY_DIR",SITE_PATH."vendors/Smarty/");
@define("PEAR_DIR",SITE_PATH."vendors/Pear/");

@define("USE_SMTP", true);
@define("SMTP_SERVER","ssl://smtp.gmail.com");
@define("SMTP_USER","ipromailtest@gmail.com");
@define("SMTP_PORT",'465');
@define("SMTP_PASSWORD",'!promail!123');
@define("SMTP_AUTH",true);


/*	cache section  */
@define("USE_CACHE", false);
$cacheOptions = array(
	'cacheDir' => SITE_PATH.'/cache/', // must include trailing slash…
	'lifeTime' => null,              // cache life in seconds (3600 - 1 hour)
	'fileNameProtection' => false,
	'memoryCaching' => false /*if false use memory*/);

//Autoloader block
include_once FRAMEWORK_PATH. "system/classMap.php";

require_once(FRAMEWORK_PATH."system/Gag.php");