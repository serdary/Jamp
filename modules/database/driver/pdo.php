<?php defined('DOC_ROOT') or exit();

/**
 * JAMP Driver Pdo Class
 *
 * @package   jamp
 * @author    Serdar Yildirim
 */
class Driver_Pdo extends Driver_Driver
{
	/**
	 * Try to connect to DB
	 * 
	 * @see Driver_Driver::connect()
	 */
	public function connect()
	{
		if ($this->connection)	return;

		$attributes = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

		$connValues = $this->conf->get('connection');
		if ($connValues['persistent'] === TRUE)
			$attributes[PDO::ATTR_PERSISTENT] = TRUE;

		try {
			$this->connection = new PDO($connValues['dsn'], $connValues['username'], $connValues['password'], $attributes);
		}
		catch (PDOException $e) {
			throw new Exception('DB error msg: ' . $e->getMessage() . ' DB error code: ' .  $e->getCode());
		}
	}

	/**
	 * Disconnect DB
	 * 
	 * @see Driver_Driver::disconnect()
	 */
	public function disconnect()
	{
		$this->connection = NULL;
	}
	
	/**
	 * Check connection, if not established, connects
	 */
	private function checkAndConnectDB()
	{
		if (!$this->connection)
			$this->connect();
	}
	
	/**
	 * Performs select action
	 * 
	 * @see Driver_Driver::select()
	 * @return mixed results
	 */
	public function select($table, $columns, $conditions)
	{
		$this->checkAndConnectDB();
		
		if (Helper_Check::isNull($columns))	$columns = array('*');
			
		Logger::Info("<hr />Driver_Pdo::select");
		
		$sql = $this->prepareSelectSql($table, $columns, $conditions);
		
		Logger::Info($sql);Logger::Info("<hr />");
		
		$statement = $this->connection->prepare($sql);
		$statement->execute();
		$statement->setFetchMode(PDO::FETCH_ASSOC);  
  
		$returnArr = array();
		while($row = $statement->fetch())  
		    $returnArr[] =  $row;
		   
		return $returnArr;
	}
	
	/**
	 * Prepares select query string
	 * 
	 * @return string sql
	 */
	private function prepareSelectSql($table, &$columns, &$conditions)
	{
        return "SELECT " . join(', ', $columns) . " FROM $table " . 
               " WHERE " . $this->prepareSqlConditionPart($conditions);
	}
	
	/**
	 * Prepares where condition part of a sql 
	 * 
	 * @return string
	 */
	private function prepareSqlConditionPart(&$conditions)
	{
        foreach ($conditions as $key => $value)
            $conds[] = "$key = $value";
            
		return join(' AND ', $conds);
	}
	
	/**
	 * Performs update action
	 * 
	 * @see Driver_Driver::update()
	 * @return boolean
	 */
	public function update($table, $data, $conditions)
	{
		$this->checkAndConnectDB();
		
		Logger::Info("<hr />Driver_Pdo::update");

		$sql = $this->prepareUpdateSql($table, $data, $conditions);
			
		Logger::Info($sql);Logger::Info("<hr />");
		
		$this->runInsertOrUpdateSql($sql, $data);
		
		return TRUE;
	}
	
	/**
	 * Prepares update query string
	 * 
	 * @return string sql
	 */
	private function prepareUpdateSql($table, &$data, &$conditions)
	{
        foreach ($data as $key => $value)
            $entries[] = "$key = ?";
            
        foreach ($conditions as $key => $value)
            $conds[] = "$key = $value";
        
        return "UPDATE $table SET " . join(', ', $entries) .
               " WHERE " . $this->prepareSqlConditionPart($conditions);
	}
	
	/**
	 * Performs insert action
	 * 
	 * @see Driver_Driver::insert()
	 * @return int last inserted id
	 */
	public function insert($table, $data)
	{
		$this->checkAndConnectDB();
		
		Logger::Info("<hr />Driver_Pdo::insert");

		$sql = $this->prepareInsertSql($table, $data);
		
		Logger::Info($sql);Logger::Info("<hr />");
		
		$this->runInsertOrUpdateSql($sql, $data);
		
		return $this->connection->lastInsertId();
	}
	
	/**
	 * Prepares insert query string
	 * 
	 * @return string sql
	 */
	private function prepareInsertSql($table, &$data)
	{
		$columns = join(',', array_keys($data));
		$values = $this->prepareUnnamedPlaceholders($data);
		
		return "INSERT INTO $table ($columns) VALUES ($values)";
	}
	
	/**
	 * Prepares unnamed placeholders string
	 * 
	 * @return string
	 */
	private function prepareUnnamedPlaceholders(&$data)
	{
		if (Helper_Check::isListEmptyOrNull($data))	return;
		
		$ph = array();
		foreach ($data as $d)
			$ph[] = '?';
		
		return join(',', $ph);
	}
	
	/**
	 * Runs insert or update sql
	 * 
	 * @param string $sql
	 * @param array $data
	 */
	private function runInsertOrUpdateSql($sql, &$data)
	{
		$statement = $this->connection->prepare($sql);
		$statement->execute(array_values($data));
	}
	
	/**
	 * Performs delete action
	 * 
	 * @see Driver_Driver::delete()
	 * @return boolean
	 */
	public function delete($table, $conditions)
	{
		$this->checkAndConnectDB();
		
		Logger::Info("<hr />Driver_Pdo::delete");

		$sql = $this->prepareDeleteSql($table, $conditions);
			
		Logger::Info($sql);Logger::Info("<hr />");
				
		$statement = $this->connection->prepare($sql);
		$statement->execute();
		
		return TRUE;
	}
	
	/**
	 * Prepares delete query string
	 * 
	 * @return string sql
	 */
	private function prepareDeleteSql($table, &$conditions)
	{
        return "DELETE FROM $table WHERE " . $this->prepareSqlConditionPart($conditions);
	}
}