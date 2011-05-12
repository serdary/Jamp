<?php defined('DOC_ROOT') or exit();

/**
 * JAMP Abstract Driver Class
 *
 * @package   jamp
 * @author    Serdar Yildirim
 */
abstract class Driver_Driver
{
	protected $connection;
	protected $conf;
	
	public function __construct() { }
	
	public function __destruct()
	{
		$this->disconnect();
	}

	/**
	 * Sets conf object of driver class
	 */
	public function setDriver(Config $conf)
	{
		$this->conf = $conf;
	}
	
	abstract public function connect();
	abstract public function disconnect();
	abstract public function select($table, $columns, $conditions);
	abstract public function update($table, $data, $conditions);
	abstract public function insert($table, $data);
	abstract public function delete($table, $conditions);
}