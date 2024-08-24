<?php
require_once('../conexion.php');

session_start();

function login($usuario, $password, $con)
{
    // Preparar consulta para seleccionar los datos del usuario administrador con el nombre de usuario especificado.
    $sql = $con->prepare("SELECT USUNAME, CONTRASEÑA FROM usuario WHERE usuario LIKE ? ");
    $sql->execute([$usuario]);

    if ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
        // Verificar si las contraseñas coinciden utilizando password_verify().
        if (password_verify($password, $row['CONTRASEÑA'])) {
            // Si las contraseñas coinciden, iniciar sesión y redirigir al usuario a la página de ventas.
            $_SESSION["user_id"] = $row['USUNAME'];
            header("Location: index.html");
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
