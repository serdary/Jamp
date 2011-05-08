<?php defined('DOC_ROOT') or exit();

/**
 * JAMP DB Class
 *
 * @package   jamp
 * @author    Serdar Yildirim
 */
class DB implements IDB
{
	private $_driver;
	private $_conf;
	
	const SELECT = 1;
	const UPDATE = 2;
	const INSERT = 3;
	const DELETE = 4;
	
	public function __construct()
	{
		$this->_conf = Config::getConf('database');
		
		$driverClassName = 'Driver_' . ucfirst($this->_conf->get('driver')); 
		$this->setDriver(new $driverClassName);
	}
	
	/**
	 * Sets driver object of db class
	 * 
	 * @see IDB::setDriver()
	 */
	public function setDriver(Driver_Driver $driver)
	{
		$this->_driver = $driver;
	}
	
	/**
	 * Select action
	 * 
	 * @see IDB::select()
	 */
	public function select($table, $columns, $conditions)
	{
		return $this->_driver->select($table, $columns, $conditions);
	}

	/**
	 * Update action
	 * 
	 * @see IDB::select()
	 */
	public function update($table, $data, $conditions)
	{
		return $this->_driver->update($table, $data, $conditions);
	}
	
	/**
	 * Insert action
	 * 
	 * @see IDB::select()
	 */
	public function insert($table, $data)
	{
		return $this->_driver->insert($table, $data);
	}
	
	/**
	 * Delete action
	 * 
	 * @see IDB::select()
	 */
	public function delete($table, $conditions)
	{
		return $this->_driver->delete($table, $conditions);
	}
}