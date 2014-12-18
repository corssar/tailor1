<?php ob_start();
global $lang;

?>

<div id="dynamicContentResults" class="dynamicContentResults">
<div id="DcResultsLoading"></div>
<table id="listDcTable" class="listDcTable">
	<tr>
		<?
		if(is_array($displayNames) && count($displayNames)>0)
		{
			foreach ($displayNames as $dName)
			{
				echo '<td>'.$dName.'</td>';
			}
		}
		?>
		<td style="background-color:#ccc;">&nbsp;</td>
	</tr>
	<?
	if(is_array($value) && count($value)>0)
	{
		$i=1;
		foreach ($value as $item)
		{
			echo "<tr>";
		  	foreach ($item['values'] as $k=>$v)
			{
		  		echo '<td>';
		  		if($k == 'dateStartVisible')
		  			$v = date("d-m-Y",$v);
		  		echo $v.'</td>';
		  	}
		  	echo '<td>
		  			<img src="templates/images/reply.gif" onclick="modalBox.open(\'ViewController\',\'\',   '.$rSearchViewId.','.$item['relatedField'].','.$fieldsArray.','.$i.','.$fieldId.');" border=0/><img src="img/item_delete.gif" onclick="removeDcItem('.$i.');" border=0/>
		  			<input type="hidden" name="view['.$fieldId.'][]" value="'.$item['relatedField'].'">
		  		  </td>
		  		</tr>';
		  	$i++;
		}
	} else {
		echo '<tr><td colspan='.(count($searchResultsHead)+1).'>No results found</td></tr>';
	}
	?>
</table>
</div>
<? 
$html = ob_get_contents();
ob_end_clean();
?>