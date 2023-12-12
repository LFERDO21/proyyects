<?php
session_start();
include("../session.php");
include("../bd.php"); // Incluye el archivo de configuración de la base de datos
date_default_timezone_set('America/Mexico_City');

// Obtén el JSON de la solicitud POST
$jsonData = isset($_POST['jsonData']) ? urldecode($_POST['jsonData']) : '';

// Decodifica el JSON
$data = json_decode($jsonData, true);

// Muestra los datos en la consola
echo '<script>';
echo 'console.log(' . json_encode($data) . ');';
echo '</script>';

// Guarda los datos en la base de datos (tabla "datos")
if ($data) {
    // Accede a los datos específicos que necesitas
    $nombreDelTest = $data['Nombre del test'];
    $fechaDeInicio = $data['Fecha de inicio'];

    // Formatea la fecha de inicio al formato MySQL (YYYY-MM-DD)
    $fechaDeInicioMySQL = date('Y-m-d', strtotime(str_replace('/', '-', $fechaDeInicio)));

    // Inicializa la variable $abreviatura_empresa
    $abreviatura_empresa = '';

    // Verifica si la sesión tiene la información necesaria para obtener $empresa_id
    if (isset($_SESSION['usuario_id'])) {
        $usuario_id = $_SESSION['usuario_id'];

        // Consulta para obtener $empresa_id
        $query_empresa_id = "SELECT empresa_id FROM personal WHERE id = $usuario_id";
        $result_empresa_id = mysqli_query($conexion, $query_empresa_id);

        if ($result_empresa_id && $row_empresa_id = mysqli_fetch_assoc($result_empresa_id)) {
            $empresa_id = $row_empresa_id['empresa_id'];

            // Consulta para obtener la abreviatura de la empresa
            $query_abreviatura_empresa = "SELECT abreviatura FROM empresas WHERE id = $empresa_id";
            $result_abreviatura_empresa = mysqli_query($conexion, $query_abreviatura_empresa);

            if ($result_abreviatura_empresa && $row_abreviatura_empresa = mysqli_fetch_assoc($result_abreviatura_empresa)) {
                $abreviatura_empresa = $row_abreviatura_empresa['abreviatura'];

                // Consulta para buscar identificadores que coincidan con la abreviatura de la empresa
                $query_coincidentes = "SELECT identificador FROM datos WHERE empresa_id = $empresa_id AND identificador LIKE '$abreviatura_empresa%'";
                $result_coincidentes = mysqli_query($conexion, $query_coincidentes);

                if ($result_coincidentes) {
                    $identificadores_coincidentes = [];

                    while ($row_coincidente = mysqli_fetch_assoc($result_coincidentes)) {
                        $identificadores_coincidentes[] = $row_coincidente['identificador'];
                    }

                    // Determina el siguiente número a utilizar
                    $next_number = 1;

                    foreach ($identificadores_coincidentes as $identificador_coincidente) {
                        // Extrae el número del identificador
                        $parts = explode('-', $identificador_coincidente);
                        $last_number = intval(end($parts));

                        if ($last_number >= $next_number) {
                            $next_number = $last_number + 1;
                        }
                    }

                    // Construye el identificador con la abreviatura y el próximo número
                    $identificador = $abreviatura_empresa . "-" . $next_number;

                    // Obtén la fecha de creación actual
                    $fechaCreacion = date('Y-m-d H:i:s');

                    // Realiza la inserción en la tabla "datos"
                    $query_insert = "INSERT INTO datos (identificador, nombre, fechainicio, personal_id, empresa_id, estado, tipo, fecha_creacion) 
                                     VALUES ('$identificador', '$nombreDelTest', '$fechaDeInicioMySQL', $usuario_id, $empresa_id, 'activo', 'tipo2', '$fechaCreacion')";

                    $resultado_insert = mysqli_query($conexion, $query_insert);

                    if ($resultado_insert) {
                        // Mostrar el mensaje de éxito en un modal y redirigir después de unos segundos
                        echo '<div id="modalExito" class="fixed inset-0 flex items-center justify-center h-screen bg-gray-800 bg-opacity-75">';
                        echo '<div class="bg-white p-8 rounded shadow-lg text-center">';
                        echo '<p class="text-2xl font-bold text-green-500">¡Guardado con éxito!</p>';
                        echo '<p class="mt-4">Serás redirigido en unos segundos...</p>';
                        echo '</div>';
                        echo '</div>';
                        echo '<script>';
                        echo 'setTimeout(function() { document.getElementById("modalExito").style.display = "none"; window.location.href = "../crear_encuesta.php"; }, 3000);';
                        echo '</script>';

                        // Consulta para obtener el último ID de datos para el usuario de la sesión actual
                        $query_last_datos_id = "SELECT MAX(id) AS last_datos_id FROM datos WHERE personal_id = $usuario_id";
                        $result_last_datos_id = mysqli_query($conexion, $query_last_datos_id);

                        if ($result_last_datos_id) {
                            $row_last_datos_id = mysqli_fetch_assoc($result_last_datos_id);
                            $last_datos_id = $row_last_datos_id['last_datos_id'];

                            // Procesa y guarda las preguntas en la tabla "preguntas"
                            foreach ($data['Preguntas'] as $pregunta) {
                                $textoPregunta = $pregunta['Pregunta'];

                                foreach ($pregunta['Respuestas'] as $respuesta) {
                                    $nombreRespuesta = $respuesta['nombre'];
                                    $categoriaRespuesta = isset($respuesta['categoria']) ? $respuesta['categoria'] : '';

                                    // Realiza la inserción en la tabla "preguntas" usando el último ID de la tabla "datos"
                                    $query_insert_pregunta = "INSERT INTO preguntas (identificador, personal_id, empresa_id, Categoria, Pregunta, respuesta, datos_id) 
                                                     VALUES ('$identificador', $usuario_id, $empresa_id, '$categoriaRespuesta', '$textoPregunta', '$nombreRespuesta', $last_datos_id)";

                                    $resultado_insert_pregunta = mysqli_query($conexion, $query_insert_pregunta);

                                    if (!$resultado_insert_pregunta) {
                                        echo '<p>Error al guardar los datos en la tabla "preguntas": ' . mysqli_error($conexion) . '</p>';
                                    }
                                }
                            }
                        } else {
                            echo '<p>Error al obtener el último ID de datos: ' . mysqli_error($conexion) . '</p>';
                        }
                    } else {
                        echo '<p>Error al guardar los datos en la tabla "datos": ' . mysqli_error($conexion) . '</p>';
                    }
                } else {
                    echo '<p>Error al buscar identificadores coincidentes: ' . mysqli_error($conexion) . '</p>';
                }
            } else {
                echo '<p>Error al obtener la abreviatura de la empresa: ' . mysqli_error($conexion) . '</p>';
            }
        } else {
            echo '<p>Error al obtener empresa_id: ' . mysqli_error($conexion) . '</p>';
        }
    } else {
        echo '<p>No se encontró información de usuario en la sesión.</p>';
    }
} else {
    echo '<p>No se recibieron datos para guardar.</p>';
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de procesamiento</title>
    <?php include("../links.php"); ?>

</head>

<body>

</body>

</html>