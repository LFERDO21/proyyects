<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <?php include("links.php"); // Incluye session.php para obtener las variables de sesión 
    ?>
</head>

<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-md w-1/3">
            <h2 class="text-2xl font-semibold mb-4">Iniciar Sesión</h2>
            <form method="POST" action="procesar_loginpersonal.php">
                <div class="mb-4">
                    <label for="correo" class="block font-medium">Correo Electrónico:</label>
                    <input type="email" name="correo" class="w-full p-2 border rounded" required>
                </div>

                <div class="mb-4">
                    <label for="contrasena" class="block font-medium">contraseña:</label>
                    <input type="password" name="contrasena" class="w-full p-2 border rounded" required>
                </div>

                <div class="mb-4">
                    <input type="submit" value="Iniciar Sesión" class="bg-blue-500 text-white py-2 px-4 rounded cursor-pointer">
                </div>
            </form>
        </div>
    </div>
</body>

</html>