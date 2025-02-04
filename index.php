<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Buzón Interno de la Dirección de Operación</title>
  <!-- Bootstrap CSS -->
  <link href="public/css/bootstrap.min.css" rel="stylesheet">
  <!-- Hoja de estilos global -->
  <link href="public/css/styles.css" rel="stylesheet">
</head>
<body>
  <!-- Header con logo alineado a la izquierda -->
  <header>
    <img src="public/img/logo.png" alt="Logo AIFA">
  </header>

  <!-- Contenido principal -->
  <div class="container main-content">
    <h1>Buzón Interno de la Dirección de Operación</h1>
    <h4>“Tu participación cuenta”</h4>
    
    <!-- Grupo de botones de acceso -->
    <div class="btn-group-access">
      <div class="btn-row">
        <a href="usuario/views/formulario.php?area=Guardia Nacional" class="btn btn-access">Guardia Nacional</a>
        <a href="usuario/views/formulario.php?area=Módulos de información AIFA" class="btn btn-access">Módulos de información AIFA</a>
        <a href="usuario/views/formulario.php?area=Ecodeli" class="btn btn-access">Ecodeli</a>
      </div>
      <!-- Botón Administrador -->
      <a href="admin/views/login.php" class="btn btn-admin">Administrador</a>
    </div>
  </div>

  <!-- Footer -->
  <footer>
    <p class="text-center">© <?php echo date("Y"); ?> Todos los derechos reservados</p>
  </footer>

  <!-- Bootstrap JS -->
  <script src="public/js/bootstrap.bundle.min.js"></script>
</body>
</html>
