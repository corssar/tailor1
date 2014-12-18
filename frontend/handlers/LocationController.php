<?
require_once(FRAMEWORK_PATH."system/location.php");

class LocationController
{
	public function getLocations($level,$pId)
	{
		require_once(FRAMEWORK_PATH."system/location.php");
		require_once(FRAMEWORK_PATH."system/WebText.php");
		$location = new Location();
		$helpText = $level==2?WebText::getText("selectRegion","�������� ������"):WebText::getText("selectCity","�������� �����");
		echo "<option value=\"0\">--$helpText--</option>";
		$otherCity = $level==3?"<option value=\"-1\">-".WebText::getText("otherCity","������ �����")."-</option>":"";
		echo $otherCity;
		foreach ($location->getChildLocations($level,$pId) as $item)
		{
			echo "<option value={$item['id']}>{$item['name']}</option>"	;
		}
		echo $otherCity;
	}
}

$tourController = new LocationController();

switch ($_REQUEST['action'])
{
	case 'getLocations'	: echo $tourController->getLocations(Request::getInt('level',"POST"),Request::getInt('pId',"POST"));
}

?>