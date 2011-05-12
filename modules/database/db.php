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
	
	public function __construct() { }
	
	/**
	 * Sets config object of db class
	 * 
	 * @see IDB::setConfig()
	 */
	public function setConfig(Config $conf)
	{
		$this->_conf = $conf;
		
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
		$this->_driver->setDriver($this->_conf);
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