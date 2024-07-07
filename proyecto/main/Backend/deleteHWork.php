<?php

    include 'logMessage.php'; 
    $endpoint = 'http://proyecto/Backend/index.php';
    
    $nombreP = $_POST['nombre'];
    $nombreT = $_POST['nombreT'];

    $data = json_encode([
        "nombre" => $nombreP,
        "nombreT" => $nombreT
    ]);

    $ch = curl_init();


    curl_setopt($ch, CURLOPT_URL, $endpoint);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
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
        log_message("La tarea '$nombreT' del proyecto '$nombreP' fue eliminada");
        echo "<script>
            alert('Tarea eliminada correctamente');
            window.location.href = './../editProyects.html';
        </script>";
    } else {
        echo "<script>
            alert('Error al eliminar la tarea');
            window.location.href = './../editProyects.html';
        </script>";
    }



    // $delete = "DELETE FROM `$nombreP` WHERE tarea = '$nombreT'";

    // $result = mysqli_query($conexion, $delete);

    // if($result == TRUE){
    //     log_message("La tarea '$nombreT' del proyecto '$nombreP' fue eliminada");
    //     echo "<script>
    //         alert('Tarea eliminada correctamente');
    //         window.location.href = './../main/editProyects.html';
    //     </script>";
    // }else{
    //     echo "<script>
    //         alert('La tarea no se elimino correctamente');
    //         window.history.back();
    //     </script>";
    // }


?>