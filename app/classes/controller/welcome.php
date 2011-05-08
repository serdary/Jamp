<?php defined('DOC_ROOT') or exit();

/**
 * JAMP Welcome Controller Pdo Class
 *
 * @package   jamp
 * @author    Serdar Yildirim
 */
class Controller_Welcome extends Controller
{
	public function __construct()
	{
		
	}
		
	/**
	 * Welcome Index Page
	 */
	public function actionIndex()
	{
		View::factory('welcome/index.php')
			->render();
	}
	
	/**
	 * Hello Page
	 */
	public function actionHello($params)
	{
		View::factory('welcome/hello.php')
			->bind('id', $params['id'])
			->bind('parentId', $params['parentId'])
			->render();
	}
	
	/**
	 * Goodbye Page
	 */
	public function actionGoodbye()
	{
		View::factory('welcome/goodbye.php')
			->render();
	}
}