<?php ob_start();?>
<div>
	<div>
		<FORM name="<?=$this->formName?>" id="<?=$this->formId?>">
		<?	foreach ($this->groups as $group)	{ ?>
			<div id="tabHead<?=$this->formId.'_'.$this->tabsCount?>" onclick="switchTab(<?=$this->formId.','.$this->tabsCount?>);">
				<span style="margin-bottom:4px;"><?=$group['groupName']?></span>
			</div>
			
			<div id="tabContainer<?$this->formId.'_'.$this->tabsCount?>">
				<table>
				<?	foreach ($this->fields['groupId'][$group['groupId']] as $beField) 
				{
					if($beField['visible'] == 1)
					{
					?>
						<tr valign="top" id="<?=$beField['fieldId']?>FieldContainer">
							<td style="border: 0px; padding:5px;font-weight:bold;font-size:12px;font-family:Tahoma,Verdana,Arial;width:150px;">
								<?=$beField['displayName']?>
							</td>
							<td style="border: 0px;width:400px; padding:5px;">
								<?=$this->createField($beField);?>
							</td>
						</tr>
				  <?} else {
				  		echo $this->createField($beField);
				  	}
				}
				  
				$this->tabsCount++;
				?>
				</table>
			</div>
		<?}?>
		</FORM>
	</div>
</div>
<? 
$html = ob_get_contents();
ob_end_clean(); 
?>