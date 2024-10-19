<?php
session_start();
include 'db_connection.php';

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
    <style>
        .calculator {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f8f9fa;
        }
        .calculator input {
            font-size: 1.5rem;
        }
    </style>
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
          <a href="logout.php" class="nav-link">
            <i class="bi bi-box-arrow-in-right"></i> Cerrar Sesión
          </a>
        </li>
      </ul>
    </div>
  </nav>

  <!-- Contenedor principal -->
  <div class="container mt-5">
      <h1 class="text-center mb-4">Calculadora</h1>
      <div class="calculator">
          <form method="POST">
              <div class="mb-3">
                  <input type="number" class="form-control" name="num1" placeholder="Número 1" required>
              </div>
              <div class="mb-3">
                  <input type="number" class="form-control" name="num2" placeholder="Número 2" required>
              </div>
              <div class="mb-3">
                  <select class="form-select" name="operation">
                      <option value="sum">Suma</option>
                      <option value="sub">Resta</option>
                      <option value="mul">Multiplicación</option>
                      <option value="div">División</option>
                  </select>
              </div>
              <button type="submit" class="btn btn-primary mb-3">Calcular</button>
          </form>

          <!-- PHP para procesar la calculadora -->
          <?php
          if ($_SERVER["REQUEST_METHOD"] == "POST") {
              // Obtener los valores del formulario
              $num1 = $_POST["num1"];
              $num2 = $_POST["num2"];
              $operation = $_POST["operation"];

              // Variable para almacenar el resultado
              $result = "";

              // Realizar la operación seleccionada
              if ($operation == "sum") {
                  $result = $num1 + $num2;
                  echo "<div class='alert alert-success'>El resultado de la suma es: $result</div>";
              } elseif ($operation == "sub") {
                  $result = $num1 - $num2;
                  echo "<div class='alert alert-success'>El resultado de la resta es: $result</div>";
              } elseif ($operation == "mul") {
                  $result = $num1 * $num2;
                  echo "<div class='alert alert-success'>El resultado de la multiplicación es: $result</div>";
              } elseif ($operation == "div") {
                  if ($num2 != 0) {
                      $result = $num1 / $num2;
                      echo "<div class='alert alert-success'>El resultado de la división es: $result</div>";
                  } else {
                      echo "<div class='alert alert-danger'>No se puede dividir entre cero</div>";
                  }
              }
          }
          ?>
      </div>
  </div>

</body>
</html>

