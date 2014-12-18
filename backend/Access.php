<?php

require_once ('../config.php');
require_once(BACKEND_PATH.'config.php');

include('inc/BackendInit.inc.php');

$username = isset($_POST['username'])?$_POST['username']:false;
$password = isset($_POST['password'])?$_POST['password']:false;
$logout	  = isset($_GET['logout'])	 ?$_GET['logout']:	 false;


if ($username && $password) $admin->login($username, $password);

if ($logout)
{
	$admin->logout();
	$session->close();
}

if ( $admin->auth_ok ) 
{
	$session->close();
	header('Location: index.php');
}
?>
<html>
<head>
<style>
	body	
	{
		background-image:url(templates/images/admin_background.jpg);
		background-color:#808080;			
		margin:0px;
		font-family:verdana;			
	}
	.login
	{
		width:350px;
		height:180px;
		background:#fff;
		border: solid 1px #000;
		font-size:13px;
		font-weight:bold;
		color:#000;
	}	
	.i_text
		{
			border: solid 1px #555;
			padding:3px;
			color:#000;
			font-weight:bold;
			width:200px;
		}
	.i_button
		{
			border: solid 1px #000;
			width: 100px;
			background:#fff;
			cursor:pointer;
		}
		form
		{
			margin:0px;
			padding:0px;
		}
</style>
</head>
<body>
<center>
  <table width="100%" height="100%">
      <tr valign="middle">
         <td align="center">
            <table class="login">
               <tr valign="top">
                  <td>
                  	<form method="POST">
	                  	<table class="login" style="padding:4px;">
			               <tr valign="top">
			                  <td align="center" colspan="2">
			                  	<b>Admin area</b>
			                  </td>
			               </tr>
			               <tr>
			                  <td align="left">
			                  	 Username:
			                  </td>
			                  <td>
			                  	 <input type="text" class="i_text" name="username" />
			                  </td>
			               </tr>
			               <tr>
			                  <td>
			                  	  Password:
			                  </td>
			                  <td>
			                  	<input type="password" class="i_text" name="password" />
			                  </td>		                  
			               </tr>
			               <tr>
			                  <td colspan="2" align="center">
			                     <input type="submit" value="Login" class="i_button" />
			                  </td>
			               </tr>
			            </table>
		            </form>
                  </td>
               </tr>
            </table>
         </td>
      </tr>
  </table>
</center>
</body>
</html>