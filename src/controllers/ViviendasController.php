<?php
include_once(__DIR__ . '/../config/database.php');
include_once(__DIR__ . '/../models/Vivienda.php');

// Añadir línea de depuración
if (!class_exists('Vivienda')) {
  die('La clase Vivienda no existe');
}

class ViviendasController {
    private $db;
    private $vivienda;
    private $viviendaModel;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->vivienda = new Vivienda($this->db);
        $this->viviendaModel = new Vivienda($this->db);
    }

    public function getAll() {
        $stmt = $this->vivienda->read();
        $viviendas_arr = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $vivienda_item = array(
                "id" => $id,
                "precio" => $precio,
                "metros_cuadrados" => $metros_cuadrados,
                "habitaciones" => $habitaciones,
                "fecha_construccion" => $fecha_construccion,
                "amueblada" => $amueblada,
                "propietario_id" => $propietario_id
            );
            array_push($viviendas_arr, $vivienda_item);
        }
        echo json_encode($viviendas_arr);
    }

    public function getAllWithPropietarios() {
        $viviendas = $this->viviendaModel->getAllWithPropietarios(); // Obtener todas las viviendas con propietarios

        // Devolver respuesta JSON con las viviendas y propietarios
        header('Content-Type: application/json');
        echo json_encode($viviendas);
    }
}
?>