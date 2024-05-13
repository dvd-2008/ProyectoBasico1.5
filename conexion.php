<?php
// Datos de conexión
$host = 'localhost:3315'; // Cambia localhost por tu dirección IP si es necesario
$dbname = 'tienda2';
$username = 'root';
$password = '';

try {
    // Crear una instancia de PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

    // Configuración adicional de PDO para manejar errores y excepciones
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    // Si hay un error al conectar, imprimir el mensaje de error
    die("Error de conexión: " . $e->getMessage());
}
?>
