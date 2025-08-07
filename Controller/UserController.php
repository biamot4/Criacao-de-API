<?php

namespace Controller;
use Model\user;


class UserController 
{
    public function  getUsers()
    {

        $user = new User();
        $users = $user->getUsers();

        if($users){
            //ENVIA A RESPOSTA 
            header('Content-Type: application/json');
            echo json_encode($users);
        } else {

            echo json_encode(["message" => "No users found"]);
        }
    }
    //FUNÇÃO PARA CRIAR UM USUÁRIO
    public function creatUser(){
        $data = json_decode (file_get_contents("php://input"));

        if(isset($data->name) && isset($data->email)){
            $user = new User();
            $user->name = $data->name;
            $user->email = $data->email;

            if($user->createUser()){
                echo json_encode(["message" => "User created sucessfully"]);
            } else {
                echo json_encode(["message" => "Failed to create user"]);
            }
        } else {
            echo json_encode(["message" => "Invalid Input"]);
        }
    }
}







?>