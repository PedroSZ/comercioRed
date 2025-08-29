<?php
include_once '../clases/venta.php';
include_once '../clases/producto.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $no_venta = $_POST['no_venta'];
    $codigo = $_POST['codigo'];
    $cantidad = intval($_POST['cantidad']);

    $venta = new Ventas();
    $producto = new Producto();

    // 1. Eliminar el producto de la venta
    $resultado = $venta->eliminarProductoDeVenta($no_venta, $codigo);

    if ($resultado) {
        // 2. Devolver cantidad al stock
        $producto->sumarStock($codigo, $cantidad);

        echo json_encode([
            "success" => true,
            "mensaje" => "Producto eliminado de la venta y stock actualizado."
        ]);
    } else {
        echo json_encode([
            "success" => false,
            "mensaje" => "Error al eliminar el producto."
        ]);
    }
}
?>
