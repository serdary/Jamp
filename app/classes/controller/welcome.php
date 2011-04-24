<?php defined('DOC_ROOT') or exit();

class Controller_Welcome extends Controller
{
	public function __construct()
	{
		
	}
	
	public function actionIndex()
	{
		View::factory('welcome/index.php')
			->render();
	}
	
	public function actionHello($params)
	{
		View::factory('welcome/hello.php')
			->bind('id', $params['id'])
			->bind('parentId', $params['parentId'])
			->render();
	}
	
	public function actionGoodbye()
	{
		View::factory('welcome/goodbye.php')
			->render();
	}
}