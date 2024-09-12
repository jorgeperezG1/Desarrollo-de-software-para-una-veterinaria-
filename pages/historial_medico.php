<?php
// Incluir las funciones de conexión a la base de datos
include_once '../includes/db.php'; // Asegúrate de tener esta línea para conectar a la base de datos

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

// Consultar todas las mascotas para llenar el selector
$pets_query = "SELECT * FROM pets"; // Ajusta el nombre de la tabla de mascotas según tu esquema
$pets_result = mysqli_query($conn, $pets_query);

$success_message = '';
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_medical_history'])) {
    // Obtener datos del formulario
    $pet_id = intval($_POST['pet_id']);
    $enfermedad = mysqli_real_escape_string($conn, $_POST['enfermedad']);
    $fecha = mysqli_real_escape_string($conn, $_POST['fecha']);

    // Insertar el historial médico
    $insert_history_query = "INSERT INTO medical_history (mascota_id, enfermedad, fecha) VALUES ($pet_id, '$enfermedad', '$fecha')";
    $result = mysqli_query($conn, $insert_history_query);

    if ($result) {
        $success_message = 'Historial médico agregado correctamente.';
    } else {
        $error_message = 'Error al agregar el historial médico: ' . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="es-mx">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Historial Médico - Veterinaria</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        td, th {
            border: 1px solid black;
            padding: 5px;
        }
        .medical-history {
            margin-top: 20px;
        }
        .medical-history label {
            display: block;
            margin: 5px 0;
        }
        .medical-history input, .medical-history button {
            display: block;
            margin-top: 5px;
        }
        .message {
            margin-top: 10px;
            padding: 10px;
            border: 1px solid #ddd;
        }
        .success {
            color: green;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <header>
        <h1>Agregar Historial Médico</h1>
        <nav>
            <ul>
                <li><a href="../index.php" class="nav-hover">Inicio</a></li>
                <li><a href="./clientes.php" class="nav-hover">Clientes</a></li>
                <li><a href="./contactos.php" class="nav-hover">Contacto</a></li>
                <li><a href="./mascotas.php" class="nav-hover">Mascotas</a></li>
                <li><a href="./historial_medico.php" class="nav-active">Historial Médico</a></li>
                <li><a href="../logout.php" class="cerrar_sesion">Cerrar sesión</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section>
            <h2>Agregar Nuevo Historial Médico</h2>
            <form action="historial_medico.php" method="post">
                <label for="pet_id">Mascota:</label>
                <select id="pet_id" name="pet_id" required>
                    <?php while ($pet_row = mysqli_fetch_assoc($pets_result)): ?>
                        <option value="<?php echo $pet_row['id']; ?>">
                            <?php echo htmlspecialchars($pet_row['alias']) . ' (' . htmlspecialchars($pet_row['especie']) . ')'; ?>
                        </option>
                    <?php endwhile; ?>
                </select>

                <label for="enfermedad">Enfermedad:</label>
                <input type="text" id="enfermedad" name="enfermedad" required>

                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha" name="fecha" required>

                <button type="submit" name="add_medical_history">Agregar Historial Médico</button>
            </form>

            <?php if ($success_message): ?>
                <div class="message success"><?php echo $success_message; ?></div>
            <?php endif; ?>

            <?php if ($error_message): ?>
                <div class="message error"><?php echo $error_message; ?></div>
            <?php endif; ?>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Veterinaria. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
