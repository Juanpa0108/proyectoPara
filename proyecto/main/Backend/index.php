<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Headers: Content-Type, Authorization");


$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);
$conexion = mysqli_connect("db", "root", "", "proyecto", 3306) or die ("Error en la conexion");


switch ($method) {
    case 'GET':
        if(isset($_GET['nombre'])){
            $nombre = $_GET['nombre'];
            $query = "SELECT tarea, fechaIT, fechaFT FROM $nombre";
            $result = mysqli_query($conexion, $query);
            $works = mysqli_fetch_all($result, MYSQLI_ASSOC);
            echo json_encode($works);
        }else{
            // Obtener los datos de la tabla 'proyectos'
            $query = "SELECT nombre, fechaI, fechaF FROM proyectos";
            $result = mysqli_query($conexion, $query);
            $projects = mysqli_fetch_all($result, MYSQLI_ASSOC);
            echo json_encode($projects);
        }

        break;

    case 'POST':
        if (isset($input['nombre'], $input['nombreT'], $input['fechaIT'], $input['fechaFT'])) {
            // Crear una nueva tarea
            $nombreP = $input['nombre'];
            $nombreT = $input['nombreT'];
            $fechaIT = $input['fechaIT'];
            $fechaFT = $input['fechaFT'];
            $query = "INSERT INTO $nombreP (tarea, fechaIT, fechaFT) VALUES ('$nombreT', '$fechaIT', '$fechaFT')";
            $result = mysqli_query($conexion, $query);
            echo json_encode(['success' => $result]);
            
        } elseif (isset($input['nombre'], $input['fechaI'], $input['fechaF'])) {
            // Crear un nuevo proyecto
            $nombre = $input['nombre'];
            $fechaI = $input['fechaI'];
            $fechaF = $input['fechaF'];
            $query1 = "CREATE TABLE $nombre (tarea VARCHAR(30), fechaIT DATE, fechaFT DATE)";
            $query2 = "INSERT INTO proyectos (nombre, fechaI, fechaF) VALUES ('$nombre', '$fechaI', '$fechaF')";
            $result1 = mysqli_query($conexion, $query1);
            $result2 = mysqli_query($conexion, $query2);
            echo json_encode(['success' => $result1 && $result2]);
            
        } else{
            echo json_encode(['error' => 'Unknown request']);
        }
        break;

    case 'PUT':
        if (isset($input['nombre'], $input['nombreT'], $input['fechaF'])) {
            // Actualizar la fecha final de una tarea
            $nombre = $input['nombre'];
            $nombreT = $input['nombreT'];
            $fechaF = $input['fechaF'];
            $query = "UPDATE $nombre SET fechaFT = '$fechaF' WHERE tarea = '$nombreT'";
            $result = mysqli_query($conexion, $query);
            echo json_encode(['success' => $result]);
            
        } elseif (isset($input['nombre'], $input['fechaF'])) {
            
            // Actualizar la fecha final de un proyecto
            $nombre = $input['nombre'];
            $fechaF = $input['fechaF'];
            $query = "UPDATE proyectos SET fechaF = '$fechaF' WHERE nombre = '$nombre'";
            $result = mysqli_query($conexion, $query);
            echo json_encode(['success' => $result]);
            
        } else{
            echo json_encode(['error' => 'Unknown request']);
        }
        break;

    case 'DELETE':
        if (isset($input['nombre'], $input['nombreT'])) {
            // Borrar una tarea
            $nombreP = $input['nombre'];
            $nombreT = $input['nombreT'];
            $query = "DELETE FROM $nombreP WHERE tarea = '$nombreT'";
            $result = mysqli_query($conexion, $query);
            echo json_encode(['success' => $result]);
            
        } elseif (isset($input['nombre'])) {
            // Borrar un proyecto
            $nombre = $input['nombre'];
            $query1 = "DROP TABLE $nombre";
            $query2 = "DELETE FROM proyectos WHERE nombre = '$nombre'";
            $result1 = mysqli_query($conexion, $query1);
            $result2 = mysqli_query($conexion, $query2);
            echo json_encode(['success' => $result1 && $result2]);
            
        } else{
            echo json_encode(['error' => 'Unknown request']);
        }
        break;

    default:
        
        echo json_encode(['error' => 'Unknown request method']);
        break;
}

mysqli_close($conexion);

?>
