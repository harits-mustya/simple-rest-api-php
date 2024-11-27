<?php

class Pokemon {
    private $conn;
    private $table = "pokemon";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getPokemons() {
        $query = "SELECT * FROM m_pokemon";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addPokemon($name, $type) {
        $query = "INSERT INTO m_pokemon (name, type) VALUES (:name, :type)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':type', $type);

        return $stmt->execute();
    }

    public function EditPokemon($id,$name, $type) {
        // $query = "UPDATE m_pokemon set name=:name,type=:type where name=:name or type=:type";
        $query = "UPDATE m_pokemon set name=:name,type=:type where id=:id";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':type', $type);

        return $stmt->execute();
    }

    public function UpdatePokemon($id,$name, $type) {
        $query = "UPDATE m_pokemon set name=:name,type=:type where id=:id";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':type', $type);

        return $stmt->execute();
    }

    public function DeletePokemon($id) {
       
        $queryfind = "SELECT * FROM m_pokemon where id=:id";
        $stmtfind = $this->conn->prepare($queryfind);
        $stmtfind->bindParam(":id", $id, PDO::PARAM_INT);
        $stmtfind->execute();
        
        if($stmtfind->rowcount()===0){
            return false;
        }
        
        $query = "DELETE FROM m_pokemon where id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
