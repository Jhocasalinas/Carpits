<?php
require_once('../conexion.php');

session_start();
header('Content-Type: application/json');

function getUserRole() {
    if (isset($_SESSION['rol'])) {
        return $_SESSION['rol'];
    }
    return '';
}

echo json_encode(['rol' => getUserRole()]);
?>