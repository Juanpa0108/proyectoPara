<?php


    include 'logMessage.php'; 
    $endpoint = 'http://proyecto/Backend/index.php';

    $nombre = $_POST['nombre'];

    $data = json_encode([
        "nombre" => $nombre
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
        log_message("El proyecto '$nombre' ha sido borrado correctamente");
        echo "<script>
            alert('Proyecto eliminado correctamente');
            window.location.href = './../editProyects.html';
        </script>";
    } else {
        echo "<script>
            alert('Error al eliminar proyecto');
            window.location.href = './../editProyects.html';
        </script>";
    }

    // $delete = "DROP TABLE `$nombre`";

    // $deleteName = "DELETE FROM `proyectos` WHERE nombre = '$nombre'";

    // $result = mysqli_query($conexion, $delete);
    // $result2 = mysqli_query($conexion, $deleteName);

    // if($result == TRUE && $result2 == TRUE){
    //     log_message("El proyecto '$nombre' fue eliminado");
    //     echo "<script>
    //         alert('Proyecto eliminado correctamente');
    //         window.location.href = './../main/editProyects.html';
    //     </script>";
    // }







?>