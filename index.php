<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entregable</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="sweet.js"></script>
    <!-- Incluir el archivo sweet.js -->
    <style>
        /* Estilos adicionales */
        .sidebar {
            height: 100%;
            width: 200px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: black;
            padding-top: 20px;
            margin: 0; /* Added */
        }

        .sidebar a {
            padding: 10px;
            text-decoration: none;
            font-size: 18px;
            color: white;
            display: block;
        }

        /* Estilos para el contenido principal */
        .main-content {
            margin-left: 0; /* Adjusted */
            padding: 0; /* Added */
        }

        /* Estilos para el encabezado */
        .header {
            background-color: black;
            color: white;
            text-align: center;
            padding: 20px;
            border-radius: 0 0 10px 10px;
            margin: 0; /* Added */
        }

        /* Estilos para la imagen */
        .main-content img {
            margin-top: 20px; /* Added */
            margin-bottom: 20px; /* Added */
            width: 500px; /* Adjusted */
            border-radius: 10px; /* Adjusted */
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar d-flex flex-column align-items-center">
        <li style="list-style: none; padding-bottom: 20px;">
            <img src="logo.jpg" alt="logotipo" style="width: 100px; border-radius: 50%;">
        </li>

        <div style="text-align: center; color: #fff; margin-top: 20px;">
            <h4> Bienvenido </h4>
        </div>

        <a href="view/tabla_prod.php" class="active"><ion-icon name="bag-outline"></ion-icon> Productos</a>
        <a href="view/tabla_usu.php" ><ion-icon name="person-outline"></ion-icon> Usuarios</a>

        <a href="view/tabla_prove.php"><ion-icon name="cube-outline"></ion-icon> Proveedor</a>
        <a href="view/tabla_cli.php"><ion-icon name="server-outline"></ion-icon> Cliente</a>
        <a href="view/tabla_desc.php"><ion-icon name="cash-outline"></ion-icon> Descuento</a>
        <a href="view/tabla_cat.php"><ion-icon name="apps-outline"></ion-icon> Categoría</a>
        <a href="view/tabla_imp.php"><ion-icon name="stats-chart-outline"></ion-icon> Impuesto</a>
        <a href="view/tabla_ven.php"><ion-icon name="cart-outline"></ion-icon> Venta</a>
        <a href="view/tabla_comp.php"><ion-icon name="basket-outline"></ion-icon> Compras</a>

        <a href="logout.php" id="logoutBtn"><ion-icon name="log-out-outline"></ion-icon> Cerrar Sesión</a>
    </div>
    
    <div class="main-content">
        <div class="header">
            <h1>Bienvenido a la empresa "TGestiona"</h1> 
        </div>
        <div class="d-flex flex-column align-items-center justify-content-center">
            <img src="tgestiona.jpg" alt="logotipo">
        </div>
    
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
