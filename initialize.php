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

// Borrar la base de datos si existe
$sql = "DROP DATABASE IF EXISTS $db_name";
if ($conn->query($sql) === TRUE) {
    echo "Base de datos '$db_name' eliminada exitosamente.<br>";
} else {
    die("Error eliminando la base de datos: " . $conn->error);
}

// Crear base de datos 
$sql = "CREATE DATABASE $db_name";
if ($conn->query($sql) === TRUE) {echo "Base de datos '$db_name' creada exitosamente.<br>";
} else {
    die("Error creando la base de datos: " . $conn->error);
}

// Conectarse a la base de datos
$conn->select_db($db_name);


// Crear tabla 'roles' 
$sql = "CREATE TABLE roles (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(30) NOT NULL
    )";
if ($conn->query($sql) === TRUE) {
    echo "Tabla 'roles' creada exitosamente.<br>";
} else {
    die("Error creando tabla 'roles': " . $conn->error);
}

// Crear tabla 'usuarios' 
$sql = "CREATE TABLE usuarios (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(30) NOT NULL,
    apellido VARCHAR(30) NOT NULL,
    usuario VARCHAR(30) NOT NULL UNIQUE,
    mail VARCHAR(50) NOT NULL UNIQUE,
    fecha_de_nacimiento DATE, 
    contraseña VARCHAR(255) NOT NULL,
    rol_id INT(6) UNSIGNED NOT NULL, -- Se agrega esta columna para la relación con 'roles'
    FOREIGN KEY (rol_id) REFERENCES roles(id),
    estado TINYINT(1) NOT NULL DEFAULT 1
)";
if ($conn->query($sql) === TRUE) {
    echo "Tabla 'usuarios' creada exitosamente.<br>";
} else {
    die("Error creando tabla 'usuarios': " . $conn->error);
}

// Crear tabla 'logs' 
$sql = "CREATE TABLE logs (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT(6) UNSIGNED NOT NULL,  -- Se debe definir la columna usuario_id antes de la FK
    fecha_de_acceso TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
)";
if ($conn->query($sql) === TRUE) {
    echo "Tabla 'logs' creada exitosamente.<br>";
} else {
    die("Error creando tabla 'logs': " . $conn->error);
}
$conn->close();
?>

