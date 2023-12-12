<?php
session_start();
include("session.php");
include("bd.php");

$nombre = "No disponible";
$nombre_completo = "No disponible";
$nombre_empresa = "No disponible";

$response = array();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id']) && isset($_POST['session_id'])) {
    $cuestionario_id = $_POST['id'];
    $session_id = $_POST['session_id'];

    // Consulta para obtener el tipo
    $sql_tipo = "SELECT tipo FROM datos WHERE id = ?";
    if ($stmt_tipo = mysqli_prepare($conexion, $sql_tipo)) {
        mysqli_stmt_bind_param($stmt_tipo, "i", $cuestionario_id);
        mysqli_stmt_execute($stmt_tipo);
        mysqli_stmt_bind_result($stmt_tipo, $tipo);
        mysqli_stmt_fetch($stmt_tipo);
        mysqli_stmt_close($stmt_tipo);

        if ($tipo !== null) {
            // Consulta para obtener nombre, personal_id y empresa_id
            $sql = "SELECT nombre, personal_id, empresa_id FROM datos WHERE id = ?";
            if ($stmt = mysqli_prepare($conexion, $sql)) {
                mysqli_stmt_bind_param($stmt, "i", $cuestionario_id);
                mysqli_stmt_execute($stmt);
                $resultado = mysqli_stmt_get_result($stmt);
                mysqli_stmt_close($stmt);

                if ($resultado && mysqli_num_rows($resultado) > 0) {
                    $dato = mysqli_fetch_assoc($resultado);
                    $nombre = $dato['nombre'];
                    $personal_id = $dato['personal_id'];
                    $empresa_id = $dato['empresa_id'];

                    // Consulta para obtener nombre completo de la persona
                    $sql_personal = "SELECT nombre_completo FROM personal WHERE id = ?";
                    if ($stmt_personal = mysqli_prepare($conexion, $sql_personal)) {
                        mysqli_stmt_bind_param($stmt_personal, "i", $personal_id);
                        mysqli_stmt_execute($stmt_personal);
                        mysqli_stmt_bind_result($stmt_personal, $nombre_completo);
                        mysqli_stmt_fetch($stmt_personal);
                        mysqli_stmt_close($stmt_personal);

                        // Consulta para obtener nombre de la empresa
                        $sql_empresa = "SELECT nombre_empresa FROM empresas WHERE id = ?";
                        if ($stmt_empresa = mysqli_prepare($conexion, $sql_empresa)) {
                            mysqli_stmt_bind_param($stmt_empresa, "i", $empresa_id);
                            mysqli_stmt_execute($stmt_empresa);
                            mysqli_stmt_bind_result($stmt_empresa, $nombre_empresa);
                            mysqli_stmt_fetch($stmt_empresa);
                            mysqli_stmt_close($stmt_empresa);

                            // Agregar datos al array de respuesta
                            $response['id_session'] = $session_id;
                            $response['nombre'] = $nombre;
                            $response['nombre_completo'] = $nombre_completo;
                            $response['nombre_empresa'] = $nombre_empresa;
                        } else {
                            $response['error'] = "Empresa no encontrada";
                        }
                    } else {
                        $response['error'] = "Persona no encontrada";
                    }
                } else {
                    $response['error'] = "No se encontraron datos para el ID proporcionado.";
                }

                // Consulta para obtener preguntas únicas relacionadas al datos_id
                $sql_preguntas = "SELECT DISTINCT pregunta FROM preguntas WHERE datos_id = ?";
                if ($stmt_preguntas = mysqli_prepare($conexion, $sql_preguntas)) {
                    mysqli_stmt_bind_param($stmt_preguntas, "i", $cuestionario_id);
                    mysqli_stmt_execute($stmt_preguntas);
                    $resultado_preguntas = mysqli_stmt_get_result($stmt_preguntas);
                    mysqli_stmt_close($stmt_preguntas);

                    $preguntas = array();

                    if ($resultado_preguntas && mysqli_num_rows($resultado_preguntas) > 0) {
                        while ($fila_pregunta = mysqli_fetch_assoc($resultado_preguntas)) {
                            $pregunta = $fila_pregunta['pregunta'];

                            // Para cada pregunta, obtener respuestas relacionadas
                            $sql_respuestas = "SELECT id, respuesta, Categoria FROM preguntas WHERE datos_id = ? AND pregunta = ?";
                            if ($stmt_respuestas = mysqli_prepare($conexion, $sql_respuestas)) {
                                mysqli_stmt_bind_param($stmt_respuestas, "is", $cuestionario_id, $pregunta);
                                mysqli_stmt_execute($stmt_respuestas);
                                $resultado_respuestas = mysqli_stmt_get_result($stmt_respuestas);
                                mysqli_stmt_close($stmt_respuestas);

                                $respuestas = array();

                                // Obtén todas las respuestas en un array
                                while ($fila_respuesta = mysqli_fetch_assoc($resultado_respuestas)) {
                                    $respuestas[] = $fila_respuesta;
                                }

                                // Reorganiza las respuestas de forma aleatoria
                                shuffle($respuestas);

                                $preguntas[] = array(
                                    'pregunta' => $pregunta,
                                    'respuestas' => $respuestas
                                );
                            }
                        }

                        // Agregar preguntas y respuestas al array de respuesta
                        $response['preguntas'] = $preguntas;
                    } else {
                        $response['error'] = "No se encontraron preguntas para el ID proporcionado.";
                    }
                } else {
                    $response['error'] = "Error en la consulta de preguntas.";
                }
            } else {
                $response['error'] = "Error en la consulta principal.";
            }
        } else {
            $response['error'] = "Tipo no encontrado";
        }
    } else {
        $response['error'] = "Error en la consulta de tipo.";
    }
}

