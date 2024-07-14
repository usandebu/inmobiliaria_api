<?php
include_once(__DIR__ . '/../config/database.php');
include_once(__DIR__ . '/../models/Propietario.php');


// Añadir línea de depuración
if (!class_exists('Propietario')) {
  die('La clase Propietario no existe');
}

class PropietariosController {
    private $db;
    private $propietario;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->propietario = new Propietario($this->db);
    }

    public function getAll() {
        $stmt = $this->propietario->read();
        $propietarios_arr = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $propietario_item = array(
                "id" => $id,
                "nombre" => $nombre,
                "telefono" => $telefono,
                "email" => $email
            );
            array_push($propietarios_arr, $propietario_item);
        }
        echo json_encode($propietarios_arr);
    }
}
?>