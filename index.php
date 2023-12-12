<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DevStore</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <?php include("links.php"); ?>

    <style>
        .swiper-container {
            max-height: 500px;
            /* Ajusta la altura a tu preferencia */
            overflow: hidden;
            /* Oculta el desbordamiento */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            /* Ajusta la altura a la pantalla completa o según sea necesario */

        }
    </style>
</head>

<body class="bg-gray-100 flex flex-col min-h-screen">
    <?php include("navbar.php"); ?>


    <div class="swiper-container w-full max-h-1/2 md:h-3/4 lg:h-1/2 m-2 relative">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img src="./img/1.svg" alt="Imagen 1" class="w-full h-full object-cover">
            </div>
            <div class="swiper-slide">
                <img src="./img/2.svg" alt="Imagen 1" class="w-full h-full object-cover">
            </div>
            <div class="swiper-slide">
                <img src="./img/3.svg" alt="Imagen 2" class="w-full h-full object-cover">
            </div>
            <div class="swiper-slide">
                <img src="./img/4.svg" alt="Imagen 3" class="w-full h-full object-cover">
            </div>
            <div class="swiper-slide">
                <img src="./img/5.svg" alt="Imagen 3" class="w-full h-full object-cover">
            </div>
            <!-- Agrega más imágenes según tus necesidades -->
        </div>
        <!-- Agregar paginación -->
        <div class="swiper-pagination"></div>
    </div>

    <div class="container mx-auto p-4">
        <div class="flex items-center"> <!-- Contenedor flex para alinear texto e imagen -->
            <div class="md:w-1/2 p-4">
                <h1 class="text-4xl font-bold text-blue-800 mb-4">Bienvenido a PsicoDev</h1>
                <h2 class="text-2xl font-semibold text-blue-600 mb-2">Crea tus preguntas a simples pasos</h2>
                <p class="text-lg text-gray-700 leading-7">¡Hola! Gracias por contactar conmigo. Si estás buscando inspiración para crear contenido innovador y creativo, te recomiendo que eches un vistazo a PsicoDev. Se trata de una plataforma que ofrece plantillas para crear test y analizar a un grupo de personas. Además, su sitio web cuenta con un diseño moderno y atractivo que puede inspirarte a crear contenido innovador y creativo.</p>
            </div>

            <div class="w-full md:w-1/2">
                <img src="./img/PsicoDev1.png" alt="Descripción de la imagen" class="w-full h-auto">
            </div>
        </div>
    </div>
    <!-- Después del contenido actual -->
    <div class="container mx-auto mt-8">
        <h2 class="text-2xl font-bold text-blue-800 mb-4">Planes Mensuales</h2>

        <!-- Contenedor para el apartado de "Planes" -->
        <div class="grid grid-cols-3 gap-4">
            <!-- Plan 1 -->
            <div class="bg-white rounded-lg shadow-md p-4 flex flex-col items-center justify-center transition duration-300 transform hover:scale-105">
                <h2 class="text-lg font-semibold mb-2">Plan Individual</h2>
                <p class="text-gray-500">Plan donde solo una persona calificada para subir test.</p>
            </div>

            <!-- Plan 2 -->
            <div class="bg-white rounded-lg shadow-md p-4 flex flex-col items-center justify-center transition duration-300 transform hover:scale-105">
                <h2 class="text-lg font-semibold mb-2">Plan Grupal</h2>
                <p class="text-gray-500">Unete junto a un grupo psicologos para determinar cualidades en la poblacion y medir sus comportamientos.</p>
            </div>

            <!-- Plan 3 -->
            <div class="bg-white rounded-lg shadow-md p-4 flex flex-col items-center justify-center transition duration-300 transform hover:scale-105">
                <h2 class="text-lg font-semibold mb-2">Plan Institucional</h2>
                <p class="text-gray-500">Escuelas, Instituciones, Organizaciones podran gozar de nuestros paquetes y plantillas para crear Tests especializados para medir alguna cualidad.</p>
            </div>
        </div>
    </div>



    <div class="container mx-auto mt-8">
        <div class="grid grid-cols-2 gap-4">
            <!-- Tarjeta "Crear empresa" -->
            <a href="sadmin/loginsad.php" class="block bg-white rounded-lg shadow-md p-4 flex items-center justify-center transition duration-300 transform hover:scale-105">
                <i class="fas fa-building text-4xl text-blue-500 mr-4"></i>
                <div>
                    <h2 class="text-lg font-semibold">Login sadmin</h2>
                    <p class="text-gray-500">Crea una nueva encuesta en nuestro sistema.</p>
                </div>
            </a> <!-- Tarjeta "Crear empresa" -->
            <a href="loginpersonal.php" class="block bg-white rounded-lg shadow-md p-4 flex items-center justify-center transition duration-300 transform hover:scale-105">
                <i class="fas fa-building text-4xl text-blue-500 mr-4"></i>
                <div>
                    <h2 class="text-lg font-semibold">Login personal</h2>
                    <p class="text-gray-500">Crea una nueva encuesta en nuestro sistema.</p>
                </div>
            </a>
            <a href="loginusuario.php" class="block bg-white rounded-lg shadow-md p-4 flex items-center justify-center transition duration-300 transform hover:scale-105">
                <i class="fas fa-building text-4xl text-blue-500 mr-4"></i>
                <div>
                    <h2 class="text-lg font-semibold">Login usuario</h2>
                    <p class="text-gray-500">Crea una nueva encuesta en nuestro sistema.</p>
                </div>
            </a>
            <a href="cerrar_sesion.php" class="block bg-white rounded-lg shadow-md p-4 flex items-center justify-center transition duration-300 transform hover:scale-105">
                <i class="fas fa-building text-4xl text-blue-500 mr-4"></i>
                <div>
                    <h2 class="text-lg font-semibold">Cerrar session</h2>
                    <p class="text-gray-500">Crea una nueva encuesta en nuestro sistema.</p>
                </div>
            </a>

        </div>
    </div>
    <footer class="bg-blue-500 text-white text-center py-2">
        <p>&copy; Team. <strong>PsicoDev</strong></p>
        <div class="mt-2">
            <a href="ventanas/aviso_privacidad.php" class="text-white text-sm">Aviso de Privacidad</a>
            <span class="mx-2">|</span>
            <a href="ventanas/politica_privacidad.php" class="text-white text-sm">Política de Privacidad</a>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var mySwiper = new Swiper('.swiper-container', {
                // Configuración de Swiper
                loop: true,
                autoplay: {
                    delay: 3000,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
            });
        });
    </script>
    <script src="main.js"></script>
</body>

</html>