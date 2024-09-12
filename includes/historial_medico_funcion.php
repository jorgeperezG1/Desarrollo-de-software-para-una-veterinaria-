<?php
<?php
// Incluir las funciones de conexión a la base de datos
include_once 'config.php';
include_once 'auth.php';
include_once 'db.php';

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

// Variable para el mensaje de éxito
$success_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_medical_history'])) {
    // Obtener datos del formulario
    $pet_id = intval($_POST['pet_id']);
    $enfermedad = mysqli_real_escape_string($conn, $_POST['enfermedad']);
    $fecha = mysqli_real_escape_string($conn, $_POST['fecha']);

    // Insertar el historial médico
    $insert_history_query = "INSERT INTO medical_history (mascota_id, enfermedad, fecha) VALUES ($pet_id, '$enfermedad', '$fecha')";
    $result = mysqli_query($conn, $insert_history_query);

    if ($result) {
        $success_message = 'Historial médico registrado correctamente.';
    } else {
        echo 'Error al agregar el historial médico: ' . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

?>