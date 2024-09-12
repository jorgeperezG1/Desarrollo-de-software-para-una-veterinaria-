<?php
// Incluir archivos de configuración y autenticación
include_once '../includes/config.php';
include_once '../includes/auth.php';
include_once '../includes/db.php';

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
$result = mysqli_query($conn, $query);

// Verificar si la consulta fue exitosa
if (!$result) {
    die('Error en la consulta: ' . mysqli_error($conn));
}

// Manejar la eliminación de un cliente
if (isset($_GET['delete'])) {
    $client_id = intval($_GET['delete']);
    $delete_query = "DELETE FROM clients WHERE id = $client_id";
    if (mysqli_query($conn, $delete_query)) {
        header('Location: clientes.php');
        exit();
    } else {
        die('Error al eliminar el cliente: ' . mysqli_error($conn));
    }
}

// Función para generar un código único
function generate_unique_code($conn, $primer_apellido) {
    $unique = false;
    $next_number = 1;
    
    while (!$unique) {
        // Generar el código de cliente con el número consecutivo
        $codigo_cliente = $primer_apellido . str_pad($next_number, 3, '0', STR_PAD_LEFT);
        
        // Verificar si el código ya existe
        $check_query = "SELECT COUNT(*) AS count FROM clients WHERE codigo_cliente = '$codigo_cliente'";
        $check_result = mysqli_query($conn, $check_query);
        $check_row = mysqli_fetch_assoc($check_result);
        
        if ($check_row['count'] == 0) {
            // El código es único
            $unique = true;
        } else {
            // Incrementar el número consecutivo y verificar de nuevo
            $next_number++;
        }
    }
    
    return $codigo_cliente;
}

// Agregar un nuevo cliente
if (isset($_POST['add_client'])) {
    $nombre_completo = mysqli_real_escape_string($conn, $_POST['nombre_completo']);
    $numero_cuenta_bancaria = mysqli_real_escape_string($conn, $_POST['numero_cuenta_bancaria']);
    $direccion = mysqli_real_escape_string($conn, $_POST['direccion']);
    $telefono = mysqli_real_escape_string($conn, $_POST['telefono']);
    $correo = mysqli_real_escape_string($conn, $_POST['correo']);
    $codigo_postal = mysqli_real_escape_string($conn, $_POST['codigo_postal']);
    $rfc = mysqli_real_escape_string($conn, $_POST['rfc']);
    
    // Extraer el primer apellido del nombre completo
    $nombres = explode(' ', $nombre_completo);
    $primer_apellido = isset($nombres[0]) ? $nombres[0] : 'Anonimo';
    
    // Generar un código único de cliente
    $codigo_cliente = generate_unique_code($conn, $primer_apellido);
    
    // Preparar y ejecutar la consulta para insertar el nuevo cliente
    $insert_query = "INSERT INTO clients (codigo_cliente, nombre_completo, numero_cuenta_bancaria, direccion, telefono, correo, codigo_postal, rfc) VALUES ('$codigo_cliente', '$nombre_completo', '$numero_cuenta_bancaria', '$direccion', '$telefono', '$correo', '$codigo_postal', '$rfc')";
    
    if (mysqli_query($conn, $insert_query)) {
        header('Location: ./clientes.php');
        exit();
    } else {
        die('Error al agregar el cliente: ' . mysqli_error($conn));
    }
}

// Cerrar la conexión
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="es-mx">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        td,th{
            border:1px solid black;
            padding:5px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Gestión de Clientes</h1>
        <nav>
            <ul>
                <li><a href="../index.php"              class="nav-hover">Inicio</a></li>
                <li><a href="#"                         class="nav-active">Clientes</a></li>
                <li><a href="./contactos.php"           class="nav-hover">Contacto</a></li>
                <li><a href="./mascotas.php"            class="nav-hover">Mascotas</a></li>
                <li><a href="./historial_medico.php"    class="nav-hover">Historial medico</a></li>
                <li><a href="../logout.php"             class="cerrar_sesion">Cerrar sesión</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section>
            
            <h2>Agregar Nuevo Cliente</h2>
            <form action="./clientes.php" method="post">
                <label for="nombre_completo">Nombre Completo:</label>
                <input type="text" id="nombre_completo" name="nombre_completo" required>
                
                <label for="numero_cuenta_bancaria">Número de Cuenta Bancaria:</label>
                <input type="text" id="numero_cuenta_bancaria" name="numero_cuenta_bancaria">
                
                <label for="direccion">Dirección:</label>
                <textarea id="direccion" name="direccion"></textarea>
                
                <label for="telefono">Teléfono:</label>
                <input type="text" id="telefono" name="telefono">
                
                <label for="correo">Correo:</label>
                <input type="email" id="correo" name="correo">
                
                <label for="codigo_postal">Código Postal:</label>
                <input type="text" id="codigo_postal" name="codigo_postal">
                
                <label for="rfc">RFC:</label>
                <input type="text" id="rfc" name="rfc">
                
                <button type="submit" name="add_client">Agregar Cliente</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Veterinaria. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
