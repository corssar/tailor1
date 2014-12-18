<?php
function blindAddSlashesRecursive(&$array)
{
	if (is_array($array))
	{
		foreach ($array as $k=>$v)
			{
				if (is_array($v))
				     blindAddSlashesRecursive($array[$k]);		   
				else $array[$k] = addslashes(trim($v));
			}
	}
	else $array = addslashes(trim($array));
}

function trimArray(&$array)
{
	if (is_array($array))
	{
		foreach ($array as $k=>$v)
			{
				if (is_array($v))
				     blindAddSlashesRecursive($array[$k]);		   
				else $array[$k] = trim($v);
			}
	}
	else $array = trim($array);
}

function noTagsRecursive(&$array)
{
	if (is_array($array))
	{
		foreach ($array as $k=>$v)
			{
				if (is_array($v))
				     noTagsRecursive($array[$k]);		   
				else $array[$k] = htmlentities($v, ENT_QUOTES);
			}
	}
	else $array = htmlentities($array, ENT_QUOTES);
}

function prepare(&$array)
{
	if (!get_magic_quotes_gpc())
	{
		blindAddSlashesRecursive($array);
	}
	else trimArray($array);
}

function WL_redirect($url)
{
	header('Location: '.$url);
	die('<script>document.location=\''.$url.'\'</script>');
}
/*
function checkArrayValues($array, $keys=false)
{
	while (list($k, $v) = each($array))
	{
		switch (current($keys))
		{
			case 'text'		: if (!$v) return $k;
				break;
			case 'int'		: if (!is_int($v)) return $k;
				break;
			case 'num'  	: if (!is_numeric($v)) return $k;
				break;
			case 'email'	: if (!preg_match( "/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+(\.)([a-zA-Z0-9\._-]+)+$/", $v)) return $k;
				break;
		}
		next($keys);
	}
	return true;
}
*/
?>