<?php 
/**
 * @description Require headers
 */
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

/**
 * @description Require files
 */
require('../model/agent.php');
require('../config/database.php');
 
$dbDetails = array(
  'dbName' => 'api_realstate',
  'dbHost' => 'localhost',
  'dbUser' => 'root',
  'dbPass' => ''
);

/**
 * @description Create connection
 */
$database = DataBase::connect_data_base($dbDetails);

/**
 * @description Create object Agent
 */
$agent = new Agent($database);

$result = $agent->read();
$numResult = $result->rowCount();

if($numResult > 0){
$agentArray = array();
$agentArray['agents'] = array();

while ($row = $result->fetch(PDO::FETCH_ASSOC)){    
  extract($row);
  $agent=array(
      "id" => $id,
      "first_name" => $first_name,
      "last_name" => $last_name,
      "email" => $email,
      "status" => $status,
      "created" => $created,
      "modified" => $modified
  );
  array_push($agentArray['agents'], $agent);
}
  echo json_encode($agentArray);
} else {
  echo json_encode(array("message" => "No agents found."));
}
