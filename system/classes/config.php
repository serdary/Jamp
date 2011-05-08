<?php defined('DOC_ROOT') or exit();

/**
 * JAMP Config Class
 *
 * @package   jamp
 * @author    Serdar Yildirim
 */
class Config
{	
	private $_data;
	private static $_configs = array();
	
	/**
	 * Includes a config file if it is not included before, return array values
	 * 
	 * @param string $confFile
	 * @throws Exception
	 * @return Config object
	 */
	public static function getConf($confFile)
	{
		if (isset(self::$_configs[$confFile]))	return self::$_configs[$confFile];
		
		$conf = new Config;
				
		try {
			include_once Core::findPath($confFile, 'config');
		}
		catch (Exception $ex) {
			throw new Exception($ex->getMessage());
		}
		
		$conf->_data = $config;
		
		return self::$_configs[$confFile] = $conf;
	}
	
	/**
	 * Gets value of the key in config
	 * 
	 * @param string $key
	 * @return string
	 */
	public function get($key = NULL)
	{
		$value = '';
		if (Helper_Check::isStringEmptyOrNull($key) || Helper_Check::isListEmptyOrNull($this->_data))
			return $value;

		if (array_key_exists($key, $this->_data))
			$value = $this->_data[$key];

		return $value;
	}
}