<?php
     $endpoint = 'http://proyecto/Backend/index.php';
    include 'logMessage.php'; 

    $nombreP = $_POST['nombre'];
    $nombreT = $_POST['nombreT'];
    $fechaIT = $_POST['fechaIT'];
    $fechaFT = $_POST['fechaFT'];

    $data = json_encode([
        "nombre" => $nombreP,
        "nombreT" => $nombreT,
        "fechaIT" => $fechaIT,
        "fechaFT" => $fechaFT
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
        log_message("Se inserto la tarea '$nombreT' al proyecto '$nombreP' con fecha de inicio '$fechaIT' y fecha de fin '$fechaFT'");
        echo "<script>
            alert('Tarea creada correctamente');
            window.location.href = './../editProyects.html';
        </script>";
    } else {
        echo "<script>
            alert('Error al crear la tarea');
            window.location.href = './../editProyects.html';
        </script>";
    }



    // $insert = "INSERT INTO `$nombreP` (tarea, fechaIT, fechaFT) VALUES ('$nombreT', '$fechaIT', '$fechaFT')";

    // $response = mysqli_query($conexion, $insert);

    // if($response == TRUE){
    //     log_message("Se inserto la tarea '$nombreT' al proyecto '$nombreP' con fecha de inicio '$fechaIT' y fecha de fin '$fechaFT'");
    //     echo "<script>
    //     alert('Tarea creada correctamente');
    //     window.location.href = './../main/editProyects.html';
    // </script>";
    // }else{
    //     echo "<script>
    //     alert('La tarea no se pudo insertar correctamente, revise el nombre del proyecto');
    //     window.history.back();
    // </script>";
    // }

?>