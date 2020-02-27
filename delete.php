<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once 'database.php';
include_once 'ticket.php';
 
$database = new Database();
$db = $database->dbConnection();
 
$ticket = new Ticket($db);
 
$data = json_decode(file_get_contents("php://input"));
 
$ticket->id = $data->id;
 
if($ticket->delete()){
 
    http_response_code(200);

    var_dump($data);
 
    echo json_encode(array("message" => "Ticket supprimé."));
}
 
else{
 
    http_response_code(503);
 
    echo json_encode(array("message" => "Impossible de supprimer."));
}
?>