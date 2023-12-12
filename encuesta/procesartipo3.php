<?php
session_start();
include("../session.php");
include("../bd.php"); // Incluye el archivo de configuración de la base de datos
date_default_timezone_set('America/Mexico_City');

// Obtén el ID del usuario desde la sesión o desde donde lo tengas almacenado
$usuario_id = $_SESSION['usuario_id'];

// Variable para almacenar el mensaje de éxito
$successMessage = "";

// Verificar si se ha recibido una solicitud POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Acceder a los datos enviados a través de $_POST
    $datosJSON = $_POST['datosJSON'];

    // Verificar si se recibieron datos JSON válidos
    if (!empty($datosJSON)) {
        $datos = json_decode($datosJSON, true);

        $nombreDelTest = $datos['Nombre del test'];
        $fechaDeInicio = $datos['Fecha de inicio'];

        // Formatea la fecha de inicio al formato MySQL (YYYY-MM-DD)
        $fechaDeInicioMySQL = date('Y-m-d', strtotime(str_replace('/', '-', $fechaDeInicio)));

        $query = "SELECT p.empresa_id, e.abreviatura FROM personal p
                  JOIN empresas e ON p.empresa_id = e.id
                  WHERE p.id = $usuario_id";
        $resultado = mysqli_query($conexion, $query);

        if ($resultado) {
            if ($row = mysqli_fetch_assoc($resultado)) {
                $empresa_id = $row['empresa_id'];
                $abreviatura_empresa = $row['abreviatura'];

                // Establece el estado en "activo"
                $estado = "activo";

                // Obtiene la fecha de creación actual
                $fechaCreacion = date('Y-m-d H:i:s');

                // Construye el identificador con la abreviatura y -1
                $identificador = $abreviatura_empresa . "-1";

                // Consulta para obtener el último identificador
                $query_last_identifier = "SELECT MAX(identificador) AS max_identifier FROM datos WHERE empresa_id = $empresa_id";
                $result_last_identifier = mysqli_query($conexion, $query_last_identifier);
                $row_last_identifier = mysqli_fetch_assoc($result_last_identifier);
                $last_identifier = $row_last_identifier['max_identifier'];

                if ($last_identifier) {
                    // Si hay un identificador anterior, incrementa el número en 1
                    $parts = explode('-', $last_identifier);
                    $last_number = intval(end($parts));
                    $next_number = $last_number + 1;
                    $identificador = $abreviatura_empresa . "-" . $next_number;
                } else {
                    // Si no hay un identificador anterior, comienza desde 1
                    $identificador = $abreviatura_empresa . "-1";
                }

                // Ejemplo de consulta de inserción:
                $query_insert = "INSERT INTO datos (identificador, nombre, fechainicio, personal_id, fecha_creacion, estado, empresa_id, tipo) 
                VALUES ('$identificador', '$nombreDelTest', '$fechaDeInicioMySQL', $usuario_id, '$fechaCreacion', '$estado', $empresa_id, 'tipo3')";

                $resultado_insert = mysqli_query($conexion, $query_insert);

                // Después de guardar los datos en la base de datos con éxito
                if ($resultado_insert) {
                    // Obtener el ID generado para el registro en la tabla "datos"
                    $datos_id = mysqli_insert_id($conexion);

                    // Recorrer las categorías y preguntas y almacenarlas en la base de datos...
                    foreach ($datos['Categorias'] as $categoria) {
                        $categoriaNombre = $categoria['Nombre'];

                        foreach ($categoria['Preguntas'] as $pregunta) {
                            // Insertar cada pregunta en la tabla "preguntas" en una fila separada
                            $query_insert_pregunta = "INSERT INTO preguntas (identificador, personal_id, empresa_id, Categoria, Pregunta, datos_id) VALUES ('$identificador', $usuario_id, $empresa_id, '$categoriaNombre', '$pregunta', $datos_id)";
                            $resultado_insert_pregunta = mysqli_query($conexion, $query_insert_pregunta);

                            if (!$resultado_insert_pregunta) {
                                echo "Error al insertar pregunta: " . mysqli_error($conexion);
                            }
                        }
                    }

                    // Mensaje de éxito
                    $successMessage = "La encuesta se ha realizado con éxito.";
                } else {
                    echo "Error al guardar los datos: " . mysqli_error($conexion);
                }
            } else {
                echo "No se encontró un empresa_id para el usuario o la abreviatura de la empresa.";
            }
        } else {
            echo "Error en la consulta SQL: " . mysqli_error($conexion);
        }
    } else {
        echo "No se han recibido datos JSON válidos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encuesta Exitosa</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <?php if (!empty($successMessage)) : ?>
            <div class="bg-green-200 text-green-700 border-l-4 border-green-700 p-4 rounded shadow">
                <?php echo $successMessage; ?>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>

<?php
// Redirigir al usuario a la página de dashboard después de 2 segundos
if (!empty($successMessage)) {
    header("refresh:2;url=../dashboardpersonal.php");
}
?>