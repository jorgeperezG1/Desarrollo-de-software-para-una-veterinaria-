<?php
// Incluir archivos de configuración y funciones de usuario
include 'includes/config.php';
include 'includes/user.php';

// Iniciar la sesión
session_start();

// Procesar el formulario de registro si se ha enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $error = 'Las contraseñas no coinciden.';
    } elseif (!register_user($username, $password, $error)) {
        // El mensaje de error ya estará configurado por `register_user`
    } else {
        header('Location: login.php');
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="es-mx">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Veterinaria</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Registro - Veterinaria</h1>
    </header>

    <main>
        <form action="register.php" method="post">
            <label for="username">Nombre de Usuario:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
            
            <label for="confirm_password">Confirmar Contraseña:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
            
            <button type="submit">Registrar</button>
        </form>

        <?php if (isset($error)): ?>
            <!-- Mostrar mensaje de error si existe -->
            <p><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <p>¿Ya tienes una cuenta? <a href="login.php">Inicia sesión aquí</a>.</p>
    </main>
</body>
</html>
