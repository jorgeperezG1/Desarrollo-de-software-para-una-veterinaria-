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

// Consultar los contactos asociados al cliente
$query = "SELECT * FROM contacts WHERE cliente_id = $client_id";
$contacts_result = mysqli_query($conn, $query);

// Comprobar si la consulta fue exitosa
if (!$contacts_result) {
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
    <title>Listado de Contactos - Veterinaria</title>
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
        <h1>Listado de Contactos</h1>
        <nav>
            <ul>
                <li><a href="../" class="nav-active">Inicio</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Contactos del Cliente</h2>
        <table>
            <thead>
                <tr>
                    <th>Nombre Completo</th>
                    <th>Número de Cuenta Bancaria</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    <th>Código Postal</th>
                    <th>RFC</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($contacts_result) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($contacts_result)): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['nombre_completo']); ?></td>
                            <td><?php echo htmlspecialchars($row['numero_cuenta_bancaria']); ?></td>
                            <td><?php echo htmlspecialchars($row['direccion']); ?></td>
                            <td><?php echo htmlspecialchars($row['telefono']); ?></td>
                            <td><?php echo htmlspecialchars($row['correo']); ?></td>
                            <td><?php echo htmlspecialchars($row['codigo_postal']); ?></td>
                            <td><?php echo htmlspecialchars($row['rfc']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">No hay contactos registrados para este cliente.</td>
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
