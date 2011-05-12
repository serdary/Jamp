<?php

require_once 'index.php';

class TagTest extends PHPUnit_Framework_TestCase
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
    /*
    public function testUpdateUsers()
    {
    	for ($i = 11; $i < 20; $i += 3)
    		$this->update($i);
    }
    
    public function testDeleteUsers()
    {
    	for ($i = 11; $i < 20; $i += 5)
    		$this->delete($i);
    }*/
    
    private function insert($index)
    {
    	$tag = DIContainer::makeTag();
    	$tag->setDB(self::$_testDB);
		
		$tag->setValue('tag ' . $index);
		$tag->setSlug('tag-' . $index);
		$tag->setStoryCount(1);
		$tag->setTagStatus(Helper_TagStatus::NORMAL);
		$tag->setCreatedBy(1);
		$tag->setCreatedAt(time());
		
		$this->assertEquals(true, $tag->save());
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