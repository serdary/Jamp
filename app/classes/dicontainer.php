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
 
	/*public static function makeDB()
	{	
		return new DB;
	}*/
 
	/**
	 * Returns db singleton object
	 * 
	 * @return DB object
	 */
	public static function getDB()
	{
		if (!isset(self::$_instances['DB']) || !(self::$_instances['DB'] instanceof IDB))
		{	
			//self::$_instances['DB'] = self::makeDB();
			self::$_instances['DB'] = new DB;
		}
		
		return self::$_instances['DB'];
	}
}