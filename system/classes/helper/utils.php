<?php defined('DOC_ROOT') or exit(0);

/**
 * JAMP Helper Utils Class
 *
 * @package   jamp
 * @author    Serdar Yildirim
 */
class Helper_Utils extends Base_Singleton
{
	private static $_instance;

	protected function __construct() { }
	
	public static function instance()
	{
		if (!isset(self::$_instance))
			self::$_instance = new Helper_Utils;
		
		return self::$_instance;
	}
	
	/**
	 * Sanitizes an array
	 * 
	 * @param array $values
	 */
	public function sanitizeArray(Array & $values)
	{
		foreach ($values as $key => $value)
			$value[$key] = $this->sanitize($value);
	}
	
	/**
	 * Sanitize a value
	 * 
	 * @param mixed $value
	 * @return mixed
	 */
	public function sanitize($value)
	{
		if (!is_string($value))	return $value;
		
		if ((bool) get_magic_quotes_gpc() === TRUE)
			$value = stripslashes($value);
			
		return $value;
	}
}