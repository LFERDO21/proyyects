<?php
session_start();
include("session.php");
include("bd.php"); // Incluye el archivo de configuración de la base de datos



if (isset($_POST['id']) && isset($_POST['session_id'])) {
    $cuestionario_id = $_POST['id'];
    $session_id = $_POST['session_id'];

    // Realiza una consulta para obtener el valor de la columna "tipo" de la tabla "datos" utilizando el ID.
    $sql_tipo = "SELECT tipo FROM datos WHERE id = $cuestionario_id";
    $resultado_tipo = mysqli_query($conexion, $sql_tipo);

    if ($resultado_tipo && mysqli_num_rows($resultado_tipo) > 0) {
        $fila_tipo = mysqli_fetch_assoc($resultado_tipo);
        $tipo = $fila_tipo['tipo'];

        // Ahora tienes el valor de "tipo" para esta entrada.

        // Realiza una consulta para obtener el nombre, personal_id y empresa_id de la tabla "datos" utilizando el ID.
        $sql = "SELECT nombre, personal_id, empresa_id FROM datos WHERE id = $cuestionario_id";
        $resultado = mysqli_query($conexion, $sql);

        if ($resultado && mysqli_num_rows($resultado) > 0) {
            $dato = mysqli_fetch_assoc($resultado);

            // Los datos se encuentran en el array $dato.
            $nombre = $dato['nombre'];
            $personal_id = $dato['personal_id'];
            $empresa_id = $dato['empresa_id'];

            // Realiza una consulta para obtener el nombre completo de la persona correspondiente.
            $sql_personal = "SELECT nombre_completo FROM personal WHERE id = $personal_id";
            $resultado_personal = mysqli_query($conexion, $sql_personal);

            if ($resultado_personal && mysqli_num_rows($resultado_personal) > 0) {
                $persona = mysqli_fetch_assoc($resultado_personal);
                $nombre_completo = $persona['nombre_completo'];

                // Realiza una consulta para obtener el nombre de la empresa correspondiente.
                $sql_empresa = "SELECT nombre_empresa FROM empresas WHERE id = $empresa_id";
                $resultado_empresa = mysqli_query($conexion, $sql_empresa);

                if ($resultado_empresa && mysqli_num_rows($resultado_empresa) > 0) {
                    $empresa = mysqli_fetch_assoc($resultado_empresa);
                    $nombre_empresa = $empresa['nombre_empresa'];

                    // Ahora puedes mostrar el nombre completo de la persona y el nombre de la empresa en tu página.
                } else {
                    // Manejo de caso en el que no se encontró la empresa correspondiente.
                    $nombre_empresa = "Empresa no encontrada";
                }
            } else {
                // Manejo de caso en el que no se encontró la persona correspondiente.
                $nombre_completo = "Persona no encontrada";
            }
        } else {
            // Manejo de caso en el que no se encontraron datos para el ID proporcionado.
            echo "No se encontraron datos para el ID proporcionado.";
        }

        // Realiza una consulta para obtener las preguntas relacionadas al datos_id correspondiente.
        $sql_preguntas = "SELECT id, pregunta FROM preguntas WHERE datos_id = $cuestionario_id ORDER BY RAND()";
        $resultado_preguntas = mysqli_query($conexion, $sql_preguntas);

        $preguntas = array();

        if ($resultado_preguntas && mysqli_num_rows($resultado_preguntas) > 0) {
            while ($fila_pregunta = mysqli_fetch_assoc($resultado_preguntas)) {
                $preguntas[] = $fila_pregunta; // Agregar la pregunta al array
            }
            shuffle($preguntas);
        } else {
            // Manejo de caso en el que no se encontraron preguntas para el ID proporcionado.
            echo "No se encontraron preguntas para el ID proporcionado.";
        }
    } else {
        // Manejo de caso en el que no se encontró el tipo para el ID proporcionado.
        echo "Tipo no encontrado";
    }
}

// Aquí creamos un objeto JavaScript con las preguntas para usar en el frontend
$preguntas_json = json_encode($preguntas);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <?php include("links.php"); ?>
</head>

