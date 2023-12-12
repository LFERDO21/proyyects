<div class="bg-blue-500 p-4">
    <div class="container mx-auto flex flex-col md:flex-row justify-between items-center">
        <h1 class="text-2xl font-semibold text-white mb-2 md:mb-0">PsicoDev</h1>
        <nav>
            <ul class="flex space-x-4">
                <li><a href="../index.php" class="text-white">Home</a></li>
                <li class="relative group">
                    <a href="#" class="text-white" id="menuTrigger">Más de nosotros</a>
                    <ul id="submenu" class="hidden absolute left-0 mt-2 space-y-2 bg-white border border-gray-200 p-2 rounded-lg opacity-0 transition duration-300 shadow-md z-10">
                        <li><a href="mision.php" class="block px-4 py-2 text-blue-500 hover:bg-blue-100">Misión</a></li>
                        <li><a href="vision.php" class="block px-4 py-2 text-blue-500 hover:bg-blue-100">Visión</a></li>
                        <li><a href="quienes_somos.php" class="block px-4 py-2 text-blue-500 hover:bg-blue-100">Quiénes somos</a></li>
                        <li><a href="valores.php" class="block px-4 py-2 text-blue-500 hover:bg-blue-100">Valores</a></li>
                    </ul>
                </li>
                <li><a href="contacto.php" class="text-white">Contacto</a></li>
            </ul>
        </nav>
    </div>
</div>

<script>
    document.getElementById('menuTrigger').addEventListener('click', function() {
        var submenu = document.getElementById('submenu');
        submenu.classList.toggle('hidden');
        submenu.classList.toggle('opacity-100');
    });
</script>