<?php


    include 'logMessage.php'; 
    $endpoint = 'http://proyecto/Backend/index.php';

    $nombre = $_POST['nombre'];
    $nombreT = $_POST['nombreT'];
    $fechaF = $_POST['fechaF'];

    $data = json_encode([
        "nombre" => $nombre,
        "nombreT" => $nombreT,
        "fechaF" => $fechaF
    ]);

    $ch = curl_init();


    curl_setopt($ch, CURLOPT_URL, $endpoint);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Content-Length: ' . strlen($data)
    ]);


    $response = curl_exec($ch);


    curl_close($ch);

    $result = json_decode($response, true);

    if (isset($result['success']) && $result['success'] == true) {
        log_message("La tarea '$nombreT' del proyecto '$nombre' cambio su fecha de finalizacion a '$fechaF'");
        echo "<script>
            alert('Tarea actualizada correctamente');
            window.location.href = './../editProyects.html';
        </script>";
    } else {
        echo "<script>
            alert('Error al actualizar la tarea');
            window.location.href = './../editProyects.html';
        </script>";
    }

   

?>