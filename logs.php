<?php
session_start();

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

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

  </head>
  <body class="py-4">
    
<main>
  <div class="container">

    <h1 class="text-center">Logs de Acceso</h1>
    <p class="lead text-center">Estos son los logs de acceso.</p>

    <!-- Botón para redirigir a Admin -->
    <div class="text-center mb-4">
      <a href="admin.php" class="btn btn-primary">Ir a Admin</a>
    </div>

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