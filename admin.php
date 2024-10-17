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
include 'db_connection.php';  // Conexión a la base de datos
$sql = "SELECT id, usuario, email, rol
        FROM usuarios";

$stmt = $pdo->prepare($sql);
$stmt->execute();
    
// Obtener resultados
$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel</title>
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
          <a href="logs.php" class="nav-link" aria-current="page">
            <i class="bi bi-file-earmark-text"></i> Logs
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
          <?php if (!empty($resultado)): ?>
            <?php foreach ($resultado as $usuario): ?>
            <tr>
              <th scope="row"><?php echo htmlspecialchars($usuario['id']); ?></th>
              <td><?php echo htmlspecialchars($usuario['usuario']); ?></td>
              <td><?php echo htmlspecialchars($usuario['email']); ?></td>
              <td>
                <select class="form-select">
                  <option value="admin">Admin</option>
                  <option value="user">User</option>
                </select>
              </td>
              <td>
                <a href="/TP-Login-UNSO/user.php?id=<?php echo htmlspecialchars($usuario['id']); ?>" class="btn btn-info btn-sm"><i class="bi bi-eye"></i> Ver</a> 
                <button class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> Eliminar</button>
              </td>
            </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td>No hay registros de acceso.</td>
            </tr>
          <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>
</html>

