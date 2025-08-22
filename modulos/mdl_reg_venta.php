<?php
//******ALTA VENTA*******
include_once '../clases/venta.php';
include_once '../clases/producto.php';
include_once '../clases/connection.php';

$hora = date("H:i:s");
$fechas     = $_POST['fecha_venta'];
$vendedores = $_POST['id_vendedor'];
$ventas     = $_POST['no_venta'];
$clientes   = $_POST['cliente'];
$codigos    = $_POST['codigoOculto'];
$cantidades = $_POST['cantidad'];
$precios    = $_POST['precio'];
$pagos      = $_POST['tipo_pago'];

$descuento = isset($_POST['descuento']) ? $_POST['descuento'] : 0;
$iva = isset($_POST['iva']) ? $_POST['iva'] : 0;
$pago = isset($_POST['pago']) ? $_POST['pago'] : 0;

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
        $venta->setHora_venta($hora);
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
                alert("ERROR: No hay suficiente stock para el producto con c\u00f3digo ' . $codigos[$i] . '");
                window.location.href="../nuevaVenta.php";
              </script>';
        exit(); // Detener el proceso
    }
}

// Registrar el descuento en la tabla descuentos solo una vez por venta
try {
    $conexion = new DB();
    $db = $conexion->connect();

    $sql = "INSERT INTO descuentos (Id_De_Cliente, No_venta, Descuento) VALUES (:cliente_id, :no_venta, :descuento)";
    $query = $db->prepare($sql);
    $query->execute([
        'cliente_id' => $clientes[0], // Tomamos el primer cliente (toda la venta tiene mismo cliente)
        'no_venta' => $ventas[0],
        'descuento' => $descuento
    ]);
} catch (PDOException $e) {
    echo '<script type="text/javascript">
            alert("Error al registrar descuento: ' . $e->getMessage() . '");
            window.location.href="../nuevaVenta.php";
          </script>';
    exit();
}

echo '<script type="text/javascript">
        alert("VENTA EXITOSA");
        window.location.href="../nuevaVenta.php";
      </script>';
?>
