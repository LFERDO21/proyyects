<?php
// Configuración de la conexión a la base de datos
$host = "localhost"; // Nombre del servidor de la base de datos
$usuario = "root"; // Nombre de usuario de la base de datos
$contraseña = ""; // Contraseña de la base de datos
$nombre_db = "psicodev"; // Nombre de la base de datos

// Establecer la conexión a la base de datos
$conexion = mysqli_connect($host, $usuario, $contraseña, $nombre_db);

// Verificar si la conexión fue exitosa
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}
