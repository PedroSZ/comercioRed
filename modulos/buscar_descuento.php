<?php
include_once '../clases/connection.php';

if (isset($_POST['no_venta'])) {
    $noVenta = $_POST['no_venta'];
    
    $db = new DB();
    $query = $db->connect()->prepare('SELECT * FROM descuentos WHERE No_venta = :no_venta');
    $query->execute(['no_venta' => $noVenta]);
    $descuento = $query->fetch(PDO::FETCH_ASSOC);

    if ($descuento) {
        echo json_encode([
            'descuento' => $descuento['Descuento'],
          
        ]);
    } else {
        // Si no existe descuento, enviamos valores en cero.
        echo json_encode([
            'descuento' => 0,
            
        ]);
    }
}
?>