<?php
// Se incluye la conexión a la base de datos. La ruta se ajusta para salir desde /admin/models hacia /usuario/config.
require_once __DIR__ . '/../../usuario/config/conexion.php';

class ReporteModel {
    private $conn;

    public function __construct() {
        // Se utiliza la variable global $conn definida en conexion.php
        global $conn;
        $this->conn = $conn;
    }

    public function guardarReporte($folio, $tipo_reporte, $descripcion, $imagen_hallazgo, $nombre_usuario, $tel_usuario) {
        $sql = "INSERT INTO reportes (folio, tipo_reporte, descripcion, imagen_hallazgo, estado, nombre_usuario, tel_usuario) 
                VALUES (:folio, :tipo_reporte, :descripcion, :imagen_hallazgo, 'pendiente', :nombre_usuario, :tel_usuario)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':folio'          => $folio,
            ':tipo_reporte'   => $tipo_reporte,
            ':descripcion'    => $descripcion,
            ':imagen_hallazgo'=> $imagen_hallazgo,
            ':nombre_usuario' => $nombre_usuario,
            ':tel_usuario'    => $tel_usuario,
        ]);
    }
}
?>
