<?php
session_start();
include("session.php");
include("bd.php"); // Incluye el archivo de configuración de la base de datos

// Consultar empresas desde la base de datos junto con el nombre del plan
$sql = "SELECT empresas.*, planes.nombre AS nombre_plan
        FROM empresas
        LEFT JOIN planes ON empresas.plan_id = planes.id";
$result = mysqli_query($conexion, $sql);

function obtenerConteo($empresaId)
{
    global $conexion;
    // Consultar el conteo de filas en la tabla "personal" para una empresa específica
    $sql = "SELECT COUNT(*) as total FROM personal WHERE empresa_id = $empresaId";
    $resultConteoPersonal = mysqli_query($conexion, $sql);

    if ($resultConteoPersonal && mysqli_num_rows($resultConteoPersonal) > 0) {
        $row = mysqli_fetch_assoc($resultConteoPersonal);
        $conteoPersonal = $row['total'];
    } else {
        $conteoPersonal = 0; // En caso de no encontrar registros
    }

    // Consultar el conteo de filas en la tabla "usuarios" para una empresa específica
    $sql = "SELECT COUNT(*) as total FROM usuarios WHERE empresa_id = $empresaId";
    $resultConteoUsuarios = mysqli_query($conexion, $sql);

    if ($resultConteoUsuarios && mysqli_num_rows($resultConteoUsuarios) > 0) {
        $row = mysqli_fetch_assoc($resultConteoUsuarios);
        $conteoUsuarios = $row['total'];
    } else {
        $conteoUsuarios = 0; // En caso de no encontrar registros
    }

    return array('personal' => $conteoPersonal, 'usuarios' => $conteoUsuarios);
}

// Verificar si se encontraron empresas
if ($result && mysqli_num_rows($result) > 0) {
    $empresas = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $empresas = array(); // Inicializar un arreglo vacío si no se encontraron empresas
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empresas</title>
    <?php include("links.php"); ?>
</head>

<body class="bg-gray-100">
    <?php include("navbar.php"); ?>

    <div class="container mx-auto mt-4">
        <a href="crear_empresa.php" class="text-blue-500 hover:underline mb-4">
            <div class="bg-white p-4 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-2">Crear Empresa</h3>
                <p class="text-gray-600">Haz clic para crear una nueva empresa.</p>
                <i class="fas fa-building text-lg mr-2"></i>
                Crear Empresa
            </div>
        </a>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-3">
            <?php foreach ($empresas as $empresa) : ?>
                <div class="bg-white p-4 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold mb-2"><?php echo $empresa['nombre_empresa']; ?></h3>
                    <p class="text-gray-600 mb-2">Abreviatura: <?php echo $empresa['abreviatura']; ?></p>
                    <p class="text-gray-600 mb-2">CCT: <?php echo $empresa['cct']; ?></p>
                    <p class="text-gray-600">Plan: <?php echo $empresa['nombre_plan']; ?></p>
                    <p class="text-gray-600">Personal: <?php echo obtenerConteo($empresa['id'])['personal']; ?></p>
                    <p class="text-gray-600">Usuarios: <?php echo obtenerConteo($empresa['id'])['usuarios']; ?></p>
                    <?php echo $empresa['id']; ?>
                    <!-- Formulario para enviar el ID de la empresa al presionar Detalles -->
                    <form action="detalles_empresa.php" method="post">
                        <input type="hidden" name="empresaId" value="<?php echo $empresa['id']; ?>">
                        <button type="submit" class="text-blue-500 hover:underline">Detalles</button>
                    </form>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</body>

</html>