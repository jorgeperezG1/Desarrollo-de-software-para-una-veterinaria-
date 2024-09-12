<?php
// Iniciar la sesión
session_start();

// Eliminar todas las variables de sesión
session_unset();

// Destruir la sesión actual
session_destroy();

// Redirigir al usuario a la página de inicio de sesión
header('Location: login.php');
exit();
?>
