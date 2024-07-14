<?php
//  http://localhost/inmobiliaria_api/index.php?endpoint=propietarios
// http://localhost/inmobiliaria_api/index.php?endpoint=viviendas
include_once(__DIR__ . '/../controllers/ViviendasController.php');
include_once(__DIR__ . '/../controllers/PropietariosController.php');

$propietariosController = new PropietariosController();
$viviendasController = new ViviendasController();

// if ($_SERVER['REQUEST_METHOD'] === 'GET') {
//     if (isset($_GET['endpoint'])) {
//         switch ($_GET['endpoint']) {
//             case 'propietarios':
//                 $propietariosController->getAll();
//                 break;
//             case 'viviendas':
//                 // $viviendasController->getAll();
//                 $viviendasController->getAllWithPropietarios(); // Usar el nuevo método que incluye propietarios

//                 break;
//             default:
//                 echo json_encode(array("message" => "Endpoint not found."));
//         }
//     } else {
//         echo json_encode(array("message" => "No endpoint specified."));
//     }
// } else {
//     echo json_encode(array("message" => "Invalid request method."));
// }
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Si se accede directamente a http://localhost/inmobiliaria_api/index.php
    if ($_SERVER['REQUEST_URI'] === '/inmobiliaria_api/' || $_SERVER['REQUEST_URI'] === '/inmobiliaria_api') {
        $viviendasController->getAllWithPropietarios(); // Devuelve todas las viviendas con propietarios
    } elseif (isset($_GET['endpoint'])) {
        switch ($_GET['endpoint']) {
            case 'propietarios':
                $propietariosController->getAll();
                break;
            case 'viviendas':
                $viviendasController->getAllWithPropietarios(); // Usar el nuevo método que incluye propietarios anidados
                break;
            default:
                echo json_encode(array("message" => "Endpoint not found."));
        }
    } else {
        echo json_encode(array("message" => "Invalid request."));
    }
} else {
    echo json_encode(array("message" => "Invalid request method."));
}
?>