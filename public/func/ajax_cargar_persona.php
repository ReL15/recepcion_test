<?php
// Incluir el archivo de configuración de la base de datos
include '../connection/config.php';

// Verificar si se ha recibido el parámetro id_persona
if (isset($_GET['id_persona'])) {
    $id_persona = $_GET['id_persona'];

    // Consulta SQL para obtener los datos de la persona seleccionada
    $sql = "SELECT nombre_completo, cedula_identidad, codigo_asignado, sede, puesto_trabajo FROM personas WHERE id = ?";

    // Preparar la consulta
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_persona);
    $stmt->execute();

    // Obtener resultados de la consulta
    $result = $stmt->get_result();

    // Verificar si se encontraron resultados
    if ($result->num_rows > 0) {
        $persona = $result->fetch_assoc();

        // Formulario HTML para el modal de Bootstrap
        echo '
        <form action="ajax/guardar_acta.php" method="POST" id="formularioActa">
            <input type="hidden" name="id_persona" value="' . $id_persona . '">
            <div class="modal-header">
                <h5 class="modal-title" id="modalActaLabel">Acta de Recepción para ' . $persona['nombre_completo'] . '</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Cédula de Identidad</label>
                    <input type="text" class="form-control" value="' . $persona['cedula_identidad'] . '" disabled>
                </div>
                <div class="form-group">
                    <label>Codigo Asignado</label>
                    <input type="text" class="form-control" value="' . $persona['codigo_asignado'] . '" disabled>
                </div>
                <div class="form-group">
                    <label>Sede</label>
                    <input type="text" class="form-control" value="' . $persona['sede'] . '" disabled>
                </div>
                <div class="form-group">
                    <label>Puesto de Trabajo</label>
                    <input type="text" class="form-control" value="' . $persona['puesto_trabajo'] . '" disabled>
                </div>
                <div class="form-group">
                    <label>Ítems de Indumentaria</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="capa" id="capa">
                        <label class="form-check-label" for="capa">Capa</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="mochila" id="mochila">
                        <label class="form-check-label" for="mochila">Mochila</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="gorra" id="gorra">
                        <label class="form-check-label" for="gorra">Gorra</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="camisa" id="camisa">
                        <label class="form-check-label" for="camisa">Camisa</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="guardarActa()">Guardar Acta</button>
            </div>
        </form>';
    } else {
        echo 'Error: No se encontró la persona.';
    }

    // Cerrar la conexión a la base de datos
    $stmt->close();
} else {
    echo 'Error: No se recibió el parámetro id_persona.';
}

// Cerrar la conexión a la base de datos
$conn->close();