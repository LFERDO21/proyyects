<?php
session_start();
include("session.php");
include("bd.php");

$response = array();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id_session']) && isset($_POST['id_datos'])) {
    $session_id = $_POST['id_session'];
    $cuestionario_id = $_POST['id_datos'];

    // Obtener respuestas del cuerpo del mensaje JSON
    $json = file_get_contents('php://input');
    $respuestasSeleccionadas = json_decode($json, true);

    if ($respuestasSeleccionadas !== null) {
        // Procesar las respuestas
        $conexion = mysqli_connect($host, $usuario, $contraseña, $nombre_db);

        foreach ($respuestasSeleccionadas as $key => $value) {
            $pregunta_id = substr($key, 9); // Obtener el ID de la pregunta desde el nombre del campo
            $respuesta = $value['respuesta'];

            // Insertar en la base de datos o hacer lo que necesites con las respuestas
            $sql_insert_respuesta = "INSERT INTO respuestas (cuestionario_id, pregunta_id, respuesta) VALUES (?, ?, ?)";
            if ($stmt_insert_respuesta = mysqli_prepare($conexion, $sql_insert_respuesta)) {
                mysqli_stmt_bind_param($stmt_insert_respuesta, "iis", $cuestionario_id, $pregunta_id, $respuesta);
                mysqli_stmt_execute($stmt_insert_respuesta);
                mysqli_stmt_close($stmt_insert_respuesta);
            }
        }

        // Simulación de una respuesta exitosa
        $response['success'] = true;
        $response['message'] = 'Respuestas procesadas correctamente.';
    } else {
        $response['error'] = 'Error al decodificar las respuestas JSON.';
    }
} else {
    $response['error'] = 'Solicitud incorrecta o faltan parámetros.';
}

// Cerrar la conexión a la base de datos si ya no es necesaria
mysqli_close($conexion);

// Enviar la respuesta como JSON
header('Content-Type: application/json');
echo json_encode($response);
