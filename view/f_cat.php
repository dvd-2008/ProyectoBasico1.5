<?php
include '../conexion.php';

// Función para obtener datos de categorías
function obtenerCategorias($pdo) {
    $query = "SELECT * FROM categorias";
    $statement = $pdo->prepare($query);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

// Función para obtener datos de usuarios
function obtenerUsuarios($pdo) {
    $query = "SELECT * FROM usuarios";
    $statement = $pdo->prepare($query);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

// Función para obtener datos de clientes
function obtenerClientes($pdo) {
    $query = "SELECT * FROM clientes";
    $statement = $pdo->prepare($query);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

// Función para obtener datos de productos
function obtenerProductos($pdo) {
    $query = "SELECT * FROM productos";
    $statement = $pdo->prepare($query);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

// Función para obtener datos de descuentos
function obtenerDescuentos($pdo) {
    $query = "SELECT * FROM descuentos";
    $statement = $pdo->prepare($query);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

// Función para obtener datos de impuestos
function obtenerImpuestos($pdo) {
    $query = "SELECT * FROM impuestos";
    $statement = $pdo->prepare($query);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}


?>
