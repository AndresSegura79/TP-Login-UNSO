<?php
session_start(); // Inicia la sesión si no lo has hecho ya

// Verifica si el usuario está autenticado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php'); // Redirige a la página de login si no está autenticado
    exit();
}

// Aquí puedes incluir las páginas que necesites
$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 'inicio'; // Obtiene la página desde la URL, por defecto 'inicio'

// Lista de archivos permitidos
$paginas_permitidas = ['inicio', 'admin', 'user', 'logs', 'registro', 'resetear_contraseña', 'cambiar_rol'];

// Verifica si la página solicitada es válida
if (in_array($pagina, $paginas_permitidas)) {
    include "$pagina.php"; // Incluye la página solicitada
} else {
    include 'login.php'; // Si no es válida, redirige a la página de inicio
}
?>
