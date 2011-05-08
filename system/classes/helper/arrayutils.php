<?php defined('DOC_ROOT') or exit(0);

/**
 * JAMP Helper Array Utils Class
 *
 * @package   jamp
 * @author    Serdar Yildirim
 */
class Helper_ArrayUtils
{
	/**
	 * Checks if a key in array is set
	 * 
	 * @param string $key
	 * @param array $arr
	 * @param mixed $default
	 * @return boolean
	 */
	public static function isKeySet($key, &$arr, $default = NULL)
	{
		if (Helper_Check::isStringEmptyOrNull($key))	return FALSE;
			
		if (isset($arr[$key]) && $arr[$key] !== NULL)	return TRUE;
	}

	/**
	 * Returns values of the key in array
	 * 
	 * @param string $key
	 * @param array $arr
	 * @param mixed $default
	 * @return mixed
	 */
	public static function getValue($key, &$arr, $default = NULL)
	{
		if (Helper_Check::isStringEmptyOrNull($key))
			return ($default !== NULL) ? $default : NULL;
			
		if (array_key_exists($key, $arr))
			return $arr[$key];
			
		return !Helper_Check::isNull($default) ? $default : NULL;
	}
}