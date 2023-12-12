<?php
// Verificar si se han recibido los datos esperados
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["tipo"]) && isset($_POST["id"]) && isset($_POST["session_id"])) {
    $tipo = $_POST["tipo"];
    $id = $_POST["id"];
    $session_id = $_POST["session_id"];

    // Realizar la redirección basada en el tipo
    switch ($tipo) {
        case "tipo1":
            header("Location: cuestionario1.php?id=$id&session_id=$session_id");
            break;
        case "tipo2":
            header("Location: cuestionario2.php?id=$id&session_id=$session_id");
            break;
        case "tipo3":
            header("Location: cuestionario3.php?id=$id&session_id=$session_id");
            break;
        case "tipo4":
            header("Location: cuestionario4.php?id=$id&session_id=$session_id");
            break;
        default:
            // Redirección genérica
            header("Location: cuestionario.php?id=$id&session_id=$session_id");
            break;
    }

    exit(); // Terminar el script después de la redirección
} else {
    // Si no se reciben los datos esperados, redirigir a una página de error o realizar alguna otra acción
    header("Location: error.php");
    exit();
}
