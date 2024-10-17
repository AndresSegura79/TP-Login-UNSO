<?php 
// Variables de conexión a la base de datos
$host = 'localhost';
$dbname = 'tp_login_unso';  // Nombre de la base de datos 
$username_db = 'root';  // Usuario de la base de datos
$password_db = '';  // Contraseña de la base de datos (vacía en XAMPP)

try {
    // Crear una nueva conexión PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username_db, $password_db);
    // Configuramos PDO para que lance excepciones en caso de error
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Mostrar error si no se puede conectar a la base de datos
    die("Error al conectar con la base de datos: " . $e->getMessage());
}
?>
