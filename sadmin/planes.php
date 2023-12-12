<?php
session_start();
include("session.php");
include("bd.php"); // Incluye el archivo de configuración de la base de datos

// Consultar planes desde la base de datos
$sql = "SELECT * FROM planes";
$result = mysqli_query($conexion, $sql);

// Verificar si se encontraron planes
if ($result && mysqli_num_rows($result) > 0) {
    $planes = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $planes = array(); // Inicializar un arreglo vacío si no se encontraron planes
}

mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planes</title>
    <?php include("links.php"); ?>
</head>

<body class="bg-gray-100">
    <?php include("navbar.php"); ?>

    <div class="w-1/2 mx-auto mt-4"> <!-- Agrega la clase mt-4 para dar espacio desde la parte superior -->
        <a href="crear_planes.php" class="text-blue-500 hover:underline mb-4">
            <div class="bg-white p-4 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-2">Crear Plan</h3>
                <p class="text-gray-600">Haz clic para crear un nuevo plan.</p>
                <i class="fas fa-building text-lg mr-2"></i>
                Crear Plan
            </div>
        </a>

        <!-- Lista de Planes -->
        <h2 class="text-2xl font-semibold mb-4">Planes Registrados</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <?php foreach ($planes as $plan) : ?>
                <div class="bg-white p-4 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold mb-2"><?php echo $plan['nombre']; ?></h3>
                    <p class="text-gray-600 mb-2">Descripción: <?php echo $plan['descripcion']; ?></p>
                    <p class="text-gray-600 mb-2">Precio: <?php echo $plan['precio']; ?></p>
                    <p class="text-gray-600">Encuestas: <?php echo $plan['encuestas_numero']; ?></p>
                    <p class="text-gray-600">Personal: <?php echo $plan['personal_numero']; ?></p>
                    <p class="text-gray-600">Usuarios: <?php echo $plan['usuarios_numero']; ?></p>
                    <p class="text-gray-600">Blogs Empresa: <?php echo $plan['blogsempresa_numero']; ?></p>
                    <p class="text-gray-600">Blogs Personal: <?php echo $plan['blogpersonal_numero']; ?></p>

                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>