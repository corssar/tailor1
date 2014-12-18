<?php

class ProductVariations
{
	public $lang;
	public $db;
	private $mainProductCodeName = '';
	
	private static $instance = null;
	
	function __construct()
	{
		global $lang;
		$this->lang = $lang;
		$this->db 	= DB::getInstance();
	}
	
	function getInstance() 
	{		
		if (self::$instance === null) 
		{
			self::$instance = new ProductVariations();
		}
		return self::$instance;				
	}
	
	public function buildVariationsManager()
	{
		$html.='
				<form name="variationsItemsArray" id="variationsItemsArray" method="POST">
					<div id="addAttributeType">
						<select name="addAttributeType" onchange="addVariation(this.value);">
							<option value="">'.$this->lang['SELECT_VARIATION_ADDITION_TYPE'].'</option>
							<option value="exist">'.$this->lang['VARIATION_ADDITION_EXIST'].'</option>
							<option value="new">'.$this->lang['VARIATION_ADDITION_NEW'].'</option>
						</select>
					</div>
					<div id="existingVariation" style="display:none;">
						<div class="variationsDescription">
							'.$this->lang['SELECT_VARIATION'].'
							<div class="description">'.$this->lang['SELECT_VARIATION_DESCRIPTION'].'</div>
						</div>
						<div class="variationsContainer">
							<select id="variationSelectList" name="variations" onchange="navigation.sendRequest(\'ViewController\',\'getVariationItems\',{variationId:this.value},\'variationItemsContainer\',\'loaderVariationsAction\');">
								<option value="" selected></option>';
					foreach ($this->getVariationsList() as $variation)
					{
						$html.='<option value="'.$variation['id'].'">'.$variation['name'].'</option>';
					}
					$html.= '</select>
							<div id="variationItemsContainer"></div>
						</div>
					</div>
					<div id="newVariation" style="display:none;">
						<div class="variationsDescription">'.$this->lang['NEW_VARIATION_NAME'].'</div>
						<div class="variationsContainer">
							<input type="text" name="newVariationName" id="newVariationName" size="10"  style="width:250px;">
						</div>
						<div class="variationsDescription">'.$this->lang['NEW_VARIATION_ITEM'].'</div>
						<div class="variationsContainer">
							<input type="text" size="10" id="newVariationItemName" style="width:175px;">&nbsp;<input type="button" class="button" value="'.$this->lang['ADD'].'" onclick="mpVariationItems.foundToSelect(document.getElementById(\'newVariationItemName\').value,document.getElementById(\'newVariationItemName\').value);">
						</div>
						<div class="variationsDescription">
							'.$this->lang['NEW_VARIATION_ITEMS'].'
							<div class="description">'.$this->lang['ADD_VARIATION_ITEM_DESCRIPTION'].'</div>
						</div>
						<div class="variationsContainer">
							<select name="newVariationItems[]" id="newVariationItems" multiple size="10" style="width:250px;"></select>
							<div>
								<img src="webcontent/img/item_up.gif" 		onclick="mpVariationItems.upOption();"		class="cursor" border="0" />
								<img src="webcontent/img/item_down.gif" 	onclick="mpVariationItems.downOption();"	class="cursor" border="0" />
								<img src="webcontent/img/item_delete.gif" 	onclick="mpVariationItems.removeItem();"	class="cursor" border="0" />
							</div>
						</div>
						<div id="loaderVariationsAction" style="display:none;"></div>
					</div>
				</form>';
		return $html;
	}
	
	public function getVariationsList()
	{
		$query = "	SELECT
						*
					FROM
						fe_ProductVariations
					WHERE
						1
					ORDER BY
						id
					ASC ";
		if($this->db->query($query))
		{
			return $this->db->result;
		}
		return array();
	}
	
