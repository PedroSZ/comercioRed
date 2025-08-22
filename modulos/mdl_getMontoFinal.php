<?php
include_once '../clases/corte_caja.php';
include_once '../clases/sesion.php';

session_start();

$id_corte = $_GET['id_corte'] ?? 0;
$corte = new CorteCaja();

$query = $corte->connect()->prepare("
    SELECT Monto_Inicial, Monto_Final, Fecha_Corte, Hora_Inicial 
    FROM corte_caja 
    WHERE Id_Corte = :id_corte LIMIT 1
");
$query->execute(['id_corte' => $id_corte]);
$caja = $query->fetch(PDO::FETCH_ASSOC);

if ($caja) {
    // Calcular total ventas
    $ventasQuery = $corte->connect()->prepare("
        SELECT SUM(Precio_al_dia * Cantidad) as total 
        FROM ventas 
        WHERE Fecha_Venta = :fecha
        AND (Hora_Venta BETWEEN :hora_inicio AND '23:59:59')
    ");
    $ventasQuery->execute([
        'fecha' => $caja['Fecha_Corte'],
        'hora_inicio' => $caja['Hora_Inicial']
    ]);
    $totalVentas = $ventasQuery->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;

    echo json_encode([
        'monto_inicial' => $caja['Monto_Inicial'],
        'total_ventas' => $totalVentas,
        'monto_final' => $caja['Monto_Final']
    ]);
} else {
    echo json_encode([
        'monto_inicial' => 0,
        'total_ventas' => 0,
        'monto_final' => 0
    ]);
}
