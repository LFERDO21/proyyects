<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-md w-1/3">
            <h2 class="text-2xl font-semibold mb-4">Registro de Usuario</h2>
            <form method="POST" action="procesar_registersad.php">
                <div class="mb-4">
                    <label for="nombre_completo" class="block font-medium">Nombre Completo:</label>
                    <input type="text" name="nombre_completo" class="w-full p-2 border rounded" required>
                </div>

                <div class="mb-4">
                    <label for="correo" class="block font-medium">Correo Electrónico:</label>
                    <input type="email" name="correo" class="w-full p-2 border rounded" required>
                </div>

                <div class="mb-4">
                    <label for="contraseña" class="block font-medium">Contraseña:</label>
                    <input type="password" name="contraseña" class="w-full p-2 border rounded" required>
                </div>

                <div class="mb-4">
                    <label for="confirm_contraseña" class="block font-medium">Confirmar Contraseña:</label>
                    <input type="password" name="confirm_contraseña" class="w-full p-2 border rounded" required>
                </div>

                <div class="mb-4">
                    <input type="submit" value="Registrar" class="bg-blue-500 text-white py-2 px-4 rounded cursor-pointer">
                </div>
            </form>
        </div>
    </div>
</body>

</html>