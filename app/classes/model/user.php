<?php defined('DOC_ROOT') or exit();

/**
 * JAMP Model User Class
 *
 * @package   jamp
 * @author    Serdar Yildirim
 */
class Model_User extends Model
{
	/* members */
	protected $id;
	private $_name;
	private $_surname;
	private $_username;
	private $_email;
	private $_password;
	private $_lastLogin;
	private $_latestActivity;
	private $_lastIp;
	private $_accountStatus;
	private $_age;
	private $_gender;
	private $_createdAt;
	private $_updatedAt;
	/* members */
	
	const TABLE = 'user';
	
	public function __construct()
	{
		$this->mapper = new Model_UserMapper;
	}
	
	/**
	 * Fills user's properties
	 */
	protected function fillProperties(Array $properties)
	{
		extract($properties);
		
		$this->id = $id;
		$this->_name = $name;
		$this->_surname = $surname;
		$this->_username = $username;
		$this->_email = $email;
		$this->_password = $password;
		$this->_lastLogin = $last_login;
		$this->_latestActivity = $latest_activity;
		$this->_lastIp = $last_ip;
		$this->_accountStatus = $account_status;
		$this->_age = $age;
		$this->_gender = $gender;
		$this->_createdAt = $created_at;
		$this->_updatedAt = $updated_at;
	}
	
	public function delete()
	{
		$this->_accountStatus = Helper_AccountStatus::DELETED;
		return $this->db->update(Model_User::TABLE, $this->mapper->update($this), array('id' => $this->id));
	}
		
	/* Getters and Setters*/	
	public function getID() { return $this->id; }
	public function getName() { return $this->_name; }
	public function getSurname() { return $this->_surname; }
	public function getUsername() { return $this->_username; }
	public function getEmail() { return $this->_email; }
	public function getPassword() { return $this->_password; }
	public function getLastLogin() { return $this->_lastLogin; }
	public function getLatestActivity() { return $this->_latestActivity; }
	public function getLastIp() { return $this->_lastIp; }
	public function getAccountStatus() { return $this->_accountStatus; }
	public function getAge() { return $this->_age; }
	public function getGender() { return $this->_gender; }
	public function getCreatedAt() { return $this->_createdAt; }
	public function getUpdatedAt() { return $this->_updatedAt; }
	
	public function setName($val) { $this->_name = $val; }
	public function setSurname($val) { $this->_surname = $val; }
	public function setUsername($val) { $this->_username = $val; }
	public function setEmail($val) { $this->_email = $val; }
	public function setPassword($val) { $this->_password = $val; }
	public function setLastLogin($val) { $this->_lastLogin = $val; }
	public function setLatestActivity($val) { $this->_latestActivity = $val; }
	public function setLastIp($val) { $this->_lastIp = $val; }
	public function setAccountStatus($val) { $this->_accountStatus = $val; }
	public function setAge($val) { $this->_age = $val; }
	public function setGender($val) { $this->_gender = $val; }
	public function setCreatedAt($val) { $this->_createdAt = $val; }
	public function setUpdatedAt($val) { $this->_updatedAt = $val; }
}
