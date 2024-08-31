<?php
require_once('../conexion.php');

// Consulta SQL
$sql = "SELECT A.OID, A.PLACA, A.FECHAAGENDAMIENTO, A.USUAGENDA, A.TIPOVEHICULO, A.OBSERVACION, B.USURNAME FROM agendamiento A INNER JOIN usuario B on A.USUAGENDA = B.OID";
$result = $conn->query($sql);

$agendamientos = array();

if ($result->num_rows > 0) {
    // Recorrer resultados y guardarlos en un array
    while($row = $result->fetch_assoc()) {
        $agendamientos[] = $row;
    }
} else {
    echo json_encode(array("error" => "No se encontraron resultados"));
    exit;
}

// Devolver los datos en formato JSON
header('Content-Type: application/json');
echo json_encode($agendamientos);


$conn->close();
?>