<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

// Cargar el autoload de Composer
require '../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Obtener los reportes de la base de datos
require_once '../../usuario/config/conexion.php';
$stmt = $conn->prepare("SELECT * FROM reportes ORDER BY id DESC");
$stmt->execute();
$reportes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Crear un nuevo spreadsheet y agregar los datos
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Encabezados
$sheet->setCellValue('A1', 'Folio');
$sheet->setCellValue('B1', 'Tipo Reporte');
$sheet->setCellValue('C1', 'Descripción');
$sheet->setCellValue('D1', 'Estado');
$sheet->setCellValue('E1', 'Nombre Usuario');
$sheet->setCellValue('F1', 'Teléfono');
$sheet->setCellValue('G1', 'Fecha Registro');

$row = 2;
foreach ($reportes as $rep) {
    $sheet->setCellValue('A' . $row, $rep['folio']);
    $sheet->setCellValue('B' . $row, $rep['tipo_reporte']);
    $sheet->setCellValue('C' . $row, $rep['descripcion']);
    $sheet->setCellValue('D' . $row, $rep['estado']);
    $sheet->setCellValue('E' . $row, $rep['nombre_usuario']);
    $sheet->setCellValue('F' . $row, $rep['tel_usuario']);
    $sheet->setCellValue('G' . $row, $rep['fecha_registro']);
    $row++;
}

$writer = new Xlsx($spreadsheet);

// Enviar las cabeceras para descargar el archivo
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="reportes.xlsx"');
$writer->save("php://output");
exit;
?>
