<?php
require_once('../conexion.php');

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_usuario = $_POST['UsuarioL'];
    $password = $_POST['ContraseñaL'];

    $stmt = $conn->prepare("SELECT * FROM usuario WHERE USURNAME = ?");
    $stmt->bind_param("s", $nombre_usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['CONTRASEÑA'])) {
            $_SESSION['usuario'] = $row['USURNAME'];
            header("Location: ../index.html"); 
            exit;
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "El usuario no existe.";
    }

    $stmt->close();
}

$conn->close();
?>
