<?php
require_once('../conexion.php');

// Verificar si se encontraron registros
$sql = "SELECT OID, TIPODOCUMENTO, NUMDOC, PRIMNOM, SEGNOM, PRIAPEL, SEGAPEL, CARGO, CORREO, NUMTELEF, USURNAME, USUROL FROM usuario";
$result = $conn->query($sql);

$usuarios = [];

if ($result->num_rows > 0) {
    // Almacenar cada fila en un array
    while($row = $result->fetch_assoc()) {
        $usuarios[] = $row;
    }
}

// Cerrar la conexión a la base de datos
echo json_encode($usuarios);

$conn->close();
?>