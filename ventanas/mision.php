<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DevStore</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <?php include("../links.php"); ?>
</head>

<body class="bg-gray-100 flex flex-col min-h-screen">
    <?php include("navbar.php"); ?>

    <div class="container mx-auto mt-8">
        <h1 class="text-3xl font-bold text-center mb-4">Mision</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="md:col-span-1">
                <p class="text-lg text-gray-700">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed nec ligula vel ex ullamcorper
                    iaculis ut ut tellus. Vivamus a purus id justo accumsan consequat vel non tortor.
                </p>
            </div>

            <div class="md:col-span-1">
                <p class="text-lg text-gray-700">
                    Curabitur a dolor eget nulla facilisis consectetur. Sed auctor tellus eget eros semper, id
                    fringilla ex consequat. Suspendisse potenti.
                </p>
            </div>
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