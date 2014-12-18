<?

class ProductSearch
{
    protected $lang;

    var $searchResultItems = array();
    public $total_count;
    public $total_pages;

    function __construct($lang)
    {
        $this->lang = $lang;
    }

    public function searchLikeKeyWord($keyWord, $sortField, $sortDirection, $countOnPage = 20, $currentPage = 1, $start, $countForPages, $filter=null)
    {
        $filterParams = $filter!=null?' AND '.$filter:'';
        if(!empty($sortField) && !empty($sortDirection)){
            $order = "ORDER BY $sortField $sortDirection";
        }else{
            $order = "ORDER BY `fe_Products`.`id` DESC";
        }
//        $start = abs((($currentPage - 1) * $countOnPage));
        $query = "SELECT
					/*fe_Products.price,
					fe_Products.oldPrice,
					fe_Products.imageSmall,
					fe_Products.image,
					fe_Products.itemNumber,
					fe_Products.number3 as quantity,
					fe_Products.dateStartVisible,
					fe_ProductTranslations.id as translateId,
					fe_ProductTranslations.masterPageId,
					fe_ProductTranslations.html,
					fe_ProductTranslations.seoTitle,
					fe_ProductTranslations.seoDescription,
					fe_ProductTranslations.seoKeywords,
					fe_ProductCategories.id as categoryId,
					fe_ProductCategoryTranslations.title as categoryTitle,
					fe_ProductCategoryTranslations.description,*/
                    SQL_CALC_FOUND_ROWS
					fe_Products.id as productId,
					fe_Products.oldPrice as oldPrice,
					fe_Products.price as price,
					fe_Products.imageSmall as imageSmall,
					fe_Products.codeName,
					fe_Products.title as name,
					fe_ProductTranslations.title as translateTitle,
					fe_ProductTranslations.shortDescription,
					fe_ProductCategories.id as categoryId,
					fe_ProductCategoryTranslations.title as categoryTitle,
					fe_ProductImages.imageSmall as imageProductSmall,
					be_ListItems.listItemName as brand,
					be_Languages.code as langCode,
					be_View.className as handler
				FROM    fe_Products
				INNER JOIN fe_ProductTranslations ON fe_ProductTranslations.productId = fe_Products.id
                INNER JOIN fe_ProductCategories ON fe_ProductCategories.id = fe_Products.categoryId
                INNER JOIN fe_ProductCategoryTranslations ON fe_ProductCategoryTranslations.categoryId = fe_ProductCategories.id
                LEFT JOIN fe_ProductImages ON fe_ProductImages.productId = fe_Products.id AND fe_ProductImages.orderNr = 1
                INNER JOIN be_ListItems ON be_ListItems.id = fe_Products.number1
                INNER JOIN be_View ON be_View.viewId =fe_Products.viewId
                INNER JOIN be_Languages ON be_Languages.id = $this->lang
				WHERE
    				fe_ProductTranslations.langId = 3 AND
    				fe_ProductCategoryTranslations.langId = 3 AND
						(fe_Products.title like ('%$keyWord%') OR
						 fe_ProductTranslations.shortDescription like ('%$keyWord%') OR
						 fe_ProductCategoryTranslations.title like ('%$keyWord%') OR
						 be_ListItems.listItemName like ('%$keyWord%'))
				$order
				LIMIT $start,$countForPages";


        if(Context::DB()->query($query))
        {
            $result = Context::DB()->result;
            $query = "SELECT FOUND_ROWS() as count";
            Context::DB()->query($query);

            $this->total_count = Context::DB()->result[0]['count'];
            $this->total_pages = ceil($this->total_count/$countOnPage);

            $i = 0;
            foreach ($result as $item)
            {
                $this->searchResultItems[$i]['productTitle'] 				= $item['translateTitle'];
                $this->searchResultItems[$i]['oldPrice'] 				= $item['oldPrice'];
                $this->searchResultItems[$i]['price'] 				= $item['price'];
                $this->searchResultItems[$i]['smallImage'] 			= appUrl::CMSConstantsToValues($item['imageSmall']);
                $this->searchResultItems[$i]['imageProductSmall'] 	= appUrl::CMSConstantsToValues($item['imageProductSmall']);
                $this->searchResultItems[$i]['brand'] 			= $item['brand'];
                $this->searchResultItems[$i]['productUrl'] 			= appUrl::getUrl($item['langCode'],$item['handler'],$item['codeName']);
                $i++;
            }
            return true;
        }
        return false;
    }



