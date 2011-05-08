<?php defined('DOC_ROOT') or exit();

/**
 * JAMP Logger Class
 *
 * @package   jamp
 * @author    Serdar Yildirim
 */
class Logger
{
	/**
	 * Writes info messages. (Currently it echoes, it should write on a log file)
	 * 
	 * @param mixed $data
	 */
	public static function Info($data)
	{
		if (Helper_Check::isNull($data))	return;
		
		//TODO: change this to filesystem log!
		
		if (is_array($data))		print_r($data);
		else if (is_object($data))	var_dump($data);
		else						echo "LOGGER-INFO:: $data <br />";
	}
	
	/**
	 * Writes fatal error messages. (Currently it echoes, it should write on a log file)
	 * 
	 * @param string $data
	 */
	public static function Fatal($msg)
	{
		if (Helper_Check::isNull($data))	return;
		
		//TODO: change this to filesystem log!
		echo "LOGGER-FATAL:: $msg <br />";
	}
}