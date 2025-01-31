<?php
$area = isset($_GET['area']) ? htmlspecialchars($_GET['area']) : 'Área Desconocida';
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
        <h1 class="fw-bold text-center">Registro de Incidencias - <?php echo $area; ?></h1>
        <form id="reporteForm" action="/usuario/controllers/guardar_reporte.php" method="POST" enctype="multipart/form-data" class="mt-4">
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

    <script>
        document.getElementById('reporteForm').addEventListener('submit', function(event) {
            let tipoReporte = document.querySelector('input[name="tipo_reporte"]:checked');
            if (!tipoReporte || tipoReporte.value !== 'comentario') {
                event.preventDefault();
                alert('Solo se pueden hacer reportes con la opción Comentario o Sugerencia.');
            } else {
                alert('Agradecemos tu valioso tiempo para compartir tu opinión con nosotros.');
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
