<?php
include("bd.php"); // Incluye el archivo de configuración de la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $nombre_empresa = mysqli_real_escape_string($conexion, $_POST["nombre_empresa"]);
    $abreviatura = mysqli_real_escape_string($conexion, $_POST["abreviatura"]);
    $cct = mysqli_real_escape_string($conexion, $_POST["cct"]);
    $descripcion = mysqli_real_escape_string($conexion, $_POST["descripcion"]);
    $plan_id = intval($_POST["plan_id"]); // Asegurarse de que el ID del plan sea un número entero

    // Insertar datos en la tabla empresas
    $sql = "INSERT INTO empresas (nombre_empresa, abreviatura, cct, descripcion, plan_id) VALUES ('$nombre_empresa', '$abreviatura', '$cct', '$descripcion', $plan_id)";

    if (mysqli_query($conexion, $sql)) {
        // Redirigir al usuario de nuevo a crear_empresa.php después de crear la empresa
        header("Location: crear_empresa.php");
        exit; // Asegurarse de que la redirección se procese correctamente
    } else {
        echo "<p class='text-red-500'>Error al crear la empresa: " . mysqli_error($conexion) . "</p>";
    }
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
