<?php
require('../pdf/fpdf.php');

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Arial bold 12
        $this->SetFont('Arial','',12);
        // Movernos a la derecha
        $this->Cell(60);
        // Título
        $this->Cell(70,10,'Reporte de Compras',0,0,'C');
        // Salto de línea
        $this->Ln(20);
        $this->SetFillColor(200,220,255); // Color de fondo de la cabecera de la tabla
        $this->Cell(30,10,'Usuario',1,0,'C', true); // Agregar borde y color de fondo
        $this->Cell(30,10,'Proveedor',1,0,'C', true); // Agregar borde y color de fondo
        $this->Cell(30,10,'Fecha',1,0,'C', true); // Agregar borde y color de fondo
        $this->Cell(30,10,'Producto',1,0,'C', true); // Agregar borde y color de fondo
        $this->Cell(30,10,'Cantidad',1,0,'C', true); // Agregar borde y color de fondo
        $this->Cell(30,10,'Precio Unitario',1,0,'C', true); // Agregar borde y color de fondo
        $this->Cell(30,10,'Total',1,0,'C', true); // Agregar borde y color de fondo
        $this->Ln();
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Número de página
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}

require '../conexion.php';

try {
    // Preparar la consulta SQL
    $query = "SELECT u.nombre_usuario, p.nombre_prov, c.fecha_compra, pro.nombre_producto, dc.cantidad, dc.precio_uni, c.total
              FROM compras c
              INNER JOIN usuarios u ON c.id_usuario = u.id_usuario
              INNER JOIN proveedores p ON c.id_prov = p.id_prov
              INNER JOIN detalles_de_compra dc ON c.id_compra = dc.id_compra
              INNER JOIN productos pro ON dc.id_pro = pro.id_pro";
    $statement = $pdo->prepare($query);
    // Ejecutar la consulta
    $statement->execute();
    // Obtener los resultados
    $compras = $statement->fetchAll(PDO::FETCH_ASSOC);

    // Crear el objeto PDF
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage('L'); // Orientación horizontal
    $pdf->SetFont('Arial','',12); // Tamaño de la letra

    // Establecer color del borde de la página
    $pdf->SetDrawColor(0,0,0); // Color del borde de la página

    // Dibujar un rectángulo alrededor de toda la página
    $pdf->Rect(5, 5, $pdf->GetPageWidth() - 10, $pdf->GetPageHeight() - 10);

    // Establecer color de fondo para el contenido de la tabla
    $pdf->SetFillColor(233,229,235); // Color de fondo del contenido de la tabla

    // Iterar sobre los resultados y agregarlos al PDF
    foreach ($compras as $row) {
        $nombre_usuario = $row['nombre_usuario'];
        $nombre_proveedor = $row['nombre_prov'];
        $fecha_compra = $row['fecha_compra'];
        $nombre_producto = $row['nombre_producto'];
        $cantidad = $row['cantidad'];
        $precio_unitario = $row['precio_uni'];
        $total = $row['total'];

        $pdf->Cell(30,10,$nombre_usuario,1,0,'C', true);
        $pdf->Cell(30,10,$nombre_proveedor,1,0,'C', true);
        $pdf->Cell(30,10,$fecha_compra,1,0,'C', true);
        $pdf->Cell(30,10,$nombre_producto,1,0,'C', true);
        $pdf->Cell(30,10,$cantidad,1,0,'C', true);
        $pdf->Cell(30,10,number_format($precio_unitario, 2),1,0,'C', true);
        $pdf->Cell(30,10,number_format($total, 2),1,0,'C', true);
        $pdf->Ln();
    }

    // Salida del PDF
    $pdf->Output();
} catch (PDOException $e) {
    // Si hay un error al conectar, imprimir el mensaje de error
    die("Error de consulta: " . $e->getMessage());
}
?>
