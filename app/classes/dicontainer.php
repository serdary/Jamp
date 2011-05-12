<?php defined('DOC_ROOT') or exit();

/**
 * JAMP Dependency Injection Container Class
 *
 * @package   jamp
 * @author    Serdar Yildirim
 */
class DIContainer
{
	private static $_instances = array();
 
	/**
	 * Create a new user object, injects dependencies
	 * 
	 * 	return Model_User object
	 */
	public static function makeUser()
	{
		$user = new Model_User;
		$user->setDB(self::getDB());
		
		return $user;
	}
 
	/**
	 * Create a new tag object, injects dependencies
	 * 
	 * 	return Model_Tag object
	 */
	public static function makeTag()
	{
		$tag = new Model_Tag;
		$tag->setDB(self::getDB());
		
		return $tag;
	}
 
	public static function makeDB($config)
	{	
		$db = new DB;
		
		switch ($config)
		{
			case 'DEVELOPMENT': $dbConfig = 'database-dev';	break;
			case 'TEST':        $dbConfig = 'database-test'; break;
			case 'STAGING':     $dbConfig = 'database-dev';	break;
			default:
			case 'PRODUCTION':  $dbConfig = 'database';	break;
		}
		
		$db->setConfig(Config::getConf($dbConfig));
		return $db;
	}
 
	/**
	 * Returns db singleton object
	 * 
	 * @return DB object
	 */
	public static function getDB($conf = APP_MODE)
	{
		$dbKey = 'DB-' . $conf;
		
		if (!isset(self::$_instances[$dbKey]) || !(self::$_instances[$dbKey] instanceof IDB))
		{	
			self::$_instances[$dbKey] = self::makeDB($conf);
		}
		
		return self::$_instances[$dbKey];
	}
}