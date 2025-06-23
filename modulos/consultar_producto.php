<?php
include_once '../clases/producto.php';

if (isset($_POST['codigoPro'])) {
    $codigo = $_POST['codigoPro'];
    $produ = new Producto();
    $item = $produ->consultarCodigo($codigo);
    
    echo json_encode($item);
}
?>