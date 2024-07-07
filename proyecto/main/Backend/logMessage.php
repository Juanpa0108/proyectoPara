<?php

function log_message($message) {
    $log_file = 'main/Backend/app.log'; // Nombre del archivo de log
    $current_time = date('Y-m-d H:i:s'); // Fecha y hora actual
    $log_entry = "[" . $current_time . "] " . $message . "\n"; // Formato del mensaje de log
    file_put_contents($log_file, $log_entry, FILE_APPEND); // Escribir en el archivo de log
}

?>