<?php
session_start();
include("session.php");
include("bd.php"); // Incluye el archivo de configuración de la base de datos

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Plan</title>
    <?php include("links.php"); ?>
</head>

<body class="bg-gray-100">
    <?php include("navbar.php"); ?>

    <div class="min-h-screen flex items-center justify-center">
        <div class="w-1/2 mx-auto">
            <h2 class="text-2xl font-semibold mb-4">Crear Plan</h2>
            <form method="POST" action="procesar_planes.php">
                <div class="mb-4">
                    <label for="nombre" class="block font-medium">Nombre del Plan:</label>
                    <input type="text" name="nombre" class="w-full p-2 border rounded" required>
                </div>

                <div class="mb-4">
                    <label for="descripcion" class="block font-medium">Descripción:</label>
                    <textarea name="descripcion" class="w-full p-2 border rounded" rows="4" required></textarea>
                </div>

                <div class="mb-4">
                    <label for="precio" class="block font-medium">Precio:</label>
                    <input type="number" name="precio" class="w-full p-2 border rounded" required>
                </div>

                <div class="mb-4">
                    <label for="encuestas_numero" class="block font-medium">Número de Encuestas:</label>
                    <input type="number" name="encuestas_numero" class="w-full p-2 border rounded" required>
                </div>

                <div class="mb-4">
                    <label for="personal_numero" class="block font-medium">Número de Personal:</label>
                    <input type="number" name="personal_numero" class="w-full p-2 border rounded" required>
                </div>

                <div class="mb-4">
                    <label for="usuarios_numero" class="block font-medium">Número de Usuarios:</label>
                    <input type="number" name="usuarios_numero" class="w-full p-2 border rounded" required>
                </div>

                <div class="mb-4">
                    <label for="blogsempresa_numero" class="block font-medium">Número de Blogs de Empresa:</label>
                    <input type="number" name="blogsempresa_numero" class="w-full p-2 border rounded" required>
                </div>

                <div class="mb-4">
                    <label for="blogpersonal_numero" class="block font-medium">Número de Blogs Del personal:</label>
                    <input type="number" name="blogpersonal_numero" class="w-full p-2 border rounded" required>
                </div>

                <div class="mb-4">
                    <input type="submit" value="Guardar Plan" class="bg-blue-500 text-white py-2 px-4 rounded cursor-pointer">
                </div>
            </form>
        </div>
    </div>
</body>

</html>