<?php
include("bd.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nuevoPlan'], $_POST['empresaId'])) {
        $nuevoPlanId = $_POST['nuevoPlan'];
        $empresaId = $_POST['empresaId']; // Obtener el valor de empresaId

        // Resto del código...

        // Ejemplo de actualización del plan en la base de datos
        $sqlActualizarPlan = "UPDATE empresas SET plan_id = $nuevoPlanId WHERE id = $empresaId";
        $resultadoActualizarPlan = mysqli_query($conexion, $sqlActualizarPlan);

        if ($resultadoActualizarPlan) {
            // Redirigir a detalles_empresa.php?id=1
            header("Location: detalles_empresa.php?id=$empresaId");
            exit(); // Asegura que el script se detenga después de la redirección
        } else {
            echo "Error al actualizar el plan en la base de datos: " . mysqli_error($conexion);
        }
    } else {
        echo "Parámetros no válidos.";
    }
} else {
    echo "Método de solicitud no permitido.";
}
