<?php
// Parámetros de conexión
$host = 'localhost';
$user = 'root';
$pass = '';  // Contraseña del usuario root (por defecto vacía en XAMPP)
$db_name = 'tp_login_unso';

// Definir el DSN (Data Source Name)
$dsn = "mysql:host=$host;charset=utf8mb4";

try {
    // Crear una nueva conexión PDO
    $conn = new PDO($dsn, $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Manejo de errores

    // Borrar la base de datos si existe
    $sql = "DROP DATABASE IF EXISTS $db_name";
    $conn->exec($sql);
    echo "Base de datos '$db_name' eliminada exitosamente.<br>";

    // Crear base de datos 
    $sql = "CREATE DATABASE $db_name";
    $conn->exec($sql);
    echo "Base de datos '$db_name' creada exitosamente.<br>";

    // Conectarse a la nueva base de datos
    $conn->exec("USE $db_name");

    // Crear tabla 'usuarios' 
    $sql = "CREATE TABLE usuarios (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(30) NOT NULL,
        apellido VARCHAR(30) NOT NULL,
        usuario VARCHAR(30) NOT NULL UNIQUE,
        mail VARCHAR(50) NOT NULL UNIQUE,
        fecha_de_nacimiento DATE, 
        contraseña VARCHAR(255) NOT NULL,
        rol VARCHAR(30) NOT NULL,
        estado TINYINT(1) NOT NULL DEFAULT 1
    )";
    $conn->exec($sql);
    echo "Tabla 'usuarios' creada exitosamente.<br>";

    // Crear tabla 'logs' 
    $sql = "CREATE TABLE logs (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        usuario_id INT(6) UNSIGNED NOT NULL,  -- Se debe definir la columna usuario_id antes de la FK
        fecha_de_acceso TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
    )";
    $conn->exec($sql);
    echo "Tabla 'logs' creada exitosamente.<br>";

} catch (PDOException $e) {
    // Manejar errores
    die("Error: " . $e->getMessage());
}

// Cerrar conexión
$conn = null;
?>
