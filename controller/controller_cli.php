<?php
include '../conexion.php';

// Verificar si se envió una solicitud POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar qué acción se debe realizar
    if (isset($_GET['accion'])) {
        // Agregar un nuevo cliente
        if ($_GET['accion'] == 'agregarCliente') {
            // Obtener datos del formulario
            $nombreCliente = $_POST['nombreCliente'];
            $direccionCliente = $_POST['direccionCliente'];
            $telefonoCliente = $_POST['telefonoCliente'];
            $emailCliente = $_POST['emailCliente'];

            // Realizar la inserción en la base de datos
            try {
                $query = "INSERT INTO clientes (nombre_cliente, direccion, telefono, email) VALUES (:nombre, :direccion, :telefono, :email)";
                $statement = $pdo->prepare($query);
                $statement->bindParam(':nombre', $nombreCliente);
                $statement->bindParam(':direccion', $direccionCliente);
                $statement->bindParam(':telefono', $telefonoCliente);
                $statement->bindParam(':email', $emailCliente);
                $statement->execute();
                // Redireccionar a la página principal
                header("Location: ../view/tabla_cli.php");
                exit();
            } catch (PDOException $e) {
                die("Error al agregar el cliente: " . $e->getMessage());
            }
        }

        // Editar un cliente existente
        elseif ($_GET['accion'] == 'editarCliente') {
            // Obtener datos del formulario
            $id = $_POST['id'];
            $nombreCliente = $_POST['nombreCliente'];
            $direccionCliente = $_POST['direccionCliente'];
            $telefonoCliente = $_POST['telefonoCliente'];
            $emailCliente = $_POST['emailCliente'];

            // Realizar la actualización en la base de datos
            try {
                $query = "UPDATE clientes SET nombre_cliente = :nombre, direccion = :direccion, telefono = :telefono, email = :email WHERE id_cliente = :id";
                $statement = $pdo->prepare($query);
                $statement->bindParam(':id', $id);
                $statement->bindParam(':nombre', $nombreCliente);
                $statement->bindParam(':direccion', $direccionCliente);
                $statement->bindParam(':telefono', $telefonoCliente);
                $statement->bindParam(':email', $emailCliente);
                $statement->execute();
                // Redireccionar a la página principal
                header("Location: ../view/tabla_cli.php");
                exit();
            } catch (PDOException $e) {
                die("Error al actualizar el cliente: " . $e->getMessage());
            }
        }
    }
}

// Verificar si se envió una solicitud GET para eliminar un cliente
if (isset($_GET['eliminarCliente'])) {
    $id = $_GET['eliminarCliente'];

    // Query para eliminar la categoría
    $query = "DELETE FROM clientes WHERE id_cliente = :id";

    try {
        // Preparar la consulta
        $statement = $pdo->prepare($query);

        // Bind de los parámetros
        $statement->bindParam(':id', $id);

        // Ejecutar la consulta
        $statement->execute();

        // Redirigir de vuelta a la página principal
        header("Location: ../view/tabla_cli.php");
        exit();
    } catch (PDOException $e) {
        // Si hay un error al ejecutar la consulta, imprimir el mensaje de error
        die("Error al eliminar cliente: " . $e->getMessage());
    }
}
?>
