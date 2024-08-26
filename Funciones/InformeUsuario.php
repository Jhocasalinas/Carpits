<?php
require_once('../conexion.php');
session_start();
header('Content-Type: application/json');

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    http_response_code(401); // Unauthorized
    echo json_encode(['error' => 'No ha iniciado sesión']);
    exit;
}

$usurname = $_SESSION['usuario']; // Nombre de usuario de la sesión actual

// Consulta SQL para obtener el informe del usuario logueado
$sql = "SELECT A.OID, A.PLACA, A.FECHAAGENDAMIENTO, A.TIPOVEHICULO, A.OBSERVACION, B.USURNAME 
        FROM agendamiento A 
        INNER JOIN usuario B ON A.USUAGENDA = B.OID
        WHERE B.USURNAME = ?"; // Selecciona solo los registros del usuario logueado

$stmt = $conn->prepare($sql);

if ($stmt === false) {
    error_log('Prepare failed: ' . $conn->error);
    echo json_encode(['error' => 'Error en la consulta SQL']);
    exit;
}

$stmt->bind_param("s", $usurname);
$stmt->execute();
$result = $stmt->get_result();

$agendamientos = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $agendamientos[] = $row;
    }
}

// Devolver los resultados en formato JSON
echo json_encode($agendamientos);

$conn->close();
?>
