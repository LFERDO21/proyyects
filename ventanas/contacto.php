<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DevStore - Contactos</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <?php include("../links.php"); ?>
</head>

<body class="bg-gray-100 flex flex-col min-h-screen">
    <?php include("navbar.php"); ?>

    <div class="container mx-auto mt-8">
        <h1 class="text-3xl font-bold text-center mb-4">Contactos</h1>

        <div class="max-w-md mx-auto bg-white p-8 rounded-md shadow-md">
            <form action="procesar_formulario.php" method="post">
                <!-- Nombre completo -->
                <div class="mb-4">
                    <label for="nombre" class="block text-sm font-medium text-gray-600">Nombre Completo</label>
                    <input type="text" name="nombre" id="nombre" class="mt-1 p-2 w-full border border-gray-300 rounded-md">
                </div>

                <!-- Correo electrónico -->
                <div class="mb-4">
                    <label for="correo" class="block text-sm font-medium text-gray-600">Correo Electrónico</label>
                    <input type="email" name="correo" id="correo" class="mt-1 p-2 w-full border border-gray-300 rounded-md">
                </div>

                <!-- Número de teléfono -->
                <div class="mb-4">
                    <label for="telefono" class="block text-sm font-medium text-gray-600">Número de Teléfono</label>
                    <input type="tel" name="telefono" id="telefono" class="mt-1 p-2 w-full border border-gray-300 rounded-md">
                </div>

                <!-- Selección de motivo -->
                <div class="mb-4">
                    <label for="motivo" class="block text-sm font-medium text-gray-600">Motivo</label>
                    <select name="motivo" id="motivo" class="mt-1 p-2 w-full border border-gray-300 rounded-md">
                        <option value="problemas">Problemas</option>
                        <option value="plan">Quiero un plan</option>
                        <option value="otra">Otra cosa</option>
                    </select>
                </div>

                <!-- Descripción -->
                <div class="mb-4">
                    <label for="descripcion" class="block text-sm font-medium text-gray-600">Descripción</label>
                    <textarea name="descripcion" id="descripcion" rows="4" class="mt-1 p-2 w-full border border-gray-300 rounded-md"></textarea>
                </div>

                <!-- Botón de enviar -->
                <div class="flex items-center justify-center">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Enviar</button>
                </div>
            </form>
        </div>
    </div>

    <footer class="bg-blue-500 text-white text-center py-2 mt-auto">
        <p>&copy; Team. <strong>PsicoDev</strong></p>
        <div class="mt-2">
            <a href="ventanas/aviso_privacidad.php" class="text-white text-sm">Aviso de Privacidad</a>
            <span class="mx-2">|</span>
            <a href="ventanas/politica_privacidad.php" class="text-white text-sm">Política de Privacidad</a>
        </div>
    </footer>
</body>

</html>