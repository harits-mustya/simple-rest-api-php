<?php

class api_database{
    private $db_host = "localhost";
    private $db_name = "PUT YOUR DATABASENAME";
    private $db_username = "PUT YOUR USERNAME";
    private $db_password = "PUT YOUR PASSWORD";

    public $conn;

    public function getConnection() {
        $this->conn = null;
    
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->db_host . ";dbname=" . $this->db_name,
                $this->db_username,
                $this->db_password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection error: " . $e->getMessage();
        }
    
        return $this->conn;
    }
    
}
