// Este código debe ir dentro de tu archivo js/script.js

// Función para eliminar un usuario
function eliminarUsuario(id) {
    // Envía una solicitud AJAX al servidor para eliminar el usuario
    $.ajax({
        url: 'controller/controller_usu.php',
        type: 'POST',
        data: { eliminarUsuario: id },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                // Si se elimina correctamente, recarga la página para reflejar los cambios
                location.reload();
            } else if (response.error) {
                // Si hay un error, muestra un SweetAlert con el mensaje de error
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.error
                });
            }
        },
        error: function(xhr, status, error) {
            // Si hay un error en la solicitud AJAX, muestra un SweetAlert con el mensaje de error
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Hubo un error al procesar la solicitud.'
            });
        }
    });
}
