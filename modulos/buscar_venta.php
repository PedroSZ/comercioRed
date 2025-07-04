<?php
include_once '../clases/venta.php';

if (isset($_POST['no_venta'])) {
    $noVenta = $_POST['no_venta'];
    $venta = new Ventas();
    $datos = $venta->consultarPorNoVenta($noVenta);

    echo json_encode($datos);
}
?>