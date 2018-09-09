<?php
/**
 * @description Require headers
 */
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Header: Content-Type, Access-Control-Allow-Header, Authorization, X-Requested-With");

/**
 * @description Require files
 */
require('../config/database.php');
require('../model/agent.php');

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

/**
 * description Get parameters sent by POST
 */
$data = json_decode(file_get_contents("php://input"));

$agent->setFirstName ($data->first_name);
$agent->setLastName ($data->last_name);
$agent->setEmail ($data->email);
$agent->setCreated (date('Y-m-d H:i:s'));

if ($agent->create()) {
  echo json_encode(array("success" => true));
} else {
  echo json_encode(array("message" => "Unable to create Agent."));
}
