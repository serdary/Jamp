<?php defined('DOC_ROOT') or exit();

/**
 * JAMP User Controller Class
 *
 * @package   jamp
 * @author    Serdar Yildirim
 */
class Controller_User extends Controller_Template_Main
{
	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * User Index Page
	 */
	public function actionIndex()
	{
		echo "Controller_User::actionIndex";
	}
	
	/**
	 * Signup Page
	 */
	public function actionSignup()
	{
		$this->setInnerContent(View::factory('user/signup.php')->render(View::STORE_OUTPUT));
		
		$this->renderPage();
	}
	
	/**
	 * Login Page
	 */
	public function actionLogin()
	{
		$this->setInnerContent(View::factory('user/login.php')->render(View::STORE_OUTPUT));
		
		$this->renderPage();
	}
}