<?php
require_once ('../conexion.php');

echo $_POST['T_documento'];
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
    
    // Preparar y ejecutar la consulta SQL

   /* $sql1 = "INSERT INTO funcionario (TIPCODUMENTO, NUMDOC, PRIMNOM, SEGNOM, PRIAPEL, SEGAPEL, NUMTELEF) 
            VALUES ('$tipo_documento', '$numero_documento', '$primer_nombre', '$segundo_nombre', '$primer_apellido', '$segundo_apellido', '$telefono')";*/
    
    $sql1 = "INSERT INTO usuario (CARGO, USUROL, CORREO, USURNAME, CONTRASEÑA, TIPCODUMENTO, NUMDOC, PRIMNOM, SEGNOM, PRIAPEL, SEGAPEL, NUMTELEF) 
            VALUES ('$cargo', '$roles', '$correo', '$nombre_usuario', '$password', '$tipo_documento', '$numero_documento', '$primer_nombre', '$segundo_nombre', '$primer_apellido', '$segundo_apellido', '$telefono')";
    
    if ($conn->query($sql1) === TRUE) {
        echo "Nuevo registro creado exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

?>