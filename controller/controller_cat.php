<?php
include '../conexion.php';

// Verificar si se envió una solicitud POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar qué acción se debe realizar
    if (isset($_GET['accion'])) {
        // Agregar una nueva categoría
        if ($_GET['accion'] == 'agregarCategoria') {
            // Obtener datos del formulario
            $nombreCategoria = $_POST['nombreCategoria'];
            $descripcionCategoria = $_POST['descripcionCategoria'];

            // Realizar la inserción en la base de datos
            try {
                $query = "INSERT INTO categorias (nombre_categoria, descripcion) VALUES (:nombre, :descripcion)";
                $statement = $pdo->prepare($query);
                $statement->bindParam(':nombre', $nombreCategoria);
                $statement->bindParam(':descripcion', $descripcionCategoria);
                $statement->execute();
                // Redireccionar a la página principal
                header("Location: ../view/tabla_cat.php");
                exit();
            } catch (PDOException $e) {
                die("Error al agregar la categoría: " . $e->getMessage());
            }
        }

        // Editar una categoría existente
        elseif ($_GET['accion'] == 'editarCategoria') {
            // Obtener datos del formulario
            $id = $_POST['id'];
            $nombreCategoria = $_POST['nombreCategoria'];
            $descripcionCategoria = $_POST['descripcionCategoria'];

            // Realizar la actualización en la base de datos
            try {
                $query = "UPDATE categorias SET nombre_categoria = :nombre, descripcion = :descripcion WHERE id_cat = :id";
                $statement = $pdo->prepare($query);
                $statement->bindParam(':id', $id);
                $statement->bindParam(':nombre', $nombreCategoria);
                $statement->bindParam(':descripcion', $descripcionCategoria);
                $statement->execute();
                // Redireccionar a la página principal
                header("Location: ../view/tabla_cat.php");
                exit();
            } catch (PDOException $e) {
                die("Error al actualizar la categoría: " . $e->getMessage());
            }
        }
    }
}

// Verificar si se envió el ID de la categoría a eliminar
if (isset($_GET['eliminarCategoria'])) {
    $id = $_GET['eliminarCategoria'];

    // Query para eliminar la categoría
    $query = "DELETE FROM categorias WHERE id_cat = :id";

    try {
        // Preparar la consulta
        $statement = $pdo->prepare($query);

        // Bind de los parámetros
        $statement->bindParam(':id', $id);

        // Ejecutar la consulta
        $statement->execute();

        // Redirigir de vuelta a la página principal
        header("Location: ../view/tabla_cat.php");
        exit();
    } catch (PDOException $e) {
        // Si hay un error al ejecutar la consulta, imprimir el mensaje de error
        die("Error al eliminar la categoría: " . $e->getMessage());
    }
}

// Si se intenta acceder a este archivo directamente, redirigir de vuelta a la página principal
header("Location: ../view/tabla_cat.php");
exit();
?>
