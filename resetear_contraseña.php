<?php
include 'db_connection.php';

// Función para validar la contraseña
function validar_contrasena($contrasena) {
    $errores = [];

    // Verificar la longitud mínima
    if (strlen($contrasena) < 8) {
        $errores[] = "La contraseña debe tener al menos 8 caracteres.";
    }

    // Verificar al menos 1 minúscula
    if (!preg_match('/[a-z]/', $contrasena)) {
        $errores[] = "La contraseña debe contener al menos 1 letra minúscula.";
    }

    // Verificar al menos 1 mayúscula
    if (!preg_match('/[A-Z]/', $contrasena)) {
        $errores[] = "La contraseña debe contener al menos 1 letra mayúscula.";
    }

    // Verificar al menos 1 número
    if (!preg_match('/\\d/', $contrasena)) {
        $errores[] = "La contraseña debe contener al menos 1 número.";
    }

    // Verificar al menos 1 carácter especial
    if (!preg_match('/[\\W_]/', $contrasena)) {
        $errores[] = "La contraseña debe contener al menos 1 carácter especial.";
    }

    return $errores;
}

// Procesar el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $contrasena = $_POST['nueva_contraseña'];
    $confirmar_contrasena = $_POST['confirmar_contraseña'];

    // Verificar si el usuario existe en la base de datos
    try {
        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $usuario = $stmt->fetch();

        if ($usuario) {
            // Verificar si ambas contraseñas coinciden
            if ($contrasena === $confirmar_contrasena) {
                // Validar la nueva contraseña
                $errores = validar_contrasena($contrasena);

                if (empty($errores)) {
                    // Encriptar la nueva contraseña
                    $contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);

                    // Actualizar la contraseña en la base de datos
                    $sql = "UPDATE usuarios SET contraseña = :contrasena WHERE email = :email";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':contrasena', $contrasena_hash);
                    $stmt->bindParam(':email', $email);
                    $stmt->execute();

                    // Redirigir al usuario a la página de login después del cambio exitoso
                    header("Location: login.php");
                    exit(); // Detener la ejecución del script después de redirigir
                } else {
                    // Mostrar errores de validación
                    echo "<div class='alert alert-danger'><ul>";
                    foreach ($errores as $error) {
                        echo "<li>$error</li>";
                    }
                    echo "</ul></div>";
                }
            } else {
                // Mostrar error si las contraseñas no coinciden
                echo "<div class='alert alert-danger'>Las contraseñas no coinciden. Por favor, inténtelo de nuevo.</div>";
            }
        } else {
            // Si el usuario no está registrado
            echo "<div class='alert alert-danger'>Usuario no registrado. Regístrese primero por favor!</div>";
        }
    } catch (PDOException $e) {
        die("Error al procesar la solicitud: " . $e->getMessage());
    }
}
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
    <div class="container mt-5">
        <h2>Cambiar Contraseña</h2>
        <form action="resetear_contraseña.php" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico:</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Ingrese su email" required>
            </div>

            <div class="mb-3">
                <label for="nueva_contraseña" class="form-label">Nueva Contraseña:</label>
                <input type="password" id="nueva_contraseña" name="nueva_contraseña" class="form-control" placeholder="Ingrese su nueva contraseña" required>
            </div>

            <div class="mb-3">
                <label for="confirmar_contraseña" class="form-label">Confirmar Contraseña:</label>
                <input type="password" id="confirmar_contraseña" name="confirmar_contraseña" class="form-control" placeholder="Confirme su nueva contraseña" required>
            </div>

            <div class="d-grid">
                <input type="submit" class="btn btn-primary" value="Cambiar Contraseña">
            </div>

            <div class="d-grid">
                <a href="login.php" class="btn btn-secondary">Volver al login</a>
            </div>
        </form>

        <!-- Recuadro de política de contraseñas -->
        <div class="password-policy mt-3 p-3 bg-light border">
            <p><strong>Requisitos para tu contraseña:</strong></p>
            <ul>
                <li>Mínimo 8 caracteres</li>
                <li>Al menos 1 número</li>
                <li>Al menos 1 letra mayúscula y 1 letra minúscula</li>
                <li>Al menos 1 carácter especial (ej: @, #, $, %, &)</li>
            </ul>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

