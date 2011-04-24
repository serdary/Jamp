<?php defined('DOC_ROOT') or exit(0);

class Helper_ArrayUtils
{
	public static function isKeySet($key, &$arr, $default = NULL)
	{
		if ($key === NULL || $key === '')	return FALSE;
			
		if (isset($arr[$key]) && $arr[$key] !== NULL)	return TRUE;
	}

	public static function getValue($key, &$arr, $default = NULL)
	{
		if ($key === NULL || $key === '')
			return ($default !== NULL) ? $default : NULL;
			
		if (array_key_exists($key, $arr))
			return $arr[$key];
			
		return ($default !== NULL)	? $default : NULL;
	}
}