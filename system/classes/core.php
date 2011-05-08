<?php defined('DOC_ROOT') or exit(0);

/**
 * JAMP Core Class
 *
 * @package   jamp
 * @author    Serdar Yildirim
 */
class Core
{
	const DEVELOPMENT = 1;
	const TEST        = 2;
	const STAGING     = 3;
	const PRODUCTION  = 4;
	
	private static $_mode;
	private static $_isInitialized;
	private static $_appSettings;
	private static $_appModules = NULL;
	
	/**
	 * Auto load function for files
	 * 
	 * @param string $className
	 * @throws Exception
	 */
	public static function auto_load($className)
	{
		try {
			include_once Core::findPath($className);
		}
		catch (Exception $ex) {
			// TODO: Keep log or smt!
			throw new Exception($ex->getMessage());
		}
	}
	
	/**
	 * Finds a class' file path
	 * 
	 * @param string $className
	 * @param string $startFolder
	 * @param string $ext
	 * @throws Exception
	 * @return file path
	 */
	public static function findPath($className, $startFolder = NULL, $ext = '.php')
	{
		if ($startFolder === NULL)	$startFolder = 'classes';
		
		$folders = array(APP_PATH, SYS_PATH);
		
		$fileName = strtolower("/" . str_replace("_", "/", $className)) . $ext;	
		
		foreach ($folders as $folder)
		{
			if (is_file($folder . $startFolder . $fileName))
				return $folder . $startFolder . $fileName;
		}
		
		// If a module class needs to be added
		if (self::$_appModules !== NULL)
		{
			foreach (self::$_appModules as $module)
			{
				$filePath = sprintf("%s%s/%s", MODULE_PATH, $module, $fileName);
				if (is_file($filePath))	return $filePath;
			}
		}
		
		// Check if it is a config file
		$filePath = sprintf("%s%s/%s", SYS_PATH, $startFolder, $fileName);
		if (is_file($filePath))	return $filePath;
		
		$filePath = sprintf("%s%s/%s", APP_PATH, $startFolder, $fileName);
		if (is_file($filePath))	return $filePath;
		
		throw new Exception('File not found! File Name: ' . $fileName);
	}
	
	/**
	 * Inits the core
	 */
	public static function init()
	{
		if (Core::isInitialized())	return;
		
		Core::setInitialized(TRUE);
		
		Core::setEnvironmentMode();
		
		Core::sanitizeGlobalArrays();
	}
	
	/**
	 * Sets the environment mode
	 */
	private static function setEnvironmentMode()
	{
		Core::setMode(Core::DEVELOPMENT);
		
		if (isset($_SERVER['MODE']))
			Core::setMode(constant('Core::' . $_SERVER['MODE']));
	}
	
	/**
	 * Sanitizes global arrays using helper methods
	 */
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
	
	public static function setAppModules($modules)
	{		
		Core::$_appModules = $modules;
	}
	
	public static function getAppSettingValue($key = NULL)
	{
		if (Helper_Check::isStringEmptyOrNull($key))	return '';
		
		return Core::$_appSettings[$key];
	}
}