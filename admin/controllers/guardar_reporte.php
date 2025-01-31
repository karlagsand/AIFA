<?php
include_once '../models/ReporteModel.php';

// Variable para mensajes
$mensaje = '';
$mensaje_clase = ''; // 'alert-success' o 'alert-danger'

// Obtener los datos del formulario
$nombre = $_POST['nombre'] ?? null;
$telefono = $_POST['telefono'] ?? null;
$tipo_reporte = $_POST['tipo_reporte'];
$descripcion = $_POST['descripcion'];
$imagen = $_FILES['imagen'] ?? null;

// Procesar la imagen si fue subida
$imagen_ruta = null;
if ($imagen && $imagen['error'] === UPLOAD_ERR_OK) {
    $imagen_ruta = 'uploads/' . basename($imagen['name']);
    move_uploaded_file($imagen['tmp_name'], '../../public/img/' . basename($imagen['name']));
}

// Crear una nueva instancia del modelo
$reporteModel = new ReporteModel();

// Generar un folio único para el reporte
$folio = 'RPT' . strtoupper(uniqid()); // Generar folio con un prefijo único

// Guardar el reporte en la base de datos
$resultado = $reporteModel->guardarReporte($folio, $tipo_reporte, $descripcion, $imagen_ruta, $nombre, $telefono);

if ($resultado) {
    // Si el reporte fue guardado correctamente
    $mensaje = 'Agradecemos tu valioso tiempo para compartir tu opinión con nosotros.';
    $mensaje_clase = 'alert-success';
    header("Location: index.php"); // Redirigir a la página principal después de un registro exitoso
    exit;
} else {
    // Si hubo un error al guardar
    $mensaje = 'Hubo un error al registrar tu reporte. Por favor, intenta más tarde.';
    $mensaje_clase = 'alert-danger';
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Incidencias</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="fw-bold text-center">Registro de Incidencias</h1>

        <!-- Mostrar mensaje de éxito o error -->
        <?php if ($mensaje): ?>
            <div class="alert <?php echo $mensaje_clase; ?>" role="alert">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>

        <form id="reporteForm" action="reporte_model.php" method="POST" enctype="multipart/form-data" class="mt-4">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre (Opcional):</label>
                <input type="text" class="form-control" id="nombre" name="nombre">
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono (Opcional):</label>
                <input type="text" class="form-control" id="telefono" name="telefono">
            </div>
            <div class="mb-3">
                <label class="form-label">Tipo de Reporte:</label>
                <div>
                    <input type="radio" name="tipo_reporte" value="comentario" required> Comentario o Sugerencia
                    <input type="radio" name="tipo_reporte" value="necesidad"> Necesidad
                    <input type="radio" name="tipo_reporte" value="ecodeli"> Ecodeli
                </div>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción del Reporte:</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="4" placeholder="Favor de redactar considerando la información necesaria que permita atender o dar seguimiento a su participación (Lugar, fecha, hora, etc.)" required></textarea>
            </div>
            <div class="mb-3">
                <label for="imagen" class="form-label">Adjuntar Imagen (Opcional):</label>
                <input type="file" class="form-control" id="imagen" name="imagen">
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-success">Enviar</button>
                <a href="index.php" class="btn btn-secondary">Regresar</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
