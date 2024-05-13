<?php
// Verificar si se envió una solicitud POST para agregar o editar una venta
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Incluir el archivo de conexión a la base de datos
    include '../conexion.php';

    // Verificar qué acción se debe realizar
    if (isset($_GET['accion'])) {
        // Agregar una nueva venta
        if ($_GET['accion'] == 'agregarVenta') {
            // Obtener los datos del formulario
            $idUsuario = $_POST['usuarioVenta'];
            $idCliente = $_POST['clienteVenta'];
            $fechaVenta = $_POST['fechaVenta'];
            $idProducto = $_POST['productoVenta'];
            $cantidad = $_POST['cantidadVenta'];
            $precioVenta = $_POST['precioVenta'];
            $idDescuento = $_POST['descuentoVenta'];
            $idImpuesto = $_POST['impuestoVenta'];

            // Calcular el total
            $total = $cantidad * $precioVenta;

            try {
                // Query para insertar la nueva venta
                $query = "INSERT INTO ventas (id_usuario, id_cliente, fecha_venta, total, id_descuento, id_impuesto) 
                          VALUES (:idUsuario, :idCliente, :fechaVenta, :total, :idDescuento, :idImpuesto)";
                $statement = $pdo->prepare($query);

                // Bind de los parámetros
                $statement->bindParam(':idUsuario', $idUsuario);
                $statement->bindParam(':idCliente', $idCliente);
                $statement->bindParam(':fechaVenta', $fechaVenta);
                $statement->bindParam(':total', $total);
                $statement->bindParam(':idDescuento', $idDescuento);
                $statement->bindParam(':idImpuesto', $idImpuesto);

                // Ejecutar la consulta
                $statement->execute();

                // Obtener el ID de la venta recién insertada
                $idVenta = $pdo->lastInsertId();

                // Insertar el detalle de la venta
                $queryDetalle = "INSERT INTO detalles_de_venta (id_ venta, id_pro, cantidad, precio_uni) 
                                 VALUES (:idVenta, :idProducto, :cantidad, :precioVenta)";
                $statementDetalle = $pdo->prepare($queryDetalle);
                $statementDetalle->bindParam(':idVenta', $idVenta);
                $statementDetalle->bindParam(':idProducto', $idProducto);
                $statementDetalle->bindParam(':cantidad', $cantidad);
                $statementDetalle->bindParam(':precioVenta', $precioVenta);
                $statementDetalle->execute();

                // Redirigir de vuelta a la página principal
                header("Location: ../view/tabla_ven.php");
                exit();
            } catch (PDOException $e) {
                // Si hay un error al ejecutar la consulta, imprimir el mensaje de error
                die("Error al agregar la venta: " . $e->getMessage());
            }
        }

        // Editar una venta existente
        elseif ($_GET['accion'] == 'editarVenta') {
            try {
                // Obtener los datos del formulario
                $id_venta = $_POST['id_venta'];
                $id_usuario = $_POST['usuarioVenta'];
                $id_cliente = $_POST['clienteVenta'];
                $fecha_venta = $_POST['fechaVenta'];
                $id_producto = $_POST['productoVenta'];
                $cantidad = $_POST['cantidadVenta'];
                $precio_uni = $_POST['precioVenta'];
                $id_descuento = $_POST['descuentoVenta'];
                $id_impuesto = $_POST['impuestoVenta'];

                // Query para actualizar los campos en la tabla ventas
                $query = "UPDATE ventas 
                          SET id_usuario = :id_usuario, id_cliente = :id_cliente, fecha_venta = :fecha_venta, id_descuento = :id_descuento, id_impuesto = :id_impuesto
                          WHERE id_venta = :id_venta";    

                // Preparar la consulta
                $statement = $pdo->prepare($query);

                // Bind de los parámetros
                $statement->bindParam(':id_venta', $id_venta);
                $statement->bindParam(':id_usuario', $id_usuario);
                $statement->bindParam(':id_cliente', $id_cliente);
                $statement->bindParam(':fecha_venta', $fecha_venta);
                $statement->bindParam(':id_descuento', $id_descuento);
                $statement->bindParam(':id_impuesto', $id_impuesto);

                // Ejecutar la consulta
                $statement->execute();

                // Query para actualizar la cantidad y el precio unitario en la tabla detalles_de_venta
                $queryDetalle = "UPDATE detalles_de_venta 
                                  SET cantidad = :cantidad, precio_uni = :precio_uni
                                  WHERE id_venta = :id_venta AND id_pro = :id_producto";

                // Preparar la consulta para actualizar la cantidad y el precio unitario
                $statementDetalle = $pdo->prepare($queryDetalle);

                // Bind de los parámetros para actualizar la cantidad y el precio unitario
                $statementDetalle->bindParam(':id_venta', $id_venta);
                $statementDetalle->bindParam(':id_producto', $id_producto);
                $statementDetalle->bindParam(':cantidad', $cantidad);
                $statementDetalle->bindParam(':precio_uni', $precio_uni);

                // Ejecutar la consulta para actualizar la cantidad y el precio unitario
                $statementDetalle->execute();

                // Redirigir de vuelta a la página principal
                header("Location: ../view/tabla_ven.php");
                exit();
            } catch (PDOException $e) {
                // Si hay un error al ejecutar la consulta, imprimir el mensaje de error
                die("Error al actualizar los detalles de la venta: " . $e->getMessage());
            }
        }
    }
}

// Verificar si se envió una solicitud GET para eliminar una venta
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['eliminarVenta'])) {
    // Incluir el archivo de conexión a la base de datos
    include '../conexion.php';

    try {
        // Obtener el ID de la venta a eliminar
        $id_venta = $_GET['eliminarVenta'];

        // Query para eliminar los detalles de venta asociados a la venta
        $query_delete_detalles = "DELETE FROM detalles_de_venta WHERE id_venta = :id_venta";
        $statement_delete_detalles = $pdo->prepare($query_delete_detalles);
        $statement_delete_detalles->bindParam(':id_venta', $id_venta);
        $statement_delete_detalles->execute();

        // Query para eliminar la venta de la tabla ventas
        $query_delete_venta = "DELETE FROM ventas WHERE id_venta = :id_venta";
        $statement_delete_venta = $pdo->prepare($query_delete_venta);
        $statement_delete_venta->bindParam(':id_venta', $id_venta);
        $statement_delete_venta->execute();

        // Redirigir de vuelta a la página principal
        header("Location: ../view/tabla_ven.php");
        exit();
    } catch (PDOException $e) {
        // Si hay un error al ejecutar la consulta, imprimir el mensaje de error
        die("Error al eliminar la venta: " . $e->getMessage());
    }
}
?>
