<?php
include_once('../config.php');
include_once('config.php');
include('inc/BackendInit.inc.php');

/* ACTIONS */
	/* --- UPDATE ITEMS --- */
	if (isset($_POST['update']) && $_POST['update'])
	{
		//print_r($_POST['elements']);
		foreach ($_POST['elements'] as $lang_id=>$v)
		{
			foreach ($v as $key=>$value)
			{
				$value = get_magic_quotes_gpc()?str_replace('"', '&quot;',$value):addslashes(str_replace('"', '&quot;',$value));
				if (!$db->query('UPDATE `be_AdminLanguage` SET `key`=\''.$key.'\', `value`=\''.$value.'\' WHERE `langId`=\''.$lang_id.'\' AND `key`=\''.$key.'\''))
				$db->query('INSERT INTO `be_AdminLanguage` (`langId`, `key`, `value`) VALUES (\''.$lang_id.'\', \''.$key.'\', \''.$value.'\') ');
				//echo 'INSERT INTO `be_AdminLanguage` (`langId`, `key`, `value`) VALUES (\''.$lang_id.'\', \''.$key.'\', \''.$value.'\') '."\n";
				$status = 'Data was successfully updated';
			}
		}
	}
	/* --- ADDD NEW ITEM --- */
	if (isset($_POST['add']) && $_POST['add'])
	{
		$lang_id = intval($_POST['new']['lang']);
		$key 	 = get_magic_quotes_gpc()?trim(str_replace('"', '&quot;',$_POST['new']['key'])):trim(addslashes(str_replace('"', '&quot;',$_POST['new']['key'])));
		$value 	 = get_magic_quotes_gpc()?trim(str_replace('"', '&quot;',$_POST['new']['val'])):trim(addslashes(str_replace('"', '&quot;',$_POST['new']['val'])));
		if ($key!='' && $value!='')
		{
			$db->query('INSERT INTO `be_AdminLanguage` (`langId`, `key`, `value`) VALUES (\''.$lang_id.'\', \''.$key.'\', \''.$value.'\')');
			$status = 'New entry was successfully added';
		}
	}
	
	/* -- DELETE ITEM -- */
	if (isset($_POST['delete']) && !empty($_POST['delete']))
	{
		foreach ($_POST['delete'] as $k=>$v) 
		{
			$k = get_magic_quotes_gpc()?$k:addslashes($k);
			$db->query('DELETE FROM `be_AdminLanguage` WHERE `key`=\''.$k.'\'');
		}
	}
	
/*==================================================================================================== */



/* FILTER */
if (isset($_POST['filter']))
{
	$session->data['page'] = null;
	$s_key = (isset($_POST['key']) && trim($_POST['key'])!='')?' AND `key`=\''.$_POST['key'].'\'':'';
	$s_val = (isset($_POST['val']) && trim($_POST['val'])!='')?' AND `value` LIKE \'%'.$_POST['val'].'%\'':'';	
	$session->data['search'] = $search_condition = $s_key.$s_val;
}

$search_condition = (isset($session->data['search']) && $session->data['search'])?$session->data['search']:'';

/*==================================================================================================== */


/* PAGING */
$paging_limit = 10;
$paging_start = isset($_POST['page'])?((intval($_POST['page'])-1)*$paging_limit):(isset($session->data['page'])?($session->data['page']):0);
$session->data['page'] = $paging_start;

$db->query('SELECT COUNT(DISTINCT `key`) as total from `be_AdminLanguage` WHERE 1=1 '.$search_condition.'');
$paging_total = ceil($db->result[0]['total']/$paging_limit);

/*==================================================================================================== */


/* GET AVAILABLE LANGUAGES */
$db->query('SELECT * from `be_Languages`');
$available_lang = $db->result;
$available_lang_count = count($available_lang);
/*==================================================================================================== */


/* GET CURRENT KEYS */
$db->query('SELECT `key` from `be_AdminLanguage` WHERE 1=1 '.$search_condition.' GROUP BY `key` LIMIT '.$paging_start.','.$paging_limit);
	$current_keys_str 	 = '';
	$lang_elements_count = 0;
	foreach ($db->result as $row)
	{
		$lang_elements_count++;
		$current_keys_str .= '\''.$row['key'].'\',';
	}
	$current_keys_str{strlen($current_keys_str)-1} = '';
	$current_keys_str = trim($current_keys_str);
/*====================================================================================================*/

/* GET ELEMENTS */
foreach ($available_lang as $val)
{
	$db->query('SELECT * from `be_AdminLanguage` WHERE `langId`=\''.$val['id'].'\' AND `key` IN ('.$current_keys_str.')');	
	foreach ($db->result as $v)
	$lang_elements[$val['id']][$v['key']] = str_replace('"', '&quot;', $v['value']);
}

/*==================================================================================================== */


