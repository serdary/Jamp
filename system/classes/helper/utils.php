<?php defined('DOC_ROOT') or exit(0);

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
	
	public function sanitizeArray(& $values)
	{
		foreach ($values as $key => $value)
			$value[$key] = $this->sanitize($value);
	}
	
	public function sanitize($value)
	{
		if (!is_string($value))	return $value;
		
		if ((bool) get_magic_quotes_gpc() === TRUE)
			$value = stripslashes($value);
			
		return $value;
	}
}