<?php
session_start();
include 'db_connection.php';

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

// Procesar la solicitud de eliminación de usuario
if (isset($_POST['eliminar'])) {
    $id = intval($_POST['id']); // Sanitizar el ID
    
    try {
        // Iniciar la transacción
        $pdo->beginTransaction();
        
        // Eliminar los registros de logs relacionados con el usuario
        $stmtLogs = $pdo->prepare("DELETE FROM logs WHERE usuario_id = ?");
        $stmtLogs->bindParam(1, $id, PDO::PARAM_INT);
        $stmtLogs->execute();
        
        // Eliminar el usuario de la tabla usuarios
        $stmtUser = $pdo->prepare("DELETE FROM usuarios WHERE id = ?");
        $stmtUser->bindParam(1, $id, PDO::PARAM_INT);
        $stmtUser->execute();
        
        // Confirmar la transacción
        $pdo->commit();
        
        echo "Usuario y sus registros eliminados con éxito.";
    } catch (PDOException $e) {
        // Revertir la transacción en caso de error
        $pdo->rollBack();
        echo "Error al eliminar el usuario o sus registros: " . $e->getMessage();
    }
}

// Manejar la búsqueda de usuarios por email
$email = isset($_GET['email']) ? $_GET['email'] : '';
$sql = "SELECT id, usuario, email, rol FROM usuarios";
if (!empty($email)) {
  $sql .= " WHERE email LIKE :email";
}
$stmt = $pdo->prepare($sql);
if (!empty($email)) {
  $stmt->bindValue(':email', '%' . $email . '%', PDO::PARAM_STR);
}
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
          <a href="logout.php" class="nav-link">
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
          <form method="GET" action="" class="d-flex">
            <input type="text" class="form-control me-2" name="email" placeholder="Buscar por email" value="<?php echo isset($_GET['email']) ? htmlspecialchars($_GET['email']) : ''; ?>">
            <button type="submit" class="btn btn-outline-success"><i class="bi bi-search"></i> Buscar</button>
          </form>
        </div>
      </div>

      <!-- User List Table -->
      <div class="table-responsive">
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Usuario</th>
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
                <select class="form-select" onchange="cambiarRol(<?php echo htmlspecialchars($usuario['id']); ?>, this.value)">
                  <option value="admin" <?php echo htmlspecialchars($usuario['rol']) == 'admin' ? 'selected' : ''; ?>>Admin</option>
                  <option value="user"  <?php echo htmlspecialchars($usuario['rol']) == 'user' ? 'selected' : ''; ?>>User</option>
                </select>
              </td>
              <td>
                <a href="/TP-Login-UNSO/user.php?id=<?php echo htmlspecialchars($usuario['id']); ?>" class="btn btn-info btn-sm"><i class="bi bi-eye"></i> Ver</a> 
                <form method='POST' action='admin.php' onsubmit='return confirm("¿Seguro que deseas eliminar este usuario?");'>
                  <input type='hidden' name='id' value="<?php echo htmlspecialchars($usuario['id']); ?>"/>
                  <button class="btn btn-danger btn-sm" type='submit' name='eliminar' value='eliminar'><i class="bi bi-trash"></i> Eliminar</button>
                </form>
              </td>
            </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="5">No hay registros de usuario.</td>
            </tr>
          <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <script src="js/script.js"></script>
</body>
</html>
