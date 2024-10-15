<?php
session_start();

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Sidebar</title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
  <style>
    body {
      display: flex;
      min-height: 100vh;
    }

    #sidebar {
      min-width: 250px;
      max-width: 250px;
      background-color: #343a40;
      color: #ffffff;
    }

    #sidebar .nav-link {
      color: #ffffff;
    }

    #sidebar .nav-link:hover {
      background-color: #495057;
    }

    #main-content {
      flex-grow: 1;
      padding: 20px;
    }
  </style>
</head>
<body>
  <!-- Sidebar -->
  <nav id="sidebar" class="bg-dark">
    <div class="d-flex flex-column p-3">
      <h4 class="text-light">Admin Panel</h4>
      <hr>
      <ul class="nav nav-pills flex-column mb-auto">
        <!-- Logs -->
        <li class="nav-item">
          <a href="logs.html" class="nav-link" aria-current="page">
            <i class="bi bi-file-earmark-text"></i> Logs
          </a>
        </li>
        <!-- Log out -->
        <li class="nav-item">
          <a href="login.html" class="nav-link">
            <i class="bi bi-box-arrow-in-right"></i> Cerrar Sesión
          </a>
        </li>
      </ul>
    </div>
  </nav>

  <!-- Main Content -->
  <div id="main-content">
    <div class="container-fluid">
      <h2>Admin</h2>
      <div class="row mb-3">
        <!-- Search Bar -->
        <div class="col-md-6">
          <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Buscar por correo" aria-label="Search">
            <button class="btn btn-outline-success" type="submit"><i class="bi bi-search"></i> Buscar</button>
          </form>
        </div>
      </div>

      <!-- User List Table -->
      <div class="table-responsive">
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nombre</th>
              <th scope="col">Correo</th>
              <th scope="col">Rol</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <!-- Ejemplo de usuario 1 -->
            <tr>
              <th scope="row">1</th>
              <td>John Doe</td>
              <td>johndoe@example.com</td>
              <td>
                <select class="form-select">
                  <option value="Admin">Admin</option>
                  <option value="User">User</option>
                </select>
              </td>
              <td>
                <button class="btn btn-info btn-sm"><i class="bi bi-eye"></i> Ver</button>
                <button class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> Eliminar</button>
              </td>
            </tr>
            <!-- Ejemplo de usuario 2 -->
            <tr>
              <th scope="row">2</th>
              <td>Jane Smith</td>
              <td>janesmith@example.com</td>
              <td>
                <select class="form-select">
                  <option value="Admin">Admin</option>
                  <option value="User" selected>User</option>
                </select>
              </td>
              <td>
                <button class="btn btn-info btn-sm"><i class="bi bi-eye"></i> Ver</button>
                <button class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> Eliminar</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
