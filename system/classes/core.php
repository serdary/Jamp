<?php defined('DOC_ROOT') or exit(0);

class Core
{
	const DEVELOPMENT = 1;
	const TEST        = 2;
	const STAGING     = 3;
	const PRODUCTION  = 4;
	
	private static $_mode;
	private static $_isInitialized;
	private static $_appSettings;
	
	public static function auto_load($className)
	{
		try
		{
			include_once Core::findPath($className);
		}
		catch (Exception $ex)
		{
			// TODO: Keep log or smt!
			throw new Exception($ex->getMessage());
		}
	}
	
	private static function findPath($className, $startFolder = NULL, $ext = '.php')
	{
		if ($startFolder === NULL)	$startFolder = 'classes';
		
		$folders = array(APP_PATH, SYS_PATH);
		
		$fileName = strtolower($startFolder . "/" . str_replace("_", "/", $className)) . $ext;	
		
		foreach ($folders as $folder)
		{
			if (is_file($folder . $fileName))	return $folder . $fileName;
		}
		
		throw new Exception('File not found! File Name: ' . $fileName);
	}
	
	public static function init()
	{
		if (Core::isInitialized())	return;
		
		Core::setInitialized(TRUE);
		
		Core::setEnvironmentMode();
		
		Core::sanitizeGlobalArrays();
	}
	
	private static function setEnvironmentMode()
	{
		Core::setMode(Core::DEVELOPMENT);
		
		if (isset($_SERVER['MODE']))
			Core::setMode(constant('Core::' . $_SERVER['MODE']));
	}
	
	private static function sanitizeGlobalArrays()
	{
		Helper_Utils::instance()->sanitizeArray($_GET);
		Helper_Utils::instance()->sanitizeArray($_POST);
		Helper_Utils::instance()->sanitizeArray($_COOKIE);
	}
	
	/* Setters and Getters */
	
	public static function getMode()
	{
		return Core::$_mode;
	}
	
	public static function setMode($value)
	{
		Core::$_mode = $value;
	}
	
	public static function isInitialized()
	{
		return Core::$_isInitialized;
	}
	
	public static function setInitialized($value)
	{
		Core::$_isInitialized = $value;
	}
	
	public static function getAppSettings()
	{
		return Core::$_appSettings;
	}
	
	public static function setAppSettings($settings)
	{
		Core::$_appSettings = array('base_url' => '/');
		
		Core::$_appSettings = $settings + Core::$_appSettings;
	}
	
	public static function getAppSettingValue($key)
	{
		if (!$key || $key === '')	return '';
		
		return Core::$_appSettings[$key];
	}
}