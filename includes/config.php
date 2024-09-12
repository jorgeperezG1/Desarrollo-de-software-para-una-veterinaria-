<?php
// Definir las constantes para la conexión a la base de datos solo si no están ya definidas

// Comprobar si la constante DB_SERVER ya está definida
if (!defined('DB_SERVER')) {
    // Definir la constante para el nombre del servidor de base de datos
    define('DB_SERVER', 'localhost');
}

// Comprobar si la constante DB_USERNAME ya está definida
if (!defined('DB_USERNAME')) {
    // Definir la constante para el nombre de usuario para la base de datos
    define('DB_USERNAME', 'root');
}

// Comprobar si la constante DB_PASSWORD ya está definida
if (!defined('DB_PASSWORD')) {
    // Definir la constante para la contraseña para la base de datos
    define('DB_PASSWORD', '');
}

// Comprobar si la constante DB_DATABASE ya está definida
if (!defined('DB_DATABASE')) {
    // Definir la constante para el nombre de la base de datos
    define('DB_DATABASE', 'veterinaria');
}
?>
