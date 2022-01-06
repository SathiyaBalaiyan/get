<?php

class UserGateway
{ 
    //private PDO $conn;   
    public function __construct(Database $database)
    {
        $this->conn = $database->getConnection();    
    }

    public function getByUsername(string $username): array
    {

        $sql = "SELECT * FROM user_table WHERE username = :username";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(":username", $username, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
}






   


 
