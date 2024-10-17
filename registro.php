<?php
session_start();
include 'db_connection.php';  // Conexión a la base de datos


// Verificar si ya está logueado
if (isset($_SESSION['user_id'])) {
    if ($_SESSION['rol'] === 'admin') {
        header('Location: admin.php');
    } else {
        header('Location: inicio.php');
    }
    exit();
}

// Procesar el formulario si se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $fecha_de_nacimiento = $_POST['fecha_de_nacimiento'];
    $contraseña = password_hash($_POST['contraseña'], PASSWORD_DEFAULT);  // Encriptar la contraseña
   
    // Verificar si el usuario o el email ya existen en la base de datos
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = :usuario OR email = :email");
    $stmt->bindParam(':usuario', $usuario);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        // Si ya existe, mostrar un mensaje de error
        echo "Error: El usuario o el email ya están registrados.";
    } else {
        // Si no existe, insertar los datos
        $sql2 = "INSERT INTO usuarios (nombre, apellido, usuario, email, fecha_de_nacimiento, contraseña)
                VALUES (?,?,?,?,?,?)";
        
        // Preparar la consulta
        $stmt2 = $pdo->prepare($sql2);
        var_dump($nombre, $apellido, $usuario, $email, $fecha_de_nacimiento, $contraseña);
        $stmt2->bindParam(1, $nombre, PDO::PARAM_STR);
        $stmt2->bindParam(2, $apellido, PDO::PARAM_STR);
        $stmt2->bindParam(3, $usuario, PDO::PARAM_STR);
        $stmt2->bindParam(4, $email, PDO::PARAM_STR);
        $stmt2->bindParam(5, $fecha_de_nacimiento, PDO::PARAM_STR);
        $stmt2->bindParam(6, $contraseña, PDO::PARAM_STR);
      
        try {
            $stmt2->execute();
            echo "Registro exitoso. Ya puedes iniciar sesión."; 
            header('Location: login.php');
        } catch (PDOException $e) {
            echo "Error al registrar el usuario." . $e->getMessage();
        }
      
    }
}
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Formulario de Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container">
    <main>
        <div class="py-5 text-center">
            <h2>Formulario de Registro</h2>
            <p class="lead">Complete los campos para crear una cuenta.</p>
        </div>

        <div class="row g-5">
            <div class="col-md-12">
                <h4 class="mb-3">Información Personal</h4>
                <form method="POST" action="" class="needs-validation" novalidate>
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="firstName" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="firstName" name="nombre" placeholder="Ingrese su nombre" required>
                        </div>
                        <div class="col-sm-6">
                            <label for="lastName" class="form-label">Apellido</label>
                            <input type="text" class="form-control" id="lastName" name="apellido" placeholder="Ingrese su apellido" required>
                        </div>
                        <div class="col-12">
                            <label for="username" class="form-label">Usuario</label>
                            <input type="text" class="form-control" id="username" name="usuario" placeholder="Elija un nombre de usuario" required>
                        </div>
                        <div class="col-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" required>
                        </div>
                        <div class="col-12">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="contraseña" placeholder="Ingrese su contraseña" required>
                        </div>
                        <div class="col-12">
                            <label for="birthdate" class="form-label">Fecha de Nacimiento</label>
                            <input type="date" class="form-control" id="birthdate" name="fecha_de_nacimiento" required>
                        </div>
                    </div>
                    <hr class="my-4">
                    <button class="w-100 btn btn-primary btn-lg" type="submit">Registrarse</button>
                </form>
            </div>
        </div>
    </main>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
