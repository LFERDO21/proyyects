<?php
session_start();
include("session.php");
include("bd.php"); // Incluye el archivo de configuración de la base de datos

// Obtén el ID del usuario desde la sesión
$usuario_id = $_SESSION['usuario_id'];

// Realiza una consulta SQL para obtener los datos relacionados en la tabla "datos" con el ID de usuario
$query = "SELECT * FROM datos WHERE personal_id = $usuario_id";
$result = mysqli_query($conexion, $query);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encuesta</title>
    <?php include("links.php"); ?>
</head>

<body class="bg-gray-100">
    <a href="dashboardpersonal.php" class="absolute top-11 left-0 m-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded flex items-center">
        <i class="fas fa-arrow-left mr-2"></i> Regresar
    </a>
    <?php include("navbar.php"); ?>

    <div class="w-1/2 mx-auto mt-4">
        <a href="crear_encuesta.php" class="text-blue-500 hover:underline mb-4">
            <div class="bg-white p-4 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-2">Crear Encuesta</h3>
                <p class="text-gray-600">Haz clic para crear una nueva Encuesta.</p>
                <i class="fas fa-building text-lg mr-2"></i>
                Crear Encuesta
            </div>
        </a>
    </div>

    <div class="container mx-auto mt-4 flex flex-wrap gap-4">

        <?php
        // Itera a través de los resultados y muestra los datos en forma de tarjetas
        while ($row = mysqli_fetch_assoc($result)) {
            $identificador = $row['identificador'];
            $estado = $row['estado'] == 'activo' ? 'green' : 'red';

            // Consulta para contar el número de categorías relacionadas con la encuesta
            $query_count_categorias = "SELECT COUNT(DISTINCT Categoria) AS num_categorias FROM preguntas WHERE identificador = '$identificador'";
            $result_count_categorias = mysqli_query($conexion, $query_count_categorias);
            $row_count_categorias = mysqli_fetch_assoc($result_count_categorias);
            $num_categorias = $row_count_categorias['num_categorias'];

            // Consulta para obtener los nombres de las categorías
            $query_categorias = "SELECT DISTINCT Categoria FROM preguntas WHERE identificador = '$identificador'";
            $result_categorias = mysqli_query($conexion, $query_categorias);
            $categorias = array();

            while ($row_categoria = mysqli_fetch_assoc($result_categorias)) {
                $categoria = $row_categoria['Categoria'];
                $categorias[] = $categoria;
            }

            // Consulta para contar el número de preguntas relacionadas con la encuesta
            $query_count_preguntas = "SELECT COUNT(*) AS num_preguntas FROM preguntas WHERE identificador = '$identificador'";
            $result_count_preguntas = mysqli_query($conexion, $query_count_preguntas);
            $row_count_preguntas = mysqli_fetch_assoc($result_count_preguntas);
            $num_preguntas = $row_count_preguntas['num_preguntas'];

            // Consulta para obtener el número de respuestas
            $query_num_respuestas = "SELECT COUNT(*) AS num_respuestas FROM respuestas WHERE identificador = '$identificador'";
            $result_num_respuestas = mysqli_query($conexion, $query_num_respuestas);
            $row_num_respuestas = mysqli_fetch_assoc($result_num_respuestas);
            $num_respuestas = $row_num_respuestas['num_respuestas'];
        ?>
            <div class="w-full md:w-1/2 lg:w-1/4 xl:w-1/4">
                <div class="bg-white p-4 rounded-lg shadow-md mb-4">
                    <h3 class="text-xl font-semibold mb-2 text-blue-500"><?php echo $row['nombre']; ?></h3>
                    <p class="text-gray-600"><span class="font-bold">Identificador:</span> <?php echo $identificador; ?></p>
                    <p class="text-gray-600"><span class="font-bold">Fecha de inicio:</span> <?php echo $row['fechainicio']; ?></p>
                    <p class="text-gray-600"><span class="font-bold">Fecha de Creación:</span> <?php echo $row['fecha_creacion']; ?></p>
                    <p class="text-gray-600 font-bold">
                        Estado:
                        <span class="font-bold <?php echo $row['estado'] === 'activo' ? 'text-green-500' : 'text-red-500'; ?>">
                            <?php echo $row['estado']; ?>
                        </span>
                    </p>

                    <p class="text-gray-600"><span class="font-bold">Número de Categorías:</span> <?php echo $num_categorias; ?></p>
                    <p class="text-gray-600"><span class="font-bold">Categorías:</span> <?php echo implode(", ", $categorias); ?></p>
                    <p class="text-gray-600"><span class="font-bold">Número de Respuestas:</span> <?php echo $num_preguntas; ?></p>
                    <!-- Agrega más detalles de acuerdo a tus necesidades -->
                    <form action="detalle_encuesta.php" method="post">
                        <!-- Agrega un campo oculto para enviar el ID de la encuesta -->
                        <input type="hidden" name="encuesta_id" value="<?php echo $row['id']; ?>">
                        <button type="submit" class="text-blue-500 hover:underline">Ver detalles</button>
                    </form>
                </div>
            </div>
        <?php
        }
        ?>

    </div>

</body>

</html>