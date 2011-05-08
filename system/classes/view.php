<?php defined('DOC_ROOT') or exit();

/**
 * JAMP View Class
 *
 * @package   jamp
 * @author    Serdar Yildirim
 */
class View
{
	private $_viewFile;
	private $_data = array();

	const ECHO_OUTPUT = 1;
	const STORE_OUTPUT = 2;
	
	public function __construct($viewFile)
	{
		$this->_viewFile = $viewFile;
	}

	/**
	 * Returns a new view object
	 * 
	 * @param string $viewFile
	 * @return View object
	 */
	public static function factory($viewFile = NULL)
	{
		return new View($viewFile);
	}

	/**
	 * Binds a variable to view object
	 * 
	 * @param string $varName
	 * @param mixed $varValue
	 */
	public function bind($varName, $varValue)
	{
		$this->_data[$varName] = $varValue;

		return $this;
	}

	/**
	 * Renders the view
	 * 
	 * @param enum $display
	 * @throws Exception
	 * @return view source
	 */
	public function render($display = View::ECHO_OUTPUT)
	{
		if (Helper_Check::isStringEmptyOrNull($this->_viewFile))
			throw new Exception("View file name should be specified");

		extract($this->_data, EXTR_OVERWRITE);

		ob_start();

		try {
			include APP_PATH . 'views/' . $this->_viewFile;
		}
		catch (Exception $ex) {
			ob_end_clean();
			throw $ex;
		}
		
		if ($display === View::STORE_OUTPUT)
			return ob_get_clean();
		
		echo ob_get_clean();
	}
}