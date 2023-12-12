<?php
// Verificar si la sesión está iniciada
if (!isset($_SESSION["usuario_id"])) {
    // La sesión no está iniciada, redirigir al usuario a loginsad.php
    header("Location: loginpersonal.php");
    exit;
}

// Obtener el correo y el nombre completo del usuario desde la sesión
$correoUsuario = $_SESSION["usuario_correo"];
$nombreUsuario = $_SESSION["usuario_nombre"];