    public function OLD_searchLikeKeyWord($keyWord)
    {
        $i=0;
        $query = "	SELECT
						fe_Pages.id,
						fe_Pages.title,
						fe_Pages.shortDescription,
						fe_Pages.text1,
						fe_Pages.dateStartVisible,
						be_View.className
					FROM
						fe_Pages
					INNER JOIN
						be_View
						ON be_View.viewId = fe_Pages.viewId AND be_View.viewType = 1
					WHERE
						(fe_Pages.title like ('%$keyWord%') OR fe_Pages.shortDescription like ('%$keyWord%'))
						AND fe_Pages.langId = $this->lang
					ORDER BY id DESC";
        if(Context::DB()->query($query))
        {
            foreach (Context::DB()->result as $item)
            {
                $this->searchResultItems[$i]['title'] 				= $item['title'];
                $this->searchResultItems[$i]['shortDescription'] 	= $item['shortDescription'];
                $this->searchResultItems[$i]['image'] 				= appUrl::CMSConstantsToValues($item['text1']);
                $this->searchResultItems[$i]['date']				= $item['dateStartVisible'];
                $this->searchResultItems[$i]['pageUrl'] 			= appUrl::getUrl($item['id'],$item['className']);
                $i++;
            }
        }

        $query = "	SELECT
						fe_ProductsCategories.id,
						fe_ProductsCategories.title,
						be_View.className
					FROM
						fe_ProductsCategories
					INNER JOIN
						be_View
						ON be_View.viewId = fe_ProductsCategories.viewId
					WHERE
						fe_ProductsCategories.title like ('%$keyWord%') AND fe_ProductsCategories.langId = $this->lang
					ORDER BY fe_ProductsCategories.id DESC";
        if(Context::DB()->query($query))
        {
            foreach (Context::DB()->result as $item)
            {
                $this->searchResultItems[$i]['title'] 				= $item['title'];
                $this->searchResultItems[$i]['pageUrl'] 			= appUrl::getUrl($item['id'],$item['className']);
                $i++;
            }
        }

        $query = "	SELECT
						fe_Products.id,
						fe_Products.title,
						be_View.className
					FROM
						fe_Products
					INNER JOIN
						be_View
						ON be_View.viewId = fe_Products.viewId
					WHERE
						(fe_Products.title like ('%$keyWord%') OR fe_Products.shortDescription like ('%$keyWord%'))
						AND fe_Products.langId = $this->lang
					ORDER BY id DESC";
        if(Context::DB()->query($query))
        {
            foreach (Context::DB()->result as $item)
            {
                $this->searchResultItems[$i]['title'] = $item['title'];
                $this->searchResultItems[$i]['pageUrl'] = appUrl::getUrl($item['id'],$item['className']);
                $i++;
            }
        }


        if($i)
            return true;
        else
            return false;
    }
    /*$query = "	SELECT
                        fe_Pages.id,
                        fe_Pages.title,
                        fe_Products.id as pId,
                        fe_Products.title p,
                        fe_ProductsCategories.id cId,
                        fe_ProductsCategories.title c,
                        be_View.className
                    FROM
                        fe_Pages
                    INNER JOIN
                        fe_ProductsCategories
                        ON
                        (
                            fe_ProductsCategories.title like ('%$keyWord%')
                        )
                        AND fe_ProductsCategories.langId = $this->lang
                    INNER JOIN
                        fe_Products
                        ON
                        (
                            fe_Products.title like ('%$keyWord%') OR fe_Products.shortDescription like ('%$keyWord%')
                        )
                        AND fe_Products.langId = $this->lang
                    INNER JOIN
                        be_View
                        ON
                        (
                            be_View.viewId = fe_Pages.viewId OR be_View.viewId = fe_ProductsCategories.viewId OR be_View.viewId = fe_Products.viewId
                        )
                        AND be_View.viewType = 1
                    WHERE
                        (
                            fe_Pages.title like ('%$keyWord%') OR fe_Pages.shortDescription like ('%$keyWord%')
                        )
                        AND fe_Pages.langId = $this->lang
                    ";*/
}


?>