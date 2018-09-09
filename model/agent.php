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
   * @description Properties
   */
  public function setFirstName ($first_name) {
    $this->first_name = $first_name;
  }
  public function setLastName ($last_name) {
    $this->last_name = $last_name;
  }
  public function setEmail ($email) {
    $this->email = $email;
  }
  public function setCreated ($created) {
    $this->created = $created;
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

  /**
   * @description Insert new agent
   */
  public function create () {
    $query = "INSERT INTO
                ".$this->table_name."
              SET
                first_name=:first_name, last_name=:last_name, email=:email, created=:created";
    $result = $this->connection->dbConnection->prepare($query);

    $this->first_name = htmlspecialchars(strip_tags($this->first_name));
    $this->last_name = htmlspecialchars(strip_tags($this->last_name));
    $this->email = htmlspecialchars(strip_tags($this->email));
    $this->created = htmlspecialchars(strip_tags($this->created));

    $result->bindParam(":first_name", $this->first_name);
    $result->bindParam(":last_name", $this->last_name);
    $result->bindParam(":email", $this->email);
    $result->bindParam(":created", $this->created);

    if ($result->execute()) return true;
    else return false;
  }
}
