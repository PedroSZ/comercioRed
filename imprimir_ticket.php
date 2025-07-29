<?php
require('fpdf/fpdf.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fecha = $_POST["fecha_venta"][0];
    $no_venta = $_POST["no_venta"][0];
    $cliente = $_POST["cliente"][0];
    $productos = $_POST["codigoOculto"];
    $nombres = $_POST["nombreOculto"];
    $cantidades = $_POST["cantidad"];
    $precios = $_POST["precio"];
    $subtotales = $_POST["subtotal"];
    $tipo_pago = $_POST["tipo_pago"][0];
    $total = $_POST["total_general_input"];
    $descuento = $_POST["descuento"];
    $iva = $_POST["iva"];
    $pago = $_POST["pago"];

    $totalDescuento = $total * $descuento / 100;
    $subtotalConDescuento = $total - $totalDescuento;
    $totalIVA = $subtotalConDescuento * $iva / 100;
    $totalFinal = $subtotalConDescuento + $totalIVA;
    $cambio = $pago - $totalFinal;

    // Crear instancia de PDF para impresora POS 58mm
    $pdf = new FPDF('P', 'mm', array(58, 200));
    $pdf->AddPage();
    $pdf->SetMargins(2, 2, 2);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(0, 4, 'La Piconeria de Ameca', 0, 1, 'C');

    $pdf->SetFont('Arial', '', 7);
    $pdf->MultiCell(0, 3, "Av. Patria No.\nCol. Santuario\nC.P. 46620 Ameca, Jal.\nTel: 375 100 3330\ne-mail: lapiconeria@gmail.com", 0, 'C');

    $pdf->Ln(1);
    $pdf->Cell(0, 4, "Fecha: $fecha", 0, 1);
    $pdf->Cell(0, 4, "Venta #: $no_venta", 0, 1);
    $pdf->Cell(0, 4, "Cliente: $cliente", 0, 1);
    $pdf->Cell(0, 4, "Tipo de pago: $tipo_pago", 0, 1);
    $pdf->Ln(1);

    // Encabezado de productos
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(11, 4, 'Codigo', 0, 0);
    $pdf->Cell(16, 4, 'Producto', 0, 0);
    $pdf->Cell(7, 4, 'Cant', 0, 0, 'R');
    $pdf->Cell(11, 4, 'Precio', 0, 0, 'R');
    $pdf->Cell(11, 4, 'Importe', 0, 1, 'R');

    $pdf->SetFont('Arial', '', 7);

    for ($i = 0; $i < count($productos); $i++) {
        $codigo = substr($productos[$i], 0, 12); // Limita largo para espacio
        $nombre = substr($nombres[$i], 0, 12); // Acorta si es muy largo
        $cant = $cantidades[$i];
        $precio = number_format($precios[$i], 2);
        $subt = number_format($subtotales[$i], 2);
        $pdf->Cell(22, 4, "$codigo - $nombre", 0, 0); // ✅ Muestra código y nombre
        $pdf->Cell(8, 4, $cant, 0, 0, 'R');
        $pdf->Cell(12, 4, "$$precio", 0, 0, 'R');
        $pdf->Cell(14, 4, "$$subt", 0, 1, 'R');
    }





    // Línea
    $pdf->Ln(1);
    $pdf->Cell(0, 0, '', 'T');
    $pdf->Ln(1);

    // Totales
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(0, 4, "Subtotal: $" . number_format($total, 2), 0, 1, 'R');
    $pdf->Cell(0, 4, "Descuento: {$descuento}%", 0, 1, 'R');
    $pdf->Cell(0, 4, "IVA: {$iva}%", 0, 1, 'R');
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(0, 5, "Total: $" . number_format($totalFinal, 2), 0, 1, 'R');

    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(0, 4, "Pago con: $" . number_format($pago, 2), 0, 1, 'R');
    $pdf->Cell(0, 4, "Cambio: $" . number_format($cambio, 2), 0, 1, 'R');

    $pdf->Ln(2);
    $pdf->SetFont('Arial', 'I', 7);
    $pdf->Cell(0, 4, "Gracias por su compra", 0, 1, 'C');
    $pdf->Ln(2);

    // Salida directa
    $pdf->Output("I", "ticket_venta.pdf");
}
?>
