<?php
require_once('../conexion.php');

$tipo_documento = $_POST['T_documento'];
$numero_documento = $_POST['N_documento'];
$primer_nombre = $_POST['P_nombre'];
$segundo_nombre = $_POST['S_nombre'];
$primer_apellido = $_POST['P_apellido'];
$segundo_apellido = $_POST['S_apellido'];
$cargo = $_POST['cargo'];
$correo = $_POST['Correo'];
$telefono = $_POST['Telefono'];
$nombre_usuario = $_POST['N_usuario'];
$roles = $_POST['Rol'];
$password = $_POST['txtPassword'];
$confirm_password = $_POST['txtconfirmPassword'];

// Validar la contraseña
if ($password !== $confirm_password) {
    die("Las contraseñas no coinciden.");
}

$Contaseña_segura = password_hash($password, PASSWORD_DEFAULT);

$sql1 = "INSERT INTO usuario (CARGO, USUROL, CORREO, USURNAME, CONTRASEÑA, TIPODOCUMENTO, NUMDOC, PRIMNOM, SEGNOM, PRIAPEL, SEGAPEL, NUMTELEF) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql1);
$stmt->bind_param("ssssssssssss", $cargo, $roles, $correo, $nombre_usuario, $Contaseña_segura, $tipo_documento, $numero_documento, $primer_nombre, $segundo_nombre, $primer_apellido, $segundo_apellido, $telefono);

if ($stmt->execute()) {
    echo '<script type="text/javascript">
            alert("Usuario creado exitosamente.");
            window.location.href = "../CrearUsuario.html";
          </script>';
    exit;
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>