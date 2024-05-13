<?php
include '../conexion.php';

// Verificar si se envió una solicitud POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar qué acción se debe realizar
    if (isset($_GET['accion'])) {
        // Agregar un nuevo producto
        if ($_GET['accion'] == 'agregarProducto') {
            // Obtener datos del formulario
            $nombreProducto = $_POST['nombreProducto'];
            $descripcionProducto = $_POST['descripcionProducto'];
            $precioCompra = $_POST['precioCompra'];
            $precioVenta = $_POST['precioVenta'];
            $stock = $_POST['stock'];
            $categoria = $_POST['categoria'];

            // Obtener la imagen del formulario
            $imagen = file_get_contents($_FILES["imagenProducto"]["tmp_name"]);
            $tipoImagen = $_FILES["imagenProducto"]["type"];

            // Verificar si el tipo de imagen es válido
            if (strpos($tipoImagen, 'image') !== false) {
                // Realizar la inserción en la base de datos
                try {
                    $query = "INSERT INTO productos (id_cat, nombre_producto, descripcion, precio_compra, precio_venta, stock, imagen) VALUES (:categoria, :nombre, :descripcion, :precioCompra, :precioVenta, :stock, :imagen)";
                    $statement = $pdo->prepare($query);
                    $statement->bindParam(':categoria', $categoria);
                    $statement->bindParam(':nombre', $nombreProducto);
                    $statement->bindParam(':descripcion', $descripcionProducto);
                    $statement->bindParam(':precioCompra', $precioCompra);
                    $statement->bindParam(':precioVenta', $precioVenta);
                    $statement->bindParam(':stock', $stock);
                    $statement->bindParam(':imagen', $imagen, PDO::PARAM_LOB);
                    $statement->execute();
                    // Redireccionar a la página principal
                    header("Location: ../view/tabla_prod.php");
                    exit();
                } catch (PDOException $e) {
                    die("Error al agregar el producto: " . $e->getMessage());
                }
            } else {
                echo "Tipo de archivo de imagen no válido.";
            }
        }

        // Editar un producto existente
        elseif ($_GET['accion'] == 'editarProducto') {
            // Obtener datos del formulario
            $id = $_POST['id'];
            $nombreProducto = $_POST['nombreProducto'];
            $descripcionProducto = $_POST['descripcionProducto'];
            $precioCompra = $_POST['precioCompra'];
            $precioVenta = $_POST['precioVenta'];
            $stock = $_POST['stock'];
            $categoria = $_POST['categoria'];

            // Obtener la imagen del formulario
            if ($_FILES['imagenProducto']['size'] > 0) {
                $imagen = file_get_contents($_FILES["imagenProducto"]["tmp_name"]);
                $tipoImagen = $_FILES["imagenProducto"]["type"];
            } else {
                // No se ha subido una nueva imagen, conservar la existente
                $query = "SELECT imagen FROM productos WHERE id_pro = :id";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                $imagen = $stmt->fetchColumn();
                // Obtener el tipo de imagen para verificar
                $tipoImagen = 'image/jpeg'; // Cambiar si se usa otro tipo de imagen
            }

            // Verificar si el tipo de imagen es válido
            if (strpos($tipoImagen, 'image') !== false) {
                // Realizar la actualización en la base de datos
                try {
                    $query = "UPDATE productos SET id_cat = :categoria, nombre_producto = :nombre, descripcion = :descripcion, precio_compra = :precioCompra, precio_venta = :precioVenta, stock = :stock, imagen = :imagen WHERE id_pro = :id";
                    $statement = $pdo->prepare($query);
                    $statement->bindParam(':id', $id);
                    $statement->bindParam(':categoria', $categoria);
                    $statement->bindParam(':nombre', $nombreProducto);
                    $statement->bindParam(':descripcion', $descripcionProducto);
                    $statement->bindParam(':precioCompra', $precioCompra);
                    $statement->bindParam(':precioVenta', $precioVenta);
                    $statement->bindParam(':stock', $stock);
                    $statement->bindParam(':imagen', $imagen, PDO::PARAM_LOB);
                    $statement->execute();
                    // Redireccionar a la página principal
                    header("Location: ../view/tabla_prod.php");
                    exit();
                } catch (PDOException $e) {
                    die("Error al editar el producto: " . $e->getMessage());
                }
            } else {
                echo "Tipo de archivo de imagen no válido.";
            }
        }
    }
}

// Verificar si se envió una solicitud GET para eliminar un producto
if (isset($_GET['eliminarProducto'])) {
    $id = $_GET['eliminarProducto'];

    // Query para eliminar la categoría
    $query = "DELETE FROM productos WHERE id_pro = :id";

    try {
        // Preparar la consulta
        $statement = $pdo->prepare($query);

        // Bind de los parámetros
        $statement->bindParam(':id', $id);

        // Ejecutar la consulta
        $statement->execute();

        // Redirigir de vuelta a la página principal
        header("Location: ../view/tabla_prod.php");
        exit();
    } catch (PDOException $e) {
        // Si hay un error al ejecutar la consulta, imprimir el mensaje de error
        die("Error al eliminar el producto: " . $e->getMessage());
    }
}
?>