	public function buildVariationsItems($variationId)
	{
		$html ='<ul id="variationItemsList">';
		foreach ($this->getVariationsItemsList($variationId) as $variationItem)
		{
			$html.='<li><input type="checkbox" name="existVariationsItems['.$variationItem['id'].']">'.$variationItem['variationItemName'].'</li>';
		}
		$html.='</ul>';
		$html.=$variationId?'<input type="text" name="newVariationItemName" id="newVariationItemName" style="width:135px;"><input type="button" class="button" value="'.$this->lang['ADD'].'" onclick="if(document.getElementById(\'newVariationItemName\').value)navigation.sendRequest(\'ViewController\',\'addVariationItem\',{newVariationItemName:document.getElementById(\'newVariationItemName\').value,variationId:'.$variationId.'},\'loaderVariationsAction\',\'loaderVariationsAction\');"/>':'';
		return $html;
	}
	
	public function addVariationItem($variationId,$newVariationItemName)
	{
		$this->db->query("INSERT INTO `fe_ProductVariationsItems` (`variationId`,`variationItemName`) VALUES ('$variationId','$newVariationItemName');");
		$js = 'var li = document.createElement(\'LI\');li.innerHTML = \'<input type="checkbox" name="existVariationsItems['.$this->db->LIID.']">'.$newVariationItemName.'\';document.getElementById(\'variationItemsList\').appendChild(li)';
		return $js;
	}
	
	public function getVariationsItemsList($variationId)
	{
		global $lang;
		$query = "	SELECT
						*
					FROM
						fe_ProductVariationsItems
					WHERE
						variationId = $variationId
					ORDER BY
						id
					ASC ";
		if($this->db->query($query))
		{
			return $this->db->result;
		}
		return array();
	}
	
	public function addProductVariation($arrayItems,$variationNumber)
	{
		if($arrayItems['addAttributeType'] == 'new')
		{
			if($this->db->query("INSERT INTO `fe_ProductVariations` (`name`) VALUES ('{$arrayItems['newVariationName']}')"))
			{
				$newVariationId = $this->db->LIID;
				$newVariationItemsQuery = '';
				$response['html'].= '<ul class="variationName">'.$arrayItems['newVariationName'].'<img src="webcontent/img/reply.gif" onclick="variationsBox.open('.$variationNumber.');" class="cursor" border="0" align="absmiddle" />&nbsp;<img src="webcontent/img/item_delete.gif" onclick="variationDelete('.$variationNumber.');" class="cursor" border="0" align="absmiddle" />';
				for($i=0; $i<count($arrayItems['newVariationItems']); $i++)
				{
					$this->db->query("INSERT INTO `fe_ProductVariationsItems` (`variationId`,`variationItemName`) VALUES ('$newVariationId','{$arrayItems['newVariationItems'][$i]}');");
					$itemsIDs.= $this->db->LIID.',';
					$response['html'].= '<li class="variationItem">'.$arrayItems['newVariationItems'][$i].'</li>';
				}
				$response['html'].= '</ul>';
				$itemsIDs = substr($itemsIDs,0,-1);
			}
		}
		elseif($arrayItems['addAttributeType'] == 'exist')
		{
			if($this->db->query("SELECT `fe_ProductVariations`.`name` FROM `fe_ProductVariations` WHERE `fe_ProductVariations`.`id` = '{$arrayItems['variations']}'"))
			{
				$response['html'].= '<ul class="variationName">'.$this->db->result[0]['name'].'<img src="webcontent/img/reply.gif" onclick="variationsBox.open('.$variationNumber.');" class="cursor" border="0" align="absmiddle" />&nbsp;<img src="webcontent/img/item_delete.gif" onclick="variationDelete('.$variationNumber.');" class="cursor" border="0" align="absmiddle" />';
				foreach ($arrayItems['existVariationsItems'] as $key=>$value)
				{
					if(strtolower($value) == 'on')
						$itemsIDs.= $key.',';
				}
				$itemsIDs = substr($itemsIDs,0,-1);
				if($this->db->query("SELECT `fe_ProductVariationsItems`.`variationItemName` FROM `fe_ProductVariationsItems` WHERE `fe_ProductVariationsItems`.`id` IN (".$itemsIDs.")"))
				{
					foreach ($this->db->result as $item)
					{
						$response['html'].= '<li class="variationItem">'.$item['variationItemName'].'</li>';
					}
				}
				$response['html'].= '</ul>';
			}
		}
		else 
			return;
		$response['js'] = "document.getElementById('variations$variationNumber').value = '$itemsIDs';";
		return $response;
	}
	
