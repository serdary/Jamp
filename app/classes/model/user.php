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
	private $_id;
	private $_name;
	private $_surname;
	private $_age;
	private $_gender;
	/* members */
	
	const TABLE = 'user';
	const MALE = 0;
	const FEMALE = 1;
	
	private $_db;
	private $_mapper;

	public function __construct()
	{
		$this->_mapper = new Model_UserMapper;
	}
	
	/**
	 * Sets db object
	 * 
	 * @param IDB $db
	 */
	public function setDB(IDB $db)
	{
		$this->_db = $db;
	}
	
	/**
	 * Fills user's properties
	 * 
	 * @param string $name
	 * @param string $surname
	 * @param int $age
	 * @param bit $gender
	 */
	public function fillUserFields($name, $surname, $age, $gender)
	{
		$this->_name = $name;
		$this->_surname = $surname;
		$this->_age = $age;
		$this->_gender = $gender;
	}
	
	/**
	 * Loads a user by id
	 * 
	 * @param int $id
	 */
	public function load($id)
	{
		$userArr = $this->_db->select(self::TABLE, NULL, array('id' => $id));
		
		if (Helper_Check::isListEmptyOrNull($userArr))	return NULL;
		
		extract($userArr[0]);
		$this->_id = $id;
		$this->fillUserFields($name, $surname, $age, $gender);
		
		return $this;
	}
	
	/**
	 * Saves the user
	 */
	public function save()
	{
		$this->_id = $this->_db->insert(self::TABLE, $this->_mapper->insert($this));
	}
	
	/**
	 * Updates the user
	 */
	public function update()
	{
		return $this->_db->update(self::TABLE, $this->_mapper->update($this), array('id' => $this->_id));
	}
	
	/**
	 * Deletes the user
	 */
	public function delete()
	{
		return $this->_db->delete(self::TABLE, array('id' => $this->_id));
	}
	
	/* Getters and Setters*/
	public function getID() { return $this->_id; }
	public function getName() { return $this->_name; }
	public function getSurname() { return $this->_surname; }
	public function getAge() { return $this->_age; }
	public function getGender() { return $this->_gender; }
	
	public function setName($val) { $this->_name = $val; }
	public function setSurname($val) { $this->_surname = $val; }
	public function setAge($val) { $this->_age = $val; }
	public function setGender($val) { $this->_gender = $val; }
}