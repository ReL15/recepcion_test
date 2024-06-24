<?php

// Aquí debes incluir tu lógica para procesar los datos del archivo Excel
$excelData = json_decode($_POST['excelData'], true);

// Ejemplo de procesamiento (insertar en la base de datos)
try {
    $pdo = new PDO('mysql:host=localhost;dbname=recepcion_test', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("INSERT INTO personas (nombre_completo, cedula_identidad, codigo_asignado, sede, puesto_trabajo, gorras, camisas, cant_camisas, carnet, mochila, capa) 
                                         VALUES (:nombre_completo, :cedula_identidad, :codigo_asignado, :sede, :puesto_trabajo, :gorras, :camisas, :cant_camisas, :carnet, :mochila, :capa)");

    foreach ($excelData as $row) {
        // Asignar valores de cada fila del Excel
        $nombreCompleto = $row['nombre_completo'];
        $cedulaIdentidad = $row['cedula_identidad'];
        $codigoAsignado = $row['codigo_asignado'];
        $sede = $row['sede'];
        $puestoTrabajo = $row['puesto_trabajo'];
        $gorras = $row['gorras'];
        $camisas = $row['camisas'];
        $cant_camisas = $row['cant_camisas'];
        $carnet = $row['carnet'];
        $mochila = $row['mochila'];
        $capa = $row['capa'];

        // Ejecutar la consulta preparada
        $stmt->execute(
            array(
                ':nombre_completo' => $nombreCompleto,
                ':cedula_identidad' => $cedulaIdentidad,
                ':codigo_asignado' => $codigoAsignado,
                ':sede' => $sede,
                ':puesto_trabajo' => $puestoTrabajo,
                ':gorras' => $gorras,
                ':camisas' => $camisas,
                ':cant_camisas' => $cant_camisas,
                ':carnet' => $carnet,
                ':mochila' => $mochila,
                ':capa' => $capa
            )
        );
    }

    echo "Datos procesados correctamente";
} catch (PDOException $e) {
    echo "Error al procesar los datos: " . $e->getMessage();
}