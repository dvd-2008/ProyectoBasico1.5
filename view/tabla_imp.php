<?php
// Incluir el archivo de conexión a la base de datos
include '../conexion.php';
include 'layaut/template.php';


$query = "SELECT id_impuesto, nombre_impuesto, CONCAT(porcentaje_impuesto, '%') AS porcentaje_impuesto FROM impuestos";

try {
    $statement = $pdo->prepare($query);
    $statement->execute();
    $impuestos = $statement->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Error al obtener impuestos: " . $e->getMessage());
}

include 'modal_imp.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Impuestos</title>
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
        <h2>Tabla de Impuestos</h2>

        <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#add_imp">
            Agregar Impuesto
        </button>

        <div class="table-container">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Porcentaje</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($impuestos as $impuesto): ?>
                        <tr>
                            <td><?php echo $impuesto['id_impuesto']; ?></td>
                            <td><?php echo $impuesto['nombre_impuesto']; ?></td>
                            <td><?php echo $impuesto['porcentaje_impuesto']; ?></td>
                            <td>
                                <a href="#" class="btn btn-warning edit-btn btn-margin" data-toggle="modal" data-target="#edit_imp_<?php echo $impuesto['id_impuesto']; ?>">Editar</a>
                                <a href="../controller/controller_imp.php?accion=eliminarImpuesto&id=<?php echo $impuesto['id_impuesto']; ?>" class="btn btn-danger btn-margin">Eliminar</a>
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
