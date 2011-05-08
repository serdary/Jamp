<?php defined('DOC_ROOT') or exit(0);

/**
 * JAMP Helper Check Class
 *
 * @package   jamp
 * @author    Serdar Yildirim
 */
class Helper_Check
{
	/**
	 * Checks if it is null
	 * 
	 * @param mixed $val
	 * @return boolean
	 */
	public static function isNull($val)
	{
		return $val === NULL;
	}
	
	/**
	 * Checks if string is empty
	 * 
	 * @param string $str
	 * @return boolean
	 */
	public static function isStringEmpty($str)
	{
		return $str === '';
	}
	
	/**
	 * Checks if string is empty or null
	 * 
	 * @param string $str
	 * @return boolean
	 */
	public static function isStringEmptyOrNull($str)
	{
		return $str === NULL || $str === '';
	}
	
	/**
	 * Checks if list is empty
	 * 
	 * @param array $arr
	 * @return boolean
	 */
	public static function isListEmpty(Array &$arr)
	{
		return count($arr) < 1;
	}
	
	/**
	 * Checks if list is empty or null
	 * 
	 * @param array $arr
	 * @return boolean
	 */
	public static function isListEmptyOrNull(Array &$arr)
	{
		return $arr === NULL || count($arr) < 1;
	}
}