<?php

class ProductList

{
    protected $db;

    protected $lang;
    protected $productsList = array();
    public $total_count;
    public $total_pages;

    private static $instance = null;

    function getInstance($lang)
    {
        if (self::$instance === null)
        {
            self::$instance = new ProductList($lang);
        }
        return self::$instance;
    }

    function __construct($lang)
    {
        $this->db = DB::getInstance();
        $this->lang = $lang;
    }

    public function getProductsList($countOnPage = 20, $currentPage = 1, $categoryId = 0, $sortField, $sortDirection, $countForPages)
    {
        $cache = new CacheFace();
        if($cacheData = $cache->get('productlist_content_'.$countOnPage.'_'.$countForPages.'_'.$currentPage.'_'.$categoryId.'_'.$sortField.'_'.$sortDirection.'_'.$countForPages)){
            $data = unserialize($cacheData);
            $this->total_count = $data['total_count'];
            $this->total_pages = $data['total_pages'];
            return $data['results'];
        }
        $category = "";
        if($categoryId > 0)
        {
            $query = "SELECT id FROM fe_ProductCategories
                      WHERE parentId = $categoryId";
            Context::DB()->query($query);
            $ids = "";
            foreach(Context::DB()->result as $item)
            {
                $ids .= "'{$item['id']}',";
            }

            $category = "AND `fe_Products`.`categoryId` in ($ids'$categoryId')";
        }

        if(!empty($sortField) && !empty($sortDirection))
        {
            $order = "ORDER BY $sortField $sortDirection";
        }
        else
        {
            $order = "ORDER BY `fe_Products`.`id` DESC";
        }
//   	$subCategory= $subCategoryId>0?"AND `fe_Products`.`number1` = $subCategoryId":"";
//    	$limit 		= $countOnPage>0?"LIMIT ".($pageNumber-1)*$countOnPage.",$countOnPage":"";
//      $start = abs((($currentPage - 1) * $countOnPage));
        $query="SELECT
					count(fe_Products.id) as productsCount
				FROM
				    `fe_Products`
				INNER JOIN `fe_ProductTranslations`
                    ON `fe_ProductTranslations`.`productId` = `fe_Products`.`id`
				WHERE
    				`fe_ProductTranslations`.`langId` = $this->lang
					$category";

        if ($this->db->query($query)){
            $this->total_count = $this->db->result[0]['productsCount'];
            $this->total_pages = ceil($this->total_count/$countOnPage);
            $startLimit = $currentPage != null && (int)$currentPage > 0 ? (int)($currentPage-1)*$countOnPage : 0;
        }
        $query="SELECT
					`fe_Products`.id as productId,
					`fe_Products`.codeName,
					`fe_Products`.title as name,
					`fe_Products`.price,
					`fe_Products`.oldPrice,
					`fe_Products`.imageSmall,
					`fe_Products`.image,
					`fe_Products`.itemNumber,
					`fe_Products`.number3 as quantity,
					`fe_Products`.dateStartVisible,
					fe_ProductVariations.id as variationId,
					`fe_ProductTranslations`.id as translateId,
					`fe_ProductTranslations`.masterPageId,
					`fe_ProductTranslations`.title as translateTitle,
					`fe_ProductTranslations`.shortDescription,
					`fe_ProductTranslations`.html,
					`fe_ProductTranslations`.seoTitle,
					`fe_ProductTranslations`.seoDescription,
					`fe_ProductTranslations`.seoKeywords,
					`fe_ProductImages`.imageSmall,
					`fe_ProductCategories`.id as categoryId,
					`fe_ProductCategoryTranslations`.title as categoryTitle,
					`fe_ProductCategoryTranslations`.description,
					`be_ListItems`.listItemName as brand,
					`be_View`.`className` as handler
				FROM
				    `fe_Products`
				LEFT JOIN `fe_ProductTranslations` ON `fe_ProductTranslations`.productId = `fe_Products`.id
                INNER JOIN `fe_ProductCategories` ON `fe_ProductCategories`.id = `fe_Products`.categoryId
                INNER JOIN `fe_ProductCategoryTranslations` ON `fe_ProductCategoryTranslations`.categoryId =`fe_ProductCategories`.id
                LEFT JOIN `fe_ProductImages` ON `fe_ProductImages`.`productId` = `fe_Products`.`id` AND `fe_ProductImages`.`orderNr` = 1
                INNER JOIN `be_ListItems` ON `be_ListItems`.`id` = `fe_Products`.`number1`
                INNER JOIN `be_View` ON `be_View`.viewId =`fe_Products`.viewId
                INNER JOIN fe_ProductVariations ON fe_ProductVariations.productId = `fe_Products`.id
				WHERE
    				`fe_ProductTranslations`.`langId` = $this->lang AND
    				`fe_ProductCategoryTranslations`.`langId` = $this->lang
    				$category
			    $order
                LIMIT $startLimit,".$countForPages;

        if ($this->db->query($query))
        {
            $this->prepareResultArray($this->db->result);

            $data = array('results'=>$this->productsList, 'total_count'=>$this->total_count, 'total_pages'=>$this->total_pages);
            $cache->save(serialize($data));
            return $this->productsList;
        }
        else
        {
            return array();
        }
    }

