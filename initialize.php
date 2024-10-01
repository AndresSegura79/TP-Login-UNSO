<?php
// Parámetros de conexión
$host = 'localhost';
$user = 'root';
$pass = '';  // Contraseña del usuario root (por defecto vacía en XAMPP)
$db_name = 'tp_login_unso';

// Conectarse al servidor MySQL sin especificar una base de datos
$conn = new mysqli($host, $user, $pass);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Crear base de datos si no existe
$sql = "CREATE DATABASE IF NOT EXISTS $db_name";
if ($conn->query($sql) === TRUE) {echo "Base de datos '$db_name' verificada o creada exitosamente.<br>";
} else {
    die("Error creando la base de datos: " . $conn->error);
}

// Conectarse a la base de datos
$conn->select_db($db_name);

// Crear tabla 'usuarios' si no existe
$sql = "CREATE TABLE IF NOT EXISTS usuarios (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(30) NOT NULL,
    correo VARCHAR(50),
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    contraseña VARCHAR(255) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "Tabla 'usuarios' verificada o creada exitosamente.<br>";
} else {
    die("Error creando tabla 'usuarios': " . $conn->error);
}
$conn->close();
?>