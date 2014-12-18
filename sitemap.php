<?
require_once("config.php");
require_once(FRAMEWORK_PATH."system/cache/CacheFace.php");
require_once(FRAMEWORK_PATH."system/Context.php");
require_once(FRAMEWORK_PATH."system/appUrl.php");

class Sitemap
{
	var $searchParams = array(
						array("table" => "fe_Pages", "whereParam" => "visible = 1 AND fe_Pages.id<>404", "viewTypeList" => "1")
					);
	
	function __construct()
	{
		$resArray = array($this->getTable());
		$this->getXML($resArray);
	}
	
	function getTable()
	{
		$i = 0;
		$query = "";
		
		foreach ($this->searchParams as $item)
		{
			$query .= ($i > 0)?" UNION ALL":"";
			$query .= "
						SELECT
							`".$item['table']."`.id,
							`".$item['table']."`.codeName,
							`".$item['table']."`.lastUpdate,
							`be_Languages`.code,
							`be_View`.className
						FROM
							`".$item['table']."`
						INNER JOIN `be_View` ON
							`be_View`.viewId = `".$item['table']."`.viewId
						LEFT JOIN `be_Languages` ON
							`be_Languages`.id = `".$item['table']."`.langId
						";
			if (isset($item['innerTable']))
			{
				$query .= "
						INNER JOIN `".$item['innerTable']."` ON
							`".$item['innerTable']."`.".$item['innerOnField']." = `".$item['table']."`.".$item['ctInnerOnField'];
			}
			
			$query .= " WHERE `".$item['table']."`.".$item['whereParam'];
			
			if (isset($item['viewIdList']))
			{
				$query .= " AND `".$item['table']."`.viewId IN (".$item['viewIdList'].")";
			}
			if (isset($item['viewTypeList']))
			{
				$query .= " AND `be_View`.viewType IN (".$item['viewTypeList'].")";
			}
			$i++;
		}
		
		$query .= "
						ORDER BY
							lastUpdate DESC
						LIMIT 0, 10000
						";
		
		if (Context::DB()->query($query))
		{
			return Context::DB()->result;
		}
		else
		{
			return array();
		}
	}

	function getXML($resArray = array())
	{
		header ("Content-type: text/xml");
	
		echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
		echo "\n<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">";
		echo "\n\t<url>";
		echo "\n\t\t<loc>".SITE_PROTOCOL.SITE_URL."</loc>";
		echo "\n\t\t<lastmod>".date("Y-m-d")."</lastmod>";
		echo "\n\t\t<priority>1.0</priority>";
		echo "\n\t</url>";
		
		foreach ($resArray as $resItem)
		{
			foreach ($resItem as $item)
			{
				echo "\n\t<url>";
				echo "\n\t\t<loc>".appUrl::getUrl($item['id'],$item['className'], $item['codeName'], $item['code'])."</loc>";
				if (isset($item['lastUpdate']))
				{
					echo "\n\t\t<lastmod>".date("Y-m-d", strtotime($item['lastUpdate']))."</lastmod>";
				}
				echo "\n\t\t<priority>0.5</priority>";
				echo "\n\t</url>";
			}
		}
		
		echo "\n</urlset>";
	}
}


$sitemap = new Sitemap();
?>