<?php
// Incluir el archivo de conexión a la base de datos
include '../conexion.php';

// Verificar si se envió una solicitud POST para agregar o editar un descuento
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar qué acción se debe realizar
    if (isset($_GET['accion'])) {
        // Agregar un nuevo descuento
        if ($_GET['accion'] == 'agregarDescuento') {
            // Obtener los datos del formulario
            $nombreDescuento = $_POST['nombreDescuento'];
            $porcentajeDescuento = $_POST['porcentajeDescuento'];

            // Query para insertar el nuevo descuento
            $query = "INSERT INTO descuentos (nombre_descuento, porcentaje_descuento) VALUES (:nombre, :porcentaje)";

            try {
                // Preparar la consulta
                $statement = $pdo->prepare($query);

                // Bind de los parámetros
                $statement->bindParam(':nombre', $nombreDescuento);
                $statement->bindParam(':porcentaje', $porcentajeDescuento);

                // Ejecutar la consulta
                $statement->execute();

                // Redirigir de vuelta a la página principal
                header("Location: ../view/tabla_desc.php");
                exit();
            } catch (PDOException $e) {
                // Si hay un error al ejecutar la consulta, imprimir el mensaje de error
                die("Error al agregar el descuento: " . $e->getMessage());
            }
        }

        // Editar un descuento existente
        elseif ($_GET['accion'] == 'editarDescuento') {
            // Obtener los datos del formulario
            $id = $_POST['id'];
            $nombreDescuento = $_POST['nombreDescuento'];
            $porcentajeDescuento = $_POST['porcentajeDescuento'];

            // Query para actualizar el descuento
            $query = "UPDATE descuentos SET nombre_descuento = :nombre, porcentaje_descuento = :porcentaje WHERE id_descuento = :id";

            try {
                // Preparar la consulta
                $statement = $pdo->prepare($query);

                // Bind de los parámetros
                $statement->bindParam(':id', $id);
                $statement->bindParam(':nombre', $nombreDescuento);
                $statement->bindParam(':porcentaje', $porcentajeDescuento);

                // Ejecutar la consulta
                $statement->execute();

                // Redirigir de vuelta a la página principal
                header("Location: ../view/tabla_desc.php");
                exit();
            } catch (PDOException $e) {
                // Si hay un error al ejecutar la consulta, imprimir el mensaje de error
                die("Error al actualizar el descuento: " . $e->getMessage());
            }
        }
    }
}

// Verificar si se envió una solicitud GET para eliminar un descuento
if (isset($_GET['eliminarDescuento'])) {
    $id = $_GET['eliminarDescuento'];

    // Query para eliminar la categoría
    $query = "DELETE FROM descuentos WHERE id_descuento = :id";

    try {
        // Preparar la consulta
        $statement = $pdo->prepare($query);

        // Bind de los parámetros
        $statement->bindParam(':id', $id);

        // Ejecutar la consulta
        $statement->execute();

        // Redirigir de vuelta a la página principal
        header("Location: ../view/tabla_desc.php");
        exit();
    } catch (PDOException $e) {
        // Si hay un error al ejecutar la consulta, imprimir el mensaje de error
        die("Error al eliminar el descuento: " . $e->getMessage());
    }
}
?>
