<?php
include("bd.php");
session_start(); // Iniciar la sesión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $correo = $_POST["correo"];
    $contraseña = $_POST["contraseña"];

    // Cifrar la contraseña con Whirlpool
    $hashed_contraseña = hash('whirlpool', $contraseña);

    // Verificar las credenciales en la base de datos
    $sql = "SELECT * FROM sadmin WHERE correo = '$correo' AND contraseña = '$hashed_contraseña'";
    $result = mysqli_query($conexion, $sql);

    if ($result && mysqli_num_rows($result) == 1) {
        // Las credenciales son correctas, almacenar información del usuario en la sesión
        // Las credenciales son correctas, almacenar información del usuario en la sesión
        $usuario = mysqli_fetch_assoc($result);
        $_SESSION["usuario_id"] = $usuario["id"];
        $_SESSION["usuario_correo"] = $usuario["correo"];
        $_SESSION["usuario_nombre"] = $usuario["nombre_completo"];

        // Redirigir al usuario a dashboardsad.php
        header("Location: dashboardsad.php");
        exit;
    } else {
        // Credenciales incorrectas, mostrar mensaje de error
        echo "<p class='text-red-500'>Credenciales incorrectas. Inténtalo de nuevo.</p>";
    }
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
