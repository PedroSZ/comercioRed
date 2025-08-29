<?php
// Depuración inicial
echo "<pre>";
print_r($_POST);
echo "</pre>";

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

        // -------------------------
        // 1. Agrupar filas por No_venta
        // -------------------------
        $ventasPorNumero = [];
        for ($i = 0; $i < count($codigos); $i++) {
            $no = $noVenta[$i];
            $ventasPorNumero[$no][] = [
                'fecha' => $nuevasFechas[$i],
                'vendedor' => $vendedores[$i],
                'cliente' => $clientes[$i],
                'codigo' => $codigos[$i],
                'cantidad' => $cantidades[$i],
                'precio' => $precios[$i],
                'pago' => $pagos[$i]
            ];
        }

        // -------------------------
        // 2. Reponer stock y eliminar ventas originales
        // -------------------------
        $numerosDeVenta = array_keys($ventasPorNumero);
        if (count($numerosDeVenta) > 0) {
            $placeholders = implode(',', array_fill(0, count($numerosDeVenta), '?'));

            // Consultar ventas originales
            $query = $db->prepare("SELECT * FROM ventas WHERE No_venta IN ($placeholders)");
            $query->execute($numerosDeVenta);
            $ventasOriginales = $query->fetchAll(PDO::FETCH_ASSOC);

            foreach ($ventasOriginales as $venta) {
                $producto = new Producto();
                $producto->setCodigo($venta['Codigo_pro']);
                $productoActual = $producto->consultarCodigo($venta['Codigo_pro']);
                $nuevoStock = $productoActual['Stock'] + $venta['Cantidad'];
                $producto->setStock($nuevoStock);
                $producto->actualizarStockDirecto();
            }

            // Eliminar ventas originales
            $deleteQuery = $db->prepare("DELETE FROM ventas WHERE No_venta IN ($placeholders)");
            $deleteQuery->execute($numerosDeVenta);
        }

        // -------------------------
        // 3. Insertar ventas nuevas
        // -------------------------
        foreach ($ventasPorNumero as $numVenta => $filas) {
            foreach ($filas as $fila) {
                $producto = new Producto();
                $producto->setCodigo($fila['codigo']);
                $productoActual = $producto->consultarCodigo($fila['codigo']);

                if ($productoActual['Stock'] >= $fila['cantidad']) {
                    $nuevoStock = $productoActual['Stock'] - $fila['cantidad'];
                    $producto->setStock($nuevoStock);
                    $producto->actualizarStockDirecto();

                    $venta = new Ventas();
                    $venta->setFeca_venta($fila['fecha']);
                    $venta->setId_vendedor($fila['vendedor']);
                    $venta->setNo_venta($numVenta);
                    $venta->setCliente_id($fila['cliente']);
                    $venta->setCodigo_pro($fila['codigo']);
                    $venta->setCantidad($fila['cantidad']);
                    $venta->setPrecio_al_dia($fila['precio']);
                    $venta->setTipo_pago($fila['pago']);
                    $venta->setHora_venta(date('H:i:s')); // Hora actual
                    $venta->guardar();
                } else {
                    exit("ERROR: No hay suficiente stock para el producto con código " . $fila['codigo']);
                }
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
