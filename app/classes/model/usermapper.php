<?php defined('DOC_ROOT') or exit();

/**
 * JAMP Model User Mapper Class
 *
 * @package   jamp
 * @author    Serdar Yildirim
 */
class Model_UserMapper implements IMapper
{
	/**
	 * Generates user properties array
	 * 
	 * @see IMapper::insert()
	 * @return array
	 */
	public function insert($user)
	{
		return array('name' => $user->getName()
			, 'surname' => $user->getSurname()
			, 'age' => $user->getAge()
			, 'gender' => $user->getGender());
	}
	
	/**
	 * Generates user properties array
	 * 
	 * @see IMapper::update()
	 * @return array
	 */
	public function update($user)
	{
		return array('name' => $user->getName()
			, 'surname' => $user->getSurname()
			, 'age' => $user->getAge()
			, 'gender' => $user->getGender());
	}
}