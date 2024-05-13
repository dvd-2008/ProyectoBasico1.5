<?php
// Verificar si se envió una solicitud POST para agregar o editar una compra
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Incluir el archivo de conexión a la base de datos
    include '../conexion.php';

    // Verificar qué acción se debe realizar
    if (isset($_GET['accion'])) {
        // Agregar una nueva compra
        if ($_GET['accion'] == 'agregarCompra') {
            // Obtener los datos del formulario
            $idUsuario = $_POST['usuarioCompra'];
            $idProveedor = $_POST['proveedorCompra'];
            $idProducto = $_POST['productoCompra'];
            $cantidad = $_POST['cantidadCompra'];
            $precioUnitario = $_POST['precioUniCompra'];
            $fechaCompra = $_POST['fechaCompra'];

            // Calcular el total
            $total = $cantidad * $precioUnitario;

            try {
                // Query para insertar la nueva compra
                $query = "INSERT INTO compras (id_usuario, id_prov, fecha_compra, total) VALUES (:idUsuario, :idProveedor, :fechaCompra, :total)";
                $statement = $pdo->prepare($query);

                // Bind de los parámetros
                $statement->bindParam(':idUsuario', $idUsuario);
                $statement->bindParam(':idProveedor', $idProveedor);
                $statement->bindParam(':fechaCompra', $fechaCompra);
                $statement->bindParam(':total', $total);

                // Ejecutar la consulta
                $statement->execute();

                // Obtener el ID de la compra recién insertada
                $idCompra = $pdo->lastInsertId();

                // Insertar el detalle de la compra
                $queryDetalle = "INSERT INTO detalles_de_compra (id_compra, id_pro, cantidad, precio_uni) VALUES (:idCompra, :idProducto, :cantidad, :precioUnitario)";
                $statementDetalle = $pdo->prepare($queryDetalle);
                $statementDetalle->bindParam(':idCompra', $idCompra);
                $statementDetalle->bindParam(':idProducto', $idProducto);
                $statementDetalle->bindParam(':cantidad', $cantidad);
                $statementDetalle->bindParam(':precioUnitario', $precioUnitario);
                $statementDetalle->execute();

                // Redirigir de vuelta a la página principal
                header("Location: ../index.php");
                exit();
            } catch (PDOException $e) {
                // Si hay un error al ejecutar la consulta, imprimir el mensaje de error
                die("Error al agregar la compra: " . $e->getMessage());
            }
        }

        // Editar una compra existente
        elseif ($_GET['accion'] == 'editarCompra') {
            try {
                // Obtener los datos del formulario
                $id_compra = $_POST['id_compra'];
                $id_usuario = $_POST['usuarioCompra'];
                $id_prov = $_POST['proveedorCompra'];
                $fecha_compra = $_POST['fechaCompra'];
                $id_pro = $_POST['productoCompra'];
                $cantidad = $_POST['cantidadCompra'];
                $precio_uni = $_POST['precioUniCompra'];

                // Query para actualizar los campos en la tabla compras
                $query = "UPDATE compras 
                          SET id_usuario = :id_usuario, id_prov = :id_prov, fecha_compra = :fecha_compra
                          WHERE id_compra = :id_compra";    

                // Preparar la consulta
                $statement = $pdo->prepare($query);

                // Bind de los parámetros
                $statement->bindParam(':id_compra', $id_compra);
                $statement->bindParam(':id_usuario', $id_usuario);
                $statement->bindParam(':id_prov', $id_prov);
                $statement->bindParam(':fecha_compra', $fecha_compra);

                // Ejecutar la consulta
                $statement->execute();

                // Query para actualizar la cantidad y el precio unitario en la tabla detalles_de_compra
                $queryDetalle = "UPDATE detalles_de_compra 
                                  SET cantidad = :cantidad, precio_uni = :precio_uni
                                  WHERE id_compra = :id_compra";

                // Preparar la consulta para actualizar la cantidad y el precio unitario
                $statementDetalle = $pdo->prepare($queryDetalle);

                // Bind de los parámetros para actualizar la cantidad y el precio unitario
                $statementDetalle->bindParam(':id_compra', $id_compra);
                $statementDetalle->bindParam(':cantidad', $cantidad);
                $statementDetalle->bindParam(':precio_uni', $precio_uni);

                // Ejecutar la consulta para actualizar la cantidad y el precio unitario
                $statementDetalle->execute();

                // Redirigir de vuelta a la página principal
                header("Location: ../index.php");
                exit();
            } catch (PDOException $e) {
                // Si hay un error al ejecutar la consulta, imprimir el mensaje de error
                die("Error al actualizar los detalles de la compra: " . $e->getMessage());
            }
        }
    }
}

// Verificar si se envió una solicitud GET para eliminar una compra
elseif ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['accion']) && $_GET['accion'] == 'eliminarCompra') {
    // Verificar si se proporcionó el ID de la compra a eliminar
    if (isset($_GET['id'])) {

        include '../conexion.php';
        
        try {
            // Obtener el ID de la compra a eliminar
            $id_compra = $_GET['id'];

            // Query para eliminar los detalles de compra asociados a la compra
            $query_delete_detalles = "DELETE FROM detalles_de_compra WHERE id_compra = :id_compra";
            $statement_delete_detalles = $pdo->prepare($query_delete_detalles);
            $statement_delete_detalles->bindParam(':id_compra', $id_compra);
            $statement_delete_detalles->execute();

            // Query para eliminar la compra de la tabla compras
            $query_delete_compra = "DELETE FROM compras WHERE id_compra = :id_compra";
            $statement_delete_compra = $pdo->prepare($query_delete_compra);
            $statement_delete_compra->bindParam(':id_compra', $id_compra);
            $statement_delete_compra->execute();

            // Redirigir de vuelta a la página principal
            header("Location: ../index.php");
            exit();
        } catch (PDOException $e) {
            // Si hay un error al ejecutar la consulta, imprimir el mensaje de error
            die("Error al eliminar la compra: " . $e->getMessage());
        }
    }
} else {
    // Si la solicitud no es POST o GET, redirigir de vuelta a la página principal
    header("Location: ../index.php");
    exit();
}
?>
