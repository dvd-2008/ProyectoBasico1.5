<?php
// Incluir el archivo de conexión a la base de datos
include '../conexion.php';

// Verificar si se envió una solicitud POST para agregar o editar un impuesto
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar qué acción se debe realizar
    if (isset($_GET['accion'])) {
        // Agregar un nuevo impuesto
        if ($_GET['accion'] == 'agregarImpuesto') {
            // Obtener los datos del formulario
            $nombreImpuesto = $_POST['nombreImpuesto'];
            $porcentajeImpuesto = $_POST['porcentajeImpuesto'];

            // Query para insertar el nuevo impuesto
            $query = "INSERT INTO impuestos (nombre_impuesto, porcentaje_impuesto) VALUES (:nombre, :porcentaje)";

            try {
                // Preparar la consulta
                $statement = $pdo->prepare($query);

                // Bind de los parámetros
                $statement->bindParam(':nombre', $nombreImpuesto);
                $statement->bindParam(':porcentaje', $porcentajeImpuesto);

                // Ejecutar la consulta
                $statement->execute();

                // Redirigir de vuelta a la página principal
                header("Location: ../view/tabla_imp.php");
                exit();
            } catch (PDOException $e) {
                // Si hay un error al ejecutar la consulta, imprimir el mensaje de error
                die("Error al agregar el impuesto: " . $e->getMessage());
            }
        }

        // Editar un impuesto existente
        elseif ($_GET['accion'] == 'editarImpuesto') {
            // Obtener los datos del formulario
            $id = $_POST['id'];
            $nombreImpuesto = $_POST['nombreImpuesto'];
            $porcentajeImpuesto = $_POST['porcentajeImpuesto'];

            // Query para actualizar el impuesto
            $query = "UPDATE impuestos SET nombre_impuesto = :nombre, porcentaje_impuesto = :porcentaje WHERE id_impuesto = :id";

            try {
                // Preparar la consulta
                $statement = $pdo->prepare($query);

                // Bind de los parámetros
                $statement->bindParam(':id', $id);
                $statement->bindParam(':nombre', $nombreImpuesto);
                $statement->bindParam(':porcentaje', $porcentajeImpuesto);

                // Ejecutar la consulta
                $statement->execute();

                // Redirigir de vuelta a la página principal
                header("Location: ../view/tabla_imp.php");
                exit();
            } catch (PDOException $e) {
                // Si hay un error al ejecutar la consulta, imprimir el mensaje de error
                die("Error al actualizar el impuesto: " . $e->getMessage());
            }
        }
    }
}

// Verificar si se envió una solicitud GET para eliminar un impuesto
elseif ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['accion']) && $_GET['accion'] == 'eliminarImpuesto') {
    // Verificar si se proporcionó el ID del impuesto a eliminar
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Query para eliminar el impuesto
        $query = "DELETE FROM impuestos WHERE id_impuesto = :id";

        try {
            // Preparar la consulta
            $statement = $pdo->prepare($query);

            // Bind de los parámetros
            $statement->bindParam(':id', $id);

            // Ejecutar la consulta
            $statement->execute();

            // Redirigir de vuelta a la página principal
            header("Location: ../view/tabla_imp.php");
            exit();
        } catch (PDOException $e) {
            // Si hay un error al ejecutar la consulta, imprimir el mensaje de error
            die("Error al eliminar el impuesto: " . $e->getMessage());
        }
    }
}
?>
