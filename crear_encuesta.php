<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Encuesta</title>
    <?php include("links.php"); ?>
</head>

<body class="bg-gray-100">
    <?php include("navbar.php"); ?>
    <a href="encuesta.php" class="absolute top-11 left-0 m-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded flex items-center">
        <i class="fas fa-arrow-left mr-2"></i> Regresar
    </a>
    <div class="container mx-auto m-4 p-4">
        <h2 class="text-2xl font-semibold mb-5">Crear Encuesta</h2>

        <!-- Menú de selección con tarjetas estilizadas -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <form method="post" action="encuesta/tipo1.php" class="bg-white border rounded-lg p-4 hover:shadow-md cursor-pointer">
                <input type="hidden" name="template" value="template1">
                <h3 class="text-lg font-semibold mb-2">Plantilla 1</h3>
                <!-- Agrega contenido descriptivo o una vista previa de la plantilla aquí -->
                <input type="submit" value="Seleccionar Plantilla" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-700">
            </form>

            <form method="post" action="encuesta/tipo2.php" class="bg-white border rounded-lg p-4 hover:shadow-md cursor-pointer">
                <input type="hidden" name="template" value="template2">
                <h3 class="text-lg font-semibold mb-2">Plantilla 2</h3>
                <!-- Agrega contenido descriptivo o una vista previa de la plantilla aquí -->
                <input type="submit" value="Seleccionar Plantilla" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-700">
            </form>

            <form method="post" action="encuesta/tipo3.php" class="bg-white border rounded-lg p-4 hover:shadow-md cursor-pointer">
                <input type="hidden" name="template" value="template3">
                <h3 class="text-lg font-semibold mb-2">Plantilla 3</h3>
                <!-- Agrega contenido descriptivo o una vista previa de la plantilla aquí -->
                <input type="submit" value="Seleccionar Plantilla" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-700">
            </form>

            <form method="post" action="encuesta/tipo4.php" class="bg-white border rounded-lg p-4 hover:shadow-md cursor-pointer">
                <input type="hidden" name="template" value="template4">
                <h3 class="text-lg font-semibold mb-2">Plantilla 4</h3>
                <!-- Agrega contenido descriptivo o una vista previa de la plantilla aquí -->
                <input type="submit" value="Seleccionar Plantilla" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-700">
            </form>
        </div>
    </div>
</body>

</html>