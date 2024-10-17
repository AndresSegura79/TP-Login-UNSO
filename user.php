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
if (isset($_GET['id'])) {
    $userId = intval($_GET['id']);
    include 'db_connection.php';  // Conexión a la base de datos
    $sql = "SELECT id, nombre, apellido, usuario, email, fecha_de_nacimiento, rol, estado
            FROM usuarios
            WHERE id = :id";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
    $stmt->execute();
        
    // Obtener resultados
    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $usuario = $resultado[0];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de usuario</title>
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
        <!-- Admin -->
        <li class="nav-item">
          <a href="admin.php" class="nav-link" aria-current="page">
                <i class="bi bi-file-earmark-text"></i> Admin
          </a>
        </li>
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
    <div class="card">
        <!-- User  Data -->
        <?php if ($usuario): ?>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">ID: <?php echo htmlspecialchars($usuario['id']); ?></li> 
                <li class="list-group-item">Nombre: <?php echo htmlspecialchars($usuario['nombre']); ?></li> 
                <li class="list-group-item">Apellido: <?php echo htmlspecialchars($usuario['apellido']); ?></li>
                <li class="list-group-item">Usuario: <?php echo htmlspecialchars($usuario['usuario']); ?></li>
                <li class="list-group-item">Fecha de nacimiento: <?php echo htmlspecialchars($usuario['fecha_de_nacimiento']); ?></li>
                <li class="list-group-item">Email: <?php echo htmlspecialchars($usuario['email']); ?></li> 
                <li class="list-group-item">Rol: <?php echo htmlspecialchars($usuario['rol']); ?></li> 
                <li class="list-group-item">Estado: <?php echo htmlspecialchars($usuario['estado']); ?></li> 
            </ul>
        <?php else: ?>
            <p class="card-body">El usuario no existe.</p>
        <?php endif; ?>
    </div>
</body>
</html>