<?php
class ReporteModel {

    private $conn;

    public function __construct() {
        $this->conn = new mysqli('localhost', 'usuario', 'contraseña', 'nombre_base_de_datos');
        if ($this->conn->connect_error) {
            die("Conexión fallida: " . $this->conn->connect_error);
        }
    }

    public function guardarReporte($folio, $tipo_reporte, $descripcion, $imagen_hallazgo, $nombre_usuario, $tel_usuario) {
        $sql = "INSERT INTO reportes (folio, tipo_reporte, descripcion, imagen_hallazgo, estado, nombre_usuario, tel_usuario) 
                VALUES (?, ?, ?, ?, 'pendiente', ?, ?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssss", $folio, $tipo_reporte, $descripcion, $imagen_hallazgo, $nombre_usuario, $tel_usuario);

        return $stmt->execute();
    }
}
?>
