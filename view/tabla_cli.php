<?php
include '../conexion.php';
include 'layaut/template.php';


$query = "SELECT * FROM clientes";

try {
    $statement = $pdo->prepare($query);
    $statement->execute();
    $clientes = $statement->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Error al obtener clientes: " . $e->getMessage());
}

include 'modal_cli.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Clientes</title>
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
        <h2>Tabla de Clientes</h2>

        <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#add_cli">
            Agregar Cliente
        </button>

        <div class="table-container">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>Correo electrónico</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clientes as $cliente): ?>
                        <tr>
                            <td><?php echo $cliente['id_cliente']; ?></td>
                            <td><?php echo $cliente['nombre_cliente']; ?></td>
                            <td><?php echo $cliente['direccion']; ?></td>
                            <td><?php echo $cliente['telefono']; ?></td>
                            <td><?php echo $cliente['email']; ?></td>
                            <td>
                                <a href="#" class="btn btn-warning edit-btn btn-margin" data-toggle="modal" data-target="#edit_cli_<?php echo $cliente['id_cliente']; ?>">Editar</a>
                                <a href="../controller/controller_cli.php?eliminarCliente=<?php echo $cliente['id_cliente']; ?>" class="btn btn-danger btn-margin">Eliminar</a>
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