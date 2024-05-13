<?php
require('../pdf/fpdf.php');

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Logo

        // Arial bold 12
        $this->SetFont('Arial','',12);
        // Movernos a la derecha
        $this->Cell(60);
        // Título
        $this->Cell(70,10,'Reporte de Venta',0,0,'C');
        // Salto de línea
        $this->Ln(20);
        $this->SetFillColor(200,220,255); // Color de fondo de la cabecera de la tabla
        $this->Cell(30,10,'Producto',1,0,'C', true); // Agregar borde y color de fondo
        $this->Cell(30,10,'Usuario',1,0,'C', true); // Agregar borde y color de fondo
        $this->Cell(30,10,'Cliente',1,0,'C', true); // Agregar borde y color de fondo
        $this->Cell(35,10,'Cantidad',1,0,'C', true); // Agregar borde y color de fondo
        $this->Cell(35,10,'Precio de Venta',1,0,'C', true); // Agregar borde y color de fondo
        $this->Cell(20,10,'Impuesto',1,0,'C', true); // Agregar borde y color de fondo
        $this->Cell(20,10,'Descuento',1,0,'C', true); // Agregar borde y color de fondo
        $this->Cell(20,10,'Total',1,0,'C', true); // Agregar borde y color de fondo
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

    // Preparar la consulta SQL
    $query = "SELECT p.nombre_producto, u.nombre_usuario, c.nombre_cliente, dv.cantidad, dv.precio_uni, v.total, imp.porcentaje_impuesto, d.porcentaje_descuento
              FROM detalles_de_venta dv
              INNER JOIN ventas v ON dv.id_venta = v.id_venta
              INNER JOIN productos p ON dv.id_pro = p.id_pro
              INNER JOIN usuarios u ON v.id_usuario = u.id_usuario
              INNER JOIN clientes c ON v.id_cliente = c.id_cliente
              LEFT JOIN impuestos imp ON v.id_impuesto = imp.id_impuesto
              LEFT JOIN descuentos d ON v.id_descuento = d.id_descuento";
    $statement = $pdo->prepare($query);
    // Ejecutar la consulta
    $statement->execute();
    // Obtener los resultados
    $detalles_de_venta = $statement->fetchAll(PDO::FETCH_ASSOC);

    // Iterar sobre los resultados y agregarlos al PDF
    foreach ($detalles_de_venta as $row) {
        $nombre_producto = $row['nombre_producto'];
        $nombre_usuario = $row['nombre_usuario'];
        $nombre_cliente = $row['nombre_cliente'];
        $cantidad = $row['cantidad'];
        $precio_venta = $row['precio_uni'];
        $impuesto = $row['porcentaje_impuesto'] ?? 0;
        $descuento = $row['porcentaje_descuento'] ?? 0;
        $total = $row['total'];

        $subtotal = $cantidad * $precio_venta;
        $impuesto_monto = $subtotal * ($impuesto / 100);
        $descuento_monto = $subtotal * ($descuento / 100);
        $total_final = $subtotal + $impuesto_monto - $descuento_monto;

        $pdf->Cell(30,10,$nombre_producto,1,0,'C', true);
        $pdf->Cell(30,10,$nombre_usuario,1,0,'C', true);
        $pdf->Cell(30,10,$nombre_cliente,1,0,'C', true);
        $pdf->Cell(35,10,$cantidad,1,0,'C', true);
        $pdf->Cell(35,10,number_format($precio_venta, 2),1,0,'C', true);
        $pdf->Cell(20,10,number_format($impuesto_monto, 2),1,0,'C', true);
        $pdf->Cell(20,10,number_format($descuento_monto, 2),1,0,'C', true);
        $pdf->Cell(20,10,number_format($total_final, 2),1,0,'C', true);
        $pdf->Ln();
    }

    // Salida del PDF
    $pdf->Output();
} catch (PDOException $e) {
    // Si hay un error al conectar, imprimir el mensaje de error
    die("Error de consulta: " . $e->getMessage());
}
?>
