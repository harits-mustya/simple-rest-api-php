<?php
require_once 'config/api_database.php';
require_once 'model/api_pokemon.php';

class api_controller{
    private $pokemon;
    private $db;

    public function __construct(){
        $database = new api_database();
        $this->db = $database->getConnection();
        $this->pokemon = new Pokemon($this->db);
    }

    public function getAll(){
        $data = $this->pokemon->getPokemons();
        echo json_encode($data);
    }
    
    public function add() {
        $input = json_decode(file_get_contents("php://input"), true);

        if(!empty($input['name'])&&!empty($input['type'])){
            $this->pokemon->addPokemon($input['name'],$input['type']);
            echo json_encode(["Message" => "Success add new pokemon"]);
        } else {
            http_response_code(400);
            echo json_encode(["Message" => "Error input"]);
        }

    }

    public function del() {
        $input = json_decode(file_get_contents("php://input"), true);
    
        // $id = $data['id'] ?? null;
    
        if(!empty($input['id'])){
            $result = $this->pokemon->DeletePokemon($input['id']);
            if($result){
                echo json_encode(['Message'=> 'Success Delete Pokemon']);
            }
            else {
            http_response_code(404);
            echo json_encode(["Message" => "Data not found, please check again"]);
            }
        }
        else {
            http_response_code(400);
            echo json_encode(["Message" => "Error Input"]);
        }
    }
    

    public function upd() {
        $input = json_decode(file_get_contents("php://input"), true);

        if(!empty($input['id'])&&!empty($input['name'])&&!empty($input['type'])){
            $this->pokemon->UpdatePokemon($input['id'],$input['name'],$input['type']);
            echo json_encode(["Message" => "Success update new pokemon"]);
        } else {
            http_response_code(400);
            echo json_encode(["Message" => "Error input"]);
        }

    }

    public function edit() {
        $input = json_decode(file_get_contents("php://input"), true);

        if(!empty($input['id'])&&!empty($input['name'])&&!empty($input['type'])){
            $this->pokemon->EditPokemon($input['id'],$input['name'],$input['type']);
            echo json_encode(["Message" => "Success edit new pokemon"]);
        } else {
            http_response_code(400);
            echo json_encode(["Message" => "Error input"]);
        }

    }

}
