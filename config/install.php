<?php
/**
 * @description Require files
 */
require('./database.php');
require('../model/agent.php');

$dbDetails = array(
  'dbName' => '',
  'dbHost' => 'localhost',
  'dbUser' => 'root',
  'dbPass' => ''
);

/**
 * @description Create connection
 */
$db = DataBase::connect_data_base($dbDetails);

$agents = array (
  "aaaa",
  "bbbb",
  "cccc",
  "dddd",
  "eeee"
);

try {
  $sql = file_get_contents("./script.sql");
  $db->dbConnection->exec($sql);

  echo "Database and table agents created successfully";
  echo "<br>";

  for ($i = 0; $i < count($agents); $i++) {
    $agent = new Agent($db);
    $agent->setFirstName ($agents[$i]);
    $agent->setLastName ($agents[$i]);
    $agent->setEmail ($agents[$i]."@gmail.com");
    $agent->setCreated (date('Y-m-d H:i:s'));
    
    $agent->create();
  }
  echo "All records inserted";
} catch (Exception $exception) {
  echo "Something was wrong: ".$exception->getMessage();
}


