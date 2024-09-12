<?php
// Incluir archivos de configuración y autenticación
include_once '../includes/config.php';
include_once '../includes/auth.php';
include_once '../includes/db.php';

// Iniciar la sesión
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    // Si el usuario no está autenticado, redirigir a la página de login
    header('Location: ../login.php');
    exit();
}

// Obtener la conexión a la base de datos
$conn = get_db_connection();

// Obtener el ID de la mascota desde los parámetros de la URL
$pet_id = isset($_GET['pet_id']) ? intval($_GET['pet_id']) : 0;

// Consultar el historial médico de la mascota
$query = "SELECT * FROM medical_history WHERE mascota_id = $pet_id";
$history_result = mysqli_query($conn, $query);

// Comprobar si la consulta fue exitosa
if (!$history_result) {
    die('Error en la consulta: ' . mysqli_error($conn));
}

// Cerrar la conexión
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="es-mx">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial Médico - Veterinaria</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        td, th {
            border: 2px solid black;
            padding: 10px;
            margin: 0px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Historial Médico</h1>
        <nav>
            <ul>
                <li><a href="../" class="nav-active">Inicio</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Historial Médico de la Mascota</h2>
        <table>
            <thead>
                <tr>
                    <th>Enfermedad</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($history_result) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($history_result)): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['enfermedad']); ?></td>
                            <td><?php echo htmlspecialchars($row['fecha']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">No hay historial médico registrado para esta mascota.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>

    <footer>
        <p>&copy; 2024 Veterinaria. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
