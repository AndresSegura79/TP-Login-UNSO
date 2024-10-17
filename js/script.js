function cambiarRol(userId, nuevoRol) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'cambiar_rol.php', true); // Cambia 'actualizar_rol.php' por tu archivo PHP donde se procesa la actualización
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status === 200) {
            try {
                const response = JSON.parse(xhr.responseText);
                if (response.status === "success") {
                    alert(response.message); // Muestra el mensaje de éxito
                } else {
                    alert(response.message); // Muestra el mensaje de error
                }
            } catch (error) {
                alert('Error al procesar la respuesta del servidor: ' + error.message);
            }
        } else {
            alert('Error al realizar la solicitud: ' + xhr.status);
        }
    };
    xhr.send('id=' + userId + '&rol=' + nuevoRol);
}