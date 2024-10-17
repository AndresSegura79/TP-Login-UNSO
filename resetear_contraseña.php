<?php


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña</title>
     <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
  <link rel="stylesheet" href="css/style.css">
  
</head>
<body>

    <div class="container">
        <h2>Cambiar Contraseña</h2>
        <form action="cambiar_contraseña.php" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico:</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Ingrese su email" required>
            </div>

            <div class="mb-3">
                <label for="nueva_contraseña" class="form-label">Nueva Contraseña:</label>
                <input type="password" id="nueva_contraseña" name="nueva_contraseña" class="form-control" placeholder="Ingrese su nueva contraseña" required>
            </div>

            <div class="d-grid">
                <input type="submit" class="btn btn-primary" value="Cambiar Contraseña">
            </div>
        </form>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

