<?php defined('DOC_ROOT') or exit();

/**
 * JAMP Main Template Controller Class
 *
 * @package   jamp
 * @author    Serdar Yildirim
 */
class Controller_Template_Main extends Controller_Template
{
	public function __construct()
	{
		$this->templateFileName = 'main.php';
	}
	
	public function renderPage()
	{
		View::factory('template/' . $this->templateFileName)
			->bind('innerContent', $this->getInnerContent())
			->render(View::ECHO_OUTPUT);
	}
}