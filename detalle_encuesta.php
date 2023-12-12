<?php
session_start();
include("session.php");
include("bd.php"); // Incluye el archivo de configuración de la base de datos

// Verifica si se recibió el ID de la encuesta
if (isset($_POST['encuesta_id'])) {
    // Recupera el ID de la encuesta desde la solicitud POST
    $encuesta_id = $_POST['encuesta_id'];

    // Realiza una consulta para obtener información de la encuesta desde la tabla datos
    $query_info_encuesta = "SELECT nombre, estado, tipo, fecha_creacion, fechainicio FROM datos WHERE id = ?";

    // Prepara la consulta
    if ($stmt_info_encuesta = mysqli_prepare($conexion, $query_info_encuesta)) {
        // Vincula parámetros
        mysqli_stmt_bind_param($stmt_info_encuesta, "s", $encuesta_id);

        // Ejecuta la consulta
        if (mysqli_stmt_execute($stmt_info_encuesta)) {
            // Almacena el resultado
            mysqli_stmt_store_result($stmt_info_encuesta);

            // Vincula las variables de resultado
            mysqli_stmt_bind_result($stmt_info_encuesta, $nombre, $estado, $tipo, $fecha_creacion, $fechainicio);

            // Muestra los resultados de la consulta
            while (mysqli_stmt_fetch($stmt_info_encuesta)) {
?>
                <!DOCTYPE html>
                <html lang="es">

                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Dashboard</title>
                    <?php include("links.php"); ?>
                    <!-- Agrega la librería jQuery -->
                    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
                </head>

                <body class="bg-gray-100">
                    <?php include("navbar.php"); ?>
                    <div class="mt-4 p-4 bg-white rounded-lg shadow-md mx-auto max-w">
                        <a href="encuesta.php" class="absolute top-11 left-0 m-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded flex items-center">
                            <i class="fas fa-arrow-left mr-2"></i> Regresar
                        </a>



                        <h1 class="text-2xl font-bold mb-4"><?php echo $nombre; ?></h1>
                        <p class="text-gray-600"><span class="font-bold">Estado:</span> <span id="estado"><?php echo $estado; ?></span></p>
                        <p class="text-gray-600"><span class="font-bold">Fecha de Creación:</span> <?php echo $fecha_creacion; ?>
                        </p>
                        <p class="text-gray-600"><span class="font-bold">Fecha de Inicio:</span> <?php echo $fechainicio; ?></p>

                        <!-- Agrega un botón con un identificador único -->
                        <button id="cambiarEstadoBtn" class="bg-red-500 text-white px-4 py-2 rounded-md mt-2"><?php echo ($estado === 'activo') ? 'Cambiar a No Activo' : 'Activar'; ?>
                        </button>

                        <!-- Agrega una sección para mostrar los usuarios relacionados con el datos_id -->
                        <!-- ... (código anterior) ... -->

                        <!-- ... (código anterior) ... -->

                        <!-- ... (código anterior) ... -->

                        <!-- Agrega una sección para mostrar los usuarios relacionados con el datos_id -->
                        <h2 class="text-xl font-bold mt-4">Usuarios relacionados:</h2>
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border border-gray-300">
                                <thead>
                                    <tr>
                                        <th class="border border-gray-300 px-4 py-2">Nombre</th>
                                        <th class="border border-gray-300 px-4 py-2">Apellidos</th>
                                        <th class="border border-gray-300 px-4 py-2">Correo</th>
                                        <th class="border border-gray-300 px-4 py-2">Clave Interna</th>
                                        <th class="border border-gray-300 px-4 py-2">Ver Respuestas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Realiza una consulta para obtener los usuarios relacionados con el datos_id
                                    $query_usuarios_relacionados = "SELECT u.id, u.nombre, u.apellidos, u.correo, u.clave_interna FROM respuestas r
                    INNER JOIN usuarios u ON r.usuario_id = u.id
                    WHERE r.datos_id = ?";
                                    if ($stmt_usuarios_relacionados = mysqli_prepare($conexion, $query_usuarios_relacionados)) {
                                        mysqli_stmt_bind_param($stmt_usuarios_relacionados, "s", $encuesta_id);
                                        mysqli_stmt_execute($stmt_usuarios_relacionados);
                                        mysqli_stmt_store_result($stmt_usuarios_relacionados);

                                        // Vincula las variables de resultado
                                        mysqli_stmt_bind_result($stmt_usuarios_relacionados, $id_usuario, $nombre_usuario, $apellidos_usuario, $correo_usuario, $clave_interna_usuario);

                                        // Array para almacenar IDs de usuarios ya mostrados
                                        $usuarios_mostrados = array();

                                        // Muestra los usuarios relacionados
                                        while (mysqli_stmt_fetch($stmt_usuarios_relacionados)) {
                                            // Verifica si el usuario ya se ha mostrado
                                            if (!in_array($id_usuario, $usuarios_mostrados)) {
                                    ?>
                                                <tr>
                                                    <td class="border border-gray-300 px-4 py-2"><?php echo $nombre_usuario; ?></td>
                                                    <td class="border border-gray-300 px-4 py-2"><?php echo $apellidos_usuario; ?></td>
                                                    <td class="border border-gray-300 px-4 py-2"><?php echo $correo_usuario; ?></td>
                                                    <td class="border border-gray-300 px-4 py-2"><?php echo $clave_interna_usuario; ?></td>
                                                    <td class="border border-gray-300 px-4 py-2">
                                                        <form action="ver_respuestas.php" method="post">
                                                            <input type="hidden" name="encuesta_id" value="<?php echo $encuesta_id; ?>">
                                                            <input type="hidden" name="tipo" value="<?php echo $tipo; ?>">
                                                            <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">
                                                            <button type="submit" class="text-blue-500 hover:underline">Ver Respuestas</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                    <?php
                                                // Agrega el ID del usuario al array de usuarios mostrados
                                                $usuarios_mostrados[] = $id_usuario;
                                            }
                                        }

                                        // Cierra la declaración
                                        mysqli_stmt_close($stmt_usuarios_relacionados);
                                    } else {
                                        echo "Error en la preparación de la consulta de usuarios relacionados: " . mysqli_error($conexion);
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- ... (código posterior) ... -->

                        <!-- ... (código posterior) ... -->

                        <!-- ... (código posterior) ... -->

                        <!-- Agrega un script de JavaScript para manejar la solicitud asíncrona -->
                        <script>
                            $(document).ready(function() {
                                // Maneja el clic del botón
                                $("#cambiarEstadoBtn").on("click", function() {
                                    // Obtiene el estado actual
                                    var estadoActual = $("#estado").text();

                                    // Realiza una solicitud AJAX
                                    $.ajax({
                                        type: "POST",
                                        url: "cambiar_estado.php",
                                        data: {
                                            encuesta_id: <?php echo $encuesta_id; ?>,
                                            estado_actual: estadoActual
                                        },
                                        success: function(response) {
                                            // Muestra el resultado en la consola (puedes cambiar esto según tus necesidades)
                                            console.log(response);

                                            // Actualiza el estado en la página sin recargar
                                            // Puedes agregar más lógica aquí para actualizar la interfaz de usuario
                                            if (estadoActual === 'activo') {
                                                $("#estado").text('no activo');
                                                $("#cambiarEstadoBtn").text('Activar');
                                            } else {
                                                $("#estado").text('activo');
                                                $("#cambiarEstadoBtn").text('Cambiar a No Activo');
                                            }
                                        },
                                        error: function(error) {
                                            console.error("Error en la solicitud AJAX: " + error);
                                        }
                                    });

                                });
                            });
                        </script>

                </body>

                </html>
<?php
            }
        } else {
            // Si hay un error en la ejecución de la consulta
            echo "Error en la ejecución de la consulta: " . mysqli_stmt_error($stmt_info_encuesta);
        }

        // Cierra la declaración
        mysqli_stmt_close($stmt_info_encuesta);
    } else {
        // Si hay un error en la preparación de la consulta
        echo "Error en la preparación de la consulta: " . mysqli_error($conexion);
    }
} else {
    // Si no se recibió el ID de la encuesta, muestra un mensaje de error o redirige a otra página
    echo "Error: No se recibió el ID de la Encuesta.";
}
?>