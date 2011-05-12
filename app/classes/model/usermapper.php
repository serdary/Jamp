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
	public function insert(Model $user)
	{
		return array('name' => $user->getName()
			, 'surname' => $user->getSurname()
			, 'username' => $user->getUsername()
			, 'email' => $user->getEmail()
			, 'password' => $user->getPassword()
			, 'last_login' => $user->getLastLogin()
			, 'latest_activity' => $user->getLatestActivity()
			, 'last_ip' => $user->getLastIp()
			, 'account_status' => $user->getAccountStatus()
			, 'age' => $user->getAge()
			, 'gender' => $user->getGender()
			, 'created_at' => $user->getCreatedAt()
			, 'updated_at' => $user->getUpdatedAt());
	}
	
	/**
	 * Generates user properties array
	 * 
	 * @see IMapper::update()
	 * @return array
	 */
	public function update(Model $user)
	{
		return array('name' => $user->getName()
			, 'surname' => $user->getSurname()
			, 'username' => $user->getUsername()
			, 'email' => $user->getEmail()
			, 'password' => $user->getPassword()
			, 'last_login' => $user->getLastLogin()
			, 'latest_activity' => $user->getLatestActivity()
			, 'last_ip' => $user->getLastIp()
			, 'account_status' => $user->getAccountStatus()
			, 'age' => $user->getAge()
			, 'gender' => $user->getGender()
			, 'created_at' => $user->getCreatedAt()
			, 'updated_at' => $user->getUpdatedAt());
	}
}