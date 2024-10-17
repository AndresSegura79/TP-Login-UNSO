<?php

include 'db_connection.php';
session_start();
/* 
Usuario Admin
Usuario:   unso
Password:  unso
*/

// Verificar si ya está logueado
if (isset($_SESSION['user_id'])) {
    if ($_SESSION['rol'] === 'admin') {
        header('Location: admin.php');
    } else {
        header('Location: inicio.php');
    }
    exit();
}

// Inicializar variable de error
$error = "";

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Usuario admin hardcodeado
    $hardcodedAdmin = [
        'username' => 'unso',
        'password' => 'unso',  // Contraseña en texto plano para el ejemplo, toca ver como securizarlo
        'rol' => 'admin'
    ];

    // Verificar si es el usuario admin hardcodeado
    if ($username === $hardcodedAdmin['username'] && $password === $hardcodedAdmin['password']) {
        // Si las credenciales son correctas, almacenar la información en la sesión
        $_SESSION['user_id'] = 9999; // ID ficticio para usuario hardcodeado
        $_SESSION['username'] = $hardcodedAdmin['username'];
        $_SESSION['rol'] = $hardcodedAdmin['rol'];

        // Redirigir según el rol del usuario
        if ($_SESSION['rol'] === 'admin') {
            header('Location: admin.php');
        } else {
            header('Location: inicio.php');
        }
        exit();
    }

    // Si no es el usuario hardcodeado, conectar a la base de datos usando PDO
    try {
        // Consulta para obtener el usuario de la base de datos
        $sql = "SELECT id, usuario, contraseña, rol FROM usuarios 
                WHERE usuario = :username AND estado = 1";  // Solo usuarios activos

        // Preparar y ejecutar la consulta
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        // Obtener el resultado
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar si el usuario existe y la contraseña es correcta
        if ($user && password_verify($password, $user['contraseña'])) {
            // Si las credenciales son correctas, almacenar la información en la sesión
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['usuario'];
            $_SESSION['rol'] = $user['rol'];

            // Redirigir según el rol del usuario
            if ($_SESSION['rol'] === 'admin') {
                header('Location: admin.php');
            } else {
                header('Location: inicio.php');
            }
            exit();
        } else {
            $error = "Usuario o contraseña incorrectos.";
        }
    } catch (PDOException $e) {
        // Manejar errores de conexión
        $error = "Error de conexión: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Inicio de Sesión</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #6E85B7, #B2ABF2);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }

        .login-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 350px;
            text-align: center;
        }

        .login-container h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        .login-container input {
            width: 100%;
            padding: 15px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
        }

        .login-container button {
            width: 100%;
            padding: 15px;
            background-color: #6E85B7;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .login-container button:hover {
            background-color: #5a6b93;
        }

        .login-container a {
            display: block;
            margin-top: 15px;
            color: #6E85B7;
            text-decoration: none;
            font-size: 14px;
        }

        .login-container a:hover {
            text-decoration: underline;
        }

        @media (max-width: 400px) {
            .login-container {
                width: 90%;
            }
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h2>Iniciar Sesión</h2>
        <?php if ($error): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="login.php" method="post">
            <input type="text" name="username" placeholder="Usuario" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Ingresar</button>
        </form>
        <a href="registro.php">¿No tienes cuenta? Regístrate aquí</a>
    </div>

</body>
</html>
