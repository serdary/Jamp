<?php defined('DOC_ROOT') or exit();

/**
 * JAMP Model Class
 *
 * @package   jamp
 * @author    Serdar Yildirim
 */
abstract class Model
{
	protected $db;
	protected $mapper;
	
	/**
	 * Sets db object
	 * 
	 * @param IDB $db
	 */
	public function setDB(IDB $db)
	{
		$this->db = $db;
	}
	
	/**
	 * Finds a item by id
	 * 
	 * @param int $id
	 */
	public function find($id)
	{
		$arr = $this->db->select(static::TABLE, NULL, array('id' => $id));
		
		if (Helper_Check::isListEmptyOrNull($arr))	return NULL;
		
		$this->fillProperties($arr[0]);
		
		return $this;
	}
	
	/**
	 * Saves the item
	 */
	public function save()
	{
		$this->id = $this->db->insert(static::TABLE, $this->mapper->insert($this));
		return $this->id > 0;
	}
	
	/**
	 * Updates the item
	 */
	public function update()
	{
		return $this->db->update(static::TABLE, $this->mapper->update($this), array('id' => $this->id));
	}
	
	/**
	 * Deletes the item
	 */
	public function delete()
	{
		return $this->db->delete(static::TABLE, array('id' => $this->id));
	}
	
	abstract protected function fillProperties(Array $arr);
	
	/*Getters and Setters Magic Func.s*/

	public function __get($name)
	{
		$method = 'get' . ucfirst($name);
		
		return $this->$method();
	}
	
	public function __set($name, $value)
	{
		$method = 'set' . ucfirst($name);
		
		$this->$method($value);
	}
}