<?php
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Incluir archivo de conexión a la base de datos
    include("../bd.php");

    // Recoger los datos del formulario
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $motivo = $_POST['motivo'];
    $descripcion = $_POST['descripcion'];

    // Validar los datos (puedes agregar más validaciones según sea necesario)

    // Insertar datos en la base de datos
    $sql = "INSERT INTO contactos (nombre, correo, telefono, motivo, descripcion) VALUES (?, ?, ?, ?, ?)";
    if ($stmt = mysqli_prepare($conexion, $sql)) {
        mysqli_stmt_bind_param($stmt, "sssss", $nombre, $correo, $telefono, $motivo, $descripcion);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        // Redirigir o mostrar un mensaje de éxito
        header("Location:../index.php");
        exit();
    } else {
        // Manejar el error en caso de fallo en la consulta
        echo "Error en la consulta: " . mysqli_error($conexion);
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);
} else {
    // Si el formulario no se ha enviado correctamente, redirigir a la página de inicio o mostrar un mensaje de error.
    header("Location: ../index.php");
    exit();
}
