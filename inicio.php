<?php
session_start();
// Verificar si ya está logueado
if (isset($_SESSION['user_id'])) {
    if ($_SESSION['rol'] === 'admin') {
        header('Location: admin.php');
        exit();
    }
  } else {
    header('Location: login.php');
    exit();
  } 
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Panel</title>
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
       
        <!-- Log out -->
        <li class="nav-item">
          <a href="logout.php" class="nav-link"> <!-- Modificación aquí -->
            <i class="bi bi-box-arrow-in-right"></i> Cerrar Sesión
          </a>
        </li>
      </ul>
    </div>
  </nav>
</body>
</html>