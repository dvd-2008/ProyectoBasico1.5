<?php
// Incluir el archivo de conexión a la base de datos
include '../conexion.php';
include 'layaut/template.php';


$query = "SELECT c.id_compra, u.nombre_usuario AS nombre_usuario, p.nombre_prov AS nombre_proveedor, c.fecha_compra, SUM(dc.cantidad * dc.precio_uni) AS total, pr.nombre_producto AS nombre_producto
          FROM compras c
          INNER JOIN usuarios u ON c.id_usuario = u.id_usuario
          INNER JOIN proveedores p ON c.id_prov = p.id_prov
          INNER JOIN detalles_de_compra dc ON c.id_compra = dc.id_compra
          INNER JOIN productos pr ON dc.id_pro = pr.id_pro
          GROUP BY c.id_compra";

try {
    $statement = $pdo->prepare($query);
    $statement->execute();
    $compras = $statement->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Error al obtener compras: " . $e->getMessage());
}

include 'modal_comp.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Compras</title>
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
    </style>
</head>
<body>
    <div class="container">
        <h2>Tabla de Compras</h2>

        <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#add_comp">
            Agregar Compra
        </button>

        <div class="table-container">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Proveedor</th>
                        <th>Fecha de Compra</th>
                        <th>Nombre de Producto</th>
                        <th>Total</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($compras as $compra): ?>
                        <tr>
                            <td><?php echo $compra['id_compra']; ?></td>
                            <td><?php echo $compra['nombre_usuario']; ?></td>
                            <td><?php echo $compra['nombre_proveedor']; ?></td>
                            <td><?php echo $compra['fecha_compra']; ?></td>
                            <td><?php echo $compra['nombre_producto']; ?></td>
                            <td><?php echo $compra['total']; ?></td>
                            <td>
                                <a href="#" class="btn btn-warning edit-btn btn-margin" data-toggle="modal" data-target="#edit_comp_<?php echo $compra['id_compra']; ?>">Editar</a>
                                <a href="../controller/controller_comp.php?accion=eliminarCompra&id=<?php echo $compra['id_compra']; ?>" class="btn btn-danger btn-margin">Eliminar</a>
                                <a href="../view/crear_pdf_comp.php?id=<?php echo $compra['id_compra']; ?>" class="btn btn-info btn-margin">Reporte Compra</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="d-flex justify-content-end">
                <a href="../index.php" class="btn btn-primary mt-3">Regresar</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>