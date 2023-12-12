<?php
session_start();
include("session.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <?php include("links.php"); ?>
</head>

<body>
    <?php include("navbar.php"); ?>

    <div class="container mx-auto mt-8">
        <div class="grid grid-cols-2 gap-4">
            <!-- Tarjeta "Crear empresa" -->
            <a href="empresa.php" class="block bg-white rounded-lg shadow-md p-4 flex items-center justify-center transition duration-300 transform hover:scale-105">
                <i class="fas fa-building fa-3x text-blue-500 mr-4"></i>
                <div>
                    <h2 class="text-lg font-semibold">Crear empresa</h2>
                    <p class="text-gray-500">Crea una nueva empresa en nuestro sistema.</p>
                </div>
            </a>

            <!-- Tarjeta "Blogs" -->
            <a href="blogs.php" class="block bg-white rounded-lg shadow-md p-4 flex items-center justify-center transition duration-300 transform hover:scale-105">
                <i class="fas fa-blog fa-3x text-green-500 mr-4"></i>
                <div>
                    <h2 class="text-lg font-semibold">Blogs</h2>
                    <p class="text-gray-500">Explora nuestros últimos blogs y artículos.</p>
                </div>
            </a>

            <!-- Tarjeta "Planes" -->
            <a href="planes.php" class="block bg-white rounded-lg shadow-md p-4 flex items-center justify-center transition duration-300 transform hover:scale-105">
                <i class="fas fa-clipboard-list fa-3x text-green-500 mr-4"></i>
                <div>
                    <h2 class="text-lg font-semibold">Planes</h2>
                    <p class="text-gray-500">Planes para las empresas.</p>
                </div>
            </a>

            <!-- Tarjeta "Comentarios" -->
            <a href="comentarios.php" class="block bg-white rounded-lg shadow-md p-4 flex items-center justify-center transition duration-300 transform hover:scale-105">
                <i class="fas fa-comments fa-3x text-purple-500 mr-4"></i>
                <div>
                    <h2 class="text-lg font-semibold">Comentarios</h2>
                    <p class="text-gray-500">Revisa y gestiona los comentarios.</p>
                </div>
            </a>
        </div>
    </div>
</body>

</html>