<?php
// Definir las constantes para la conexión a la base de datos solo si no están ya definidas

// Comprobar si la constante DB_SERVER ya está definida
if (!defined('DB_SERVER')) {
    // Definir la constante para el nombre del servidor de base de datos
    define('DB_SERVER', 'sql113.infinityfree.com');
}

// Comprobar si la constante DB_USERNAME ya está definida
if (!defined('DB_USERNAME')) {
    // Definir la constante para el nombre de usuario para la base de datos
    define('DB_USERNAME', 'if0_37205457');
}

// Comprobar si la constante DB_PASSWORD ya está definida
if (!defined('DB_PASSWORD')) {
    // Definir la constante para la contraseña para la base de datos
    define('DB_PASSWORD', 'xVSD9LDbYDmqt2');
}

// Comprobar si la constante DB_DATABASE ya está definida
if (!defined('DB_DATABASE')) {
    // Definir la constante para el nombre de la base de datos
    define('DB_DATABASE', 'if0_37205457_veterinaria');
}
?>
