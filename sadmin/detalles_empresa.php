<?php
session_start();
include("session.php");
include("bd.php"); // Agrega esta línea para incluir la conexión a la base de datos

if (isset($_POST['empresaId'])) {
    // Obtiene el ID de la empresa desde el array POST
    $empresaId = $_POST['empresaId'];

    $sql = "SELECT * FROM empresas WHERE id = $empresaId";
    $resultado = mysqli_query($conexion, $sql);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $fila = mysqli_fetch_assoc($resultado);
        $nombreEmpresa = $fila['nombre_empresa'];
        $abreviaturaEmpresa = $fila['abreviatura'];
        $cctEmpresa = $fila['cct'];
        $descripcionEmpresa = $fila['descripcion'];
        $planId = $fila['plan_id']; // Nueva línea para obtener el plan_id


        // Obtiene el límite de personal y usuarios desde la tabla "planes"

        function obtenerLimitePersonalUsuarios($empresaId, $conexion)
        {
            global $planId;
            $sqlLimite = "SELECT pl.personal_numero, pl.usuarios_numero, p.nombre FROM empresas e
              INNER JOIN planes pl ON e.plan_id = pl.id
              LEFT JOIN planes p ON e.plan_id = p.id
              WHERE e.id = $empresaId";

            $resultadoLimite = mysqli_query($conexion, $sqlLimite);

            if ($resultadoLimite && mysqli_num_rows($resultadoLimite) > 0) {
                $filaLimite = mysqli_fetch_assoc($resultadoLimite);
                return $filaLimite;
            } else {
                return ["personal_numero" => 0, "usuarios_numero" => 0, "nombre" => "Plan no encontrado"];
            }
        }

        function obtenerConteoPersonal($empresaId, $conexion)
        {
            $sqlConteoPersonal = "SELECT COUNT(p.id) AS conteo, pl.personal_numero AS limite FROM personal p
                                  INNER JOIN empresas e ON p.empresa_id = e.id
                                  INNER JOIN planes pl ON e.plan_id = pl.id
                                  WHERE e.id = $empresaId";

            $resultadoConteo = mysqli_query($conexion, $sqlConteoPersonal);

            if ($resultadoConteo && mysqli_num_rows($resultadoConteo) > 0) {
                $filaConteo = mysqli_fetch_assoc($resultadoConteo);
                $conteo = $filaConteo['conteo'];
                $limite = $filaConteo['limite'];

                return "$conteo / $limite";
            } else {
                return "0 / 0";
            }
        }
        function obtenerListaPlanes($conexion)
        {
            $sql = "SELECT id, nombre FROM planes";
            $resultado = mysqli_query($conexion, $sql);

            $planes = [];

            if ($resultado && mysqli_num_rows($resultado) > 0) {
                while ($fila = mysqli_fetch_assoc($resultado)) {
                    $planes[] = $fila;
                }
            }

            return $planes;
        }
        function obtenerConteoUsuarios($empresaId, $conexion)
        {
            $sqlConteoUsuarios = "SELECT COUNT(id) AS conteo FROM usuarios WHERE empresa_id = $empresaId";

            $resultadoConteo = mysqli_query($conexion, $sqlConteoUsuarios);

            if ($resultadoConteo && mysqli_num_rows($resultadoConteo) > 0) {
                $filaConteo = mysqli_fetch_assoc($resultadoConteo);
                $conteo = $filaConteo['conteo'];

                return $conteo;
            } else {
                return 0;
            }
        }
        function obtenerConteoUsuariosActivo($empresaId, $conexion)
        {
            $sqlConteoUsuarios = "SELECT COUNT(id) AS conteo FROM usuarios WHERE empresa_id = $empresaId AND estado = 'Activo'";

            $resultadoConteo = mysqli_query($conexion, $sqlConteoUsuarios);

            if ($resultadoConteo && mysqli_num_rows($resultadoConteo) > 0) {
                $filaConteo = mysqli_fetch_assoc($resultadoConteo);
                $conteo = $filaConteo['conteo'];

                return $conteo;
            } else {
                return 0;
            }
        }

        function obtenerConteoPersonalActivo($empresaId, $conexion)
        {
            $sqlConteoPersonal = "SELECT COUNT(p.id) AS conteo, pl.personal_numero AS limite 
                                  FROM personal p
                                  INNER JOIN empresas e ON p.empresa_id = e.id
                                  INNER JOIN planes pl ON e.plan_id = pl.id
                                  WHERE e.id = $empresaId AND p.estado = 'Activo'";

            $resultadoConteo = mysqli_query($conexion, $sqlConteoPersonal);

            if ($resultadoConteo && mysqli_num_rows($resultadoConteo) > 0) {
                $filaConteo = mysqli_fetch_assoc($resultadoConteo);
                $conteo = $filaConteo['conteo'];
                $limite = $filaConteo['limite'];

                return "$conteo / $limite";
            } else {
                return "0 / 0";
            }
        }
        include("navbar.php");

        $listaPlanes = obtenerListaPlanes($conexion);

?>

        <!DOCTYPE html>
        <html lang="es">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Detalles de la Empresa</title>
            <?php include("links.php"); ?>
            <style>
                .clickable-row {
                    cursor: pointer;
                }
            </style>
        </head>

        <body class="bg-gray-100">
            <div class="min-h-screen flex items-center justify-center">
                <div class="w-3/4 mx-auto bg-white p-8 rounded shadow-md">

                    <h1 class="text-2xl font-semibold mb-4">Detalles de la Empresa</h1>
                    <p class="mb-2"><strong>Nombre:</strong> <?php echo $nombreEmpresa; ?></p>
                    <p class="mb-2"><strong>Identificador:</strong> <?php echo $abreviaturaEmpresa; ?></p>
                    <p class="mb-2"><strong>CCT:</strong> <?php echo $cctEmpresa; ?></p>
                    <p class="mb-4"><strong>Descripción:</strong> <?php echo $descripcionEmpresa; ?></p>
                    <p class="mb-4"><strong>Plan Actual:</strong> <?php echo obtenerLimitePersonalUsuarios($empresaId, $conexion)['nombre']; ?></p>
                    <p><strong>Límite de Personal:</strong> <?php echo obtenerLimitePersonalUsuarios($empresaId, $conexion)['personal_numero']; ?></p>
                    <p><strong>Límite de Usuarios:</strong> <?php echo obtenerLimitePersonalUsuarios($empresaId, $conexion)['usuarios_numero']; ?></p>
                    <form id="cambioPlanForm" action="procesar_cambio_plan.php" method="post">
                        <label for="nuevoPlan">Selecciona un nuevo plan:</label>
                        <select name="nuevoPlan" id="nuevoPlan">
                            <option value="" disabled selected hidden>Selecciona un plan</option> <!-- Opción no seleccionable -->
                            <?php foreach ($listaPlanes as $plan) : ?>
                                <option value="<?php echo $plan['id']; ?>"><?php echo $plan['nombre']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <input type="hidden" name="empresaId" value="<?php echo $empresaId; ?>">
                        <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded cursor-pointer mb-4 inline-block">Cambiar Plan</button>
                    </form>
                    <!-- Modals -->

                    <!-- Modal de selección de plan -->
                    <div id="myModal" class="hidden fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center">
                        <div class="bg-white p-8 rounded">
                            <p>Por favor, selecciona un plan antes de continuar.</p>
                            <button onclick="closeModal()" class="bg-blue-500 text-white py-2 px-4 rounded cursor-pointer mt-4">Cerrar</button>
                        </div>
                    </div>

                    <!-- Modal de estado cambiado -->
                    <div id="estadoCambiadoModal" class="hidden fixed bottom-4 right-4 bg-green-500 p-4 rounded shadow-md text-white flex items-center">
                        <i class="fas fa-check-circle text-2xl mr-2"></i>
                        <p id="estadoCambiadoMensaje"></p>
                    </div>

                    <!-- Fin de Modals -->


                    <p class="mb-2"><strong>Personal Activos:</strong> <span id="personalActivoConteo"><?php echo obtenerConteoPersonalActivo($empresaId, $conexion); ?></span></p>
                    <?php
                    $limitePersonalUsuarios = obtenerLimitePersonalUsuarios($empresaId, $conexion);
                    if ($limitePersonalUsuarios["personal_numero"] > 0) {
                        $conteoPersonal = obtenerConteoPersonal($empresaId, $conexion);
                        if ($conteoPersonal != "{$limitePersonalUsuarios['personal_numero']} / {$limitePersonalUsuarios['personal_numero']}") {
                            echo '<a href="agregar_personal.php?id=' . $empresaId . '" class="bg-blue-500 text-white py-2 px-4 rounded cursor-pointer mb-4 inline-block">Agregar Personal</a>';
                        }
                    }
                    ?> <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NOMBRE COMPLETO</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">PROFESIONAL</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">CLAVE INTERNA</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ESTADO</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sqlPersonal = "SELECT id, nombre_completo, profesional, clave_interna, estado FROM personal WHERE empresa_id = $empresaId";
                            $resultadoPersonal = mysqli_query($conexion, $sqlPersonal);

                            if ($resultadoPersonal && mysqli_num_rows($resultadoPersonal) > 0) {
                                while ($filaPersonal = mysqli_fetch_assoc($resultadoPersonal)) {
                                    $estado = $filaPersonal['estado'];
                                    $nuevoEstado = $estado === 'Activo' ? 'No Activo' : 'Activo';
                                    echo "<tr class='bg-white clickable-row' data-personal-id='" . $filaPersonal['id'] . "' data-personal-estado='" . $estado . "'>";
                                    echo "<td class='px-6 py-4 whitespace-nowrap'>" . $filaPersonal['nombre_completo'] . "</td>";
                                    echo "<td class='px-6 py-4 whitespace-nowrap'>" . $filaPersonal['profesional'] . "</td>";
                                    echo "<td class='px-6 py-4 whitespace-nowrap'>" . $filaPersonal['clave_interna'] . "</td>";
                                    echo "<td class='px-6 py-4 whitespace-nowrap'>" . $estado . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='4' class='px-6 py-4 whitespace-nowrap'>No hay personal registrado.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php
                    $limitesUsuarios = obtenerLimitePersonalUsuarios($empresaId, $conexion);
                    $limiteUsuarios = $limitesUsuarios['usuarios_numero'];
                    $conteoUsuarios = obtenerConteoUsuariosActivo($empresaId, $conexion);

                    echo "<p class='mb-2'><strong>Usuarios:</strong><span id='usuariosConteo'>$conteoUsuarios / $limiteUsuarios</span></p>";

                    if ($conteoUsuarios < $limiteUsuarios) {
                        // Si no se ha alcanzado el límite, mostrar el formulario con el botón Agregar Usuario
                        echo '<form action="agregar_usuarios.php" method="post" class="mb-4 inline-block">
                                <input type="hidden" name="empresaId" value="' . $empresaId . '">
                                <input type="submit" value="Agregar Usuario" class="bg-blue-500 text-white py-2 px-4 rounded cursor-pointer">
                              </form>';
                    }
                    ?>




                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NOMBRE COMPLETO</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">CLAVE INTERNA</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ESTADO</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sqlUsuarios = "SELECT id, nombre, apellidos, edad, correo, estado, clave_interna FROM usuarios WHERE empresa_id = $empresaId";
                            $resultadoUsuarios = mysqli_query($conexion, $sqlUsuarios);

                            if ($resultadoUsuarios && mysqli_num_rows($resultadoUsuarios) > 0) {
                                while ($filaUsuarios = mysqli_fetch_assoc($resultadoUsuarios)) {
                                    echo "<tr class='bg-white clickable-row' data-usuario-id='" . $filaUsuarios['id'] . "'>";
                                    echo "<td class='px-6 py-4 whitespace-nowrap'>" . $filaUsuarios['nombre'] . " " . $filaUsuarios['apellidos'] . "</td>";
                                    echo "<td class='px-6 py-4 whitespace-nowrap'>" . $filaUsuarios['clave_interna'] . "</td>";
                                    echo "<td class='px-6 py-4 whitespace-nowrap'>" . $filaUsuarios['estado'] . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='4' class='px-6 py-4 whitespace-nowrap'>No hay Usuarios registrados para esta empresa.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>

                </div>
            </div>
            <script>
                function closeModal() {
                    const modal = document.getElementById("myModal");
                    modal.classList.add("hidden");
                }

                document.addEventListener("DOMContentLoaded", function() {
                    const form = document.getElementById("cambioPlanForm");

                    form.addEventListener("submit", function(event) {
                        const nuevoPlan = document.getElementById("nuevoPlan").value;

                        if (!nuevoPlan) {
                            // No se ha seleccionado ningún plan
                            event.preventDefault(); // Detener el envío del formulario

                            // Muestra la modal con Tailwind CSS (asegúrate de tener Tailwind CSS configurado en tu proyecto)
                            const modal = document.getElementById("myModal");
                            modal.classList.remove("hidden");
                        }
                    });
                });


                document.addEventListener("DOMContentLoaded", function() {
                    const rows = document.querySelectorAll(".clickable-row");
                    const rowsUsuarios = document.querySelectorAll(".clickable-row[data-usuario-id]");

                    rows.forEach((row) => {
                        row.addEventListener("click", function() {
                            const estadoElement = this.querySelector("td:nth-child(4)");
                            const estadoActual = estadoElement.textContent;
                            const nuevoEstado = estadoActual === "Activo" ? "No Activo" : "Activo";
                            estadoElement.textContent = nuevoEstado;

                            const personalId = this.getAttribute("data-personal-id");
                            actualizarEstadoEnBaseDeDatos(personalId, nuevoEstado);

                            // Muestra el modal de estado cambiado
                            mostrarEstadoCambiadoModal(this.querySelector("td:nth-child(1)").textContent, nuevoEstado);
                        });
                    });

                    rowsUsuarios.forEach((row) => {
                        row.addEventListener("click", function() {
                            const estadoElement = this.querySelector("td:nth-child(3)"); // El índice del estado es diferente para usuarios
                            const estadoActual = estadoElement.textContent;
                            const nuevoEstado = estadoActual === "Activo" ? "No Activo" : "Activo";
                            estadoElement.textContent = nuevoEstado;

                            const usuarioId = this.getAttribute("data-usuario-id");
                            actualizarEstadoUsuarioEnBaseDeDatos(usuarioId, nuevoEstado);

                            // Muestra el modal de estado cambiado
                            mostrarEstadoCambiadoModal(this.querySelector("td:nth-child(1)").textContent, nuevoEstado);
                        });
                    });

                    function mostrarEstadoCambiadoModal(nombreCompleto, nuevoEstado) {
                        const modal = document.getElementById("estadoCambiadoModal");
                        const mensajeElement = document.getElementById("estadoCambiadoMensaje");

                        mensajeElement.textContent = `Estado de ${nombreCompleto} cambiado a ${nuevoEstado}.`;
                        modal.classList.remove("hidden");

                        // Oculta el modal después de 3 segundos
                        setTimeout(function() {
                            modal.classList.add("hidden");
                            // Recargar la página después de 3 segundos
                            window.location.reload();
                        }, 3000);
                    }

                    function actualizarEstadoEnBaseDeDatos(personalId, nuevoEstado) {
                        const xhr = new XMLHttpRequest();
                        xhr.open("POST", "actualizar_estado_personal.php", true);
                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState === 4 && xhr.status === 200) {
                                if (xhr.responseText !== "OK") {
                                    alert("Error al actualizar el estado en la base de datos.");
                                }
                            }
                        };
                        xhr.send(`personal_id=${personalId}&nuevo_estado=${nuevoEstado}`);
                    }

                    function actualizarEstadoUsuarioEnBaseDeDatos(usuarioId, nuevoEstado) {
                        const xhr = new XMLHttpRequest();
                        xhr.open("POST", "actualizar_estado_usuario.php", true);
                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState === 4 && xhr.status === 200) {
                                if (xhr.responseText !== "OK") {
                                    alert("Error al actualizar el estado en la base de datos.");
                                }
                            }
                        };
                        xhr.send(`usuarioId=${usuarioId}&nuevoEstado=${nuevoEstado}`);
                    }
                });
            </script>
        </body>

        </html>

<?php
    } else {
        echo "Empresa no encontrada.";
    }
} else {
    echo "ID de empresa no válido.";
}
?>