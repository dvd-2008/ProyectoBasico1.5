<?php
include '../conexion.php';
include 'layaut/template.php';


// Obtener datos de ventas
$query = "SELECT v.id_venta, u.nombre_usuario AS nombre_usuario, c.nombre_cliente AS nombre_cliente, v.fecha_venta, 
                 SUM(dv.cantidad * p.precio_venta * (1 + imp.porcentaje_impuesto / 100) - (d.porcentaje_descuento * p.precio_venta / 100)) AS total,
                 p.nombre_producto AS nombre_producto
          FROM ventas v
          INNER JOIN usuarios u ON v.id_usuario = u.id_usuario
          INNER JOIN clientes c ON v.id_cliente = c.id_cliente
          INNER JOIN detalles_de_venta dv ON v.id_venta = dv.id_venta
          INNER JOIN productos p ON dv.id_pro = p.id_pro
          LEFT JOIN descuentos d ON v.id_descuento = d.id_descuento
          LEFT JOIN impuestos imp ON v.id_impuesto = imp.id_impuesto
          GROUP BY v.id_venta";

try {
    $statement = $pdo->prepare($query);
    $statement->execute();
    $ventas = $statement->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Error al obtener ventas: " . $e->getMessage());
}

include 'modal_ven.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Ventas</title>
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
        <h2>Tabla de Ventas</h2>

        <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#add_ven">
            Agregar Venta
        </button>

        <div class="table-container">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Cliente</th>
                        <th>Fecha de Venta</th>
                        <th>Nombre de Producto</th>
                        <th>Total</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ventas as $venta): ?>
                        <tr>
                            <td><?php echo $venta['id_venta']; ?></td>
                            <td><?php echo $venta['nombre_usuario']; ?></td>
                            <td><?php echo $venta['nombre_cliente']; ?></td>
                            <td><?php echo $venta['fecha_venta']; ?></td>
                            <td><?php echo $venta['nombre_producto']; ?></td>
                            <td><?php echo number_format($venta['total'], 2); ?></td>
                            <td>
                                <a href="#" class="btn btn-warning edit-btn btn-margin" data-toggle="modal" data-target="#edit_ven_<?php echo $venta['id_venta']; ?>">Editar</a>
                                <a href="../controller/controller_ven.php?eliminarVenta=<?php echo $venta['id_venta']; ?>" class="btn btn-danger btn-margin">Eliminar</a>
                                <a href="../view/crear_pdf_ven.php?id=<?php echo $venta['id_venta']; ?>" class="btn btn-info btn-margin">Reporte Venta</a>
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
