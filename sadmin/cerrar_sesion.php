<?php
session_start(); // Iniciar la sesión

// Destruir todas las variables de sesión
session_destroy();

// Redirigir al usuario a la página de inicio de sesión
header("Location: loginsad.php");
exit;
