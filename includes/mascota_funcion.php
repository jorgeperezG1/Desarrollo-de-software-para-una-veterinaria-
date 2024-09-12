<?php
// Incluir archivos de configuración y autenticación
include_once 'config.php';
include_once 'auth.php';
include_once 'db.php';

// Iniciar la sesión
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header('Location: ../login.php');
    exit();
}

// Conectar a la base de datos
$conn = get_db_connection();

// Consultar los clientes
$query = "SELECT * FROM clients";
$clients_result = mysqli_query($conn, $query);

// Consultar las mascotas
$pets_query = "SELECT * FROM pets";
$pets_result = mysqli_query($conn, $pets_query);

// Función para generar un código único de mascota
function generate_unique_pet_code($conn, $pet_name) {
    $unique = false;
    $next_number = 1;

    while (!$unique) {
        // Crear el código de mascota
        $pet_code = $pet_name . '-' . str_pad($next_number, 3, '0', STR_PAD_LEFT);

        // Verificar si el código ya existe
        $check_query = "SELECT COUNT(*) AS count FROM pets WHERE codigo = '$pet_code'";
        $check_result = mysqli_query($conn, $check_query);
        $check_row = mysqli_fetch_assoc($check_result);

        if ($check_row['count'] == 0) {
            $unique = true;
        } else {
            $next_number++;
        }
    }

    return $pet_code;
}

// Agregar una nueva mascota
if (isset($_POST['add_pet'])) {
    $client_id = intval($_POST['client_id']);
    $alias = mysqli_real_escape_string($conn, $_POST['alias']);
    $especie = mysqli_real_escape_string($conn, $_POST['especie']);
    $raza = mysqli_real_escape_string($conn, $_POST['raza']);
    $color_pelo = mysqli_real_escape_string($conn, $_POST['color_pelo']);
    $fecha_nacimiento = mysqli_real_escape_string($conn, $_POST['fecha_nacimiento']);
    $peso_actual = floatval($_POST['peso_actual']);
    
    // Obtener el nombre de la mascota del formulario
    $pet_name = mysqli_real_escape_string($conn, $_POST['alias']);

    // Generar un código único de mascota
    $pet_code = generate_unique_pet_code($conn, $pet_name);

    // Insertar la nueva mascota en la base de datos
    $insert_query = "INSERT INTO pets (codigo, cliente_id, alias, especie, raza, color_pelo, fecha_nacimiento, peso_actual) VALUES ('$pet_code', $client_id, '$alias', '$especie', '$raza', '$color_pelo', '$fecha_nacimiento', $peso_actual)";

    if (mysqli_query($conn, $insert_query)) {
        header('Location: ../pages/mascotas.php');
        exit();
    } else {
        die('Error al agregar la mascota: ' . mysqli_error($conn));
    }
}

// Cerrar la conexión
mysqli_close($conn);
?>
