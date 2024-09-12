<?php
// Incluir el archivo de conexión a la base de datos
include 'db.php';

// Función para registrar un nuevo usuario
function register_user($username, $password, &$error) {
    // Obtener una conexión a la base de datos
    $conn = get_db_connection();

    // Convertir el nombre de usuario a minúsculas para la verificación
    $username_lower = strtolower($username);

    // Verificar si el nombre de usuario ya existe (ignorando mayúsculas y minúsculas)
    $query_check = "SELECT * FROM users WHERE LOWER(username) = ?";
    $stmt_check = mysqli_prepare($conn, $query_check);
    mysqli_stmt_bind_param($stmt_check, 's', $username_lower);
    mysqli_stmt_execute($stmt_check);
    $result_check = mysqli_stmt_get_result($stmt_check);

    if (mysqli_num_rows($result_check) > 0) {
        // Si ya existe un usuario con ese nombre, configurar el mensaje de error y retornar falso
        $error = 'Error al registrar el usuario. "' . htmlspecialchars($username) . '" ya se encuentra registrado.';
        mysqli_stmt_close($stmt_check);
        mysqli_close($conn);
        return false;
    }

    // Continuar con el registro si no existe
    mysqli_stmt_close($stmt_check);

    // Formatear el nombre de usuario para que tenga la primera letra en mayúscula
    $formatted_username = ucwords(strtolower($username));

    // Hashear la contraseña
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Preparar la consulta para insertar el nuevo usuario
    $query = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'ss', $formatted_username, $hashed_password);
    $success = mysqli_stmt_execute($stmt);

    // Cerrar la declaración y la conexión
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    return $success;
}
?>
