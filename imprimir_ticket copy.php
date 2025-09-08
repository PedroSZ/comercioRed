<?php
require('fpdf/fpdf.php');
require_once 'clases/sesion.php';
require_once 'clases/tipo_usuario.php';
require_once 'clases/sucursal.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ================== DATOS DE LA VENTA ==================
    $fecha = $_POST["fecha_venta"][0];
    $no_venta = $_POST["no_venta"][0];
    $cliente = $_POST["cliente"][0];
    $productos = $_POST["codigoOculto"];
    $nombres = $_POST["nombreOculto"];
    $cantidades = $_POST["cantidad"];
    $precios = $_POST["precio"];
    $subtotales = $_POST["subtotal"];
    $tipo_pago = isset($_POST["tipo_pago"][0]) ? strtoupper(trim($_POST["tipo_pago"][0])) : '';
    $referencia = isset($_POST["referencia"]) ? trim($_POST["referencia"]) : '';
    $total = $_POST["total_general_input"];
    $descuento = $_POST["descuento"];
    $iva = $_POST["iva"];
    $pago = $_POST["pago"];

    $totalDescuento = $total * $descuento / 100;
    $subtotalConDescuento = $total - $totalDescuento;
    $totalIVA = $subtotalConDescuento * $iva / 100;
    $totalFinal = $subtotalConDescuento + $totalIVA;
    $cambio = $pago - $totalFinal;

    // ================== DATOS DE LA SUCURSAL ==================
    $sesion = new Sesion();
    $currentUser = $sesion->getCurrentUser();

    $user = new Tipo_Usuario();
    $user->establecerDatos($currentUser);
    $idSucursal = $user->getConfiguracion(); // Id_Comercio de la sucursal

    $sucursalObj = new Sucursal();
    $datosSucursal = $sucursalObj->obtenerSucursalPorId($idSucursal);

    // ================== ALTO DINÁMICO DEL TICKET ==================
    $alto = 0;
    $lineHeight = 5;
    $alto += 6 * $lineHeight; // Encabezado de tienda + dirección
    $alto += 5 * $lineHeight; // Fecha, venta, cliente, tipo pago, referencia
    $alto += 1 * $lineHeight; // Espaciado
    $alto += 1 * $lineHeight; // Encabezado de tabla
    $alto += count($productos) * $lineHeight; // Por cada producto
    $alto += 4 * $lineHeight; // Línea + Subtotal + Descuento + IVA
    $alto += 3 * $lineHeight; // Total + Pago + Cambio
    $alto += 2 * $lineHeight; // Gracias por su compra + espaciado
    $alto += 13; // extra para evitar corte

    // ================== CREAR PDF ==================
    $pdf = new FPDF('P', 'mm', array(58, $alto));
    $pdf->AddPage();
    $pdf->SetMargins(2, 2, 2);

    // LOGO si existe
    if (!empty($datosSucursal['Logotipo']) && file_exists($datosSucursal['Logotipo'])) {
        $pdf->Image($datosSucursal['Logotipo'], 5, 5, 50); // x=18, y=2, ancho=20mm
        $pdf->Ln(22); // espacio después del logo
    }

    // Nombre de la sucursal
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(0, 4, utf8_decode($datosSucursal['Nombre_Sucursal']), 0, 1, 'C');

    // Datos de contacto
    $pdf->SetFont('Arial', '', 7);
    $pdf->MultiCell(0, 3,
        utf8_decode($datosSucursal['Domicilio']) . "\n" .
        "Tel: " . $datosSucursal['Telefono'] . "\n" .
        "E-mail: " . $datosSucursal['Email'],
    0, 'C');

    $pdf->Ln(1);
    $pdf->Cell(0, 4, "Fecha: $fecha", 0, 1);
    $pdf->Cell(0, 4, "Venta #: $no_venta", 0, 1);
    $pdf->Cell(0, 4, "Cliente: $cliente", 0, 1);
    $pdf->Cell(0, 4, "Tipo de pago: $tipo_pago", 0, 1);
    $tipo_pago_limpio = strtoupper(trim($tipo_pago));
    if (strpos($tipo_pago_limpio, 'TARJETA') !== false) {
        if ($referencia !== '') {
            $pdf->Cell(0, 4, "Referencia: $referencia", 0, 1);
        } else {
            $pdf->Cell(0, 4, "Referencia: (NO PROPORCIONADA)", 0, 1);
        }
    }

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
        $codigo = substr($productos[$i], 0, 12);
        $nombre = substr($nombres[$i], 0, 12);
        $cant = $cantidades[$i];
        $precio = number_format($precios[$i], 2);
        $subt = number_format($subtotales[$i], 2);
        $pdf->Cell(22, 4, "$codigo - $nombre", 0, 0);
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

    // Salida del PDF
    $pdf->Output("I", "ticket_venta.pdf");
}
?>