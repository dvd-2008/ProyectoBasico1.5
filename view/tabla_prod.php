<?php
include '../conexion.php';
include 'layaut/template.php';


$query = "SELECT productos.*, categorias.nombre_categoria AS nombre_categoria FROM productos LEFT JOIN categorias ON productos.id_cat = categorias.id_cat";

try {
    $statement = $pdo->prepare($query);
    $statement->execute();
    $productos = $statement->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error al obtener productos: " . $e->getMessage());
}

include 'modal_prod.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Productos</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Custom styles for this page */
        .container {
            padding: 20px;
            margin-left: 15%;
        }
        .table-container {
            margin-top: 20px;
        }
        .btn-margin {
            margin-right: 5px;
        }
        /* Style for image in table */
        .product-image {
            max-width: 150px;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Tabla de Productos</h2>

        <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#add_prod">
            Agregar Producto
        </button>

        <div class="table-container">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio Compra</th>
                        <th>Precio Venta</th>
                        <th>Stock</th>
                        <th>Categoría</th>
                        <th>Imagen</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos as $producto): ?>
                        <tr>
                            <td><?php echo $producto['id_pro']; ?></td>
                            <td><?php echo $producto['nombre_producto']; ?></td>
                            <td><?php echo $producto['descripcion']; ?></td>
                            <td><?php echo $producto['precio_compra']; ?></td>
                            <td><?php echo $producto['precio_venta']; ?></td>
                            <td><?php echo $producto['stock']; ?></td>
                            <td><?php echo $producto['nombre_categoria']; ?></td>
                            <td><img class="product-image" src="data:image/jpeg;base64,<?php echo base64_encode($producto['imagen']) ?>" alt=""></td>
                            <td>
                                <a href="#" class="btn btn-warning edit-btn btn-margin" data-toggle="modal" data-target="#edit_prod_<?php echo $producto['id_pro']; ?>">Editar</a>
                                <a href="../controller/controller_prod.php?eliminarProducto=<?php echo $producto['id_pro']; ?>" class="btn btn-danger btn-margin">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>