<?php defined('DOC_ROOT') or exit();

include_once SYS_PATH . 'classes/base/singleton.php';

class Bootstrap extends Base_Singleton
{
	private static $_instance;
	
	protected function __construct() { }
	
	public static function instance()
	{
		if (!isset(self::$_instance))
		{
			self::$_instance = new Bootstrap;
			
			require_once SYS_PATH . 'classes/core.php';
		}
		
		spl_autoload_register(array('Core', 'auto_load'));
			
		return self::$_instance;
	}
	
	public function init()
	{
		Core::init();
		
		$this->setSettings();
		
		$this->setRoutes();
	}
	
	private function setSettings()
	{
		$settings = array('base_url' => "/Jamp");
		Core::setAppSettings($settings);
	}
	
	private function setRoutes()
	{	
		Router::instance()->setRoute(new Route('username', '/user/:username', 'user'));
		
		// Default route of app
		Router::instance()->setRoute(new Route('defaultControllerActionPidId', '/:controller/:action/:parentId/:id'));
		Router::instance()->setRoute(new Route('defaultControllerActionId', '/:controller/:action/:id'));
		Router::instance()->setRoute(new Route('defaultControllerAction', '/:controller/:action'));
		Router::instance()->setRoute(new Route('defaultController', '/:controller'));
		
		Router::instance()->setRoute(new Route('homepage', '/', 'welcome'));
	}
}