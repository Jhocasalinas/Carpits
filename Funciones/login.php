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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_usuario = $_POST['UsuarioL'];
    $password = $_POST['ContraseñaL'];

    $stmt = $conn->prepare("SELECT * FROM usuario WHERE USURNAME = ?");
    $stmt->bind_param("s", $nombre_usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
        // Verificar si las contraseñas coinciden utilizando password_verify().
        if (password_verify($password, $row['CONTRASEÑA'])) {
            $_SESSION['usuario'] = $row['USURNAME'];
            header("Location: ../index.html"); 
            exit;
        } else {
            // Si las contraseñas no coinciden, mostrar un mensaje de error.
            return "Contraseña incorrecta";
        }
    } else {
        // Si el usuario no existe en la base de datos, mostrar un mensaje de error.
        return "El nombre de usuario es incorrecto o no está activo";
    }
}

$conn->close();
?>
