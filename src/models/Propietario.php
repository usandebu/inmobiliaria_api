<?php
class Propietario {
    private $conn;
    private $table_name = "propietarios";

    public $id;
    public $nombre;
    public $telefono;
    public $email;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
?>