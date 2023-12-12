<?php
session_start();
include("bd.php"); // Asegúrate de incluir el archivo que contiene la conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $precio = $_POST["precio"];
    $encuestas_numero = $_POST["encuestas_numero"];
    $personal_numero = $_POST["personal_numero"];
    $usuarios_numero = $_POST["usuarios_numero"];
    $blogsempresa_numero = $_POST["blogsempresa_numero"];
    $blogpersonal_numero = $_POST["blogpersonal_numero"];

    // Insertar datos en la tabla de planes
    $sql = "INSERT INTO planes (nombre, descripcion, precio, encuestas_numero, personal_numero, usuarios_numero, blogsempresa_numero, blogpersonal_numero)
            VALUES ('$nombre', '$descripcion', $precio, $encuestas_numero, $personal_numero, $usuarios_numero, $blogsempresa_numero, $blogpersonal_numero)";

    if (mysqli_query($conexion, $sql)) {
        // Redireccionar a la página de éxito o mostrar un mensaje de éxito aquí
        header("Location: planes.php"); // Redireccionar a la página de planes
        exit();
    } else {
        echo "<p class='text-red-500'>Error al crear el plan: " . mysqli_error($conexion) . "</p>";
    }
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
