<?php
include("bd.php"); // Asegúrate de incluir el archivo que contiene la conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica si se han proporcionado los datos necesarios
    if (isset($_POST["usuarioId"]) && isset($_POST["nuevoEstado"])) {
        $usuarioId = $_POST["usuarioId"];
        $nuevoEstado = $_POST["nuevoEstado"];

        // Consulta SQL para actualizar el estado del usuario
        $sql = "UPDATE usuarios SET estado = '$nuevoEstado' WHERE id = $usuarioId";

        // Ejecuta la consulta SQL
        if (mysqli_query($conexion, $sql)) {
            // La actualización se realizó con éxito
            echo "OK";
        } else {
            // Hubo un error al actualizar el estado en la base de datos
            echo "Error";
        }
    } else {
        // Datos incorrectos en la solicitud POST
        echo "Error: Datos incorrectos en la solicitud.";
    }
} else {
    // Solicitud no válida
    echo "Error: Solicitud no válida.";
}
