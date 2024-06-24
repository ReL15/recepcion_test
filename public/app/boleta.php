<?php
// Incluir el archivo de configuración de la base de datos
include '../connection/config.php';

// Verificar si se ha recibido el parámetro id_persona
if (isset($_GET['id_persona'])) {
    $id_persona = $_GET['id_persona'];

    // Consulta SQL para obtener los datos de la persona seleccionada
    $sql = "SELECT * FROM personas WHERE id = ?";

    // Preparar la consulta
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_persona);
    $stmt->execute();

    // Obtener resultados de la consulta
    $result = $stmt->get_result();

    // Verificar si se encontraron resultados
    if ($result->num_rows > 0) {
        $persona = $result->fetch_assoc();
        ?>
        <div class="modal-header bg-dark" data-bs-theme="dark">
            <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Acta de recepcion</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="func/guardar_registro.php" method="post" id="formularioActa">
            <div class="modal-body">

                <div class="container-fluid">
                    <h2 class="fs-5">Datos del Censista</h2>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control text" id="id" name="id" placeholder=""
                            value="<?= $persona['id']; ?>" readonly>
                        <label class="label" for="id">ID</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control text" id="nombre_completo" name="nombre_completo" placeholder=""
                            value="<?= $persona['nombre_completo']; ?>" readonly>
                        <label class="label" for="nombre_completo">Nombre Completo</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control text" id="cedula_identidad" name="cedula_identidad"
                            placeholder="" value="<?= $persona['cedula_identidad']; ?>" readonly>
                        <label class="label" for="cedula_identidad">DUI</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control text" id="codigo_asignado" name="codigo_asignado" placeholder=""
                            value="<?= $persona['codigo_asignado']; ?>" readonly>
                        <label class="label" for="codigo_asignado">Codigo Asignado</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control text" id="sede" name="sede" placeholder=""
                            value="<?= $persona['sede']; ?>" readonly>
                        <label class="label" for="sede">Sede</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control text" id="puesto_trabajo" name="puesto_trabajo" placeholder=""
                            value="<?= $persona['puesto_trabajo']; ?>" readonly>
                        <label class="label" for="puesto_trabajo">Cargo</label>
                    </div>

                    <hr class="fs-5">

                    <h2 class="fs-5">Articulos a recibir</h2>
                    <div class="form-check form-switch form-check-inline">
                        <input class="form-check-input" type="checkbox" name="gorra" id="gorra" <?php if ($persona['gorras'] == 'X') echo 'checked="checked"'; ?> >
                        <label class="form-check-label" for="gorra">Gorra</label>
                    </div>

                    <div class="form-check form-switch form-check-inline">
                        <input class="form-check-input" type="checkbox" name="camisa" id="camisa" <?php if ($persona['camisas'] == 'X')
                            echo 'checked="checked"'; ?> >
                        <label class="form-check-label" for="camisa">Camisa</label>
                    </div>

                    <div class="form-check form-switch form-check-inline">
                        <input class="form-check-input" type="checkbox" name="mochila" id="mochila" <?php if ($persona['mochila'] == 'X')
                            echo 'checked="checked"'; ?> >
                        <label class="form-check-label" for="mochila">Mochila</label>
                    </div>

                    <div class="form-check form-switch form-check-inline">
                        <input class="form-check-input" type="checkbox" name="capa" id="capa" <?php if ($persona['capa'] == 'X')
                            echo 'checked="checked"'; ?> >
                        <label class="form-check-label" for="capa">Capa</label>
                    </div>
                    <div class="form-check form-switch form-check-inline mb-3">
                        <input class="form-check-input" type="checkbox" name="carnet" id="carnet" <?php if ($persona['carnet'] == 'X')
                            echo 'checked="checked"'; ?> >
                        <label class="form-check-label" for="carnet">Carnet</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="number" class="form-control text" id="cant_camisas" name="cant_camisas"
                            placeholder=""  value="<?= $persona['cant_camisas']; ?>">
                        <label class="label" for="cant_camisas">Camisas recibidas</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control text" id="observaciones" name="observaciones" placeholder="" >
                        <label class="label" for="observaciones" >Observaciones generales</label>
                    </div>
                </div>
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Aceptar</button>
            </div>
        </form>

        <?php
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