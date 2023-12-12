<?php
session_start();
include("../session.php");
include("../bd.php"); // Incluye el archivo de configuración de la base de datos

// Obtén el ID del usuario desde la sesión o desde donde lo tengas almacenado
$usuario_id = $_SESSION['usuario_id']; // Asegúrate de tener una variable de sesión con el ID del usuario

// Realiza una consulta SQL para obtener el empresa_id del usuario desde la tabla personal
$query = "SELECT empresa_id FROM personal WHERE id = $usuario_id";
$resultado = mysqli_query($conexion, $query);

if ($resultado) {
    // La consulta se realizó con éxito
    if ($row = mysqli_fetch_assoc($resultado)) {
        $empresa_id = $row['empresa_id'];

        // Ahora que tienes el empresa_id, puedes buscar la abreviatura de la empresa
        $query_empresa = "SELECT abreviatura FROM empresas WHERE id = $empresa_id";
        $resultado_empresa = mysqli_query($conexion, $query_empresa);

        if ($resultado_empresa) {
            // La consulta se realizó con éxito
            if ($row_empresa = mysqli_fetch_assoc($resultado_empresa)) {
                $abreviatura_empresa = $row_empresa['abreviatura'];
            } else {
                // No se encontró la abreviatura de la empresa, maneja este caso según tus necesidades
            }
        } else {
            // Hubo un error en la consulta SQL para obtener la abreviatura de la empresa, maneja el error apropiadamente
        }
    } else {
        // No se encontró el empresa_id del usuario, maneja este caso según tus necesidades
    }
} else {
    // Hubo un error en la consulta SQL para obtener el empresa_id del usuario, maneja el error apropiadamente
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Encuesta</title>
    <?php include("../links.php"); ?>
</head>

<body class="bg-gray-100">
    <?php include("../navbar.php"); ?>
    <a href="../crear_encuesta.php" class="absolute top-11 left-0 m-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded flex items-center">
        <i class="fas fa-arrow-left mr-2"></i> Regresar
    </a>
    <div class="container mx-auto mt-10">
        <h3 class="text-xl font-semibold mb-2">Plantilla 2</h3>

        <!-- Barra de Progreso -->
        <div class="w-full h-3 bg-gray-300 mt-2 rounded-full">
            <div id="progresoActual" class="w-0 h-full text-center text-xs text-white bg-blue-500 rounded-full"></div>
        </div>

        <div id="flujo">
            <div id="step1">
                <h4>Paso 1: Nombre</h4>
                <input id="nombreInput" type="text" placeholder="Nombre del test" class="w-full p-2 border rounded">
                <button onclick="siguientePaso(1)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Siguiente</button>
            </div>
            <div id="step2" style="display: none;">
                <h4>Paso 2: Fecha de inicio</h4>
                <input id="fechaInput" type="text" placeholder="Fecha de inicio (DD/MM/AAAA)" class="w-full p-2 border rounded">
                <script>
                    flatpickr("#fechaInput", {
                        dateFormat: "d/m/Y", // Formato de fecha deseado
                        locale: {
                            firstDayOfWeek: 1, // Lunes como primer día de la semana
                        },
                    });
                </script>
                <button onclick="siguientePaso(2)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Siguiente</button>
            </div>
            <div id="step3" style="display: none;">
                <h4>Paso 3: Categorías</h4>
                <input type="text" id="nuevaCategoriaInput" placeholder="Nombre de la categoría" class="w-full p-2 border rounded">
                <button onclick="agregarCategoria()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" id="btnAgregarCategoria">Agregar Categoría</button>
                <button onclick="siguientePaso(3)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" id="btnPaso3">Siguiente</button>
            </div>


            <div id="step4" style="display: none;">
                <h4>Paso 4: Agregar Preguntas</h4>

                <!-- Campo de entrada para la pregunta -->
                <input id="preguntaInput" type="text" placeholder="Pregunta" class="w-full p-2 border rounded">

                <!-- Campos de entrada para las respuestas -->
                <div class="mt-4">
                    <p>Respuestas:</p>
                    <div class="mt-2">
                        <label for="respuestaA">A:</label>
                        <input id="respuestaA" type="text" placeholder="Respuesta A" class="w-full p-2 border rounded">
                    </div>
                    <div class="mt-2">
                        <label for="respuestaB">B:</label>
                        <input id="respuestaB" type="text" placeholder="Respuesta B" class="w-full p-2 border rounded">
                    </div>
                    <div class="mt-2">
                        <label for="respuestaC">C:</label>
                        <input id="respuestaC" type="text" placeholder="Respuesta C" class="w-full p-2 border rounded">
                    </div>
                </div>

                <button onclick="agregarPregunta()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">Agregar Pregunta</button>
                <button onclick="confirmarSiguientePaso(4)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Siguiente</button>
            </div>

            <div id="step5" style="display: none;">
                <h4>Paso 5: Finalizar</h4>
                <p>¡El test ha sido finalizado! Aquí puedes mostrar un mensaje de confirmación o realizar cualquier acción adicional.</p>
                <button onclick="finalizar()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Finalizar</button>

            </div>
        </div>
        <!-- Área de visualización de datos ingresados con estilos de Tailwind CSS -->
        <div id="datosIngresados" class="mt-4 p-4 bg-gray-100 rounded">
            <h4 class="text-lg font-semibold mb-2">Datos Ingresados</h4>
            <p class="mb-2"><strong>Nombre del test:</strong> <span id="nombreMostrado" class="font-semibold"></span></p>
            <p class="mb-2"><strong>Fecha de inicio:</strong> <span id="fechaMostrada" class="font-semibold"></span></p>
            <p class="mb-2"><strong>Categorías:</strong></p>
            <ul id="categoriasMostradas" class="list-disc ml-8"></ul>
            <p class="mb-2"><strong>Preguntas y Respuestas:</strong></p>
            <ul id="preguntasMostradas" class="list-disc ml-8"></ul>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        var maxPasos = 5;
        var pasosCompletados = 0;
        var currentStep = 1;

        // Object to store the information
        var data = {
            "Nombre del test": "",
            "Fecha de inicio": "",
            "Categorias": [], // Stores categories as an array
            "Preguntas": [] // Stores questions with references to categories
        };

        function siguientePaso(step) {
            if (step === 1) {
                var nombreInput = document.getElementById("nombreInput");
                if (!nombreInput.value.trim()) {
                    alert("Por favor, ingresa el nombre del test.");
                    return; // Detener la ejecución si el nombre no está presente
                }
                data["Nombre del test"] = nombreInput.value;
            } else if (step === 2) {
                var fechaInput = document.getElementById("fechaInput");
                if (!fechaInput.value.trim()) {
                    alert("Por favor, ingresa la fecha de inicio.");
                    return; // Detener la ejecución si la fecha no está presente
                }
                data["Fecha de inicio"] = fechaInput.value;
            }

            if (step < maxPasos) {
                mostrarPaso(step + 1);
                pasosCompletados++;
            } else if (step === maxPasos) {
                mostrarPaso(step);
                pasosCompletados++;
                mostrarMensajeMaximoAlcanzado();
            }
        }

        function confirmarSiguientePaso(step) {
            // Validar los campos antes de mostrar el cuadro de confirmación
            if (step === 1) {
                var nombreInput = document.getElementById("nombreInput");
                if (!nombreInput.value.trim()) {
                    alert("Por favor, ingresa el nombre del test.");
                    return; // Detener la ejecución si el nombre no está presente
                }
                data["Nombre del test"] = nombreInput.value;
            } else if (step === 2) {
                var fechaInput = document.getElementById("fechaInput");
                if (!fechaInput.value.trim()) {
                    alert("Por favor, ingresa la fecha de inicio.");
                    return; // Detener la ejecución si la fecha no está presente
                }
                data["Fecha de inicio"] = fechaInput.value;
            }

            // Muestra un cuadro de confirmación personalizado
            var confirmacion = window.confirm("¿Estás seguro de querer avanzar al siguiente paso?");

            if (confirmacion) {
                siguientePaso(step);
            } else {
                // Si el usuario cancela, no hace nada
            }
        }

        function mostrarMensajeMaximoAlcanzado() {
            // Hide all steps, except the last one (Step 5)
            for (var i = 1; i <= maxPasos; i++) {
                var paso = document.getElementById("step" + i);
                if (i !== maxPasos) {
                    paso.style.display = "none";
                } else {
                    paso.style.display = "block";
                }
            }

            // Show the "Next" button
            var btnSiguiente = document.getElementById("btnSiguiente");
            btnSiguiente.style.display = "block";

            // Show the maximum reached message
            var mensajeMaximo = document.getElementById("mensajeMaximo");
            mensajeMaximo.style.display = "block";
        }

        var btnAgregarCategoria = document.getElementById("btnAgregarCategoria");
        var nuevaCategoriaInput = document.getElementById("nuevaCategoriaInput");
        var maxCategorias = 3; // Define the maximum allowed categories

        function agregarCategoria() {
            var nuevaCategoriaInput = document.getElementById("nuevaCategoriaInput");
            var nombreCategoria = nuevaCategoriaInput.value.trim();

            if (nombreCategoria) {
                if (data.Categorias.length < maxCategorias) {
                    data.Categorias.push(nombreCategoria);
                    nuevaCategoriaInput.value = ''; // Clear the input field
                    actualizarVista(); // Update the category view
                    nuevaCategoriaInput.focus(); // Focus again on the input field
                } else {
                    alert("You have reached the maximum allowed categories."); // Show a message if the limit is reached
                }
            }
        }

        function actualizarBtnPaso3() {
            // Disable the Next button if the maximum categories have been added
            var btnPaso3 = document.getElementById("btnPaso3");
            if (data.Categorias.length >= maxCategorias) {
                btnPaso3.disabled = true; // Disable the Next button
                nuevaCategoriaInput.style.display = "none"; // Hide the new category input
                btnAgregarCategoria.style.display = "none"; // Hide the add category button
            } else {
                btnPaso3.disabled = false; // Enable the Next button
            }
        }

        function agregarPregunta() {
            // Get the values of the question and the answers
            var preguntaInput = document.getElementById("preguntaInput");
            var respuestaA = document.getElementById("respuestaA");
            var respuestaB = document.getElementById("respuestaB");
            var respuestaC = document.getElementById("respuestaC");

            var pregunta = preguntaInput.value;
            var respuestas = [{
                    nombre: respuestaA.value,
                    categoria: data.Categorias[0] // Associate with the first category
                },
                {
                    nombre: respuestaB.value,
                    categoria: data.Categorias[1] // Associate with the second category
                },
                {
                    nombre: respuestaC.value,
                    categoria: data.Categorias[2] // Associate with the third category
                }
            ];

            // Check if a question and at least one answer were entered
            if (pregunta && respuestas.some(respuesta => respuesta.nombre)) {
                // Create an object of question and answers
                var preguntaObj = {
                    "Pregunta": pregunta,
                    "Respuestas": respuestas
                };

                // Add the question to the array of questions
                data.Preguntas.push(preguntaObj);

                // Clear the input fields
                preguntaInput.value = "";
                respuestaA.value = "";
                respuestaB.value = "";
                respuestaC.value = "";

                // Update the view
                actualizarVista();
            } else {
                alert("Please enter a question and at least one answer.");
            }
        }

        function mostrarPaso(paso) {
            // Hide the current step
            var pasoActual = document.getElementById("step" + currentStep);
            pasoActual.style.display = "none";

            // Show the next step
            if (paso <= 5) {
                var siguientePaso = document.getElementById("step" + paso);
                siguientePaso.style.display = "block";
            }

            currentStep = paso;
            actualizarVista();
            actualizarBarraDeProgreso(); // Update the progress bar
        }

        function actualizarVista() {
            // Update the display area of entered data
            var nombreMostrado = document.getElementById("nombreMostrado");
            nombreMostrado.textContent = data["Nombre del test"];
            var fechaMostrada = document.getElementById("fechaMostrada");
            fechaMostrada.textContent = data["Fecha de inicio"];

            var categoriasMostradas = document.getElementById("categoriasMostradas");
            categoriasMostradas.innerHTML = '';

            data.Categorias.forEach(function(categoria, index) {
                var li = document.createElement("li");
                li.textContent = "Categoría " + String.fromCharCode(65 + index) + ": " + categoria;
                categoriasMostradas.appendChild(li);
            });

            var preguntasMostradas = document.getElementById("preguntasMostradas");
            preguntasMostradas.innerHTML = '';

            data.Preguntas.forEach(function(pregunta, index) {
                var p = document.createElement("p");
                p.textContent = "Pregunta " + (index + 1) + ": " + pregunta.Pregunta;

                // Iterate through the answers and display the name, the answer, and the category
                pregunta.Respuestas.forEach(function(respuesta, idx) {
                    var liRespuesta = document.createElement("li");
                    liRespuesta.textContent = String.fromCharCode(65 + idx) + ": " + respuesta.nombre + " (Categoría " + String.fromCharCode(65 + idx) + ": " + data.Categorias[idx] + ")";
                    p.appendChild(liRespuesta);
                });

                preguntasMostradas.appendChild(p);
            });
        }

        function actualizarBarraDeProgreso() {
            const numPasos = 5; // Total number of steps in your flow
            const progreso = currentStep / numPasos; // Calculate the current progress

            // Update the width of the progress bar and display the progress as a percentage
            const barraDeProgreso = document.getElementById("progresoActual");
            barraDeProgreso.style.width = (progreso * 100) + "%";
            barraDeProgreso.textContent = (progreso * 100).toFixed(0) + "%";
        }

        function mostrarCambiosEnConsola() {
            var jsonData = JSON.stringify(data, null, 2); // Convert the 'data' object to a JSON string with indentation of 2 spaces
            console.log(jsonData); // Display the JSON string in the console with vertical format
        }


        function finalizar() {
            // Muestra los cambios en la consola antes de enviar la solicitud
            mostrarCambiosEnConsola();

            // Crea un formulario dinámicamente
            var form = document.createElement("form");
            form.method = "post"; // Establece el método de envío como POST
            form.action = "procesartipo2.php"; // Establece la URL del archivo de procesamiento PHP

            // Crea un campo de entrada oculto para enviar el JSON
            var jsonDataInput = document.createElement("input");
            jsonDataInput.type = "hidden";
            jsonDataInput.name = "jsonData"; // Establece el nombre del campo
            jsonDataInput.value = JSON.stringify(data); // Establece el valor del campo como el JSON serializado

            // Agrega el campo de entrada al formulario
            form.appendChild(jsonDataInput);

            // Agrega el formulario al cuerpo del documento
            document.body.appendChild(form);

            // Envía el formulario
            form.submit();
        }
    </script>


</body>

</html>