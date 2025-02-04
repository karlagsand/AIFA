<?php
session_start();

// Recibir credenciales del formulario
$usuario    = $_POST['usuario'] ?? '';
$contrasena = $_POST['contrasena'] ?? '';

// En este ejemplo se utilizan credenciales fijas. En producción, se deben consultar y cifrar las contraseñas.
if ($usuario === 'admin@aifa.aero' && $contrasena === 'admin123') {
    $_SESSION['admin'] = $usuario;
    header("Location: ../views/panel.php");
    exit;
} else {
    header("Location: ../views/login.php?error=1");
    exit;
}
?>
