<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('../conexion.php');
header('Content-Type: application/json');

$sql = "SELECT OID, TIPODOCUMENTO, NUMDOC, PRIMNOM, SEGNOM, PRIAPEL, SEGAPEL, CARGO, CORREO, NUMTELEF, USURNAME, USUROL FROM usuario";
$result = $conn->query($sql);

$usuarios = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $usuarios[] = $row;
    }
}

echo json_encode($usuarios);

$conn->close();
?>