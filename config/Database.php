<?php
class Database {
    // Database Parameters
    private $host = 'travelcreators.cyjab92k0cyh.us-east-1.rds.amazonaws.com';
    private $db_name = 'travelcreators';
    private $username = 'admin';
    private $password = '12345678';
    private $conn;

    // Database Connect
    public function connect() {
        $this->conn = null;

        try { 
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }

        return $this->conn;
    }
}