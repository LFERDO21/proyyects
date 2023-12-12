<?php
include("bd.php"); // Incluye el archivo de configuración de la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['encuesta_id'])) {
    $encuesta_id = $_POST['encuesta_id'];

    // Obtén el estado actual
    $query_estado_actual = "SELECT estado FROM datos WHERE id = ?";
    $stmt_estado_actual = mysqli_prepare($conexion, $query_estado_actual);

    if ($stmt_estado_actual) {
        mysqli_stmt_bind_param($stmt_estado_actual, "i", $encuesta_id);
        mysqli_stmt_execute($stmt_estado_actual);
        mysqli_stmt_store_result($stmt_estado_actual);

        if (mysqli_stmt_num_rows($stmt_estado_actual) > 0) {
            mysqli_stmt_bind_result($stmt_estado_actual, $estado_actual);
            mysqli_stmt_fetch($stmt_estado_actual);

            // Cambia el estado
            $nuevo_estado = ($estado_actual == 'activo') ? 'no activo' : 'activo';

            // Actualiza el estado
            $query_update_estado = "UPDATE datos SET estado = ? WHERE id = ?";
            $stmt_update_estado = mysqli_prepare($conexion, $query_update_estado);

            if ($stmt_update_estado) {
                mysqli_stmt_bind_param($stmt_update_estado, "si", $nuevo_estado, $encuesta_id);

                if (mysqli_stmt_execute($stmt_update_estado)) {
                    echo "Estado actualizado con éxito a '$nuevo_estado'.";
                } else {
                    echo "Error al actualizar el estado: " . mysqli_stmt_error($stmt_update_estado);
                }

                mysqli_stmt_close($stmt_update_estado);
            } else {
                echo "Error en la preparación de la consulta de actualización: " . mysqli_error($conexion);
            }
        } else {
            echo "No se encontró la encuesta con ID: $encuesta_id";
        }

        mysqli_stmt_close($stmt_estado_actual);
    } else {
        echo "Error en la preparación de la consulta de estado actual: " . mysqli_error($conexion);
    }
} else {
    echo "Error: No se recibió el ID de la Encuesta.";
}
