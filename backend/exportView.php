<?
require_once ('../config.php');
include_once BACKEND_PATH.'config.php';
include_once BACKEND_PATH.'inc/BackendInit.inc.php';

if (!$admin->auth_ok)
{
	header('Location: Access.php');
}
else 
{
	header('Content-type: text/html; charset=UTF-8') ;
    view::exportView($_GET['id']);
}

?>