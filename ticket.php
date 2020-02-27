<?php


class Ticket
{
	public $id;
	public $datee;
	public $description;
	public $severite;

	private $connection;

	public function __construct($connection)
	{
		
		$this->connection=$connection;
	}


	public function create()
	{
		$query="INSERT INTO ticket(datee,description,severite) VALUES(:datee, :description,:severite)";
		$ct=$this->connection->prepare($query);

		$this->datee=htmlspecialchars(strip_tags($this->datee));
    $this->description=htmlspecialchars(strip_tags($this->description));
    $this->severite=htmlspecialchars(strip_tags($this->severite));


		$ct->bindParam(":datee",$this->datee);
		$ct->bindParam(":description",$this->description);
		$ct->bindParam(":severite",$this->severite);

		if($ct->execute())
		{
			return true;
		}

		return false;
	}

	public function read()
	{
		$query= "SELECT * FROM ticket";

		$p=$this->connection->prepare($query);

		$p->execute();

		return $p;
	}

	// update the product
function update(){
 
    $query = "UPDATE
                ticket
            SET
                datee = :datee,
                description = :description,
                severite = :severite
            WHERE
                id = :id";
    $stmt = $this->connection->prepare($query);
 
    $this->datee=htmlspecialchars(strip_tags($this->datee));
    $this->description=htmlspecialchars(strip_tags($this->description));
    $this->severite=htmlspecialchars(strip_tags($this->severite));
    $this->id=htmlspecialchars(strip_tags($this->id));
 
    $stmt->bindParam(':datee', $this->datee);
    $stmt->bindParam(':description', $this->description);
    $stmt->bindParam(':severite', $this->severite);
    $stmt->bindParam(':id', $this->id);
 
    if($stmt->execute()){
        return true;
    }
 
    return false;
}

	public function delete()
	{

    $query = "DELETE FROM ticket WHERE id = ?";
 
    $stmt = $this->connection->prepare($query);
 
    $this->id=htmlspecialchars(strip_tags($this->id));
    $stmt->bindParam(1, $this->id);
 
    if($stmt->execute()){
        return true;
    }
 
    return false;
		
	}
}