	public function createVariatedProducts($productId,$IDs)
	{
		$this->db->query("UPDATE `fe_Products` SET `variationId` = $productId WHERE `id` = $productId");
		
		$query = "	SELECT 
						`fe_ProductVariations`.`id` as variationId ,
						`fe_ProductVariations`.`name` ,
						`fe_ProductVariationsItems`.`id` as variationItemId
					FROM 
						`fe_ProductVariations`
					INNER JOIN
						`fe_ProductVariationsItems`
						ON 
						(
							`fe_ProductVariationsItems`.`id` IN (".$IDs.")
						)
					WHERE 
						`fe_ProductVariations`.`id` = `fe_ProductVariationsItems`.`variationId`
					GROUP BY 
						`fe_ProductVariations`.`id`
					ORDER BY
						`fe_ProductVariations`.`id`,`fe_ProductVariationsItems`.`variationId`
					ASC
					";
		
		if($this->db->query($query) && count($this->db->result)>0)
		{
			$variations = $this->db->result;
		}
		
		$varItemsIDs = asort(explode(',',$IDs));
		$variationsANDitems = array();
		for($i=0;$i<count($variations);$i++)
		{
			$this->db->query("SELECT id FROM `fe_ProductVariationsItems` WHERE `variationId` = {$variations[$i]['variationId']} AND `id` IN ($IDs) ORDER BY `id` ASC");
			
			for($j=0;$j<count($this->db->result);$j++)
			{
				$variationsANDitems[$i][$j] = $this->db->result[$j]['id'];
			}
		}
		
		for($i=0;$i<count($variationsANDitems[0]);$i++)
		{
			if(count($variationsANDitems)>1)
			{
				for($j=0;$j<count($variationsANDitems[1]);$j++)
				{
					if(count($variationsANDitems)>2)
					{
						for($k=0;$k<count($variationsANDitems[2]);$k++)
						{
							if($i==0 && $j==0 && $k==0)
								$this->db->query("UPDATE `fe_Products` SET `variation1` = '{$variationsANDitems[0][$i]}',`variation2` = '{$variationsANDitems[1][$j]}',`variation3` = '{$variationsANDitems[2][$k]}' WHERE id = $productId");
							else
							{
								$this->db->query("INSERT INTO `fe_Products` (`langId`,`viewId`,`masterPageId`,`seo1`,`seo2`,`visible`,`introHtml`,`outroHtml`,`categoryId`,`title`,`html`,`shortDescription`,`price`,`dateStartVisible`,`dateEndVisible`,`text1`,`text2`,`text3`,`text4`,`text5`,`number1`,`number2`,`number3`,`number4`) 
																SELECT `langId`,`viewId`,`masterPageId`,`seo1`,`seo2`,`visible`,`introHtml`,`outroHtml`,`categoryId`,`title`,`html`,`shortDescription`,`price`,`dateStartVisible`,`dateEndVisible`,`text1`,`text2`,`text3`,`text4`,`text5`,`number1`,`number2`,`number3`,`number4` FROM `fe_Products` WHERE `fe_Products`.`id` = $productId");
								$codeName = $this->generateProductPrefix($this->db->LIID).$this->mainProductCodeName;
								$this->db->query("UPDATE `fe_Products` SET `codeName` = '$codeName',`variationId` = $productId, `variation1` = '{$variationsANDitems[0][$i]}', `variation2` = '{$variationsANDitems[1][$j]}', `variation3` = '{$variationsANDitems[2][$k]}' WHERE `id` = {$this->db->LIID}");
							}
						}
					}
					else 
					{
						if($i==0 && $j==0)
							$this->db->query("UPDATE `fe_Products` SET `variation1` = '{$variationsANDitems[0][$i]}',`variation2` = '{$variationsANDitems[1][$j]}' WHERE id = $productId");
						else
						{
							$this->db->query("INSERT INTO `fe_Products` (`langId`,`viewId`,`masterPageId`,`seo1`,`seo2`,`visible`,`introHtml`,`outroHtml`,`categoryId`,`title`,`html`,`shortDescription`,`price`,`dateStartVisible`,`dateEndVisible`,`text1`,`text2`,`text3`,`text4`,`text5`,`number1`,`number2`,`number3`,`number4`) 
															SELECT `langId`,`viewId`,`masterPageId`,`seo1`,`seo2`,`visible`,`introHtml`,`outroHtml`,`categoryId`,`title`,`html`,`shortDescription`,`price`,`dateStartVisible`,`dateEndVisible`,`text1`,`text2`,`text3`,`text4`,`text5`,`number1`,`number2`,`number3`,`number4` FROM `fe_Products` WHERE `fe_Products`.`id` = $productId");
							$codeName = $this->generateProductPrefix($this->db->LIID).$this->mainProductCodeName;
							$this->db->query("UPDATE `fe_Products` SET `codeName` = '$codeName',`variationId` = $productId, `variation1` = '{$variationsANDitems[0][$i]}', `variation2` = '{$variationsANDitems[1][$j]}' WHERE `id` = {$this->db->LIID}");
						}
					}
				}
			}
			else 
			{
				if($i==0)
					$this->db->query("UPDATE `fe_Products` SET `variation1` = '{$variationsANDitems[0][$i]}' WHERE id = $productId");
				else
				{
					$this->db->query("INSERT INTO `fe_Products` (`langId`,`viewId`,`masterPageId`,`seo1`,`seo2`,`visible`,`introHtml`,`outroHtml`,`categoryId`,`title`,`html`,`shortDescription`,`price`,`dateStartVisible`,`dateEndVisible`,`text1`,`text2`,`text3`,`text4`,`text5`,`number1`,`number2`,`number3`,`number4`) 
										SELECT `langId`,`viewId`,`masterPageId`,`seo1`,`seo2`,`visible`,`introHtml`,`outroHtml`,`categoryId`,`title`,`html`,`shortDescription`,`price`,`dateStartVisible`,`dateEndVisible`,`text1`,`text2`,`text3`,`text4`,`text5`,`number1`,`number2`,`number3`,`number4` FROM `fe_Products` WHERE `fe_Products`.`id` = $productId");
					$codeName = $this->generateProductPrefix($this->db->LIID).$this->mainProductCodeName;
					$this->db->query("UPDATE `fe_Products` SET `codeName` = '$codeName',`variationId` = $productId, `variation1` = '{$variationsANDitems[0][$i]}' WHERE `id` = {$this->db->LIID}");					
				}
			}
		}
	}
	
	public function isRelatedProduct($productId)
	{
		global $lang;
		$query = "	SELECT
						`fe_Products`.`variationId`
					FROM
						`fe_Products`
					WHERE
						`fe_Products`.`id` = $productId
					";
		if($this->db->query($query))
		{
			if($this->db->result[0]['variationId'] && $this->db->result[0]['variationId']!='')
				return true;
		}
		return false;
	}
	
	public function getRelatedVariatedProducts($productId)
	{
		global $lang;
		
		$query = "	SELECT 
						`fe_Products`.*,
						variation1.name as variationName1,
						variation2.name as variationName2,
						variation3.name as variationName3,
						variationItem1.variationItemName as variationItemName1,
						variationItem2.variationItemName as variationItemName2,
						variationItem3.variationItemName as variationItemName3
					FROM
						`fe_Products`
					LEFT JOIN
						`fe_ProductVariationsItems` as variationItem1 ON variationItem1.id = `fe_Products`.variation1
					LEFT JOIN
						`fe_ProductVariationsItems` as variationItem2 ON variationItem2.id = `fe_Products`.variation2
					LEFT JOIN
						`fe_ProductVariationsItems` as variationItem3 ON variationItem3.id = `fe_Products`.variation3
					LEFT JOIN
						`fe_ProductVariations` as variation1 ON	variation1.id = variationItem1.variationId
					LEFT JOIN
						`fe_ProductVariations` as variation2 ON	variation2.id = variationItem2.variationId
					LEFT JOIN
						`fe_ProductVariations` as variation3 ON	variation3.id = variationItem3.variationId
					WHERE
						`fe_Products`.`id` = $productId ";
		if($this->db->query($query))
		{
			$html.='<tr valign="top">
						<td class="fieldNameContainer">'.$this->lang['CURR_PRODUCT_ATTRIBUTES'].':</td>
						<td class="fieldHtmlContainer">';
							for ($i=1; $i<=3; $i++)
							{
								if($this->db->result[0]['variationItemName'.$i])
								{
									$variations[$this->db->result[0]['variationName'.$i]] = $this->db->result[0]['variationItemName'.$i];
									$html.= '<div style="font-size:11px;"><b>'.$this->db->result[0]['variationName'.$i].'</b> : '.$this->db->result[0]['variationItemName'.$i].'</div>';
								}
							}
			$html.='	</td>						
					</tr>';
		}
		
		$query = "	SELECT 
						`fe_Products`.*,
						variationItem1.variationItemName as variationItemName1,
						variationItem2.variationItemName as variationItemName2,
						variationItem3.variationItemName as variationItemName3
					FROM
						`fe_Products`
					LEFT JOIN
						`fe_ProductVariationsItems` as variationItem1
						ON	
							variationItem1.id = `fe_Products`.variation1
					LEFT JOIN
						`fe_ProductVariationsItems` as variationItem2
						ON	
							variationItem2.id = `fe_Products`.variation2
					LEFT JOIN
						`fe_ProductVariationsItems` as variationItem3
						ON	
							variationItem3.id = `fe_Products`.variation3
					INNER JOIN 
						`fe_Products` as product
						ON product.id = $productId
					WHERE
						`fe_Products`.`variationId` = product.variationId
						
					ORDER BY 
						`fe_Products`.`id`
					ASC";
		if($this->db->query($query))
		{
			$html.= '<tr valign="top">
							<td class="fieldNameContainer">'.$this->lang['RELATED_PRODUCTS'].':<div id="ebannuyIndicator"></div></td>
							<td class="fieldHtmlContainer">
								<table style="font-size:11px;width:100%;">';
									$html.='<tr><td><b>'.$this->lang['PRODUCT_NAME'].'</b></td>';
								foreach ($variations as $key=>$value)
								{
									$html.='<td><b>'.$key.'</b></td>';
								}
									$html.='</tr>';
						for ($i=0; $i<count($this->db->result);$i++)
						{
							if($this->db->result[$i]['id'] == $productId) continue;
							$action = $this->db->result[$i]['visible']==1?'make inactive':'make active';
							$html.='<tr>
										<td>'.$this->db->result[$i]['title'].'</td>
										<td>'.$this->db->result[$i]['variationItemName1'].'</td>
										<td>'.$this->db->result[$i]['variationItemName2'].'</td>
										<td>'.$this->db->result[$i]['variationItemName3'].'</td>
										<td>
											<!--<input type="button" id="actbtn'.$this->db->result[$i]['id'].'" value="'.$action.'" onclick="navigation.sendRequest(\'ViewController\',\'variatedProductsStatusChange\',{productId:'.$this->db->result[$i]['id'].',productStatus:'.$this->db->result[$i]['visible'].'},\'ebannuyIndicator\',\'ebannuyIndicator\');">-->
										</td>
									</tr>';
						}
			$html.= '			</table>
							</td>
						</tr>';
		}
		return $html;
	}
	
	public function generateProductPrefix($productId)
	{
		$position = 6;
		$retStr = $productId."";
		$strLen = strlen($retStr);
		for ($i = 0; $i<($position-$strLen); $i++)
		{
			$retStr = '0'.$retStr;
		}
		return PRODUCT_PREFIX.$retStr;
	}
	
	public function setMainProductCodeName($productId)
	{
		$query = "	SELECT
						`fe_Products`.`codeName`
					FROM
						`fe_Products`
					WHERE
						`fe_Products`.`id` = $productId
					";
		if($this->db->query($query))
		{
			$this->mainProductCodeName = $this->db->result[0]['codeName'];
		}
		$this->db->query("UPDATE `fe_Products` SET `codeName` = concat('".$this->generateProductPrefix($productId)."',codeName) WHERE id = $productId");
	}
}

?>