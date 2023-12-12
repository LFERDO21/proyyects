<?php
include("bd.php"); // Incluye el archivo de configuración de la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $nombre_completo = $_POST["nombre_completo"];
    $correo = $_POST["correo"];
    $contraseña = $_POST["contraseña"];
    $confirm_contraseña = $_POST["confirm_contraseña"];

    // Verificar si las contraseñas coinciden
    if ($contraseña !== $confirm_contraseña) {
        echo "<p class='text-red-500'>Las contraseñas no coinciden. Inténtalo de nuevo.</p>";
    } else {
        // Cifrar la contraseña con Whirlpool
        $hashed_contraseña = hash('whirlpool', $contraseña);

        // Insertar datos en la tabla sadmin
        $sql = "INSERT INTO sadmin (nombre_completo, correo, contraseña) VALUES ('$nombre_completo', '$correo', '$hashed_contraseña')";

        if (mysqli_query($conexion, $sql)) {
            echo "<p class='text-green-500'>Usuario registrado exitosamente.</p>";

            // Redirigir al usuario a loginsad.php después del registro exitoso
            header("Location: loginsad.php");
            exit; // Asegurarse de que la redirección se procese correctamente
        } else {
            echo "<p class='text-red-500'>Error al registrar el usuario: " . mysqli_error($conexion) . "</p>";
        }
    }
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
