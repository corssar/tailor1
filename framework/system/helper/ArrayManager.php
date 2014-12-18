<?php
class ArrayManager
{
    /*
     * @param $needle: Array ('key' => 'value') that will be searched
     * @param $haystack
     * @return false|string
     */
	public static function subarray_search($needle, $haystack)
	{
	    if (empty($needle) || empty($haystack)) {
	        return false;
	    }
	   
	    foreach ($haystack as $key => $value) {
	        $exists = 0;
	        foreach ($needle as $nkey => $nvalue) {
	            if (!empty($value[$nkey]) && $value[$nkey] == $nvalue) {
	                $exists = 1;
	            } else {
	                $exists = 0;
	            }
	        }
	        if ($exists) return $key;
	    }
	   
	    return false;
	}
}
?>