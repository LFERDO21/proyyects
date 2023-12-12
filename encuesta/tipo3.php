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
    <!-- Agregar enlaces a los estilos de Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 font-sans">
    <?php include("../navbar.php"); ?>
    <a href="../crear_encuesta.php" class="absolute top-11 left-0 m-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded flex items-center">
        <i class="fas fa-arrow-left mr-2"></i> Regresar
    </a>
    <div class="container mx-auto mt-10">
        <h3 class="text-xl font-semibold mb-4">Test de Diagnóstico de Riesgo Psicosociales</h3>

        <!-- Barra de Progreso -->
        <div class="w-full h-3 bg-gray-300 mt-4 rounded-full">
            <div id="progresoActual" class="w-0 h-full text-center text-xs text-white bg-blue-500 rounded-full"></div>
        </div>

        <div id="flujo" class="mt-6">
            <div id="step1">
                <h4 class="text-lg font-semibold mb-2">Paso 1: Nombre</h4>
                <input id="nombreInput" type="text" placeholder="Nombre del test" class="w-full p-3 border rounded focus:outline-none focus:ring focus:border-blue-300">
                <button onclick="siguientePaso(1)" class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded mt-2">Siguiente</button>
            </div>
            <div id="step2" style="display: none;">
                <h4 class="text-lg font-semibold mb-2">Paso 2: Fecha de inicio</h4>
                <p class="italic">Es la fecha en cuando se va a empezar a poder responder el test</p>
                <input id="fechaInput" type="text" placeholder="Fecha de inicio (DD/MM/AAAA)" class="w-full p-3 border rounded focus:outline-none focus:ring focus:border-blue-300">
                <script>
                    flatpickr("#fechaInput", {
                        dateFormat: "d/m/Y",
                        locale: {
                            firstDayOfWeek: 1,
                        },
                    });
                </script>
                <button onclick="siguientePaso(2)" class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded mt-2">Siguiente</button>
            </div>

            <div id="step3" style="display: none;">
                <h4 class="text-lg font-semibold mb-2">Paso 3: Categorías</h4>
                <input id="nuevaCategoriaInput" type="text" placeholder="Nombre de la categoría" class="w-full p-3 border rounded focus:outline-none focus:ring focus:border-blue-300">
                <button onclick="agregarCategoria()" class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded mt-2">Agregar Categoría</button>
                <button onclick="siguientePaso(3)" class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded mt-2">Siguiente</button>
            </div>

            <!-- Paso 4 para agregar preguntas (se muestra después de cada categoría) -->
            <div id="step4" style="display: none;">
                <h4 class="text-lg font-semibold mb-2">Paso 4: Agregar Preguntas</h4>
                <h5 class="mb-2">Preguntas para la categoría <span id="categoriaActual"></span></h5>
                <input id="nuevaPreguntaInput" type="text" placeholder="Nueva pregunta" class="w-full p-3 border rounded focus:outline-none focus:ring focus:border-blue-300">
                <button onclick="agregarPregunta()" class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded mt-2">Agregar Pregunta</button>

                <form id="formularioJSON" action="procesartipo3.php" method="post">
                    <!-- Agrega un campo oculto para almacenar los datos JSON -->
                    <input type="hidden" id="datosJSON" name="datosJSON" value="">
                    <button onclick="enviarFormulario()" class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded mt-2">Finalizar</button>
                </form>

                <div class="m-4">
                    <div id="botonesCambioCategoria" class="mb-4"></div> <!-- Contenedor para los botones de cambio de categoría -->
                </div>
                <!-- Lista de preguntas -->
                <ul id="preguntasLista" class="mt-4 list-disc ml-8"></ul>
            </div>

            <div id="step5" style="display: none;">
                <h4 class="text-lg font-semibold mb-2">Paso 5: Finalizar</h4>
                <p>¡El test ha sido finalizado! Aquí puedes mostrar un mensaje de confirmación o realizar cualquier acción adicional.</p>
            </div>
        </div>

        <!-- Área de visualización de datos ingresados con estilos de Tailwind CSS -->
        <div id="datosIngresados" class="mt-4 p-4 bg-gray-100 rounded">
            <h4 class="text-lg font-semibold mb-2">Datos Ingresados</h4>
            <p class="mb-2"><strong>Nombre del test:</strong> <span id="nombreMostrado" class="font-semibold"></span></p>
            <p class="mb-2"><strong>Fecha de inicio:</strong> <span id="fechaMostrada" class="font-semibold"></span></p>
            <p class="mb-2"><strong>Categorías:</strong></p>
            <ul id="categoriasMostradas" class="list-disc ml-8"></ul>
        </div>

    </div>



    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        // Objeto para almacenar la información
        var data = {
            "Nombre del test": "",
            "Fecha de inicio": "",
            Categorias: []
        };

        var currentStep = 1;
        var categoriaActual = ""; // Variable para realizar un seguimiento de la categoría actual

        function siguientePaso(step) {
            if (step === 1) {
                var nombreInput = document.getElementById("nombreInput");
                data["Nombre del test"] = nombreInput.value;
            } else if (step === 2) {
                var fechaInput = document.getElementById("fechaInput");
                data["Fecha de inicio"] = fechaInput.value;
            }

            if (step < 3) {
                mostrarPaso(step + 1);
            } else if (step === 3) {
                // Muestra el Paso 4 para agregar preguntas
                mostrarPaso(4);
                // Llena los botones de cambio de categoría
                llenarBotonesCambioCategoria();
            }
        }

        function agregarCategoria() {
            var nombreCategoriaInput = document.getElementById("nuevaCategoriaInput");
            var nombreCategoria = nombreCategoriaInput.value.trim();

            if (nombreCategoria) {
                var nuevaCategoriaData = {
                    Nombre: nombreCategoria,
                    Preguntas: []
                };

                data.Categorias.push(nuevaCategoriaData);
                nombreCategoriaInput.value = '';
            }

            mostrarPaso(3);
        }

        function agregarPregunta() {
            var nuevaPreguntaInput = document.getElementById("nuevaPreguntaInput");
            var pregunta = nuevaPreguntaInput.value.trim();

            if (pregunta && categoriaActual) {
                var categoria = data.Categorias.find(function(categoria) {
                    return categoria.Nombre === categoriaActual;
                });

                if (categoria) {
                    categoria.Preguntas.push(pregunta);
                    nuevaPreguntaInput.value = '';
                    mostrarPreguntas();
                }
            }
        }

        function finalizar() {
            // Verifica si los datos están listos para ser enviados
            if (data && data["Nombre del test"] && data["Fecha de inicio"] && data.Categorias.length > 0) {
                // Realiza una solicitud POST con los datos JSON
                fetch("procesartipo3.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                        },
                        body: JSON.stringify(data),
                    })
                    .then((response) => response.json())
                    .then((result) => {
                        console.log("Datos enviados con éxito y respuesta recibida:", result);
                        // Aquí puedes realizar cualquier acción adicional según la respuesta del servidor
                    })
                    .catch((error) => {
                        console.error("Error al enviar los datos:", error);
                    });
            } else {
                console.error("Faltan datos para enviar o no se han completado los pasos anteriores.");
            }

            mostrarPaso(5); // Avanza al Paso 5 (Finalizar)
        }



        function cambiarCategoria(categoria) {
            categoriaActual = categoria;
            var categoriaActualElement = document.getElementById("categoriaActual");
            categoriaActualElement.textContent = categoria;

            // Actualiza la vista para reflejar la nueva categoría
            mostrarPreguntas();
        }

        // Función para llenar los botones de cambio de categoría
        function llenarBotonesCambioCategoria() {
            var botonesCambioCategoria = document.getElementById("botonesCambioCategoria");
            botonesCambioCategoria.innerHTML = "";

            data.Categorias.forEach(function(categoria) {
                var button = document.createElement("button");
                button.textContent = "Cambiar a " + categoria.Nombre;
                button.className = "bg-blue-500 hover-bg-blue-700 text-white font-bold m-2 py-2 px-4 rounded";
                button.onclick = function() {
                    cambiarCategoria(categoria.Nombre);
                };
                botonesCambioCategoria.appendChild(button);
            });
        }

        function mostrarPreguntas() {
            var preguntasLista = document.getElementById("preguntasLista");
            preguntasLista.innerHTML = '';
            if (categoriaActual) {
                var categoria = data.Categorias.find(function(categoria) {
                    return categoria.Nombre === categoriaActual;
                });
                if (categoria && categoria.Preguntas.length > 0) {
                    categoria.Preguntas.forEach(function(pregunta, index) {
                        var li = document.createElement("li");
                        li.textContent = pregunta;

                        // Agrega un botón "x" para eliminar la pregunta
                        var botonEliminar = document.createElement("button");
                        botonEliminar.textContent = "x";
                        botonEliminar.className = "ml-2 text-red-500 font-semibold";
                        botonEliminar.onclick = function() {
                            eliminarPregunta(categoria.Nombre, index);
                        };

                        li.appendChild(botonEliminar);
                        preguntasLista.appendChild(li);
                    });
                }
            }
            // Actualiza las categorías mostradas en el área de visualización de datos
            var categoriasMostradas = document.getElementById("categoriasMostradas");
            categoriasMostradas.innerHTML = '';

            data.Categorias.forEach(function(categoria) {
                var li = document.createElement("li");
                li.textContent = categoria.Nombre;

                if (categoria.Preguntas.length > 0) {
                    var ul = document.createElement("ul");

                    categoria.Preguntas.forEach(function(pregunta) {
                        var liPregunta = document.createElement("li");
                        liPregunta.textContent = pregunta;
                        ul.appendChild(liPregunta);
                    });

                    li.appendChild(ul);
                }

                categoriasMostradas.appendChild(li);
            });
        }

        function eliminarPregunta(categoriaNombre, index) {
            var categoria = data.Categorias.find(function(categoria) {
                return categoria.Nombre === categoriaNombre;
            });
            if (categoria && categoria.Preguntas.length > index) {
                categoria.Preguntas.splice(index, 1);
                mostrarPreguntas();
            }
        }

        function mostrarPaso(paso) {
            // Oculta el paso actual
            var pasoActual = document.getElementById("step" + currentStep);
            pasoActual.style.display = "none";

            // Muestra el siguiente paso
            if (paso <= 5) {
                var siguientePaso = document.getElementById("step" + paso);
                siguientePaso.style.display = "block";
            }

            currentStep = paso;
            actualizarVista();
            actualizarBarraDeProgreso(); // Actualiza la barra de progreso
        }

        function actualizarVista() {
            // Actualiza el área de visualización de datos ingresados
            var nombreMostrado = document.getElementById("nombreMostrado");
            nombreMostrado.textContent = data["Nombre del test"];
            var fechaMostrada = document.getElementById("fechaMostrada");
            fechaMostrada.textContent = data["Fecha de inicio"];

            var categoriasMostradas = document.getElementById("categoriasMostradas");
            categoriasMostradas.innerHTML = '';

            data.Categorias.forEach(function(categoria) {
                var li = document.createElement("li");
                li.textContent = categoria.Nombre;

                if (categoria.Preguntas.length > 0) {
                    var ul = document.createElement("ul");

                    categoria.Preguntas.forEach(function(pregunta) {
                        var liPregunta = document.createElement("li");
                        liPregunta.textContent = pregunta;
                        ul.appendChild(liPregunta);
                    });

                    li.appendChild(ul);
                }

                categoriasMostradas.appendChild(li);
            });
        }

        function actualizarBarraDeProgreso() {
            const numPasos = 5; // Número total de pasos en tu flujo
            const progreso = currentStep / numPasos; // Calcula el progreso actual

            // Actualiza el ancho de la barra de progreso y muestra el progreso como porcentaje
            const barraDeProgreso = document.getElementById("progresoActual");
            barraDeProgreso.style.width = (progreso * 100) + "%";
            barraDeProgreso.textContent = (progreso * 100).toFixed(0) + "%";
        }



        function mostrarCambiosEnConsola() {
            // Convierte el objeto de datos a formato JSON
            var jsonData = JSON.stringify(data, null, 2);
            console.log("Cambios en el JSON de datos:");
            console.log(jsonData);
        }

        function enviarFormulario() {
            // Convierte el objeto de datos a formato JSON
            var jsonData = JSON.stringify(data);

            // Actualiza el valor del campo oculto "datosJSON" con el JSON
            var datosJSONInput = document.getElementById("datosJSON");
            datosJSONInput.value = jsonData;

            // Envía el formulario
            var formulario = document.getElementById("formularioJSON");
            formulario.submit();
        }
    </script>



</body>

</html>