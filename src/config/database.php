<?php
class Database {
    private $host = $_ENV["localhost"];
    private $db_name = $_ENV["inmobiliaria"];
    private $username = $_ENV["username"];
    private $password = $_ENV["password"];
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>