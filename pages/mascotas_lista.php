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

// Obtener el ID del cliente desde los parámetros de la URL
$client_id = isset($_GET['client_id']) ? intval($_GET['client_id']) : 0;

// Consultar las mascotas asociadas al cliente
$query = "SELECT * FROM pets WHERE cliente_id = $client_id";
$pets_result = mysqli_query($conn, $query);

// Comprobar si la consulta fue exitosa
if (!$pets_result) {
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
    <title>Listado de Mascotas - Veterinaria</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        td, th{
            border:2px solid black;
            padding:10px;
            margin:0px;
        }
    </style>

</head>
<body>
    <header>
        <h1>Listado de Mascotas</h1>
        <nav>
            <ul>
                <li><a href="../" class="nav-active">Inicio</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Mascotas del Cliente</h2>
        <table>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Alias</th>
                    <th>Especie</th>
                    <th>Raza</th>
                    <th>Color del Pelo</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Peso Actual</th>
                    <th>ver historial medico</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($pets_result) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($pets_result)): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['codigo']); ?></td>
                            <td><?php echo htmlspecialchars($row['alias']); ?></td>
                            <td><?php echo htmlspecialchars($row['especie']); ?></td>
                            <td><?php echo htmlspecialchars($row['raza']); ?></td>
                            <td><?php echo htmlspecialchars($row['color_pelo']); ?></td>
                            <td><?php echo htmlspecialchars($row['fecha_nacimiento']); ?></td>
                            <td><?php echo htmlspecialchars($row['peso_actual']) . ' kg'; ?></td>
                            <td><a href="historial_medico_lista.php?pet_id=<?php echo urlencode($row['id']); ?>">Ver Historial Médico</a></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">No hay mascotas registradas para este cliente.</td>
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
