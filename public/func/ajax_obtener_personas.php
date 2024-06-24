<?php

include '../connection/config.php';

// Consulta SQL para obtener las personas
$sql = "SELECT * from personas";
$result = $conn->query($sql);

// Arreglo donde se almacenarán los datos para la DataTable
$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Convertir el arreglo a formato JSON y enviarlo de vuelta a la DataTable
echo json_encode(array('data' => $data));

// Cerrar la conexión a la base de datos
$conn->close();