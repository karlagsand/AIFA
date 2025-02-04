<?php
// Usamos __DIR__ para establecer la ruta correcta al modelo
require_once __DIR__ . '/../../admin/models/ReporteModel.php';

// Variables para mensajes
$mensaje = '';
$mensaje_clase = ''; // 'alert-success' o 'alert-danger'

// Obtener los datos del formulario
$nombre       = $_POST['nombre'] ?? null;
$telefono     = $_POST['telefono'] ?? null;
$tipo_reporte = $_POST['tipo_reporte'] ?? null;
$descripcion  = $_POST['descripcion'] ?? null;
$imagen       = $_FILES['imagen'] ?? null;

// Procesar la imagen si fue subida
$imagen_ruta = null;
if ($imagen && $imagen['error'] === UPLOAD_ERR_OK) {
    // Se crea la ruta relativa para la imagen
    $imagen_ruta = 'uploads/' . basename($imagen['name']);
    // Mover la imagen a la carpeta pública (ajusta la ruta según tu estructura)
    move_uploaded_file($imagen['tmp_name'], __DIR__ . '/../../public/img/' . basename($imagen['name']));
}

// Crear una instancia del modelo y generar un folio único
$reporteModel = new ReporteModel();
$folio = 'RPT' . strtoupper(uniqid());

// Guardar el reporte en la base de datos
$resultado = $reporteModel->guardarReporte($folio, $tipo_reporte, $descripcion, $imagen_ruta, $nombre, $telefono);

if ($resultado) {
    // Redirige a la página principal con un mensaje de éxito
    header("Location: ../../index.php?mensaje=exito");
    exit;
} else {
    $mensaje = 'Hubo un error al registrar tu reporte. Por favor, intenta más tarde.';
    $mensaje_clase = 'alert-danger';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Error al registrar el reporte</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="alert <?php echo $mensaje_clase; ?>" role="alert">
            <?php echo $mensaje; ?>
        </div>
        <a href="../../usuario/views/formulario.php" class="btn btn-secondary">Regresar</a>
    </div>
</body>
</html>
