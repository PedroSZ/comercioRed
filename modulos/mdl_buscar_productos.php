<?php
include_once '../clases/producto.php';

if (isset($_POST['query'])) {
    $busqueda = trim($_POST['query']);

    $producto = new Producto();
    $query = "SELECT * FROM productos WHERE Codigo LIKE :busqueda OR Nombre LIKE :busqueda LIMIT 10";
    $resultados = $producto->consulta($query, ['busqueda' => $busqueda . '%']);

    if ($resultados) {
        echo json_encode($resultados);
    } else {
        echo json_encode([]);
    }
} else {
    echo json_encode([]);
}



?>
