<?php
    include 'logMessage.php'; 
    $endpoint = 'http://proyecto/Backend/index.php';
    
    $nombre = $_POST['nombre'];
    $fechaI = $_POST['fechaI'];
    $fechaF = $_POST['fechaF'];

    $data = json_encode([
        "nombre" => $nombre,
        "fechaI" => $fechaI,
        "fechaF" => $fechaF
    ]);

    $ch = curl_init();


    curl_setopt($ch, CURLOPT_URL, $endpoint);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
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
        log_message("El proyecto '$nombre' fue creado con fecha de inicio '$fechaI' y fecha de finalizacion '$fechaF'");
        echo "<script>
            alert('Proyecto creado correctamente');
            window.location.href = './../createProyects.html';
        </script>";
    } else {
        echo "<script>
            alert('Error al crear el proyecto');
            window.location.href = './../createProyects.html';
        </script>";
    }


    // $createTable = "CREATE TABLE `$nombre`
    //                 (tarea varchar(30), 
    //                  fechaIT date, 
    //                  fechaFT date)";

    // $result1 = mysqli_query($conexion, $createTable);

    // $inserTable = "INSERT INTO proyectos (nombre, fechaI, fechaF) VALUES ('$nombre', '$fechaI', '$fechaF')";

    // $result2 = mysqli_query($conexion, $inserTable);

    // if($result2===TRUE){
    //     log_message("La tabla para el proyecto '$nombre' fue creada con fecha de inicio '$fechaI' y fecha de finalizacion '$fechaF'");
    //     echo "<script>
    //     alert('Proyecto creado correctamente');
    //     window.location.href = './../main/createProyects.html';
    // </script>";
    // }

   


?>