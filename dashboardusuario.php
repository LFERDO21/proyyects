<?php
session_start();
include("session.php");
include("bd.php");

// Obtener el ID de usuario de la sesión
$session_id = $_SESSION["usuario_id"];

// Realiza una consulta para obtener el ID de la empresa del usuario actual
$query_empresa_usuario = "SELECT empresa_id FROM usuarios WHERE id = $session_id";
$resultado_empresa_usuario = mysqli_query($conexion, $query_empresa_usuario);

$id_empresa_usuario = 0; // Supongamos que el ID 0 representa que no se encuentra asociado a ninguna empresa

if ($resultado_empresa_usuario && mysqli_num_rows($resultado_empresa_usuario) == 1) {
    $fila_empresa_usuario = mysqli_fetch_assoc($resultado_empresa_usuario);
    $id_empresa_usuario = $fila_empresa_usuario['empresa_id'];
}

// Realiza una consulta para obtener todos los datos desde la tabla "datos" con la columna "identificador" y la información de la empresa
$sql = "SELECT datos.*, personal.nombre_completo AS nombre_personal FROM datos LEFT JOIN personal ON datos.personal_id = personal.id WHERE datos.empresa_id = $id_empresa_usuario";
$resultado = mysqli_query($conexion, $sql);

$datos = array();

if ($resultado && mysqli_num_rows($resultado) > 0) {
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $datos[] = $fila;
    }
}

// Realizar una consulta para obtener los datos_id de la tabla respuestas
$query = "SELECT datos_id FROM respuestas WHERE usuario_id = $session_id";
$result = mysqli_query($conexion, $query);

$datos_id_array = array();

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $datos_id = $row['datos_id'];
        $datos_id_array[] = $datos_id;
    }
}

// Separar los tests por hacer y los tests ya realizados
$tests_por_hacer = array();
$tests_realizados = array();

foreach ($datos as $dato) {
    $coincide_con_respuesta = in_array($dato['id'], $datos_id_array);

    if ($coincide_con_respuesta) {
        $tests_realizados[] = $dato;
    } else {
        $tests_por_hacer[] = $dato;
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <?php include("links.php"); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
</head>

<body>
    <?php include("navbar.php"); ?>

    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-4">Tests Por hacer</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 gap-4">
            <?php
            if (!empty($tests_por_hacer)) {
                foreach ($tests_por_hacer as $dato) {
                    // Verifica si el test se ha realizado
                    $coincide_con_respuesta = in_array($dato['id'], $datos_id_array);
            ?>
                    <div class="max-w-full <?php echo $coincide_con_respuesta ? 'bg-purple-200' : 'bg-white'; ?> shadow-lg rounded-lg overflow-hidden text-sm sm:text-base md:text-lg lg:text-base xl:text-lg">
                        <!-- Código para mostrar los tests por hacer -->
                        <img class="w-full h-48 object-cover object-center" src="PsicoDev.svg" alt="Imagen">
                        <div class="px-6 py-4">
                            <div class="font-bold text-xl mb-2"><?php echo $dato['nombre']; ?></div>
                            <p class="text-gray-700 text-sm mb-2">Tipo: <?php echo $dato['tipo']; ?></p> <!-- Agregado: Mostrar tipo -->
                            <?php
                            if ($coincide_con_respuesta) {
                                // Si ya se realizó la prueba, muestra un mensaje
                                echo "<p class='text-purple-600 text-base font-bold'>Ya se realizó la prueba</p>";
                            } else {
                                // Si aún no se ha realizado, muestra el botón para realizar la prueba
                                echo "<form method='post' action='";
                                // Agregar la lógica de redirección según el tipo
                                if ($dato['tipo'] == 'tipo1') {
                                    echo 'cuestionario1.php';
                                } elseif ($dato['tipo'] == 'tipo2') {
                                    echo 'cuestionario2.php';
                                } elseif ($dato['tipo'] == 'tipo3') {
                                    echo 'cuestionario3.php';
                                } else {
                                    // Si no hay un tipo específico, puedes redirigir a una página predeterminada o mostrar un mensaje de error
                                    echo 'error_page.php';
                                }
                                echo "'>";
                                echo "<input type='hidden' name='id' value='{$dato['id']}'>";
                                echo "<input type='hidden' name='session_id' value='{$session_id}'>";
                                echo "<button type='submit' class='bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded'>";
                                echo "Realizar Prueba";
                                echo "</button>";
                                echo "</form>";
                            }
                            ?>
                        </div>
                        <div class="px-6 py-4">
                            <div class="text-sm sm:text-base md:text-lg lg:text-base xl:text-lg">
                                <p class="text-gray-900 leading-none"><?php echo $dato['nombre_personal']; ?></p>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "<p class='text-gray-700 text-base'>Todos los tests están realizados. <a href='mas_test.php'>Ir a conocer más tests</a></p>";
            }
            ?>
        </div>
    </div>
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-4">Tests Ya Realizados</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 gap-4">
            <?php
            if (!empty($tests_realizados)) {
                foreach ($tests_realizados as $dato) {
            ?>
                    <div class="max-w-full bg-purple-200 shadow-lg rounded-lg overflow-hidden text-sm sm:text-base md:text-lg lg:text-base xl:text-lg">
                        <!-- Código para mostrar los tests ya realizados -->
                        <img class="w-full h-48 object-cover object-center" src="PsicoDev.svg" alt="Imagen">
                        <div class="px-6 py-4">
                            <div class="font-bold text-xl mb-2"><?php echo $dato['nombre']; ?></div>
                            <p class='text-purple-600 text-base font-bold'>Ya se realizó la prueba</p>
                        </div>
                        <div class="px-6 py-4">
                            <div class="text-sm sm:text-base md:text-lg lg:text-base xl:text-lg">
                                <p class="text-gray-900 leading-none"><?php echo $dato['nombre_personal']; ?></p>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "<p class='text-gray-700 text-base'>No hay tests realizados hasta ahora.</p>";
            }
            ?>
        </div>
    </div>
</body>

</html>