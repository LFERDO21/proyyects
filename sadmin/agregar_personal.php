<?php
session_start();
include("bd.php"); // Incluye el archivo de configuración de la base de datos

// Obtener el ID de la empresa de la URL
if (isset($_GET['id'])) {
    $empresaId = $_GET['id'];

    // Consultar la base de datos para obtener la abreviatura de la empresa
    $sqlEmpresa = "SELECT abreviatura FROM empresas WHERE id = $empresaId";
    $resultadoEmpresa = mysqli_query($conexion, $sqlEmpresa);

    if ($resultadoEmpresa && mysqli_num_rows($resultadoEmpresa) > 0) {
        $filaEmpresa = mysqli_fetch_assoc($resultadoEmpresa);
        $abreviaturaEmpresa = $filaEmpresa['abreviatura'];
    } else {
        $abreviaturaEmpresa = "No encontrada"; // Si no se encuentra la empresa, mostrar un mensaje predeterminado
    }
} else {
    // Manejo de error si no se proporciona un ID válido en la URL
    echo "ID de empresa no válido.";
    exit();
}

// Inicializa otras variables
$nombreCompleto = $profesional = $edad = $sexo = $claveInterna = $correo = $contrasena = $confirmacionContrasena = "";

// Procesar el formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $nombreCompleto = $_POST["nombre_completo"];
    $profesional = $_POST["profesional"];
    $edad = $_POST["edad"];
    $sexo = $_POST["sexo"];
    $claveInterna = $_POST["clave_interna"];
    $correo = $_POST["correo"];
    $contrasena = $_POST["contrasena"];
    $confirmacionContrasena = $_POST["confirmacion_contrasena"];

    // Validar los datos según tus requisitos

    // Verificar que las contraseñas coinciden
    if ($contrasena === $confirmacionContrasena) {
        // Las contraseñas coinciden, encriptar la contraseña
        $hashedPassword = password_hash($contrasena, PASSWORD_BCRYPT);

        // Crear la clave combinando la abreviatura y la clave interna
        $clave = $abreviaturaEmpresa . $claveInterna;

        // Establecer el estado como "Activo" de forma automática
        $estado = "Activo";

        // Insertar datos en la tabla de personal
        $sqlInsertarPersonal = "INSERT INTO personal (nombre_completo, profesional, edad, sexo, clave_interna, correo, contrasena, empresa_id, estado) VALUES ('$nombreCompleto', '$profesional', $edad, '$sexo', '$clave', '$correo', '$hashedPassword', $empresaId, '$estado')";

        if (mysqli_query($conexion, $sqlInsertarPersonal)) {
            // Redirigir al usuario después de agregar el personal
            header("Location: empresa.php?id=$empresaId");
            exit();
        } else {
            echo "Error al agregar personal: " . mysqli_error($conexion);
        }
    } else {
        echo "Las contraseñas no coinciden.";
    }
}
// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Personal</title>
    <?php include("links.php"); ?>
</head>

<body class="bg-gray-100">
    <?php include("navbar.php"); ?>

    <div class="min-h-screen flex items-center justify-center">
        <div class="w-1/2 mx-auto">
            <div class="min-h-screen flex items-center justify-center">
                <div class="w-1/2 mx-auto">
                    <h2 class="text-2xl font-semibold mb-4">Agregar Personal</h2>
                    <p>ID de Empresa: <?php echo $empresaId; ?></p>
                    <p>Abreviatura de Empresa: <?php echo $abreviaturaEmpresa; ?></p>

                    <form method="POST">
                        <input type="hidden" name="empresa_id" value="<?php echo $empresaId; ?>">

                        <div class="mb-4">
                            <label for="nombre_completo" class="block font-medium">Nombre Completo:</label>
                            <input type="text" name="nombre_completo" class="w-full p-2 border rounded" value="<?php echo $nombreCompleto; ?>" required>
                        </div>
                        <div class="mb-4">
                            <label for="profesional" class="block font-medium">Profesión:</label>
                            <select name="profesional" class="w-full p-2 border rounded" required>
                                <option value="" disabled selected>Selecciona una opción</option>
                                <option value="Psicologo">Psicologo(a)</option>
                                <option value="Doctor">Doctor(a)</option>
                                <option value="Maestro">Maestro(a)</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="edad" class="block font-medium">Edad:</label>
                            <input type="number" name="edad" class="w-full p-2 border rounded" value="<?php echo $edad; ?>" required>
                        </div>

                        <div class="mb-4">
                            <label for="sexo" class="block font-medium">Sexo:</label>
                            <select name="sexo" class="w-full p-2 border rounded" required>
                                <option value="" disabled selected>Selecciona una opción</option>
                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="clave_interna" class="block font-medium">Clave Interna:</label>
                            <?php echo $abreviaturaEmpresa; ?><input type="text" name="clave_interna" class="w-full p-2 border rounded" value="<?php echo $claveInterna; ?>" required>
                        </div>

                        <div class="mb-4">
                            <label for="correo" class="block font-medium">Correo:</label>
                            <input type="email" name="correo" class="w-full p-2 border rounded" value="<?php echo $correo; ?>" required>
                        </div>

                        <div class="mb-4">
                            <label for="contrasena" class="block font-medium">Contraseña:</label>
                            <input type="password" name="contrasena" class="w-full p-2 border rounded" value="<?php echo $contrasena; ?>" required>
                        </div>

                        <div class="mb-4">
                            <label for="confirmacion_contrasena" class="block font-medium">Confirmar Contraseña:</label>
                            <input type="password" name="confirmacion_contrasena" class="w-full p-2 border rounded" value="<?php echo $confirmacionContrasena; ?>" required>
                        </div>

                        <div class="mb-4">
                            <input type="submit" value="Agregar Personal" class="bg-blue-500 text-white py-2 px-4 rounded cursor-pointer">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>