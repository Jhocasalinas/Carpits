<?php
require_once('../conexion.php');

session_start();

if (!isset($_SESSION['usuario_id'])) {
    die("<script>
        alert('No estás autorizado para realizar esta acción.');
        window.location.href = '../Agendar.html'; // Redirige al formulario
    </script>");
}

$usuario_id = $_SESSION['usuario_id'];

$Fecha_tecnomecanica = $_POST['fechatecnomecanica'];
$placa = $_POST['Placa'];
$T_vehiculo = $_POST['Tipo_vehiculo'];
$observaciones = $_POST['Observaciones'];

$sql_check = "SELECT PLACA, FECHAAGENDAMIENTO, USUAGENDA FROM agendamiento WHERE PLACA = ?";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("s", $placa);
$stmt_check->execute();
$result_check = $stmt_check->get_result();

if ($result_check->num_rows > 0) {
    $row = $result_check->fetch_assoc();
    $fecha_ultimo_agendamiento = $row['FECHAAGENDAMIENTO'];
    $usuario_id_existente = $row['USUAGENDA'];

    $fecha_limite = date('Y-m-d', strtotime($fecha_ultimo_agendamiento . ' +15 days'));

    if (date('Y-m-d') > $fecha_limite) {
        $sql_update = "UPDATE agendamiento SET FECHAAGENDAMIENTO = ?, TIPOVEHICULO = ?, OBSEVACION = ?, USUAGENDA = ? WHERE PLACA = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("ssssi", $Fecha_tecnomecanica, $T_vehiculo, $observaciones, $usuario_id, $placa);

        if ($stmt_update->execute()) {
            echo "<script>
                alert('Registro actualizado correctamente.');
                window.location.href = '../Agendar.html'; // Redirige al formulario
            </script>";
        } else {
            echo "<script>
                alert('Error: " . $stmt_update->error . "');
                window.location.href = '../Agendar.html'; // Redirige al formulario
            </script>";
        }
    } else {
        $sql_user = "SELECT USURNAME FROM usuario WHERE OID = ?";
        $stmt_user = $conn->prepare($sql_user);
        $stmt_user->bind_param("i", $usuario_id_existente);
        $stmt_user->execute();
        $result_user = $stmt_user->get_result();
        $usuario_agendado = $result_user->fetch_assoc()['USURNAME'];

        echo "<script>
            alert('La placa ya ha sido agendada por el usuario: $usuario_agendado. La placa puede ser re-agendada después de 15 días desde la última fecha de agendamiento.');
            window.location.href = '../Agendar.html'; // Redirige al formulario
        </script>";
    }

    $stmt_check->close();
} else {
    $sql_insert = "INSERT INTO agendamiento (PLACA, FECHAAGENDAMIENTO, TIPOVEHICULO, OBSEVACION, USUAGENDA) 
            VALUES (?, ?, ?, ?, ?)";

    $stmt_insert = $conn->prepare($sql_insert);
    $stmt_insert->bind_param("ssssi", $placa, $Fecha_tecnomecanica, $T_vehiculo, $observaciones, $usuario_id);

    if ($stmt_insert->execute()) {
        echo "<script>
            alert('Registro guardado correctamente.');
            window.location.href = '../Agendar.html'; // Redirige al formulario
        </script>";
    } else {
        echo "<script>
            alert('Error: " . $stmt_insert->error . "');
            window.location.href = '../Agendar.html'; // Redirige al formulario
        </script>";
    }

    $stmt_insert->close();
}

$conn->close();
?>
