<?php
// Incluir el archivo de conexión a la base de datos
include '../conexion.php';

// Verificar si se envió una solicitud POST para agregar o editar un proveedor
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar qué acción se debe realizar
    if (isset($_GET['accion'])) {
        // Agregar un nuevo proveedor
        if ($_GET['accion'] == 'agregarProveedor') {
            // Obtener los datos del formulario
            $nombreProveedor = $_POST['nombreProveedor'];
            $direccionProveedor = $_POST['direccionProveedor'];
            $telefonoProveedor = $_POST['telefonoProveedor'];
            $emailProveedor = $_POST['emailProveedor'];

            // Query para insertar el nuevo proveedor
            $query = "INSERT INTO proveedores (nombre_prov, direccion, telefono, email) VALUES (:nombre, :direccion, :telefono, :email)";

            try {
                // Preparar la consulta
                $statement = $pdo->prepare($query);

                // Bind de los parámetros
                $statement->bindParam(':nombre', $nombreProveedor);
                $statement->bindParam(':direccion', $direccionProveedor);
                $statement->bindParam(':telefono', $telefonoProveedor);
                $statement->bindParam(':email', $emailProveedor);

                // Ejecutar la consulta
                $statement->execute();

                // Redirigir de vuelta a la página principal
                header("Location: ../view/tabla_prove.php");
                exit();
            } catch (PDOException $e) {
                // Si hay un error al ejecutar la consulta, imprimir el mensaje de error
                die("Error al agregar el proveedor: " . $e->getMessage());
            }
        }

        // Editar un proveedor existente
        elseif ($_GET['accion'] == 'editarProveedor') {
            // Obtener los datos del formulario
            $id = $_POST['id'];
            $nombreProveedor = $_POST['nombreProveedor'];
            $direccionProveedor = $_POST['direccionProveedor'];
            $telefonoProveedor = $_POST['telefonoProveedor'];
            $emailProveedor = $_POST['emailProveedor'];

            // Query para actualizar el proveedor
            $query = "UPDATE proveedores SET nombre_prov = :nombre, direccion = :direccion, telefono = :telefono, email = :email WHERE id_prov = :id";

            try {
                // Preparar la consulta
                $statement = $pdo->prepare($query);

                // Bind de los parámetros
                $statement->bindParam(':id', $id);
                $statement->bindParam(':nombre', $nombreProveedor);
                $statement->bindParam(':direccion', $direccionProveedor);
                $statement->bindParam(':telefono', $telefonoProveedor);
                $statement->bindParam(':email', $emailProveedor);

                // Ejecutar la consulta
                $statement->execute();

                // Redirigir de vuelta a la página principal
                header("Location: ../view/tabla_prove.php");
                exit();
            } catch (PDOException $e) {
                // Si hay un error al ejecutar la consulta, imprimir el mensaje de error
                die("Error al actualizar el proveedor: " . $e->getMessage());
            }
        }
    }
}

// Verificar si se envió una solicitud GET para eliminar un proveedor
if (isset($_GET['eliminarProveedor'])) {
    $id = $_GET['eliminarProveedor'];

    // Query para eliminar la categoría
    $query = "DELETE FROM proveedores WHERE id_prov = :id";

    try {
        // Preparar la consulta
        $statement = $pdo->prepare($query);

        // Bind de los parámetros
        $statement->bindParam(':id', $id);

        // Ejecutar la consulta
        $statement->execute();

        // Redirigir de vuelta a la página principal
        header("Location: ../view/tabla_prove.php");
        exit();
    } catch (PDOException $e) {
        // Si hay un error al ejecutar la consulta, imprimir el mensaje de error
        die("Error al eliminar el proveedor: " . $e->getMessage());
    }
}
?>
