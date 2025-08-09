<?php

namespace Model;

use PDO;
use Model\Connection;


class User 
{

    private $conn;

    public $id;
    public $name;

    public $email;


    public function __construct()
    {
        $this->conn = Connection :: getConnection();
    }

    //MÉTODO PARA OBTER TODOS OS USUÁRIOS

    public function getUsers()
    {
    
        $sql = "SELECT * FROM users";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createUser()
    {
        $sql = "INSERT INTO users( name, email) VALUES (:name, :email)";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":name" , $this->name, PDO::PARAM_STR);
        $stmt->bindParam(":email", $this->email, PDO::PARAM_STR);

        if ($stmt->execute()){
            return true;
        }
        
        return false;
    }

    public function updateUser()
    {
        $sql = "UPDATE users SET name = :name, email = :email WHERE id = :id";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
        $stmt->bindParam(":name", $this->name, PDO::PARAM_STR);
        $stmt->bindParam(":email", $this->email, PDO::PARAM_STR);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    public function deleteUser()
    {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindparam(":id", $this->id, PDO::PARAM_INT);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

}




?>