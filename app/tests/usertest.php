<?php

require_once 'index.php';

class UserTest extends PHPUnit_Framework_TestCase
{
	private static $_testDB;

    protected function setUp()
    {
        self::$_testDB = DIContainer::getDB('TEST');
    }
    
    public function testInsertMultiple()
    {
		for ($i = 0; $i < 10; $i++)
    		$this->insert($i);
    }
    
    public function testUpdateUsers()
    {
    	for ($i = 11; $i < 20; $i += 3)
    		$this->update($i);
    }
    
    public function testDeleteUsers()
    {
    	for ($i = 11; $i < 20; $i += 5)
    		$this->delete($i);
    }
    
    private function insert($index)
    {
    	$user = DIContainer::makeUser();
    	$user->setDB(self::$_testDB);
		
		$user->setName('name-' . $index);
		$user->setSurname('surname-' . $index);
		$user->setAge($index);
		$user->setEmail('name-' . $index . '@surname-' . $index . '.com');
		$user->setGender($index % 2);
		$user->setLastLogin(time());
		$user->setAccountStatus(Helper_AccountStatus::ACTIVE);
		$user->setLastIp('127.0.0.' . $index);
		$user->setPassword('password-' . $index);
		$user->setUsername('username-' . $index);
		$user->setCreatedAt(time());
		$user->setLatestActivity(time());
		
		$this->assertEquals(true, $user->save());
    }
    
    private function update($id)
    {
    	$user = DIContainer::makeUser()->find($id);
    	if (Helper_Check::isNull($user))
    	{
    		$this->assertEquals(true, 'User is not found');
    		return;
    	}
    	
    	$user->setDB(self::$_testDB);
    	
		$user->setName('name-updated-' . $id);
		$user->setAge(100);
		$user->setGender(Helper_Gender::FEMALE);
		
		$this->assertEquals(true, $user->update());
    }
    
    private function delete($id)
    {
		$user = DIContainer::makeUser()->find($id);
    	if (Helper_Check::isNull($user))
    	{
    		$this->assertEquals(true, 'User is not found');
    		return;
    	}
    	
		$this->assertEquals(true, $user->delete());
    }
}