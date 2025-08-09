<?php

namespace Controller;
use Model\User;


class UserController 
{
    public function  getUsers()
    {

        $user = new User();
        $users = $user->getUsers();

        if($users){
            //ENVIA A RESPOSTA 
            header('Content-Type: application/json', true, 200);
            echo json_encode($users);
        } else {
            header('content-Type: application/json', true, 404);
            echo json_encode(["message" => "No users found"]);
        }
    }
    //FUNÇÃO PARA CRIAR UM USUÁRIO
    public function createUser(){
        $data = json_decode (file_get_contents("php://input"));

        if(isset($data->name) && isset($data->email)){
            $user = new User();
            $user->name = $data->name;
            $user->email = $data->email;

            if($user->createUser()){
                header('content-Type: application/json', true, 201);
                echo json_encode(["message" => "User created sucessfully"]);
            } else {
                header('content-Type: application/json' , true, 500);
                echo json_encode(["message" => "Failed to create user"]);
            }
        } else {
            header('content-Type: application/json', true, 400);
            echo json_encode(["message" => "Invalid Input"]);
        }
    }

     public function updateUser(){

        $data = json_decode (file_get_contents("php://input"));

        if(isset($data->id) && isset($data->name) && isset($data->email)){
            $user = new User();
            $user->id = $data->id;
            $user->name = $data->name;
            $user->email = $data->email;

            if($user->updateUser()){
                header('content-Type: application/json', true, 200);
                echo json_encode(["message" => "Usuário atualizado com sucesso!"]);
            } else {
                header('content-Type: application/json' , true, 500);
                echo json_encode(["message" => "Falha ao atualizar usuário"]);
            }
        } else {
            header('content-Type: application/json', true, 400);
            echo json_encode(["message" => "Informação inválida"]);
        }
    }

    public function deleteUser(){
        $id = $_GET['id'] ?? null;

        if($id){
            $user = new User();
            $user->id = $id;

            if($user->deleteUser()){
                header('content-Type: application/json', true, 200);
                echo json_encode(["message" => "Usuário excluido com sucesso!"]);
            } else {
                header('content-Type: application/json' , true, 500);
                echo json_encode(["message" => "Falha ao excluir usuário"]);
            }
        } else {
            header('content-Type: application/json', true, 400);
            echo json_encode(["message" => "Id inválido"]);
        }
    }
}

?>