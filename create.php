<?php
// required headers
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
 
// make sure data is not empty
if(
    !empty($data->datee) &&
    !empty($data->description) &&
    !empty($data->severite)
){
	var_dump($data);
 
    $ticket->datee=$data->datee;
    $ticket->description=$data->description;
    $ticket->severite=$data->severite;
 
    if($ticket->create()){
 
 
        echo json_encode(array("message" => "Ticket crée."));
    }
 

    else{
 
  
        echo json_encode(array("message" => "Impossible de créer."));
    }
}
 
else{
 
    
    echo json_encode(array("message" => "Impossible de créer. Données manquantes"));
}
?>