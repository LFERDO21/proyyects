<?php
session_start();
include("session.php");
include("bd.php"); // Incluye el archivo de configuración de la base de datos

// Consultar planes disponibles desde la base de datos
$sql = "SELECT id, nombre FROM planes";
$result = mysqli_query($conexion, $sql);

// Verificar si se encontraron planes
if ($result && mysqli_num_rows($result) > 0) {
    $planes = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $planes = array(); // Inicializar un arreglo vacío si no se encontraron planes
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Empresa</title>
    <?php include("links.php"); ?>
</head>

<body class="bg-gray-100">
    <?php include("navbar.php"); ?>

    <div class="min-h-screen flex items-center justify-center">
        <div class="w-1/2 mx-auto">
            <h2 class="text-2xl font-semibold mb-4">Crear Empresa</h2>
            <form method="POST" action="procesar_empresa.php">
                <div class="mb-4">
                    <label for="nombre_empresa" class="block font-medium">Nombre de la Empresa:</label>
                    <input type="text" name="nombre_empresa" class="w-full p-2 border rounded" required>
                </div>

                <div class="mb-4">
                    <label for="abreviatura" class="block font-medium">Abreviatura:</label>
                    <input type="text" name="abreviatura" class="w-full p-2 border rounded" required>
                </div>

                <div class="mb-4">
                    <label for="cct" class="block font-medium">Código de Control de Trabajo (CCT):</label>
                    <input type="text" name="cct" class="w-full p-2 border rounded" required>
                </div>

                <div class="mb-4">
                    <label for="descripcion" class="block font-medium">Descripción:</label>
                    <textarea name="descripcion" class="w-full p-2 border rounded" rows="4" required></textarea>
                </div>

                <div class="mb-4">
                    <!-- Agrega el campo de selección de planes -->
                    <label for="plan_id" class="block font-medium">Seleccionar Plan:</label>
                    <select name="plan_id" class="w-full p-2 border rounded">
                        <?php foreach ($planes as $plan) : ?>
                            <option value="<?php echo $plan['id']; ?>"><?php echo $plan['nombre']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-4">
                    <input type="submit" value="Guardar Empresa" class="bg-blue-500 text-white py-2 px-4 rounded cursor-pointer">
                </div>
            </form>
        </div>
    </div>
</body>

</html>