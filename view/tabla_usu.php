<?php
include '../conexion.php';
include 'layaut/template.php';


$query = "SELECT * FROM usuarios";

try {
    $statement = $pdo->prepare($query);
    $statement->execute();
    $usuarios = $statement->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Error al obtener usuarios: " . $e->getMessage());
}

include './modal_usu.php'
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/script.js"></script>
    <title>Tabla de Usuarios</title>
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
        <h2>Tabla de Usuarios</h2>

        <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#add_usu">
            Agregar Usuarios
        </button>

        <div class="table-container">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Contraseña</th>
                        <th>Correo Electrónico</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $usuario): ?>
                        <tr>
                            <td><?php echo $usuario['id_usuario']; ?></td>
                            <td><?php echo $usuario['nombre_usuario']; ?></td>
                            <td><?php echo $usuario['contrasena']; ?></td>
                            <td><?php echo $usuario['correo_electronico']; ?></td>
                            <td>
                                <a href="#" class="btn btn-warning edit-btn btn-margin" data-toggle="modal" data-target="#edit_usu_<?php echo $usuario['id_usuario']; ?>">Editar</a>
                                <a href="../controller/controller_usu.php?eliminarUsuario=<?php echo $usuario['id_usuario']; ?>" class="btn btn-danger btn-margin">Eliminar</a>
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