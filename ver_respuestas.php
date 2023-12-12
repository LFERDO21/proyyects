<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Respuestas del Usuario</title>
    <?php include("links.php"); ?>
</head>

<body class="font-sans bg-gray-100">

    <?php
    session_start();
    include("session.php");
    include("bd.php"); // Incluye el archivo de configuración de la base de datos

    // Inicializa un array asociativo para los totales de categoría
    $totalsByCategory = array();

    // Verifica si se recibieron los datos del formulario POST
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Recupera los datos del formulario
        $tipo = $_POST["tipo"];
        $id_usuario = $_POST["id_usuario"];
        $encuesta_id = $_POST["encuesta_id"];

        // Realiza una consulta para obtener las respuestas del usuario con los IDs proporcionados
        $query_respuestas = "SELECT pregunta_id, respuesta FROM respuestas WHERE usuario_id = ? AND datos_id = ?";

        if ($stmt_respuestas = mysqli_prepare($conexion, $query_respuestas)) {
            mysqli_stmt_bind_param($stmt_respuestas, "ss", $id_usuario, $encuesta_id);
            mysqli_stmt_execute($stmt_respuestas);
            mysqli_stmt_store_result($stmt_respuestas);

            // Vincula las variables de resultado
            mysqli_stmt_bind_result($stmt_respuestas, $pregunta_id, $respuesta);

            // Recopila los totales por categoría
            while (mysqli_stmt_fetch($stmt_respuestas)) {
                // Consulta para obtener la categoría de la tabla preguntas
                $query_categoria = "SELECT Categoria FROM preguntas WHERE id = ?";
                if ($stmt_categoria = mysqli_prepare($conexion, $query_categoria)) {
                    mysqli_stmt_bind_param($stmt_categoria, "s", $pregunta_id);
                    mysqli_stmt_execute($stmt_categoria);
                    mysqli_stmt_store_result($stmt_categoria);

                    // Vincula la variable de resultado
                    mysqli_stmt_bind_result($stmt_categoria, $categoria);

                    // Obtiene la categoría
                    mysqli_stmt_fetch($stmt_categoria);

                    // Suma las respuestas a los totales de categoría
                    if (!isset($totalsByCategory[$categoria])) {
                        $totalsByCategory[$categoria] = 0;
                    }
                    $totalsByCategory[$categoria] += $respuesta;

                    // Cierra la declaración de la categoría
                    mysqli_stmt_close($stmt_categoria);
                } else {
                    echo "Error en la preparación de la consulta de categoría: " . mysqli_error($conexion);
                }
            }

            // Cierra la declaración de respuestas
            mysqli_stmt_close($stmt_respuestas);

            // Consulta para obtener información adicional del usuario
            $query_usuario = "SELECT Nombre, Apellidos, Correo, clave_interna, Sexo FROM usuarios WHERE ID = ?";
            if ($stmt_usuario = mysqli_prepare($conexion, $query_usuario)) {
                mysqli_stmt_bind_param($stmt_usuario, "s", $id_usuario);
                mysqli_stmt_execute($stmt_usuario);
                mysqli_stmt_store_result($stmt_usuario);

                // Vincula las variables de resultado
                mysqli_stmt_bind_result($stmt_usuario, $nombre, $apellidos, $correo, $clave_interna, $sexo);

                // Obtiene la información adicional del usuario
                mysqli_stmt_fetch($stmt_usuario);

                // Muestra la información adicional del usuario
                echo "<div class='container mx-auto mt-8 p-4 bg-white shadow-lg'>";
                echo "<h2 class='text-xl font-bold mb-4'>Información Adicional del Usuario</h2>";
                echo "<p class='text-gray-600'><span class='font-bold'>Nombre Completo:</span> $nombre $apellidos</p>";
                echo "<p class='text-gray-600'><span class='font-bold'>Correo:</span> $correo</p>";
                echo "<p class='text-gray-600'><span class='font-bold'>Clave Interna:</span> $clave_interna</p>";
                echo "<p class='text-gray-600'><span class='font-bold'>Sexo:</span> $sexo</p>";
                echo "</div>";

                // Cierra la declaración de usuario
                mysqli_stmt_close($stmt_usuario);
            } else {
                echo "Error en la preparación de la consulta de usuario: " . mysqli_error($conexion);
            }
        } else {
            // Si hay un error en la preparación de la consulta de respuestas
            echo "Error en la preparación de la consulta de respuestas: " . mysqli_error($conexion);
        }

        // ... (tu código existente) ...
    }
    ?>
    <a href="#" onclick="submitForm()" class="absolute top-0 left-0 m-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded flex items-center">
        <i class="fas fa-arrow-left mr-2"></i> Regresar
    </a>

    <div class="container mx-auto mt-8 p-4 bg-white shadow-lg">
        <h2 class="text-xl font-bold mb-4">Gráfico de Pastel</h2>
        <div class="container mx-auto mt-4 p-4 bg-white shadow-lg text-center">
            <h2 class="text-xl font-bold mb-4">Detalle de Puntuaciones</h2>
            <ul class="list-none pl-8">
                <?php
                $first = true;
                foreach ($totalsByCategory as $category => $score) {
                    if ($first) {
                        $first = false;
                        echo "<li class='text-lg font-bold mb-2'>$category: $score puntos</li>";
                    } else {
                        echo "<li>$category: $score puntos</li>";
                    }
                }
                ?>
            </ul>
        </div>
        <div style="width: 100%; max-width: 600px; height: 400px; margin: 0 auto;">
            <canvas id="myPieChart"></canvas>
        </div>
    </div>




    <form id="formDetalleEncuesta" action="detalle_encuesta.php" method="post">
        <input type="hidden" name="encuesta_id" value="<?php echo $encuesta_id; ?>">
    </form>


    <!-- Enlace que llama a una función JavaScript para enviar el formulario por POST -->



    <!-- Script para configurar y dibujar el gráfico de pastel -->
    <!-- Script para configurar y dibujar el gráfico de pastel -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function submitForm() {
            // Envía el formulario
            document.getElementById("formDetalleEncuesta").submit();
        }

        var ctx = document.getElementById('myPieChart').getContext('2d');
        var myPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: <?php echo json_encode(array_keys($totalsByCategory)); ?>,
                datasets: [{
                    data: <?php echo json_encode(array_values($totalsByCategory)); ?>,
                    backgroundColor: [
                        'rgba(255, 191, 128, 0.7)', // Amarillo pastel
                        'rgba(255, 165, 0, 0.7)', // Naranja pastel
                        'rgba(255, 140, 0, 0.7)', // Naranja oscuro pastel
                        'rgba(255, 110, 74, 0.7)', // Melocotón pastel
                        'rgba(255, 99, 132, 0.7)', // Rosa pastel
                        'rgba(255, 182, 193, 0.7)', // Rosa claro pastel
                        'rgba(173, 216, 230, 0.7)', // Azul celeste pastel
                        'rgba(135, 206, 250, 0.7)', // Azul claro pastel
                        'rgba(70, 130, 180, 0.7)', // Azul oscuro pastel
                        'rgba(173, 255, 47, 0.7)', // Verde pastel
                        'rgba(152, 251, 152, 0.7)', // Verde claro pastel
                        'rgba(34, 139, 34, 0.7)', // Verde oscuro pastel
                        'rgba(50, 205, 50, 0.7)', // Verde lima pastel
                        'rgba(255, 250, 205, 0.7)', // Amarillo claro pastel
                        'rgba(238, 232, 170, 0.7)', // Amarillo oscuro pastel

                        // Puedes agregar más colores según la cantidad de categorías
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: 'bottom'
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            var dataset = data.datasets[tooltipItem.datasetIndex];
                            var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
                                return previousValue + currentValue;
                            });
                            var currentValue = dataset.data[tooltipItem.index];
                            var percentage = Math.floor(((currentValue / total) * 100) + 0.5);
                            return currentValue + ' puntos (' + percentage + '%)';
                        }
                    }
                }
            }
        });

        // Ordena las categorías y los puntos de mayor a menor
        var sortedCategories = <?php
                                arsort($totalsByCategory);
                                echo json_encode(array_keys($totalsByCategory));
                                ?>;
        var sortedScores = <?php echo json_encode(array_values($totalsByCategory)); ?>;

        // Muestra la información de la categoría predominante
        document.getElementById('predominantCategory').innerHTML = "<span class='text-lg font-bold'>Puntuación por categorías:</span> <span class='text-orange-500 font-bold'>" + sortedCategories[0] + "</span> con <span class='text-orange-500 font-bold'>" + sortedScores[0] + "</span> puntos.";

        // Muestra las demás categorías y sus puntos en orden
        var total = sortedScores.reduce(function(previousValue, currentValue, currentIndex, array) {
            return previousValue + currentValue;
        });

        var listElement = document.createElement('ul');

        sortedCategories.forEach((category, index) => {
            var categoryScore = sortedScores[index];
            var listItem = document.createElement('li');
            listItem.innerHTML = category + ": " + categoryScore + ' puntos';
            listElement.appendChild(listItem);
        });

        document.getElementById('predominantCategory').appendChild(listElement);
    </script>
</body>

</html>