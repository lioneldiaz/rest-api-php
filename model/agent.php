<?php
class Agent
{
  private $connection;
  private $table_name = 'tb_agents';

  private $id;
  private $first_name;
  private $last_name;
  private $status;
  private $email;
  private $created;
  private $modified;

  /**
   * @description Constructor
   * @param {Object} db Object of type PDO  
   */
  public function __construct ($db) {
    $this->connection = $db;
  }

  /**
   * @description Read Agents 
   */
  public function read(){
    $query = "SELECT
                id, first_name, last_name, email, status, created, modified
              FROM
                ".$this->table_name." 
              ORDER BY
                first_name DESC";
                
    $reuslt = $this->connection->dbConnection->prepare($query);
    $reuslt->execute();

    return $reuslt;
  }
}
