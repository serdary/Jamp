<?php defined('DOC_ROOT') or exit();

/**
 * JAMP IDB Interface
 *
 * @package   jamp
 * @author    Serdar Yildirim
 */
interface IDB
{
	public function setDriver(Driver_Driver $driver);
	public function select($table, $columns, $conditions);
	public function update($table, $data, $conditions);
	public function insert($table, $data);
	public function delete($table, $conditions);
}