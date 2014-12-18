<?php
/**
 * UserPage. Base class for users pages.
 * 
 * @author Andrew Grischuk spizdil from Maxim Melnichuk
 * @package 1.0.1
 */
require_once(FRAMEWORK_PATH."core/Page.php");

abstract class UserPage extends Page 
{
		protected $defaultPageDataClass = 'UserPageData';

}
?>