<?php
include("bd.php"); // Asegúrate de incluir el archivo que contiene la conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $personalId = $_POST["personal_id"];
    $nuevoEstado = $_POST["nuevo_estado"];

    // Actualizar el estado en la base de datos
    $sqlActualizarEstado = "UPDATE personal SET estado = '$nuevoEstado' WHERE id = $personalId";

    if (mysqli_query($conexion, $sqlActualizarEstado)) {
        echo "OK";
    } else {
        echo "Error al actualizar el estado: " . mysqli_error($conexion);
    }
} else {
    echo "Solicitud no válida.";
}
