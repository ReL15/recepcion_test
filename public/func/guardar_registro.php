<?php

require_once '../vendor/autoload.php';

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

// Crear un nuevo objeto PHPWord
$phpWord = new PhpWord();

// Verificar que se reciban los datos esperados por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Configuración de conexión a la base de datos (debes llenar estos detalles con tu configuración)
    $host = "localhost"; // Cambiar si tu base de datos está en otro servidor
    $usuario = "root";
    $contrasena = "";
    $base_de_datos = "recepcion_test";

    // Datos recibidos del formulario
    $id_persona = $_POST['id'];
    // Si está marcado, asignar 1, de lo contrario 0

    $gorras = isset($_POST['gorra']) ? 1 : 0;
    $camisas = isset($_POST['camisa']) ? 1 : 0;
    $cant_camisas = $_POST['cant_camisas'];
    $mochila = isset($_POST['mochila']) ? 1 : 0;
    $capas = isset($_POST['capa']) ? 1 : 0;
    $carnet = isset($_POST['carnet']) ? 1 : 0;
    $observaciones = $_POST['observaciones'];

    // Conexión a la base de datos usando MySQLi
    $conexion = new mysqli($host, $usuario, $contrasena, $base_de_datos);

    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Error en la conexión a la base de datos: " . $conexion->connect_error);
    }

    // Preparar la consulta SQL para insertar los datos en la tabla correspondiente
    $sql = "INSERT INTO actas_recepcion (id_persona, gorras, camisas, cant_camisas, mochila, capas, carnet, observaciones) 
                                 VALUES ($id_persona, '$gorras', '$camisas', '$cant_camisas', '$mochila', '$capas', '$carnet', '$observaciones')";

    // Preparar la declaración
    $declaracion = $conexion->query($sql);

    if ($gorras == 1) {
        $update = "UPDATE personas SET estado = 'Recuperado' WHERE id=$id_persona";
        $use_update = $conexion->query($update);
        
    }
    

    // Verificar si la preparación de la declaración fue exitosa
    if ($declaracion === TRUE) {


        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "recepcion_test";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Conexión establecida correctamente";
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
        }

        if ($id_persona != 0) {
            $stmt = $conn->prepare("SELECT actas_recepcion.id, 
            actas_recepcion.id_persona, 
            personas.nombre_completo, 
            personas.cedula_identidad, 
            personas.codigo_asignado, 
            personas.puesto_trabajo, 
            personas.sede, 
            actas_recepcion.fecha, 
            actas_recepcion.gorras, 
            actas_recepcion.camisas, 
            actas_recepcion.cant_camisas, 
            actas_recepcion.mochila,
            actas_recepcion.capas,
            actas_recepcion.carnet,
            actas_recepcion.observaciones,
            actas_recepcion.entrego
            FROM actas_recepcion
            INNER JOIN personas ON actas_recepcion.id_persona = personas.id
            WHERE actas_recepcion.id = $id_persona");
            $stmt->execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($resultados as $index => $row) {
                // Procesar la plantilla de Word
                $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('../docs/template.docx');
                $templateProcessor->setValue('nombre', $row['nombre_completo']);
                $templateProcessor->setValue('dui', $row['cedula_identidad']);
                $templateProcessor->setValue('codigo', $row['codigo_asignado']);
                $templateProcessor->setValue('cargo', $row['puesto_trabajo']);
                $templateProcessor->setValue('sede', $row['sede']);
                $templateProcessor->setValue('fecha', $row['fecha']);
                $templateProcessor->setValue('gorras', $row['gorras']);
                $templateProcessor->setValue('camisas', $row['camisas']);
                $templateProcessor->setValue('cant_camisas', $row['cant_camisas']);
                $templateProcessor->setValue('mochila', $row['mochila']);
                $templateProcessor->setValue('capas', $row['capas']);
                $templateProcessor->setValue('carnet', $row['carnet']);
                $templateProcessor->setValue('observaciones', $row['observaciones']);
                $templateProcessor->setValue('entrego', $row['entrego']);


                $nuevoNombreArchivo = '../docs/acta_' . date('Ymd') . '_' . $id_persona . '.docx';
                $templateProcessor->saveAs($nuevoNombreArchivo);

                include 'download.php';

                header("Location: ../docs/$nuevoNombreArchivo");
                

            }
        } else {
            echo 'Error: No se recibió el parámetro id_persona.';
        }
    } else {
        echo "Error al guardar los datos: " . $conexion->error;

    }

    // Cerrar la declaración y la conexión
} else {
    // Si no se recibieron datos por POST, mostrar un mensaje de error
    echo "Error: No se recibieron datos por el método POST.";
}