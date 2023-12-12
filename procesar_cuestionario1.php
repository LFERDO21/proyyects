<?php
include("bd.php"); // Incluye el archivo de conexión a la base de datos.

if (isset($_GET['respuesta_final'])) {
    // Obtener el valor del parámetro GET 'respuesta_final'
    $respuestaFinalJSON = $_GET['respuesta_final'];

    // Decodificar el JSON en un array asociativo
    $respuestaFinal = json_decode($respuestaFinalJSON, true);

    if ($respuestaFinal !== null) {
        // Obtener el identificador relacionado con $respuestaFinal['id'] desde la base de datos
        $id = $respuestaFinal['id'];
        $sql = "SELECT identificador FROM datos WHERE id = $id";
        $result = mysqli_query($conexion, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $identificador = $row['identificador'];
        } else {
            echo "No se encontró un identificador relacionado con el ID proporcionado.";
            exit;
        }

        // Iniciar una transacción
        mysqli_begin_transaction($conexion);

        // Recorrer las respuestas y generar las consultas SQL
        foreach ($respuestaFinal['respuestas'] as $pregunta_id => $respuesta) {
            $datos_id = $respuestaFinal['id'];
            $usuario_id = $respuestaFinal['session_id'];

            // Generar la consulta SQL de inserción
            $sql = "INSERT INTO respuestas (identificador, datos_id, usuario_id, pregunta_id, respuesta) VALUES ('$identificador', $datos_id, $usuario_id, $pregunta_id, '$respuesta')";

            // Ejecutar la consulta
            $result = mysqli_query($conexion, $sql);

            // Verificar si la consulta fue exitosa
            if (!$result) {
                mysqli_rollback($conexion);
                echo "Error al insertar datos en la tabla de respuestas: " . mysqli_error($conexion);
                exit; // Terminar el proceso si hay un error
            }
        }

        // Confirmar la transacción
        mysqli_commit($conexion);

        // Redirigir a dashboardusuario.php
        header("Location: dashboardusuario.php");
        exit;
    } else {
        echo "Error al decodificar el JSON.";
    }
} else {
    echo "El parámetro GET 'respuesta_final' no se ha proporcionado.";
}
