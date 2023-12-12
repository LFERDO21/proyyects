<?php
session_start();
include("session.php");
include("bd.php");

$successMessage = "";
$abreviaturaEmpresa = "";

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Verificar si se ha enviado el identificador de la empresa
    if (isset($_POST['empresaId'])) {
        $empresaId = $_POST['empresaId'];

        // Obtener la abreviatura de la empresa
        $sqlEmpresa = "SELECT abreviatura FROM empresas WHERE id = $empresaId";
        $resultadoEmpresa = mysqli_query($conexion, $sqlEmpresa);

        if ($resultadoEmpresa && mysqli_num_rows($resultadoEmpresa) > 0) {
            $filaEmpresa = mysqli_fetch_assoc($resultadoEmpresa);
            $abreviaturaEmpresa = $filaEmpresa['abreviatura'];
        } else {
            $abreviaturaEmpresa = "No encontrada";
        }

        // Obtener los datos del formulario
        $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : "";
        $apellidos = isset($_POST["apellidos"]) ? $_POST["apellidos"] : "";
        $edad = isset($_POST["edad"]) ? $_POST["edad"] : "";
        $correo = isset($_POST["correo"]) ? $_POST["correo"] : "";
        $contrasena = isset($_POST["contrasena"]) ? $_POST["contrasena"] : "";
        $estado = isset($_POST["estado"]) ? $_POST["estado"] : "";
        $sexo = isset($_POST["sexo"]) ? $_POST["sexo"] : "";
        $claveInterna = isset($_POST["clave_interna"]) ? $_POST["clave_interna"] : "";

        $confirmacionContrasena = isset($_POST["confirmacion_contrasena"]) ? $_POST["confirmacion_contrasena"] : "";

        // Verificar si las contraseñas coinciden
        if ($contrasena === $confirmacionContrasena) {
            // Hashear la contraseña
            $hashedPassword = password_hash($contrasena, PASSWORD_BCRYPT);

            // Preparar la sentencia SQL con una declaración preparada
            $stmt = mysqli_prepare($conexion, "INSERT INTO usuarios (nombre, apellidos, edad, correo, contrasena, estado, clave_interna, empresa_id, sexo) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

            // Vincular parámetros
            mysqli_stmt_bind_param($stmt, "ssisssisi", $nombre, $apellidos, $edad, $correo, $hashedPassword, $estado, $claveInterna, $empresaId, $sexo);

            // Ejecutar la sentencia SQL
            if (mysqli_stmt_execute($stmt)) {
                $successMessage = "Usuario agregado con éxito";
                // Redirigir a la página de agregar usuarios
                header("Location: empresa.php");
                exit(); // Ensure no further code is executed
            } else {
                // Mostrar un mensaje de error si falla la inserción
                echo "Error al agregar usuario: " . mysqli_stmt_error($stmt);
            }

            // Cerrar la declaración preparada
            mysqli_stmt_close($stmt);
        } else {
            echo "Las contraseñas no coinciden.";
        }
    } else {
        echo "ID de empresa no válido.";
    }
}

// Resto del código HTML...
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Usuarios</title>
    <?php include("links.php"); ?>
</head>

<body class="bg-gray-100">
    <?php include("navbar.php"); ?>

    <div class="min-h-screen flex items-center justify-center">
        <div class="w-1/2 mx-auto">
            <form id="regresarForm" action="detalles_empresa.php" method="post">
                <input type="hidden" name="empresaId" value="<?php echo $empresaId; ?>">
                <a href="#" onclick="document.getElementById('regresarForm').submit();" class="text-blue-500 font-medium mb-4 block">
                    <i class="fas fa-arrow-left mr-2"></i> Regresar a Detalles de la Empresa
                </a>
            </form>

            <h2 class="text-2xl font-semibold mb-4">Agregar Usuarios</h2>

            <!-- Formulario para agregar usuarios -->
            <form method="POST">
                <input type="hidden" name="empresa_id" value="<?php echo $empresaId; ?>">
                <input type="hidden" name="empresaId" value="<?php echo $empresaId; ?>"> <!-- Add this line -->

                <div class="mb-4">
                    <label for="nombre" class="block font-medium">Nombre:</label>
                    <input type="text" name="nombre" class="w-full p-2 border rounded" value="<?php echo isset($nombre) ? $nombre : ''; ?>" required>
                    <?php if (isset($nombre)) echo '<br /><b>Notice</b>: Undefined variable: nombre'; ?>
                </div>

                <!-- ... (rest of the form) ... -->

            </form>

            <!-- Mensaje de éxito -->
            <?php
            if (!empty($successMessage)) {
                echo '<div id="successModal" class="fixed inset-0 bg-green-500 bg-opacity-75 flex items-center justify-center">
                        <div class="bg-white p-6 rounded shadow-md">
                            <p class="text-lg font-semibold text-green-700">' . $successMessage . '</p>
                        </div>
                    </div>';
            }
            ?>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Referencia al formulario
            var form = document.querySelector("form");

            // Manejador del evento de envío del formulario
            form.addEventListener("submit", function(event) {
                // Verificar si las contraseñas coinciden
                var contrasena = form.querySelector("[name=contrasena]").value;
                var confirmacionContrasena = form.querySelector("[name=confirmacion_contrasena]").value;

                if (contrasena !== confirmacionContrasena) {
                    alert("Las contraseñas no coinciden");
                    event.preventDefault(); // Evitar el envío del formulario
                }
            });
        });
    </script>
</body>

</html>