    public function getProductsSimpleList($categoryId = 0, $subCategoryId = 0)
    {
        $category 	= $categoryId>0?"AND `fe_Products`.`categoryId` = $categoryId":"";
        $subCategory= $subCategoryId>0?"AND `fe_Products`.`number1` = $subCategoryId":"";
//    	$start= $startDate>0?"AND `fe_Products`.`dateStartVisible` > $startDate":"";
        $query="SELECT
					`fe_Products`.*,
					`be_View`.`className` as handler
				FROM `fe_Products`
				INNER JOIN `be_View`
					ON `be_View`.`viewId` = `fe_Products`.`viewId`
				WHERE
    				`fe_Products`.`langId` = $this->lang
    				$category
    				$subCategory
				";

        if ($this->db->query($query))
        {
            $this->prepareResultArray($this->db->result);
            return $this->productsList;
        }
        else
        {
            return array();
        }
    }

    protected function prepareResultArray($dataIn)
    {
        $this->productsList = array();
        for($i=0;$i<count($dataIn);$i++)
        {
            $this->productsList[$i]['productId']		= $dataIn[$i]['productId'];
            $this->productsList[$i]['variationId']		= $dataIn[$i]['variationId'];
            $this->productsList[$i]['productTitle']		= $dataIn[$i]['name'];
            $this->productsList[$i]['categoryId']		= $dataIn[$i]['categoryId'];
            //$this->productsList[$i]['categoryTitle']	= $dataIn[$i]['categoryTitle'];
            $this->productsList[$i]['shortDescription']	= appUrl::CMSConstantsToValues($dataIn[$i]['shortDescription']);
            $this->productsList[$i]['html']				= appUrl::CMSConstantsToValues($dataIn[$i]['html']);
            $this->productsList[$i]['description']		= appUrl::CMSConstantsToValues($dataIn[$i]['description']);
            $this->productsList[$i]['smallImage']		= appUrl::CMSConstantsToValues($dataIn[$i]['imageSmall']);
            $this->productsList[$i]['image']			= appUrl::CMSConstantsToValues($dataIn[$i]['image']);
            $this->productsList[$i]['imageProductSmall']= appUrl::CMSConstantsToValues($dataIn[$i]['imageSmall']);
//			$this->productsList[$i]['imageTitle']		= appUrl::CMSConstantsToValues($dataIn[$i]['text4']);
//            $this->productsList[$i]['street']			= appUrl::CMSConstantsToValues($dataIn[$i]['text4']);
//            $this->productsList[$i]['contactInfo']		= appUrl::CMSConstantsToValues($dataIn[$i]['text5']);
            $this->productsList[$i]['productUrl']		= appUrl::getUrl($dataIn[$i]['productId'],$dataIn[$i]['handler'],$dataIn[$i]['codeName']);
//			$this->productsList[$i]['productfile']		= appUrl::CMSConstantsToValues($dataIn[$i]['text3']);
            $this->productsList[$i]['brand']		    = $dataIn[$i]['brand'];
            $this->productsList[$i]['price']            = $dataIn[$i]['price'];
            $this->productsList[$i]['oldPrice']         = $dataIn[$i]['oldPrice'];
//            $this->productsList[$i]['type']				= $dataIn[$i]['number1'];
            $this->productsList[$i]['quantity']			= $dataIn[$i]['quantity'];
            $this->productsList[$i]['itemNumber']		= $dataIn[$i]['itemNumber'];
            $this->productsList[$i]['date']				= $dataIn[$i]['dateStartVisible'];

        }
    }

