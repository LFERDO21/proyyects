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
            <a href="encuesta.php" class="block bg-white rounded-lg shadow-md p-4 flex items-center justify-center transition duration-300 transform hover:scale-105">
                <i class="fas fa-building text-4xl text-blue-500 mr-4"></i>
                <div>
                    <h2 class="text-lg font-semibold">Encuesta</h2>
                    <p class="text-gray-500">Crea una nueva encuesta en nuestro sistema.</p>
                </div>
            </a>
        </div>
    </div>
</body>

</html>