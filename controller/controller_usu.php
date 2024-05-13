<?php
include '../conexion.php';

// Verificar si se envió una solicitud POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar qué acción se debe realizar
    if (isset($_GET['accion'])) {
        // Agregar un nuevo usuario
        if ($_GET['accion'] == 'agregarUsuario') {
            // Obtener datos del formulario
            $nombreUsuario = $_POST['nombreUsuario'];
            $contrasenaUsuario = $_POST['contrasenaUsuario'];
            $correoUsuario = $_POST['correoUsuario'];

            // Realizar la inserción en la base de datos
            try {
                $query = "INSERT INTO usuarios (nombre_usuario, contrasena, correo_electronico) VALUES (:nombre, :contrasena, :correo)";
                $statement = $pdo->prepare($query);
                $statement->bindParam(':nombre', $nombreUsuario);
                $statement->bindParam(':contrasena', $contrasenaUsuario);
                $statement->bindParam(':correo', $correoUsuario);
                $statement->execute();
                // Redireccionar a la página principal
                header("Location: ../view/tabla_usu.php");
                exit();
            } catch (PDOException $e) {
                die("Error al agregar al usuario: " . $e->getMessage());
            }
        }

        // Editar un usuario existente
        elseif ($_GET['accion'] == 'editarUsuario') {
            // Obtener datos del formulario
            $id = $_POST['id'];
            $nombreUsuario = $_POST['nombreUsuario'];
            $contrasenaUsuario = $_POST['contrasenaUsuario'];
            $correoUsuario = $_POST['correoUsuario'];

            // Realizar la actualización en la base de datos
            try {
                $query = "UPDATE usuarios SET nombre_usuario = :nombre, contrasena = :contrasena, correo_electronico = :correo WHERE id_usuario = :id";
                $statement = $pdo->prepare($query);
                $statement->bindParam(':id', $id);
                $statement->bindParam(':nombre', $nombreUsuario);
                $statement->bindParam(':contrasena', $contrasenaUsuario);
                $statement->bindParam(':correo', $correoUsuario);
                $statement->execute();
                // Redireccionar a la página principal
                header("Location: ../view/tabla_usu.php");
                exit();
            } catch (PDOException $e) {
                die("Error al actualizar el usuario: " . $e->getMessage());
            }
        }
    }
}

// Verificar si se envió una solicitud GET para eliminar un usuario
// Verificar si se envió el ID de la categoría a eliminar
if (isset($_GET['eliminarUsuario'])) {
    $id = $_GET['eliminarUsuario'];

    // Query para eliminar la categoría
    $query = "DELETE FROM usuarios WHERE id_usuario = :id";

    try {
        // Preparar la consulta
        $statement = $pdo->prepare($query);

        // Bind de los parámetros
        $statement->bindParam(':id', $id);

        // Ejecutar la consulta
        $statement->execute();

        // Redirigir de vuelta a la página principal
        header("Location: ../view/tabla_usu.php");
        exit();
    } catch (PDOException $e) {
        // Si hay un error al ejecutar la consulta, imprimir el mensaje de error
        die("Error al eliminar la categoría: " . $e->getMessage());
    }
}

?>
