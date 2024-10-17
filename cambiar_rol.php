<?php
include 'db_connection.php';  // Conexión a la base de datos
if (isset($_POST['id']) && isset($_POST['rol'])) {
    $id = $_POST['id'];
    $nuevoRol = $_POST['rol'];

    // Actualizar el rol en la base de datos
    $sql = "UPDATE usuarios SET rol = :rol WHERE id = :id";
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':rol', $nuevoRol, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    try {
        $stmt->execute();
        echo json_encode(["status" => "success", "message" => "Rol actualizado correctamente"]);
    } catch (PDOException $e) {
        echo json_encode(["status" => "error", "message" => "Error al actualizar el rol: " . $e->getMessage()]);
    }                  
} else {
    echo json_encode(["status" => "error", "message" => "Error por falta de parametros"]);
}
?>

