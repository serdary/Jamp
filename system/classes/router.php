<?php defined('DOC_ROOT') or exit(0);

class Router extends Base_Singleton
{
	private static $_instance;
	
	private $_routes;
		
	protected function __construct() { }
	
	public static function instance()
	{
		if (!isset(self::$_instance))
			self::$_instance = new Router;
			
		return self::$_instance;
	}
	
	public function setRoute(Route $route)
	{
		$this->_routes[] = $route;
	}
	
	public function getRoute($uri)
	{		
		foreach($this->_routes as $route)
		{
			if ($route->matches($uri))	return $route;
		}
		
		return NULL;
	}
}