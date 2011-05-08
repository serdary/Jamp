<?php defined('DOC_ROOT') or exit();

/**
 * JAMP User Controller Pdo Class
 *
 * @package   jamp
 * @author    Serdar Yildirim
 */
class Controller_User extends Controller
{
	public function __construct()
	{
		
	}
	
	/**
	 * User Index Page
	 */
	public function actionIndex()
	{
		echo "Controller_User::actionIndex";
		
		// create empty user obj, fill properties and save
		/*
		$user = DIContainer::makeUser();
		
		$user->fillUserFields('name-test1', 'surname-test1', 23, Model_User::MALE);
		$user->save();
		Logger::Info("<hr />");Logger::Info($user);Logger::Info("<hr />");
		*/
		
		// Load user with user id = 1
		/*
		$user = DIContainer::makeUser()->load(1);
		Logger::Info("<hr />");Logger::Info($user);Logger::Info("<hr />");
		*/
		
		// Update loaded user
		/*
		$user = DIContainer::makeUser()->load(1);
		$user->setName('name-test2');
		$user->setAge(777);
		$user->setGender(Model_User::FEMALE);
		Logger::Info('Result: ' . $user->update());
		*/
		
		// Delete loaded user
		/*
		$user = DIContainer::makeUser()->load(2);
		Logger::Info('Result: ' . $user->delete());
		*/
	}
}