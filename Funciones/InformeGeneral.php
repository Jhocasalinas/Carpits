<?php
require 'vendor/autoload.php'; // Incluye el autoloader de Composer

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Incluye el archivo de conexión a la base de datos
require_once('../conexion.php');

// Consulta SQL
$sql = "SELECT A.OID, A.PLACA, A.FECHAAGENDAMIENTO, A.USUAGENDA, A.TIPOVEHICULO, A.OBSERVACION, B.USURNAME 
        FROM agendamiento A 
        INNER JOIN usuario B ON A.USUAGENDA = B.OID";

$result = $conn->query($sql);

if ($result === false) {
    die("Error en la consulta SQL: " . $conn->error);
}

// Crear una nueva instancia de Spreadsheet
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Definir encabezados de columnas
$headers = ['OID', 'Placa', 'Fecha de Agendamiento', 'Usuario que Agenda', 'Tipo de Vehículo', 'Observaciones'];
$sheet->fromArray($headers, NULL, 'A1');

// Agregar los datos al archivo Excel
$rowNumber = 2; // Comienza en la fila 2 para dejar espacio para los encabezados
while ($row = $result->fetch_assoc()) {
    $sheet->setCellValue('A' . $rowNumber, $row['OID']);
    $sheet->setCellValue('B' . $rowNumber, $row['PLACA']);
    $sheet->setCellValue('C' . $rowNumber, $row['FECHAAGENDAMIENTO']);
    $sheet->setCellValue('D' . $rowNumber, $row['USURNAME']);
    $sheet->setCellValue('E' . $rowNumber, $row['TIPOVEHICULO']);
    $sheet->setCellValue('F' . $rowNumber, $row['OBSERVACION']);
    $rowNumber++;
}

// Crear un escritor para el archivo Excel
$writer = new Xlsx($spreadsheet);

// Definir el nombre del archivo
$filename = 'informes_agendamiento.xlsx';

// Establecer las cabeceras para la descarga del archivo
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');

// Enviar el archivo Excel al navegador
$writer->save('php://output');

$conn->close();
