<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

// Conexión a la base de datos para obtener los reportes
require_once __DIR__ . '/../../usuario/config/conexion.php';


$stmt = $conn->prepare("SELECT * FROM reportes ORDER BY fecha_registro DESC");
$stmt->execute();
$reportes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración</title>
    <link href="../../public/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../public/css/styles.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Panel de Administración</h1>
        <div class="mb-3">
            <a href="exportar_reporte.php" class="btn btn-success btn-custom">Exportar Reportes XLSX</a>
            <a href="login.php" class="btn btn-secondary float-end btn-custom">Cerrar Sesión</a>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Folio</th>
                    <th>Tipo Reporte</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th>Nombre Usuario</th>
                    <th>Teléfono</th>
                    <th>Fecha de Registro</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reportes as $rep): ?>
                    <tr>
                        <td><?php echo $rep['folio']; ?></td>
                        <td><?php echo $rep['tipo_reporte']; ?></td>
                        <td><?php echo $rep['descripcion']; ?></td>
                        <td><?php echo $rep['estado']; ?></td>
                        <td><?php echo $rep['nombre_usuario']; ?></td>
                        <td><?php echo $rep['tel_usuario']; ?></td>
                        <td><?php echo $rep['fecha_registro']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Todos los derechos reservados</p>
    </footer>
    <script src="../../public/js/bootstrap.bundle.min.js"></script>
</body>
</html>
