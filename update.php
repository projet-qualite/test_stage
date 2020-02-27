<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once 'database.php';
include_once 'ticket.php';
 
$database = new Database();
$db = $database->dbConnection();
 
$ticket = new Ticket($db);


 
$data = json_decode(file_get_contents("php://input"));

var_dump($data);


$ticket->id = $data->id;
$ticket->datee = $data->datee;
$ticket->description = $data->description;
$ticket->severite = $data->severite;
 
if($ticket->update()){
 
    http_response_code(200);
 
    echo json_encode(array("message" => "Ticket mis à jour."));
}
 
else{
 
    http_response_code(503);
 
    echo json_encode(array("message" => "Impossible de mettre le ticket à jour."));
}

?>