// Cerrar la conexión a la base de datos cuando ya no sea necesaria
mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <?php include("links.php"); ?>
    <!-- Agregar el enlace a los estilos de Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .pregunta-card {
            display: none;
        }

        #finalizacion-card {
            display: none;
        }
    </style>
</head>

<body class="bg-gray-200">
    <?php include("navbar.php"); ?>

    <!-- Sección de datos (con estilo de Tailwind CSS) -->
    <div class="container mx-auto mt-5 bg-white p-4 rounded-md">
        <h1 class="text-2xl font-bold mb-2">Nombre: <?php echo htmlspecialchars($nombre); ?></h1>
        <p class="text-gray-600">Persona: <?php echo htmlspecialchars($nombre_completo); ?></p>
        <p class="text-gray-600">Empresa: <?php echo htmlspecialchars($nombre_empresa); ?></p>
    </div>
    <!-- Sección de preguntas y respuestas (con estilo de Tailwind CSS) -->
    <div id="preguntas-section" class="container mx-auto mt-4 bg-white p-4 rounded-md">
        <h2 class="text-2xl font-bold mb-4">Preguntas y Respuestas</h2>

        <?php
        // Verificar si hay preguntas en la respuesta
        if (isset($response['preguntas']) && !empty($response['preguntas'])) {
            $conexion = mysqli_connect($host, $usuario, $contraseña, $nombre_db);

            foreach ($response['preguntas'] as $index => $pregunta) {
                $numero_pregunta = $index + 1;
                $pregunta_id = "pregunta-" . $numero_pregunta;

                echo "<div class='pregunta-card bg-gray-100 p-4 rounded-md mb-4' id='$pregunta_id'>";
                echo "<h3 class='text-xl font-bold mt-2 mb-2'>Pregunta $numero_pregunta: " . htmlspecialchars($pregunta['pregunta']) . "</h3>";

                if (!empty($pregunta['respuestas'])) {
                    echo "<form data-form-id='" . htmlspecialchars($pregunta['pregunta']) . "'>";

                    foreach ($pregunta['respuestas'] as $respuesta) {
                        echo "<label class='block mb-2'><input type='radio' name='pregunta_" . htmlspecialchars($pregunta['pregunta']) . "' value='" . htmlspecialchars($respuesta['id']) . "' class='mr-2'/> "
                            . htmlspecialchars($respuesta['respuesta']) . "</label>";
                    }

                    echo "</form>";
                } else {
                    echo "<p class='text-gray-600'>No hay respuestas para esta pregunta.</p>";
                }

                echo "</div>";
            }

            // Agregar botones "Siguiente" y "Regresar" con clases de Tailwind
            echo "<div class='flex justify-between'>";
            echo "<button id='regresar-btn' onclick='mostrarAnterior()' class='bg-blue-500 text-white px-4 py-2 rounded-md'>Regresar</button>";
            echo "<button id='siguiente-btn' onclick='mostrarSiguiente()' class='bg-green-500 text-white px-4 py-2 rounded-md'>Siguiente</button>";
            echo "</div>";
        } else {
            echo "<p class='text-gray-600'>No hay preguntas y respuestas disponibles.</p>";
        }
        ?>
    </div>

    <!-- Nueva tarjeta para el mensaje "Ya casi terminas" -->
    <div id="casi-terminado-card" class="container mx-auto mt-4 bg-white p-4 rounded-md" style="display: none;">
        <h2 class="text-2xl font-bold mb-4">¡Ya casi terminas!</h2>
        <p>Gracias por completar la encuesta. Estás a punto de finalizar.</p>
        <button id="finalizar-btn" onclick="finalizarEncuesta()" class="bg-red-500 text-white px-4 py-2 rounded-md mt-4">Finalizar</button>
        <!-- Puedes agregar más contenido o estilos según tus necesidades -->
    </div>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var preguntas = document.querySelectorAll('.pregunta-card');
            var currentIndex = 0;
            var respuestasSeleccionadas = {
                'id_session': <?php echo $session_id; ?>,
                'id_datos': <?php echo $cuestionario_id; ?>
            };

            ocultarPreguntas();

            function ocultarPreguntas() {
                preguntas.forEach(function(pregunta, index) {
                    if (index !== currentIndex) {
                        pregunta.style.display = 'none';
                    } else {
                        pregunta.style.display = 'block';
                    }
                });
            }

            window.mostrarAnterior = function() {
                if (currentIndex > 0) {
                    currentIndex--;
                    ocultarPreguntas();
                } else {
                    alert("Esta es la primera pregunta. No hay preguntas anteriores.");
                }
            };

            window.mostrarSiguiente = function() {
                var formularioActual = preguntas[currentIndex].querySelector('form');
                var respuestaSeleccionada = formularioActual.querySelector('input[type="radio"]:checked');

                if (respuestaSeleccionada) {
                    var valorRespuesta = respuestaSeleccionada.value;
                    respuestasSeleccionadas['pregunta_' + currentIndex] = {
                        'respuesta': valorRespuesta
                    };

                    if (currentIndex < preguntas.length - 1) {
                        currentIndex++;
                        ocultarPreguntas();
                    } else {
                        // Ocultar la sección de preguntas y mostrar la tarjeta "Ya casi terminas"
                        document.getElementById('preguntas-section').style.display = 'none';
                        document.getElementById('casi-terminado-card').style.display = 'block';
                    }

                    console.log(JSON.stringify(respuestasSeleccionadas, null, 2));
                } else {
                    alert("Por favor, selecciona una respuesta antes de continuar.");
                }
            };

            window.finalizarEncuesta = function() {
                var casiTerminadoCard = document.getElementById('casi-terminado-card');

                // Envía los datos al archivo procesar_cuestionario2.php
                fetch('procesar_cuestionario2.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify(respuestasSeleccionadas),
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log(data);

                        // Redirige solo si la respuesta es exitosa
                        window.location.href = 'procesar_cuestionario2.php';
                    })
                    .catch(error => {
                        console.error('Error:', error);

                        // Verifica si la respuesta no es JSON
                        if (error.message.includes('Unexpected token <')) {
                            // Muestra un mensaje de error al usuario
                            alert('Error en la solicitud: La respuesta no es válida (no es JSON).');
                        } else {
                            // Muestra un mensaje de error genérico
                            alert('Error en la solicitud: ' + error.message);
                        }
                    });
            };
        });
    </script>
</body>

</html>