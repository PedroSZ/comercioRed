
<?php
//******ALTA VENTA*******
	include_once '../clases/venta.php';
include_once '../clases/producto.php';

$fechas     = $_POST['fecha_venta'];
$vendedores = $_POST['id_vendedor'];
$ventas     = $_POST['no_venta'];
$clientes   = $_POST['cliente'];
$codigos    = $_POST['codigo'];
$cantidades = $_POST['cantidad'];
$precios    = $_POST['precio'];
$pagos      = $_POST['tipo_pago'];

for ($i = 0; $i < count($codigos); $i++) {
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

    // Actualizar stock del producto
  /*  $producto = new Producto();
    $producto->setCodigo($codigos[$i]);
    $producto->setStock($cantidades[$i]);
    $producto->actualizarStock();*/


		echo '<script type="text/javascript">
								alert("VENTA EXITOSA");
								window.location.href="../nuevaVenta.php";
								activarModulo(RegUsuario);
						</script>';
}

?>