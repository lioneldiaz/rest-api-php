<?php

class DataBase {
  private $dbName;
  private $dbHost;
  private $dbPass;
  private $dbUser;
  static $connection;

  /**
   * @description Constructor
   * @param {Array} dbDetails Array with the parameters for the connection to the database 
   */
  private function __construct ($dbDetails = array()) {
    $this->dbName = $dbDetails['dbName'];
    $this->dbHost = $dbDetails['dbHost'];
    $this->dbUser = $dbDetails['dbUser'];
    $this->dbPass = $dbDetails['dbPass'];

    try {
      $this->dbConnection = new PDO('mysql:host='.$this->dbHost.';dbname='.$this->dbName, $this->dbUser, $this->dbPass);
    } catch (PDOException $exception) {
      echo "Connection ERROR: " . $exception->getMessage();
    }      
  }

  /**
   * @description Verify if there is a connection, if connection exists, return the connection in another way, create the connection
   * @param {Array} dbDetails Array with the parameters for the connection to the database
   */
  static function connect_data_base ($dbDetails) {
    if (isset(self::$connection)) {
      return $connection;
    } else {
      return self::$connection = new DataBase($dbDetails);
    }
  }
}
