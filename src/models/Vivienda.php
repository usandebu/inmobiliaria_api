<?php
class Vivienda {
    private $conn;
    private $table_name = "viviendas";

    public $id;
    public $precio;
    public $metros_cuadrados;
    public $habitaciones;
    public $fecha_construccion;
    public $amueblada;
    public $propietario_id;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Método para obtener todas las viviendas con información completa del propietario
    public function getAllWithPropietarios() {
        $query = "SELECT v.id, v.precio, v.metros_cuadrados, v.habitaciones, v.fecha_construccion, 
                         v.amueblada, p.id as propietario_id, p.nombre, p.telefono, p.email
                  FROM viviendas v
                  INNER JOIN propietarios p ON v.propietario_id = p.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $viviendas = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $vivienda = array(
                "id" => $row['id'],
                "precio" => $row['precio'],
                "metros_cuadrados" => $row['metros_cuadrados'],
                "habitaciones" => $row['habitaciones'],
                "fecha_construccion" => $row['fecha_construccion'],
                "amueblada" => $row['amueblada'],
                "propietario" => array(
                    "id" => $row['propietario_id'],
                    "nombre" => $row['nombre'],
                    "telefono" => $row['telefono'],
                    "email" => $row['email']
                )
            );
            $viviendas[] = $vivienda;
        }

        return $viviendas;
    }
}
?>