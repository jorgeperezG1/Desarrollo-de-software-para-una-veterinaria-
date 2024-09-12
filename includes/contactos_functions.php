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

// Consultar los contactos
$contacts_query = "SELECT * FROM contacts";
$contacts_result = mysqli_query($conn, $contacts_query);

// Agregar un nuevo contacto
if (isset($_POST['add_contact'])) {
    $cliente_id = intval($_POST['cliente_id']);
    $nombre_completo = mysqli_real_escape_string($conn, $_POST['nombre_completo']);
    $numero_cuenta_bancaria = mysqli_real_escape_string($conn, $_POST['numero_cuenta_bancaria']);
    $direccion = mysqli_real_escape_string($conn, $_POST['direccion']);
    $telefono = mysqli_real_escape_string($conn, $_POST['telefono']);
    $correo = mysqli_real_escape_string($conn, $_POST['correo']);
    $codigo_postal = mysqli_real_escape_string($conn, $_POST['codigo_postal']);
    $rfc = mysqli_real_escape_string($conn, $_POST['rfc']);
    
    // Insertar el nuevo contacto en la base de datos
    $insert_query = "INSERT INTO contacts (cliente_id, nombre_completo, numero_cuenta_bancaria, direccion, telefono, correo, codigo_postal, rfc) VALUES ($cliente_id, '$nombre_completo', '$numero_cuenta_bancaria', '$direccion', '$telefono', '$correo', '$codigo_postal', '$rfc')";

    if (mysqli_query($conn, $insert_query)) {
        header('Location: ../pages/contactos.php');
        exit();
    } else {
        die('Error al agregar el contacto: ' . mysqli_error($conn));
    }
}

// Cerrar la conexión
mysqli_close($conn);
?>
