<?php
session_start();
/* 
Credenciales Admin 
Usuario:  unso
password: unso
*/
if (isset($_SESSION['user_id'])) {
   if ($_SESSION['rol'] === 'admin') {
    header('Location: admin.php');
   } else {
    header('Location: inicio.php');
   }
  exit(); 
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (isset($users[$username]) && $users[$username]['password'] === $password) {
        // Si las credenciales son correctas, almacenar la información en la sesión
        $_SESSION['user_id'] = 1; // ID de ejemplo
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $users[$username]['role']; // Guardar el rol en la sesión

        // Redirigir según el rol del usuario
        if ($_SESSION['role'] === 'admin') {
            header('Location: admin.php'); // Redirigir si esadmin
        } else {
            header('Location: inicio.php'); // Redirigir si es user
        }
        exit();
    } else {
        // Si las credenciales son incorrectas, mostrar un error
        $error = "Usuario o contraseña incorrectos.";
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

        /* Añadiendo un diseño responsivo */
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
        <form action="login.php" method="post">
            <input type="text" name="username" placeholder="Usuario" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Ingresar</button>
        </form>
        <a href="registro.php">¿No tienes cuenta? Regístrate aquí</a>
    </div>

</body>
</html>

