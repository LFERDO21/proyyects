<?php
include("bd.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    // Consulta SQL para verificar las credenciales en la tabla "usuarios"
    $sql = "SELECT id, nombre, correo, contrasena, estado FROM usuarios WHERE correo = '$correo'";
    $resultado = mysqli_query($conexion, $sql);

    if ($resultado && mysqli_num_rows($resultado) == 1) {
        $usuario = mysqli_fetch_assoc($resultado);

        // Verifica si la contraseña proporcionada coincide con la almacenada en la base de datos
        if (password_verify($contrasena, $usuario['contrasena'])) {
            // Verifica el estado del usuario
            if ($usuario["estado"] === "Activo") {
                // Las credenciales son válidas y el usuario está activo, establece las variables de sesión
                session_start();
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_nombre'] = $usuario['nombre'];
                $_SESSION['usuario_correo'] = $usuario['correo'];

                // Redirige al usuario a su página de inicio (por ejemplo, su panel de control)
                header("Location: dashboardusuario.php");
                exit();
            } else {
                // El usuario no está activo, muestra el modal
                echo '<script>
                        document.addEventListener("DOMContentLoaded", function () {
                            var modal = document.getElementById("modal");
                            modal.classList.remove("hidden");
                        });
                      </script>';
            }
        } else {
            // Contraseña incorrecta
            $mostrarModalCredencialesIncorrectas = true;
        }
    } else {
        // El correo no se encontró en la base de datos
        header("Location: loginusuario.php?error=correo");
        exit();
    }
} else {
    // Redirige al formulario de inicio de sesión si no se envió por POST
    header("Location: loginusuario.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <?php include("links.php"); ?>
</head>

<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-md w-1/3">
            <h2 class="text-2xl font-semibold mb-4">Iniciar Sesión</h2>
            <form method="POST" action="procesar_loginusuario.php">
                <div class="mb-4">
                    <label for="correo" class="block font-medium">Correo Electrónico:</label>
                    <input type="email" name="correo" class="w-full p-2 border rounded" required>
                </div>

                <div class="mb-4">
                    <label for="contrasena" class="block font-medium">Contraseña:</label>
                    <input type="password" name="contrasena" class="w-full p-2 border rounded" required>
                </div>

                <div class="mb-4">
                    <input type="submit" value="Iniciar Sesión" class="bg-blue-500 text-white py-2 px-4 rounded cursor-pointer">
                </div>
            </form>
        </div>
    </div>

    <!-- Modal -->
    <div id="modal" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay, show/hide based on modal state -->
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

            <!-- This element is to trick the browser into centering the modal contents -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <!-- Modal panel, show/hide based on modal state -->
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white p-4">
                    <h3 class="text-lg font-semibold mb-2">Cuenta no activa</h3>
                    <p>Tu usuario no se encuentra activo. Comunícate con un superior.</p>
                </div>
                <div class="bg-gray-50 p-4 sm:p-6 sm:flex sm:flex-row-reverse">
                    <button onclick="document.getElementById('modal').classList.add('hidden')" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-500 text-base font-medium text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>