$session->close();
?>
<html>
	<head>
		<meta http-equiv=content-type content="text/html; charset=UTF-8">
	</head>
	<style>
		body
		{
			background-image:url('templates/images/admin_background.jpg');
		}
		form
		{
			margin:0px;
			padding:0px;
		}
		.table1
		{
			/*border: solid 1px #000;*/
			background-color:#fff;
			width:850px;
			height:100%;
		}
		.tablesearch
		{
			border: solid 1px #aaa;
			background: #000;
			width:90%;
			color:#aaa;
			font-weight:bold;
			font-size:12px;
		}
		.i_select
		{
			border: solid 1px #aaa;
			background:#eee;
		}
		.i_text
		{
			border: solid 1px #aaa;
			background:#eee;
		}
		.i_text2
		{
			border: solid 1px #aaa;
			background:#fff;
			width:99%;
		}
		.i_button
		{
			border: solid 1px #aaa;
			color:#000;
			background:#eee;
			cursor:pointer;
			font-size:12px;
			padding-top:0px;
			padding-bottom:0px;
			width:60px;
		}
		.i_button2
		{
			border: solid 1px #aaa;
			color:#000;
			background:#eee;
			cursor:pointer;
			font-size:12px;
			padding-top:0px;
			padding-bottom:0px;
			width:240px;
		}
		.languages
		{
			width:90%;
			height:470px;
			border:solid 1px #aaa;
			background:#eee;
			font-size:13px;
		}
		.thead
		{
			background:#888;
			height:20px;
			color:#ddf;
			font-weight:bold;
			font-size:14px;
		}
		.tbottom
		{
			background:#ccf;
			height:20px;
			color:#000;
			font-weight:bold;
			font-size:13px;
			border-top: solid 1px #aaa;
		}
		.delete_submit
		{
			background:url('templates/images/action_delete.gif'); 
			border:none; 
			font-size:0px; 
			color:#f00; 
			width:16px; 
			height:16px; 
			cursor:pointer;
		}
		.paging_button
		{
			border:none;
			background:transparent;
			font-weight:bold;
			font-size:12px;
			cursor:pointer;
			width:20px;
		}
	</style>
	<body>
		<center>
			<table border="0" class="table1">
				<tr valign="top">
					<td align="center">
						<h3>Admin Language Panel</h3>
						<table border="0" class="tablesearch">
							<tr valign="top">
								<td align="left" rowspan="2" nowrap><font size="3" color="Gray">Filter area</font></td>
								<td width="100%">&nbsp;</td>							
							</tr>
							<tr valign="middle">
								<td align="center">
									<form method="POST">
									Search by KEY: <input type="text" class="i_text" name="key">
									&nbsp;&nbsp;&nbsp;
									Search by VALUE: <input type="text" class="i_text" name="val">
									&nbsp;&nbsp;
									<input type="submit" value="Filter" name="filter" class="i_button"><br><br>
									</form>
								</td>
							</tr>
						</table>
						<center>
						<table width="90%" cellpadding="0" cellspacing="1">
							<tr>
							<td align="left">								
								<?php if ($status) {?> <font size="3" color="White" style="background:#696"><b>&nbsp; <?=$status?> &nbsp;</b></font> <?}?>
								&nbsp;
							</td>
							</tr>
						</table>
						</center>
						<form method="POST">						
						<table class="languages" border="0">
							<tr valign="top" class="thead">
								<?php foreach ($available_lang as $row){?>
								<td align="center" width="<?=floor(100/$available_lang_count)?>%"><?=$row['name']?></td>
								<?}?>
								<td align="center">&nbsp;</td>
							</tr>	
							<?php
								//die(print_r($available_lang, true));
								$keys_array = array();
								if (count($lang_elements))
								{
									foreach ($lang_elements as $l=>$l_array)
									{
										foreach ($l_array as $k=>$v) if (!in_array($k, $keys_array)) $keys_array[] = $k;
									}								
									
									foreach ($keys_array as $key)	
									{
										$tr=true;									
										foreach ($available_lang as $lang_row)
										{
										if ($tr) {echo '<tr valign="top">'; $tr = false;}
										if (isset($lang_elements[$lang_row['id']][$key]))
										{?>
											<td align="center"><?=$key?><br>
																<input type="text" class="i_text2" value="<?=$lang_elements[$lang_row['id']][$key]?>" <?php if (trim($lang_elements[$lang_row['id']][$key])=='') {?>style="border:solid 1px #f00 !important;"<?}?> name="elements[<?=$lang_row['id']?>][<?=$key?>]">
											</td>
										<?}
										else 
										{?>
											<td align="center"><?=$key?><br>
																<input type="text" class="i_text2" style="border:solid 1px #f00 !important;" name="elements[<?=$lang_row['id']?>][<?=$key?>]">
											</td>
										<?}
										}
										?><td><input type="submit" value="1" class="delete_submit" title="Delete" name="delete[<?=$key?>]" /></td></tr><?
									}
								}
								else 
								{?>
									<tr>
										<td colspan="30" align="center">
											<br><br><br>
											<h2>No items found ...</h2>
										</td>
									</tr>	
								<?}								
							?>	
							<tr valign="bottom">
								<td colspan="30" align="right" height="100%"><input type="submit" name="update" class="i_button2" value="Update data"></td>
							</tr>						
							<tr valign="middle">
								<td colspan="30" align="center" nowrap class="tbottom">
									<div style="float:left;">
										&nbsp;KEY <input type="text" class="i_text" name="new[key]">
										&nbsp;&nbsp;VALUE <input type="text" class="i_text" name="new[val]">
										&nbsp; LANG <select name="new[lang]" class="i_select">
																<?php
																	foreach ($available_lang as $lang)
																	{?>
																		<option value="<?=$lang['id']?>"><?=$lang['name']?></option>
																	<?}
																?>
														  </select>
										&nbsp;&nbsp;<input type="submit" value="Add" name="add" class="i_button">
									</div>
									<div style="float:right;padding-top:3px;">
										<?php for ($i=1; $i<=$paging_total; $i++ ) {?>
										<input type="submit" class="paging_button" name="page" value="<?=$i?>" />										
										<?}?>
										&nbsp;
									</div>
								</td>
							</tr>
						</table>
						</form>
					</td>
				</tr>			
			</table>
		</center>			
	</body>
</html>