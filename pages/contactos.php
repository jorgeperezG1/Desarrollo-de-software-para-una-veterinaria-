<?php
// Incluir las funciones de contactos
include_once '../includes/contactos_functions.php';
?>

<!DOCTYPE html>
<html lang="es-mx">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactos del Cliente</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        td,th {
            border: 1px solid black;
            padding: 5px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Agregar un Contacto</h1>
        <nav>
            <ul>
                <li><a href="../index.php"      class="nav-hover">Inicio</a></li>
                <li><a href="./clientes.php"    class="nav-hover">Clientes</a></li>
                <li><a href="./contactos.php"   class="nav-active">Contactos</a></li>
                <li><a href="./mascotas.php"    class="nav-hover">Mascotas</a></li>
                <li><a href="./historial_medico.php"    class="nav-hover">Historial medico</a></li>
                <li><a href="../logout.php"     class="cerrar_sesion">Cerrar sesión</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section>
            <h2>Agregar Nuevo Contacto</h2>
            <form action="contactos.php" method="post">
                <label for="cliente_id">Cliente:</label>
                <select id="cliente_id" name="cliente_id" required>
                    <?php while ($client_row = mysqli_fetch_assoc($clients_result)): ?>
                        <option value="<?php echo $client_row['id']; ?>">
                            <?php echo htmlspecialchars($client_row['nombre_completo']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
                
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
                
                <button type="submit" name="add_contact">Agregar Contacto</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Veterinaria. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
