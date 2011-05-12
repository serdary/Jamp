<?php defined('DOC_ROOT') or exit(0);

/**
 * JAMP Route Class
 *
 * @package   jamp
 * @author    Serdar Yildirim
 */
class Route
{
	private $_name;
	private $_pattern;
	private $_defaultController = NULL;
	private $_controller;
	private $_action;
	private $_params;
	
	const PATTERN_REGEX_MATCH = '@:([\w]+)@';
	const PATTERN_REGEX_REPLACE = '([a-zA-Z0-9_\+\-%]+)';
	
	public function __construct($name, $pattern, $defaultController = NULL)
	{
		$this->_name = $name;
		$this->_pattern = $pattern;
		$this->_defaultController = $defaultController;
	}
	
	/**
	 * Matces a uri to a route
	 * 
	 * @param string $uri
	 * @return boolean
	 */
	public function matches($uri)
	{
		Logger::Info("Pattern: " . $this->_pattern);
		
		if ($uri === $this->_pattern && $this->_defaultController !== NULL)
		{
			$action = $this->_pattern === "/" ? 'index' : substr($this->_pattern, 1);
			$this->setRouteHandlers(array('controller' => $this->_defaultController, 'action' => $action));
			return TRUE;
		}
		
	    preg_match_all(Route::PATTERN_REGEX_MATCH, $this->_pattern, $matches, PREG_PATTERN_ORDER);
    	$matches = $matches[0];
    	
		Logger::Info("MATCHES");Logger::Info($matches);
 
    	$patternRegex = sprintf("@^%s/?$@", 
    		preg_replace(Route::PATTERN_REGEX_MATCH, Route::PATTERN_REGEX_REPLACE, $this->_pattern));
    	
   		$params = array();
    	if (preg_match($patternRegex, $uri, $matchedValues))
    	{
	    	array_shift($matchedValues);
	      
	    	foreach($matches as $index => $value)
	    		$params[substr($value, 1)] = urldecode($matchedValues[$index]);
	    }
	    
	    $this->setRouteParams($params);
	    
	    $this->setRouteHandlers($params);

		Logger::Info("VALUES");Logger::Info($matchedValues);
		Logger::Info("PARAMS");Logger::Info($params);
		Logger::Info("-------------------------------------------------------------------------------");
		
		//return (count($params) > 0 || $this->isHomeRoute());
		return (count($params) > 0);
	}
	
	/**
	 * Sets the route params
	 * 
	 * @param array $params
	 */
	private function setRouteParams(&$params)
	{
	    foreach ($params as $key => $val)
	    {
	    	if ($key === 'controller' || $key === 'action' || $key === 'param')	continue;
	    	
	    	$params['param'][$key] = $val;
	    }
	}
	
	/**
	 * Sets the route handlers
	 * 
	 * @param array $params
	 */
	private function setRouteHandlers($params)
	{		
		$this->setController(Helper_ArrayUtils::isKeySet('controller', $params) 
			? $params['controller'] : $this->_defaultController);

		$this->setAction(Helper_ArrayUtils::isKeySet('action', $params) ? $params['action'] : 'index');
		
		$this->setParams(Helper_ArrayUtils::isKeySet('param', $params) ? $params['param'] : NULL);
	}
	
	/**
	 * Checks if the route is home route
	 * 
	 * @return boolean
	 */
	private function isHomeRoute()
	{
		return $this->_pattern === '/' && $this->_defaultController !== NULL;
	}
	
	/* Getters and Setters */
	public function getController()
	{
		return $this->_controller;
	}
	
	public function setController($value)
	{
		$this->_controller = ucfirst(trim($value));
	}
	
	public function getAction()
	{
		return $this->_action;
	}
	
	public function setAction($value)
	{
		$this->_action = ucfirst(trim($value));
	}
	
	public function getParams()
	{
		return $this->_params;
	}

	public function setParams($value)
	{
		if (!$value || !is_array($value))	return;
		
		foreach ($value as $key => $val)
		{
			$this->_params[$key] = strtolower(trim($val));
		}
	}
	
	public function getName()
	{
		return $this->_name;
	}
	
	public function setName($value)
	{
		$this->_name = $value;
	}
	
	public function getPattern()
	{
		return $this->_pattern;
	}
	
	public function setPattern($value)
	{
		$this->_pattern = $value;
	}
}
