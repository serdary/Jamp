<?php defined('DOC_ROOT') or exit();

class Logger
{
	public static function Info($msg)
	{
		if (!$msg || $msg === '')	return;
		
		//TODO: change this to file log!
		//echo "LOGGER-INFO:: $msg <br />";
	}
	
	public static function InfoArr($arr)
	{
		if (!$arr || !is_array($arr))	return;
	
		//TODO: change this to file log!
		/*echo 'LOGGER-INFO-ARR:: ';
		print_r($arr);
		echo '<br />';*/
	}
	
	public static function Fatal($msg)
	{
		if (!$msg || $msg === '')	return;
		
		//TODO: change this to file log!
		//echo "LOGGER-FATAL:: $msg <br />";
	}
}