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

function login($usuario, $password, $con)
{
    // Preparar consulta para seleccionar los datos del usuario administrador con el nombre de usuario especificado.
    $sql = $con->prepare("SELECT USUNAME, CONTRASEÑA FROM usuario WHERE usuario LIKE ? ");
    $sql->execute([$usuario]);

<<<<<<< HEAD
    $stmt = $conn->prepare("SELECT OID, USURNAME, CONTRASEÑA, USUROL FROM usuario WHERE USURNAME = ?");
    $stmt->bind_param("s", $nombre_usuario);
    $stmt->execute();
    $result = $stmt->get_result();


    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['CONTRASEÑA'])) {
            $_SESSION['usuario_id'] = $row['OID']; // Almacena el ID del usuario
            $_SESSION['rol'] = $row['USUROL']; // Asigna el rol del usuario desde la base de datos
            $_SESSION['usuario'] = $row['USURNAME'];

            header("Location: ../index.html"); 
=======
    if ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
        // Verificar si las contraseñas coinciden utilizando password_verify().
        if (password_verify($password, $row['CONTRASEÑA'])) {
            // Si las contraseñas coinciden, iniciar sesión y redirigir al usuario a la página de ventas.
            $_SESSION["user_id"] = $row['USUNAME'];
            header("Location: index.html");
>>>>>>> 84cacbc23eda006deb5fcab2c6241b0b60792656
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
