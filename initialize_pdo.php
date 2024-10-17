<?php
include 'db_connection.php';

try {
     // Borrar la base de datos si existe
    $sql = "DROP DATABASE IF EXISTS $dbname";
    $pdo->exec($sql);
    echo "Base de datos '$dbname' eliminada exitosamente.<br>";

    // Crear base de datos 
    $sql = "CREATE DATABASE $dbname";
    $pdo->exec($sql);
    echo "Base de datos '$dbname' creada exitosamente.<br>";

    // Conectarse a la nueva base de datos
    $pdo->exec("USE $dbname");

    // Crear tabla 'usuarios' 
    $sql = "CREATE TABLE usuarios (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(30) NOT NULL,
        apellido VARCHAR(30) NOT NULL,
        usuario VARCHAR(30) NOT NULL UNIQUE,
        email VARCHAR(50) NOT NULL UNIQUE,
        fecha_de_nacimiento DATE, 
        contraseña VARCHAR(255) NOT NULL,
        rol VARCHAR(30) NOT NULL DEFAULT 'user',
        estado TINYINT(1) NOT NULL DEFAULT 1
    )";
    $pdo->exec($sql);
    echo "Tabla 'usuarios' creada exitosamente.<br>";

    // Crear tabla 'logs' 
    $sql = "CREATE TABLE logs (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        usuario_id INT(6) UNSIGNED NOT NULL,  -- Se debe definir la columna usuario_id antes de la FK
        fecha_de_acceso TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
    )";
    $pdo->exec($sql);
    echo "Tabla 'logs' creada exitosamente.<br>";

} catch (PDOException $e) {
    // Manejar errores
    die("Error: " . $e->getMessage());
}

// Cerrar conexión
$pdo = null;
?>
