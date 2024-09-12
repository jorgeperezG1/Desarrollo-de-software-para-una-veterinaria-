<?php
// Incluir archivos de configuración y autenticación
include_once 'includes/config.php';
include_once 'includes/auth.php';
include_once 'includes/db.php';

// Iniciar la sesión
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    // Si el usuario no está autenticado, redirigir a la página de login
    header('Location: login.php');
    exit();
}

// Conectar a la base de datos
$conn = get_db_connection();

// Consultar los clientes
$query = "SELECT * FROM clients";
$result = mysqli_query($conn, $query);

// Cerrar la conexión
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="es-mx">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Veterinaria</title>
    <link rel="stylesheet" href="./css/style.css">

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
        <h1>Bienvenido a la Página de la Veterinaria</h1>
        <nav>
            <ul>
                <li><a href="#"                             class="nav-active">Inicio</a></li>
                <li><a href="./pages/clientes.php"          class="nav-hover">Clientes</a></li>
                <li><a href="./pages/contactos.php"         class="nav-hover">Contacto</a></li>
                <li><a href="./pages/mascotas.php"          class="nav-hover">Mascotas</a></li>
                <li><a href="./pages/historial_medico.php"  class="nav-hover">Historial medico</a></li>
                <li><a href="./logout.php"                  class="cerrar_sesion">Cerrar sesión</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section>
            <h2>Panel de Control</h2>
            <!-- Mostrar el nombre del usuario autenticado -->
            <p>Bienvenido, <?php echo htmlspecialchars($_SESSION['username']); ?>.</p>
            <p>Aquí podrás gestionar clientes, mascotas y más.</p>
        </section>

        <h2>Listado de Clientes</h2>
        <table>
            <thead>
                <tr>
                    <th>Código Cliente</th>
                    <th>Nombre Completo</th>
                    <th>numero de cuent bancaria</th>
                    <th>dirección</th>
                    <th>telefono</th>
                    <th>correo</th>
                    <th>codigo postal</th>
                    <th>RFC</th>

                    <th>Ver mascotas</th>
                    <th>ver contacto asociados</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && mysqli_num_rows($result) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['codigo_cliente']); ?></td>
                            <td><?php echo htmlspecialchars($row['nombre_completo']); ?></td>
                            <td><?php echo htmlspecialchars($row['numero_cuenta_bancaria']); ?></td>
                            <td><?php echo htmlspecialchars($row['direccion']); ?></td>
                            <td><?php echo htmlspecialchars($row['telefono']); ?></td>
                            <td><?php echo htmlspecialchars($row['correo']); ?></td>
                            <td><?php echo htmlspecialchars($row['codigo_postal']); ?></td>
                            <td><?php echo htmlspecialchars($row['rfc']); ?></td>

                            <td><a href="pages/mascotas_lista.php?client_id=<?php echo urlencode($row['id']); ?>">Ver Mascotas</a></td>
                            <td><a href="pages/contactos_lista.php?client_id=<?php echo urlencode($row['id']); ?>">Ver contactos</a></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">No hay clientes registrados.</td>
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
