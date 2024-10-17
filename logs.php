<?php
session_start();
include 'db_connection.php';  // Conexión a la base de datos
// Verificar si ya está logueado
if (isset($_SESSION['user_id'])) {
  if ($_SESSION['rol'] !== 'admin') {
      header('Location: inicio.php');
      exit();
  }
} else {
  header('Location: login.php');
  exit();
} 
$sql = "SELECT logs.fecha_de_acceso, usuarios.nombre, usuarios.apellido, usuarios.usuario, usuarios.id 
            FROM logs 
            JOIN usuarios ON logs.usuario_id = usuarios.id 
            ORDER BY logs.fecha_de_acceso DESC";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    
    // Obtener resultados
    $logs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html> 
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Logs - Admin Panel</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
   <!-- Sidebar -->
    <nav id="sidebar" class="bg-dark">
      <div class="d-flex flex-column p-3">
      <h4 class="text-light">Menu</h4>
      <hr>
      <ul class="nav nav-pills flex-column mb-auto">
        <!-- Logs -->
        <li class="nav-item">
          <a href="admin.php" class="nav-link" aria-current="page">
            <i class="bi bi-file-earmark-text"></i> Admin
          </a>
        </li>
        <!-- Log out -->
        <li class="nav-item">
          <a href="logout.php" class="nav-link"> <!-- Modificación aquí -->
            <i class="bi bi-box-arrow-in-right"></i> Cerrar Sesión
          </a>
        </li>
      </ul>
      </div>
    </nav>  
    <main>
      <h1 class="text-center">Logs de Acceso</h1>
      <p class="lead text-center">Estos son los logs de acceso.</p>
      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Usuario</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">Fecha de acceso</th>
          </tr>
        </thead>
        <tbody>
          <!-- Log Entries -->
          <?php if (!empty($logs)): ?>
            <?php foreach ($logs as $log): ?>
              <tr>
                <td><?php echo htmlspecialchars($log['id']); ?></td> 
                <td><?php echo htmlspecialchars($log['usuario']); ?></td> 
                <td><?php echo htmlspecialchars($log['nombre']); ?></td>
                <td><?php echo htmlspecialchars($log['apellido']); ?></td>
                <td><?php echo htmlspecialchars($log['fecha_de_acceso']); ?></td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td>No hay registros de acceso.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </main>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
