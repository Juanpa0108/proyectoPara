<?php
    session_start();

    $endpoint = 'http://proyecto/Backend/index.php';

    $ch = curl_init();

    // Configurar cURL
    curl_setopt($ch, CURLOPT_URL, $endpoint);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Ejecutar cURL y obtener la respuesta
    $response = curl_exec($ch);

    // Cerrar cURL
    curl_close($ch);

    // Decodificar la respuesta JSON
    $projects = json_decode($response, true);

    // Verificar si la respuesta contiene un error
    if (isset($projects['error'])) {
        echo "Error: " . $projects['error'];
    } else {
        // Devolver las actividades como JSON
        echo json_encode($projects);
    }






    // $conexion = mysqli_connect("localhost", "root", "", "proyecto") or die ("Error en la conexion");

    // // Consulta para obtener las actividades del usuario
    // $sql = "SELECT  nombre, fechaI, fechaF FROM proyectos";
    // $result = mysqli_query($conexion, $sql);

    // // Almacenar las actividades en un array
    // $proyectos = [];
    // while ($row = mysqli_fetch_assoc($result)) {
    //     $proyectos[] = $row;
    // }

    // // Devolver las actividades como JSON
    // echo json_encode($proyectos);
?>