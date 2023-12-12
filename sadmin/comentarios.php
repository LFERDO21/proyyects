<?php
session_start();
include("session.php");
include("bd.php");

// Obtener todos los contactos
$sql_todos = "SELECT * FROM contactos";
$result_todos = mysqli_query($conexion, $sql_todos);

// Verificar errores en la consulta
if (!$result_todos) {
    die("Error en la consulta todos: " . mysqli_error($conexion));
}

// Obtener contactos con estado pendiente
$sql_pendientes = "SELECT * FROM contactos WHERE estado = 'pendiente'";
$result_pendientes = mysqli_query($conexion, $sql_pendientes);

// Verificar errores en la consulta
if (!$result_pendientes) {
    die("Error en la consulta pendientes: " . mysqli_error($conexion));
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactos</title>
    <?php include("links.php"); ?>
</head>

<body>
    <?php include("navbar.php"); ?>

    <div class="container mx-auto mt-8">
        <h1 class="text-3xl font-bold mb-4">Comentarios</h1>

        <!-- Tabla para mostrar todos los contactos -->
        <h2 class="text-2xl font-semibold mb-2">Todos los Comentarios</h2>
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">ID</th>
                    <th class="py-2 px-4 border-b">Nombre</th>
                    <th class="py-2 px-4 border-b">Correo</th>
                    <th class="py-2 px-4 border-b">Telefono</th>
                    <th class="py-2 px-4 border-b">Motivo</th>
                    <th class="py-2 px-4 border-b">Descripcion</th>
                    <th class="py-2 px-4 border-b">Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result_todos)) {
                    echo "<tr>";
                    echo "<td class='py-2 px-4 border-b'>" . $row['id'] . "</td>";
                    echo "<td class='py-2 px-4 border-b'>" . $row['nombre'] . "</td>";
                    echo "<td class='py-2 px-4 border-b'>" . $row['correo'] . "</td>";
                    echo "<td class='py-2 px-4 border-b'>" . $row['telefono'] . "</td>";
                    echo "<td class='py-2 px-4 border-b'>" . $row['motivo'] . "</td>";
                    echo "<td class='py-2 px-4 border-b'>" . $row['descripcion'] . "</td>";
                    echo "<td class='py-2 px-4 border-b'>" . $row['estado'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

    </div>
</body>

</html>

<?php
// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>