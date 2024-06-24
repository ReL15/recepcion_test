<style>
    .bold {
        font-weight: 700;
    }

    .blue {
        color: #0d6efd;
    }

    .red {
        color: red;
    }

    .red:hover {
        color: white;
        background-color: red;
    }

    .green {
        color: #198754;
    }

    .text {
        color: #6c757d;
        font-weight: 700;
    }

    .text::placeholder {
        color: #6c757d;
    }

    .label {
        color: #565e64;
    }
</style>

<?php
include ("inc/navbar.php");
?>

<div class="col-lg-9 mx-auto p-4 py-md-5">
    <header class="d-flex align-items-center pb-3">
        <a href="/" class="d-flex align-items-center text-body-emphasis text-decoration-none">
            <h1 class=" bold">Recepcion de<span class="text-body-secondary"> indumentaria</span></h1>
        </a>
    </header>

    <main>
        <hr class="col-3 col-md-2 mb-5">
        <div class="mb-3 text-end">
            <button class="btn btn-success mb-2" onclick="importarDesdeExcel()">
                <i class="fad fa-file-excel"></i> Importar datos
            </button>
        </div>
        <div class="table-responsive">
            <table id="tablaPersonas" class="table table-borederless">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre Completo</th>
                        <th>Cédula de Identidad</th>
                        <th>Codigo Asignado</th>
                        <th>Sede</th>
                        <th>Puesto de Trabajo</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Aquí se cargarán dinámicamente los datos desde la base de datos -->
                </tbody>
            </table>
        </div>

        <!-- Modal para el formulario de acta de recepción -->
        <div class="modal fade modal-lg" id="modalActa" tabindex="-1" role="dialog" aria-labelledby="modalActaLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!-- Aquí se carga dinámicamente el formulario usando JavaScript -->
                </div>
            </div>
        </div>

        <div class="modal fade modal-lg" id="imprimirArchivo" tabindex="-1" role="dialog" aria-labelledby="modalActaLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!-- Aquí se carga dinámicamente el formulario usando JavaScript -->
                </div>
            </div>
        </div>
    </main>
    <footer class="pt-5 my-5 text-body-secondary border-top">
        Created by the Bootstrap team &middot; &copy; 2024
    </footer>
</div>

<script>

    $(document).ready(function () {

        // Configurar DataTable
        $('#tablaPersonas').DataTable({
            "ajax": "func/ajax_obtener_personas.php",
            "columns": [
                { "data": "id" },
                { "data": "nombre_completo" },
                { "data": "cedula_identidad" },
                { "data": "codigo_asignado" },
                { "data": "sede" },
                { "data": "puesto_trabajo" },
                { "data": "gorras" },
                { "data": "camisas" },
                { "data": "cant_camisas" },
                { "data": "carnet" },
                { "data": "mochila" },
                { "data": "capa" },
                { "data": "estado"},
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return '<button class="btn btn-primary" onclick="abrirFormulario(' + row.id + ')">Crear Acta</button>';
                    }
                }
            ],
            "columnDefs": [{ visible: false, targets: 6 }, { visible: false, targets: 7 }, { visible: false, targets: 8 }, { visible: false, targets: 9 }, { visible: false, targets: 10 }, { visible: false, targets: 11 }]
        });
    });

    function importarDesdeExcel() {
        var fileInput = document.createElement('input');
        fileInput.type = 'file';
        fileInput.accept = '.xlsx, .xls';

        fileInput.onchange = function (event) {
            var file = event.target.files[0];
            var reader = new FileReader();
            reader.onload = function (e) {
                var data = new Uint8Array(e.target.result);
                var workbook = XLSX.read(data, { type: 'array' });

                // Obtener la primera hoja de cálculo
                var firstSheet = workbook.Sheets[workbook.SheetNames[0]];

                // Convertir la hoja de cálculo a un arreglo de objetos
                var jsonData = XLSX.utils.sheet_to_json(firstSheet, { raw: true });

                // Enviar datos al servidor
                $.ajax({
                    url: 'func/ajax_procesar_excel.php',
                    type: 'POST',
                    data: { excelData: JSON.stringify(jsonData) },
                    success: function (response) {
                        // Recargar la tabla después de importar
                        $('#tablaPersonas').DataTable().ajax.reload();
                        alert('Datos importados correctamente');
                    },
                    error: function (xhr, status, error) {
                        alert('Error al importar los datos desde Excel');
                        console.error(xhr.responseText);
                    }
                });
            };
            reader.readAsArrayBuffer(file);
        };

        fileInput.click();
    }

    // Función para abrir el modal con el formulario
    function abrirFormulario(idPersona) {
        $.ajax({
            url: 'app/boleta.php',
            type: 'GET',
            data: { id_persona: idPersona },
            success: function (data) {
                $('#modalActa .modal-content').html(data);
                $('#modalActa').modal('show');
            }
        });
    }

    function imprimirArchivo(idPersona) {
        $.ajax({
            url: 'docs/_test.php',
            type: 'GET',
            data: { id_persona: idPersona },
            success: function (data) {
                
            }
        });
    }
</script>