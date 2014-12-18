<?

class Search
{
	protected $lang;
	
	var $searchResultItems = array();
	
	function __construct($lang)
	{
		$this->lang = $lang;
	}

	public function searchLikeKeyWord($keyWord, $filter=null)
	{
		$filterParams = $filter!=null?' AND '.$filter:'';
		$query = "	SELECT
						fe_Pages.id,
						fe_Pages.codeName,
						fe_Pages.title,
						fe_Pages.shortDescription,
						fe_Pages.seo1,
						fe_Pages.introHtml,
						fe_Pages.html,
						fe_Pages.dateStartVisible,
						be_View.className,
						be_Languages.code as langCode
					FROM
						fe_Pages
					INNER JOIN
						be_View
						ON be_View.viewId = fe_Pages.viewId AND be_View.viewType = 1
					LEFT JOIN be_Languages ON
							be_Languages.id = fe_Pages.langId
					WHERE
						(fe_Pages.title like ('%$keyWord%') OR 
						 fe_Pages.shortDescription like ('%$keyWord%') OR 
						 fe_Pages.introHtml like ('%$keyWord%') OR
						 fe_Pages.html like ('%$keyWord%') OR
						 fe_Pages.seo1 like ('%$keyWord%'))
						AND fe_Pages.langId = $this->lang $filterParams
					ORDER BY id DESC";

		if(Context::DB()->query($query))
		{
            $i = 0;
			foreach (Context::DB()->result as $item)
			{
				$this->searchResultItems[$i]['title'] 				= $item['title'];
				if(strlen($item['seo1'])>0)
					$this->searchResultItems[$i]['description'] 		= $item['seo1'];
				elseif(strlen($item['shortDescription'])>0)
					$this->searchResultItems[$i]['description'] 		= $item['shortDescription'];
				elseif(strlen(strip_tags($item['introHtml']))>0)
					$this->searchResultItems[$i]['description'] 		= strip_tags($item['introHtml']);
				elseif(strlen(strip_tags($item['html']))>0)
					$this->searchResultItems[$i]['description'] 		= strip_tags($item['html']);
				$this->searchResultItems[$i]['date']				= $item['dateStartVisible'];
				$this->searchResultItems[$i]['pageUrl'] 			= appUrl::getUrl($item['id'],$item['className'],$item['langCode'],$item['codeName']);
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