<?php
include_once '../clases/producto.php';

header('Content-Type: application/json');

if (isset($_POST['codigo']) && isset($_POST['stock'])) {
    $codigo = $_POST['codigo'];
    $stock = $_POST['stock'];

    $producto = new Producto();
    $producto->setCodigo($codigo);
    $producto->setStock($stock);
    $producto->actualizarStockDirecto(); // Usamos tu método directo

    echo json_encode(['success' => true]);
} else {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
}
?>
