<?php
// Incluir las funciones de mascotas
include_once '../includes/mascota_funcion.php';

?>

<!DOCTYPE html>
<html lang="es-mx">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mascotas del cliente</title>
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
        <h1>agregar una Mascotas</h1>
        <nav>
            <ul>
                <li><a href="../index.php"              class="nav-hover">Inicio</a></li>
                <li><a href="./clientes.php"            class="nav-hover">Clientes</a></li>
                <li><a href="./contactos.php"           class="nav-hover">Contacto</a></li>
                <li><a href="#"                         class="nav-active">Mascotas</a></li>
                <li><a href="./historial_medico.php"    class="nav-hover">Historial medico</a></li>
                <li><a href="../logout.php"             class="cerrar_sesion">Cerrar sesión</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section>
            <h2>Agregar Nueva Mascota</h2>
            <form action="mascotas.php" method="post">
                <label for="client_id">Cliente:</label>
                <select id="client_id" name="client_id" required>
                    <?php while ($client_row = mysqli_fetch_assoc($clients_result)): ?>
                        <option value="<?php echo $client_row['id']; ?>">
                            <?php echo htmlspecialchars($client_row['nombre_completo']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
                
                <label for="alias">Alias:</label>
                <input type="text" id="alias" name="alias" required>
                
                <label for="especie">Especie:</label>
                <input type="text" id="especie" name="especie" required>
                
                <label for="raza">Raza:</label>
                <input type="text" id="raza" name="raza" required>
                
                <label for="color_pelo">Color de Pelo:</label>
                <input type="text" id="color_pelo" name="color_pelo" required>
                
                <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>
                
                <label for="peso_actual">Peso Actual (kg):</label>
                <input type="number" step="0.01" id="peso_actual" name="peso_actual" required>
                
                <button type="submit" name="add_pet">Agregar Mascota</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Veterinaria. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
