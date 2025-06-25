<?php
//******ALTA VENTA*******
include_once '../clases/venta.php';
include_once '../clases/producto.php';

$fechas     = $_POST['fecha_venta'];
$vendedores = $_POST['id_vendedor'];
$ventas     = $_POST['no_venta'];
$clientes   = $_POST['cliente'];
$codigos    = $_POST['codigoOculto'];
$cantidades = $_POST['cantidad'];
$precios    = $_POST['precio'];
$pagos      = $_POST['tipo_pago'];

for ($i = 0; $i < count($codigos); $i++) {
    $producto = new Producto();
    $producto->setCodigo($codigos[$i]);
    $productoActual = $producto->consultarCodigo($codigos[$i]);

    if ($productoActual["Stock"] >= $cantidades[$i]) {
        // Descontar la cantidad vendida del stock
        $nuevoStock = $productoActual["Stock"] - $cantidades[$i];
        $producto->setStock($nuevoStock);
        $producto->actualizarStockDirecto(); // Método que debe actualizar directamente el stock

        // Registrar la venta
        $venta = new Ventas();
        $venta->setFeca_venta($fechas[$i]);
        $venta->setId_vendedor($vendedores[$i]);
        $venta->setNo_venta($ventas[$i]);
        $venta->setCliente_id($clientes[$i]);
        $venta->setCodigo_pro($codigos[$i]);
        $venta->setCantidad($cantidades[$i]);
        $venta->setPrecio_al_dia($precios[$i]);
        $venta->setTipo_pago($pagos[$i]);
        $venta->guardar();
    } else {
        // Si no hay suficiente stock, mostramos error
        echo '<script type="text/javascript">
                alert("ERROR: No hay suficiente stock para el producto con código ' . $codigos[$i] . '");
                window.location.href="../nuevaVenta.php";
              </script>';
        exit(); // Detener el proceso
    }
}

echo '<script type="text/javascript">
        alert("VENTA EXITOSA");
        window.location.href="../nuevaVenta.php";
      </script>';
?>
