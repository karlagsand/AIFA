<?php
require_once __DIR__ . '/../../usuario/config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $tipo_reporte = $_POST['tipo_reporte'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';
    $imagen = '';

    if (!empty($_FILES['imagen']['name'])) {
        $targetDir = "uploads/";
        $imagen = $targetDir . basename($_FILES['imagen']['name']);
        move_uploaded_file($_FILES['imagen']['tmp_name'], $imagen);
    }

    $stmt = $conn->prepare("INSERT INTO reportes (nombre_usuario, tel_usuario, tipo_reporte, descripcion, imagen, fecha_registro) VALUES (?, ?, ?, ?, ?, NOW())");
    $stmt->execute([$nombre, $telefono, $tipo_reporte, $descripcion, $imagen]);

    header("Location: ../../index.php");
    exit;
}
?>