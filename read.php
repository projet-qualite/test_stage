<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once 'database.php';
include_once 'ticket.php';
 

$database = new Database();
$db = $database->dbConnection();
 
$ticket = new Ticket($db);

$rt= $ticket->read();
$nombre=$rt->rowCount();


if($nombre>0)
{
	$tab=array();
	$tab["enr"]=array();

	while($ligne=$rt->fetch(PDO::FETCH_ASSOC))
	{

		extract($ligne);

		$ticket_elements=array(
			'id' =>$id , 
			'datee' =>$datee ,
			'description' =>$description ,
			'severite' =>$severite);

		array_push($tab["enr"], $ticket_elements);
	}
	http_response_code(200);	
	echo json_encode($tab);
}

else{
	http_response_code(404);
	echo json_encode(array('Message' => "Aucun ticket trouvé"));
}