<body>
    <?php include("navbar.php"); ?>

    <!-- Sección de datos (con estilo de Tailwind CSS) -->
    <div class="container mx-auto mt-5">
        <div class="bg-gray-100 p-4">
            <h1 class="text-2xl font-bold">Nombre: <?php echo $nombre; ?></h1>
            <p class="text-gray-600">Persona: <?php echo $nombre_completo; ?></p>
            <p class="text-gray-600">Empresa: <?php echo $nombre_empresa; ?></p>
            <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700" id="progress-bar">
                <div class="w-full bg-gray-200 rounded-full h-2.5 mb-4 dark:bg-gray-700">
                    <div class="bg-purple-600 h-2.5 rounded-full dark:bg-purple-500 w-full"></div>
                </div>
            </div> <!-- Progreso y total de preguntas -->
            <p>Progreso <span id="conteo-pregunta">1</span> de <span id="total-preguntas"><?php echo count($preguntas); ?></span></p>
        </div>
    </div>


    <!-- Sección de preguntas (con estilo de Tailwind CSS) -->
    <div class="container mx-auto mt-4">
        <div class="bg-gray-100 p-4">
            <h2 class="text-2xl font-bold">Preguntas: <span id="numero-pregunta">1</span></h2>
            <form id="cuestionario-form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div id="preguntas-container" data-preguntas='<?php echo $preguntas_json; ?>'>
                    <!-- Aquí se mostrarán las preguntas y respuestas -->
                </div>
                <button id="anterior" class="hidden bg-red-500 text-black py-2 px-4 rounded mt-4">Anterior</button>
                <button id="siguiente" class="bg-blue-500 text-white py-2 px-4 rounded mt-4">Siguiente</button>
                <!-- ¡Nuevo formulario! -->
                <!-- Fin del nuevo formulario -->
                <div id="json-respuestas" style="display: none;"></div>
            </form>
            <form id="finalizar-form" method="get" action="procesar_cuestionario1.php">
                <input type="hidden" name="respuesta_final" id="respuesta-final-json-input">
                <button id="finalizar" class="bg-green-500 text-white py-2 px-4 rounded mt-4" type="submit" style="display: none;" value="respuestaFinal">Finalizar</button>
            </form>

        </div>
    </div>


    <style>
        [type="radio"]:checked+div[data-index] {
            background-color: #7c3aed;
            /* Cambia el color de fondo cuando está seleccionado */
            color: #ffffff;
            /* Cambia el color del texto cuando está seleccionado */
            width: 30px;
            height: 30px;
            border-radius: 50%;
            /* Hacer un círculo */
            box-shadow: 0 0 35px #7c3aed;
            /* Establecer el color de sombra igual al color de fondo y ajustar el desplazamiento a 0 */
        }




        /* Cambiar el tamaño de los círculos */
        [type="radio"]+div[data-index] {
            width: 35px;
            height: 35px;
            line-height: 35px;
            /* Centrar el contenido verticalmente en el círculo */
            border-radius: 50%;
            /* Hacer un círculo */
        }
    </style>


    <script>
        var totalPreguntas = <?php echo count($preguntas); ?>;
        // Crear un objeto para almacenar las respuestas
        var respuestas = {};
        var preguntas = JSON.parse(document.getElementById('preguntas-container').getAttribute('data-preguntas'));
        var preguntaActual = 0;
        var cuestionario_id = <?php echo $cuestionario_id; ?>;

        // Declarar la variable preguntasContainer en el ámbito global
        var preguntasContainer = document.getElementById('preguntas-container');




        // Después de actualizar preguntaActual y totalPreguntas
        if (preguntaActual === totalPreguntas) {
            document.getElementById("finalizar").style.display = "block";
        } else {
            document.getElementById("finalizar").style.display = "none";
        }


        // Función para mostrar una pregunta y sus respuestas
        function mostrarPregunta() {
            var preguntasContainer = document.getElementById('preguntas-container');
            var preguntaId = preguntas[preguntaActual].id;
            var preguntaTexto = preguntas[preguntaActual].pregunta;
            // Actualizar el número de pregunta
            document.getElementById('numero-pregunta').innerText = (preguntaActual + 1);
            document.getElementById('conteo-pregunta').innerText = (preguntaActual + 1);

            // Verificar si preguntaActual es igual a totalPreguntas - 1 (última pregunta)
            if (preguntaActual === (totalPreguntas - 1)) {
                document.getElementById("siguiente").style.display = "block";
                document.getElementById("finalizar").style.display = "none";
                // Mostrar un mensaje al usuario
                preguntasContainer.innerHTML = "Has llegado al final de las preguntas, presiona 'Finalizar' para terminar el proceso.";
            } else {
                document.getElementById("siguiente").style.display = "block";
                document.getElementById("finalizar").style.display = "none";
            }

            // Crear una tarjeta (card) para mostrar la pregunta y las respuestas
            var card = document.createElement('div');
            card.classList.add('bg-white', 'p-4', 'shadow', 'rounded-xl', 'mb-4');

            // Agregar la pregunta
            var preguntaElement = document.createElement('p');
            preguntaElement.classList.add('text-gray-800', 'mb-2');
            preguntaElement.innerText = preguntaTexto;
            card.appendChild(preguntaElement);

            // Agregar las respuestas
            for (var i = 1; i <= 5; i++) {
                var label = document.createElement('label');
                label.classList.add('inline-flex', 'items-center', 'justify-center', 'mt-2'); // Añadir 'justify-center' para centrar horizontalmente.

                var input = document.createElement('input');
                input.type = 'radio';
                input.name = 'respuesta_' + preguntaId;
                input.value = i;
                input.classList.add('sr-only');
                input.id = 'respuesta' + preguntaId + '_' + i;

                var respuesta = document.createElement('div');
                respuesta.classList.add('relative', 'h-6', 'w-6', 'border-2', 'border-gray-200', 'rounded-full', 'cursor-pointer', 'inline-flex', 'items-center', 'justify-center', 'm-2', 'text-center');
                respuesta.setAttribute('data-index', i);
                respuesta.innerText = i;

                label.appendChild(input);
                label.appendChild(respuesta);
                card.appendChild(label);
            }

            // Agregar la tarjeta al contenedor de preguntas
            preguntasContainer.innerHTML = '';
            preguntasContainer.appendChild(card);

            // Actualizar la barra de progreso
            actualizarBarraDeProgreso();

        }


        mostrarPregunta(); // Mostrar la primera pregunta al cargar la página



        // Función para obtener todas las respuestas
        function obtenerRespuestas() {
            // Tu código para obtener las respuestas y almacenarlas en un objeto
        }

        // Función para verificar si todas las preguntas han sido respondidas
        function todasLasPreguntasRespondidas(respuestas) {
            // Tu código para verificar si todas las preguntas han sido respondidas
        }

        // Función para verificar si todas las preguntas han sido respondidas
        function todasLasPreguntasRespondidas(respuestas) {
            var numeroPreguntas = Object.keys(preguntas).length;

            for (var i = 1; i <= numeroPreguntas; i++) {
                var preguntaId = 'respuesta_' + i;
                if (!respuestas.hasOwnProperty(preguntaId)) {
                    return false; // Si falta una respuesta, no todas las preguntas están respondidas
                }
            }

            return true; // Todas las preguntas están respondidas
        }




        // Escuchar el evento "submit" del formulario
        document.querySelector("form").addEventListener("submit", function(e) {
            e.preventDefault(); // Prevenir el envío del formulario para manejarlo con JavaScript

            // Obtener todos los elementos de entrada de radio del formulario
            var radios = document.querySelectorAll("input[type=radio]");

            radios.forEach(function(radio) {
                if (radio.checked) {
                    var pregunta_id = radio.name.replace("respuesta_", ""); // Obtener el ID de la pregunta
                    var respuesta = radio.value; // Obtener el valor de la respuesta

                    // Almacenar la respuesta en el objeto de respuestas
                    respuestas[pregunta_id] = respuesta;
                }
            });


            var session_id = <?php echo $session_id; ?>;

            // Crear un objeto para almacenar las respuestas y agregar el campo "id" fuera del objeto de respuestas
            var respuestaFinal = {
                "id": cuestionario_id,
                "session_id": session_id, // Agregar el ID de la sesión actual
                "respuestas": respuestas
            };

            // Eliminar el campo "id" del objeto de respuestas
            delete respuestaFinal.respuestas.id;

            // Mostrar el JSON en la consola
            console.log("Respuestas en formato JSON:", JSON.stringify(respuestaFinal, null, 2));
            document.getElementById("respuesta-final-json-input").value = JSON.stringify(respuestaFinal);

        });

        //...
        // Botón "Siguiente"
        document.getElementById("siguiente").addEventListener("click", function() {
            // Obtener la pregunta actual
            var preguntaId = preguntas[preguntaActual].id;

            // Obtener la respuesta seleccionada
            var respuestaSeleccionada = document.querySelector('input[name="respuesta_' + preguntaId + '"]:checked');

            if (respuestaSeleccionada) {
                // Almacenar la respuesta en el objeto de respuestas con el ID de la pregunta como clave
                respuestas[preguntaId] = respuestaSeleccionada.value;

                // Mostrar la siguiente pregunta
                if (preguntaActual < totalPreguntas - 1) {
                    preguntaActual++;
                    mostrarPregunta();
                    document.getElementById("anterior").style.display = "block";
                } else {
                    // Si es la última pregunta, mostrar el mensaje y finalizar
                    preguntasContainer.innerHTML = "Has llegado al final de las preguntas, presiona 'Finalizar' para terminar el proceso.";
                    document.getElementById("siguiente").style.display = "none";
                    document.getElementById("finalizar").style.display = "block";
                }
            } else {
                // Mostrar un mensaje de error si no se ha seleccionado una respuesta
                alert("Por favor, selecciona una opción antes de continuar.");
            }
        });


        // Botón "Anterior"
        document.getElementById("anterior").addEventListener("click", function() {
            if (preguntaActual > 0) {
                preguntaActual--;
                mostrarPregunta();
                document.getElementById("siguiente").style.display = "block";
                document.getElementById("finalizar").style.display = "none";
            }

            // Verificar si preguntaActual es igual a 0 (primera pregunta) después de mostrar la pregunta anterior
            if (preguntaActual === 0) {
                this.style.display = "none";
            }
        });


        // Obtén una referencia a la barra de progreso
        var progressBar = document.getElementById('progress-bar');

        // Función para actualizar la barra de progreso
        // Función para actualizar la barra de progreso
        function actualizarBarraDeProgreso() {
            var progreso = (preguntaActual + 1) / totalPreguntas; // Sumamos 1 para obtener el progreso actual
            var progressBar = document.getElementById('progress-bar');
            progressBar.style.width = (progreso * 100) + '%';
        }

        // Llama a la función para mostrar la barra de progreso al cargar la página
        actualizarBarraDeProgreso();

        // En tus funciones para mostrar y avanzar preguntas, llama a la función actualizarBarraDeProgreso para actualizar la barra de progreso en cada paso.
    </script>
</body>

</html>