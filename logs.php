<?php
session_start();
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
  <body class="py-4">
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
      <div class="container">

        <h1 class="text-center">Logs de Acceso</h1>
        <p class="lead text-center">Estos son los logs de acceso.</p>
        <!-- Logs grid -->
        <div class="row mb-3">
          <!-- Header Row -->
          <div class="col-md-6">
            <strong>Usuario</strong>
          </div>
          <div class="col-md-6">
            <strong>Log de acceso</strong>
          </div>
        </div>

        <!-- Log Entries -->
        <div class="row mb-3">
          <div class="col-md-6">John Doe</div>
          <div class="col-md-6">2024-10-01 10:00 AM</div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">Jane Smith</div>
          <div class="col-md-6">2024-10-01 11:30 AM</div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">Alice Johnson</div>
          <div class="col-md-6">2024-10-02 09:15 AM</div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">Bob Brown</div>
          <div class="col-md-6">2024-10-02 02:45 PM</div>
        </div>

        <!-- Add more log entries as needed -->

      </div> <!-- End Container -->
    </main>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
