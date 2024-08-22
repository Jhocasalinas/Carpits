<?php

// Configuración de la conexión a SQL Server
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cdacarpits";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error al conectar a la base de datos: " . $conn->connect_error);
} else {
    echo "Conexión establecida con éxito.";
}
?>