    public function loadimage($inputFilename,$imageType,$newDimension)
    {
        $imagedata = getimagesize($inputFilename);
        $w = $imagedata[0];
        $h = $imagedata[1];

        if($w==$h)
        {
            $new_height = $newDimension;
            $new_width = $newDimension;
        }

        if ($h>$newDimension || $w>$newDimension)
        {
            if ( ( $h - ($h*0.1) ) > $w )
            {
                $new_height = $newDimension;
                $per   = ($new_height/$h);
                $new_width = floor($w*$per);
            }
            else
            {
                $new_width = $newDimension;
                $per   = ($new_width/$w);
                $new_height = floor($h*$per);
            }
        } else {
            $new_height = $h;
            $new_width = $w;
        }
        /*if ($h>800 || $w>600)
        {
            if ( ( $h - ($h*0.25) ) > $w )
            {
                $new_height = 600;
                $per   = ($new_height/$h);
                $new_width = floor($w*$per);
            }
            else
            {
                $new_width = 800;
                $per   = ($new_width/$w);
                $new_height = floor($h*$per);
            }
        }*/
        //$im1 = ImageCreateTrueColor($w, $h);
        $im2 = ImageCreateTrueColor($new_width, $new_height);

        $imageType = strtolower(substr($imageType,strpos($imageType,'/')+1,strlen($imageType)-strpos($imageType,'/')));
        switch ($imageType)
        {
            case 'gif': $image = @imagecreatefromgif($inputFilename); break;
            case 'bmp': $image = @imagecreatefromwbmp($inputFilename); break;
            case 'png': $image = @imagecreatefrompng($inputFilename); break;
            case 'jpg': $image = @imagecreatefromjpeg($inputFilename); break;
            case 'jpeg': $image = @imagecreatefromjpeg($inputFilename); break;
        }
        imagecopyResampled ($im2, $image, 0, 0, 0, 0, $new_width, $new_height, $w, $h);
        return $im2;
        /*imagecopyResampled ($im1, $image, 0, 0, 0, 0, $w, $h, $w, $h);
        imagecopyResampled ($im2, $image, 0, 0, 0, 0, $new_width, $new_height, $w, $h);
        $im_arr = array($im1,$im2);
        return $im_arr;*/
    }

    public function getProductPhoto ($productId)
    {
        $query = "SELECT imageSmall, image, imageBig
                  FROM fe_ProductImages
                  WHERE productId = $productId and viewId = 57";
        if (!Context::DB()->query($query))
            return null;

            $result = Context::DB()->result;
            $results = array();
            for ($i = 0;$i<count($result);$i++)
            {
                $results[$i]['image']				 = appUrl::checkUrl($result[$i]['image']);
                $results[$i]['imageSmall']			 = appUrl::checkUrl($result[$i]['imageSmall']);
                $results[$i]['imageBig']			 = appUrl::checkUrl($result[$i]['imageBig']);
            }
            return $results;
    }
    public function getColorAndSize($productId)
    {
        $query = "SELECT pv.*, pSize.title as size, pColor.title as colorTitle, pColor.colorCode
                  FROM fe_Products
                      INNER JOIN fe_ProductVariations pv ON fe_Products.id = pv.productId
                      INNER JOIN fe_ProductAttributeItems pSize ON pv.attribute1ValueId = pSize.id
                      INNER JOIN fe_ProductAttributeItems pColor ON pv.attribute2ValueId = pColor.id
                  WHERE productId = $productId";
        if (!Context::DB()->query($query))
            return null;

        $result = Context::DB()->result;
        $results = array();
        for ($i = 0;$i<count($result);$i++)
        {
            $results[$result[$i]['colorTitle']]['color']=$result[$i]['colorCode'];
            $results[$result[$i]['colorTitle']]['title']=$result[$i]['colorTitle'];
            $results[$result[$i]['colorTitle']]['data'][$result[$i]['size']] =$result[$i];
            //$results[$result[$i]['colorTitle']][$result[$i]['colorCode']][$result[$i]['size']]				 = $result[$i];
        }
        return $results;
    }

}