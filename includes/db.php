<?php
// Incluir la configuración de la base de datos
include_once 'config.php';

// Función para obtener una conexión a la base de datos
function get_db_connection() {
    // Intentar conectar a la base de datos
    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

    // Comprobar si la conexión fue exitosa
    if (!$conn) {
        // Mostrar un mensaje de error y terminar el script si la conexión falla
        die('No se pudo conectar a la base de datos: ' . mysqli_connect_error());
    }

    // Retornar la conexión
    return $conn;
}
?>
