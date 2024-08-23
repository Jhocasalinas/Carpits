<?php
function login($usuario, $password, $con)
{
    $sql = $con->prepare("SELECT OID, USUFUNCIONARIO, password, nombre FROM usuario WHERE usuario LIKE ? ");
    $sql->execute([$usuario]);

    if ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
        // Verificar si las contraseñas coinciden utilizando password_verify()
        if (password_verify($password, $row['password'])) {
            // Si las contraseñas coinciden, iniciar sesión y redirigir al usuario
            $_SESSION["user_id"] = $row['id'];
            $_SESSION["user_name"] = $row['nombre'];
            $_SESSION["user_type"] =  'admin';
            header("Location: ventas.php");
            exit;
        } else {
            // Si las contraseñas no coinciden, mostrar un mensaje de error
            return "Contraseña incorrecta";
        }
    } else {
        // Si el usuario no existe en la base de datos, mostrar un mensaje de error
        return "El nombre de usuario es incorrecto o no está activo";
    }
}
function registrar($usuario, $email, $password, $nombre, $con)
{
    // Preparar consulta para insertar un nuevo usuario en la base de datos
    $sql = $con->prepare("INSERT INTO usuario (OID, , password, nombre) VALUES (?, ?, ?,?)");
    $sql->execute([$usuario, $email, password_hash($password, PASSWORD_DEFAULT), $nombre]);
    header("Location: login_admin.php");
    exit;
}

?>