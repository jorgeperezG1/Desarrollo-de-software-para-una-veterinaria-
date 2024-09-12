<?php
// Incluir archivos de configuración y autenticación
include 'includes/config.php';
include 'includes/auth.php';

// Iniciar la sesión
session_start();

// Procesar el formulario de inicio de sesión si se ha enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Intentar autenticar al usuario
    if (($formatted_username = authenticate($username, $password)) !== false) {
        // Si la autenticación es exitosa, establecer variables de sesión
        $_SESSION['authenticated'] = true;
        $_SESSION['username'] = $formatted_username;
        // Redirigir al usuario a la página principal
        header('Location: index.php');
        exit();
    } else {
        // Si la autenticación falla, mostrar un mensaje de error
        $error = 'Nombre de usuario o contraseña incorrectos.';
    }
}
?>

<!DOCTYPE html>
<html lang="es-mx">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Veterinaria</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Login - Veterinaria</h1>
    </header>

    <main>
        <form action="login.php" method="post">
            <label for="username">Nombre de Usuario:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit">Iniciar sesión</button>
        </form>

        <?php if (isset($error)): ?>
            <!-- Mostrar mensaje de error si existe -->
            <p><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <p>¿No tienes una cuenta? <a href="register.php">Regístrate aquí</a>.</p>
    </main>
</body>
</html>
