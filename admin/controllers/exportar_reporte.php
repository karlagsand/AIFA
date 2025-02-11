<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

require '../../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

require_once '../../usuario/config/conexion.php';
$stmt = $conn->prepare("SELECT folio, tipo_reporte, descripcion, estado, nombre_usuario, tel_usuario, fecha_registro FROM reportes ORDER BY id DESC");
$stmt->execute();
$reportes = $stmt->fetchAll(PDO::FETCH_ASSOC);

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$sheet->setCellValue('A1', 'Folio');
$sheet->setCellValue('B1', 'Tipo Reporte');
$sheet->setCellValue('C1', 'Descripción');
$sheet->setCellValue('D1', 'Estado');
$sheet->setCellValue('E1', 'Nombre Usuario');
$sheet->setCellValue('F1', 'Teléfono');
$sheet->setCellValue('G1', 'Fecha Registro');

$row = 2;
foreach ($reportes as $reporte) {
    $sheet->setCellValue("A$row", $reporte['folio']);
    $sheet->setCellValue("B$row", $reporte['tipo_reporte']);
    $sheet->setCellValue("C$row", $reporte['descripcion']);
    $sheet->setCellValue("D$row", $reporte['estado']);
    $sheet->setCellValue("E$row", $reporte['nombre_usuario']);
    $sheet->setCellValue("F$row", $reporte['tel_usuario']);
    $sheet->setCellValue("G$row", $reporte['fecha_registro']);
    $row++;
}

$writer = new Xlsx($spreadsheet);
$filename = 'Reportes_' . date('Y-m-d') . '.xlsx';

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');

$writer->save('php://output');
exit;
?>
