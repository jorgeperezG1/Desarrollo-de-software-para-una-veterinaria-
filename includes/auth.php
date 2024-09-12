<?php
// Incluir el archivo de conexión a la base de datos
include 'db.php';

// Función para autenticar al usuario
function authenticate($username, $password) {
    // Obtener una conexión a la base de datos
    $conn = get_db_connection();

    // Convertir el nombre de usuario a minúsculas para la verificación
    $username_lower = strtolower($username);

    // Preparar y ejecutar la consulta para obtener el usuario
    $query = "SELECT * FROM users WHERE LOWER(username) = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 's', $username_lower);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        // Verificar la contraseña usando password_verify
        if (password_verify($password, $row['password'])) {
            // Devolver el nombre de usuario formateado
            $formatted_username = $row['username'];
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            return $formatted_username;
        } else {
            // Contraseña incorrecta
            echo "Password is incorrect!<br>";
        }
    }

    // Cerrar la conexión y la declaración
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    return false;
}
?>
