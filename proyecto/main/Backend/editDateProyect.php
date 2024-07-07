<?php


    include 'logMessage.php'; 
    $endpoint = 'http://proyecto/Backend/index.php';

    $nombre = $_POST['nombre'];
    $fechaF = $_POST['fechaF'];

    $data = json_encode([
        "nombre" => $nombre,
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
        log_message("El proyecto '$nombre' cambio su fecha de finalizacion a '$fechaF'");
        echo "<script>
            alert('Fecha finalizacion actualizada correctamente');
            window.location.href = './../editProyects.html';
        </script>";
    } else {
        echo "<script>
            alert('Error al actualizar la fecha de finalizacion');
            window.location.href = './../editProyects.html';
        </script>";
    }

    // $update = "UPDATE proyectos SET `fechaF` = '$fechaF' WHERE `nombre`= '$nombre'";

    // $result = mysqli_query($conexion, $update);

    // if ($result == true){
    //     log_message("El proyecto '$nombre' cambio su fecha de finalizacion a '$fechaF'");
    //     echo "<script>
    //         alert('fecha finalizacion actualizada correctamente');
    //         window.location.href = './../main/editProyects.html';
    //     </script>";
    // }


?>