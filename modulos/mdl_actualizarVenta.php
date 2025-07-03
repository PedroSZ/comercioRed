<?php
// mdl_actualizarVenta.php
include_once '../clases/venta.php';
include_once '../clases/producto.php';
include_once '../clases/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $noVenta = $_POST['no_venta'];
    $nuevasFechas = $_POST['fecha_venta'];
    $vendedores = $_POST['id_vendedor'];
    $clientes = $_POST['cliente'];
    $codigos = $_POST['codigoOculto'];
    $cantidades = $_POST['cantidad'];
    $precios = $_POST['precio'];
    $pagos = $_POST['tipo_pago'];
    
    try {
        $conexion = new DB();
        $db = $conexion->connect();

        // Consultar ventas actuales
        $query = $db->prepare("SELECT * FROM ventas WHERE No_venta = :no_venta");
        $query->execute(['no_venta' => $noVenta]);
        $ventasOriginales = $query->fetchAll(PDO::FETCH_ASSOC);

        // Reponer stock de los productos originales
        foreach ($ventasOriginales as $venta) {
            $producto = new Producto();
            $producto->setCodigo($venta['Codigo_pro']);
            $productoActual = $producto->consultarCodigo($venta['Codigo_pro']);
            
            $nuevoStock = $productoActual['Stock'] + $venta['Cantidad'];
            $producto->setStock($nuevoStock);
            $producto->actualizarStockDirecto();
        }

        // Eliminar las ventas actuales
        $deleteQuery = $db->prepare("DELETE FROM ventas WHERE No_venta = :no_venta");
        $deleteQuery->execute(['no_venta' => $noVenta]);

        // Registrar los nuevos productos de la venta
        for ($i = 0; $i < count($codigos); $i++) {
            $producto = new Producto();
            $producto->setCodigo($codigos[$i]);
            $productoActual = $producto->consultarCodigo($codigos[$i]);

            if ($productoActual['Stock'] >= $cantidades[$i]) {
                $nuevoStock = $productoActual['Stock'] - $cantidades[$i];
                $producto->setStock($nuevoStock);
                $producto->actualizarStockDirecto();

                $venta = new Ventas();
                $venta->setFeca_venta($nuevasFechas[$i]);
                $venta->setId_vendedor($vendedores[$i]);
                $venta->setNo_venta($noVenta);
                $venta->setCliente_id($clientes[$i]);
                $venta->setCodigo_pro($codigos[$i]);
                $venta->setCantidad($cantidades[$i]);
                $venta->setPrecio_al_dia($precios[$i]);
                $venta->setTipo_pago($pagos[$i]);
                $venta->guardar();
            } else {
                echo '<script>alert("ERROR: No hay suficiente stock para el producto con c\u00f3digo ' . $codigos[$i] . '");
                      window.location.href="../actualizarVenta.php";</script>';
                exit();
            }
        }

        echo '<script>alert("Venta actualizada correctamente"); window.location.href="../actualizarVenta.php";</script>';
    } catch (PDOException $e) {
        echo '<script>alert("Error al actualizar la venta: ' . $e->getMessage() . '"); window.location.href="../actualizarVenta.php";</script>';
    }
} else {
    header('Location: ../actualizarVenta.php');
    exit();
}
?>
