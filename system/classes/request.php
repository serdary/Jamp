<?php defined('DOC_ROOT') or exit(0);

class Request extends Base_Singleton
{
	const GET = 'GET';
	const POST = 'POST';
	
	public static $clientIp;
	public static $clientHost;
	public static $clientAgent;
	public static $method;
	
	private static $_instance;
	
	private $_uri;
	private $_route;
	
	protected function __construct() { }
	
	public static function instance()
	{
		if (!self::$_instance)
		{
			$request = new Request;
			
			$request->findClientIp();
			$request->findClientHost();
			$request->findClientAgent();
			$request->findHttpMethod();
			
			$request->setRequestedUri();
			
			$request->findRoute();
			
			self::$_instance = $request;			
		}
		
		return self::$_instance;
	}
	
	public function getResponse()
	{		
		$response = $this->runRequestedAction();
	}
	
	private function findClientIp()
	{
		if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))	Request::$clientHost = $_SERVER['HTTP_X_FORWARDED_FOR'];
		else if (isset($_SERVER['HTTP_CLIENT_IP']))		Request::$clientHost = $_SERVER['HTTP_CLIENT_IP'];
		else if (isset($_SERVER['REMOTE_ADDR']))		Request::$clientHost = $_SERVER['REMOTE_ADDR'];
		else 											Request::$clientHost = '0.0.0.0';
	}
	
	private function findClientHost()
	{
		if (isset($_SERVER['HTTP_HOST'])) Request::$clientHost = $_SERVER['HTTP_HOST'];
	}
	
	private function findClientAgent()
	{
		if (isset($_SERVER['HTTP_USER_AGENT']))
			Request::$clientAgent = $_SERVER['HTTP_USER_AGENT'];
	}
	
	private function findHttpMethod()
	{
		Request::$method = Request::GET;
		
		if (isset($_SERVER['REQUEST_METHOD']))
			Request::$method = $_SERVER['REQUEST_METHOD'];
	}
	
	private function setRequestedUri()
	{
		if (isset($_SERVER['REQUEST_URI']))
		{
			$this->prepareRequestedUriFromUri();
		}
		else
		{
			if (isset($_SERVER['PHP_SELF']))			$this->_uri = $_SERVER['PHP_SELF'];
			else if (isset($_SERVER['REDIRECT_URL']))	$this->_uri = $_SERVER['REDIRECT_URL'];
		}
		
		$this->removeBaseUrlPathFromUri();
		
		Logger::Info('Detected Uri is: ' . $this->_uri);
	}
	
	private function prepareRequestedUriFromUri()
	{
		$this->_uri = rawurldecode($this->getUrlPathOfUrl($_SERVER['REQUEST_URI']));
	}
	
	private function getUrlPathOfUrl($uri)
	{
		return parse_url($uri, PHP_URL_PATH);
	}
	
	private function removeBaseUrlPathFromUri()
	{
		$baseUrlPath = parse_url(Core::getAppSettingValue('base_url'), PHP_URL_PATH);
	
		if (strpos($this->_uri, $baseUrlPath) !== 0)	return;
		
		Logger::Info("Before remove base url: " . $this->_uri . ' - After: ' . substr($this->_uri, strlen($baseUrlPath)));
		
		$this->_uri = substr($this->_uri, strlen($baseUrlPath));
	}
	
	private function runRequestedAction()
	{
		$controllerClass = $this->getRequestedController();

		try {
			$controller = new ReflectionClass($controllerClass);
			
			$controller->getMethod($this->getRequestedAction())
				->invoke(new $controllerClass, $this->_route->getParams());
		}
		catch (Exception $ex) {throw $ex;
			Logger::Fatal("Requested Url is not found! Url was: " . $this->_uri);
			
			// TODO: 404 ??
			throw new Exception("Requested Url is not found! Url was: " . $this->_uri);
		}
	}
	
	private function getRequestedController()
	{		
		return 'Controller_' . $this->_route->getController();
	}
	
	private function getRequestedAction()
	{		
		return 'action' . $this->_route->getAction();
	}
	
	private function findRoute()
	{		
		try {
			$this->_route = Router::instance()->getRoute($this->_uri);
			if ($this->_route === NULL)
				throw new Exception('Route cannot be found for url: ' . $this->_url);
		}
		catch (Exception $ex) {
			Logger::Fatal($ex->getMessage());
			
			// TODO: 404 ??
			throw new Exception($ex->getMessage());
		}
	}
}