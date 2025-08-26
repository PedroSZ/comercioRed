<?php
include_once 'connection.php';

class CorteCaja extends DB {
    private $id_corte;
    private $id_usuario;
    private $fecha_corte;
    private $monto_inicial;
    private $monto_final;
    private $hora_inicial;
    private $hora_final;

    // === Abrir caja ===
    public function abrirCaja($id_usuario, $monto_inicial) {
        // Verificar si ya hay caja abierta
        if ($this->cajaAbierta($id_usuario)) {
            return false;
        }

        $fecha = date("Y-m-d");
        $hora = date("H:i:s");

        $query = $this->connect()->prepare("
            INSERT INTO corte_caja 
            (Id_Usuario, Fecha_Corte, Monto_Inicial, Hora_Inicial, Monto_Final, Hora_Final) 
            VALUES (:usuario, :fecha, :monto_inicial, :hora_inicial, 0, '00:00:00')
        ");

        return $query->execute([
            'usuario' => $id_usuario,
            'fecha' => $fecha,
            'monto_inicial' => $monto_inicial,
            'hora_inicial' => $hora
        ]);
    }

    // === Cerrar caja ===
    public function cerrarCaja($id_corte, $id_usuario) {
        // 1. Obtener datos de la caja abierta
        $query = $this->connect()->prepare("
            SELECT Hora_Inicial, Fecha_Corte, Monto_Inicial 
            FROM corte_caja 
            WHERE Id_Corte = :id_corte AND Id_Usuario = :usuario LIMIT 1
        ");
        $query->execute([
            'id_corte' => $id_corte,
            'usuario' => $id_usuario
        ]);
        $caja = $query->fetch(PDO::FETCH_ASSOC);

        if (!$caja) return false;

        $hora_inicial = $caja['Hora_Inicial'];
        $fecha = $caja['Fecha_Corte'];
        $monto_inicial = $caja['Monto_Inicial'];
        $hora_final = date("H:i:s");

        // 2. Calcular ventas con desglose: subtotal, descuentos, IVA y total neto
$ventasQuery = $this->connect()->prepare("
    SELECT 
        SUM(v.Precio_al_dia * v.Cantidad) AS subtotal,
        SUM((v.Precio_al_dia * v.Cantidad) * IFNULL(d.Descuento,0) / 100) AS total_descuento,
        SUM(
            ((v.Precio_al_dia * v.Cantidad) - (v.Precio_al_dia * v.Cantidad * IFNULL(d.Descuento,0)/100)) 
            * IFNULL(d.Iva,0) / 100
        ) AS total_iva,
        SUM(
            (v.Precio_al_dia * v.Cantidad) 
            - ((v.Precio_al_dia * v.Cantidad) * IFNULL(d.Descuento,0) / 100)
            + (((v.Precio_al_dia * v.Cantidad) - (v.Precio_al_dia * v.Cantidad * IFNULL(d.Descuento,0)/100)) * IFNULL(d.Iva,0) / 100)
        ) AS total_neto
    FROM ventas v
    LEFT JOIN descuentos d ON v.No_venta = d.No_venta
    WHERE v.Id_Vendedor = :usuario
    AND v.Fecha_Venta = :fecha
    AND (v.Hora_Venta BETWEEN :hora_inicial AND :hora_final)
");
$ventasQuery->execute([
    'usuario' => $id_usuario,
    'fecha' => $fecha,
    'hora_inicial' => $hora_inicial,
    'hora_final' => $hora_final
]);

$ventas = $ventasQuery->fetch(PDO::FETCH_ASSOC);

// Si no hay ventas, inicializamos en 0
$subtotal       = $ventas['subtotal'] ?? 0;
$totalDescuento = $ventas['total_descuento'] ?? 0;
$totalIva       = $ventas['total_iva'] ?? 0;
$totalNeto      = $ventas['total_neto'] ?? 0;

// Calcular monto final en caja
$monto_final = $monto_inicial + $totalNeto;

        // 3. Guardar cierre de caja
       // 3. Guardar cierre de caja con desglose
$update = $this->connect()->prepare("
    UPDATE corte_caja 
    SET Subtotal = :subtotal,
        Total_Descuento = :total_descuento,
        Total_Iva = :total_iva,
        Monto_Final = :monto_final,
        Hora_Final = :hora_final
    WHERE Id_Corte = :id_corte
");
$update->execute([
    'subtotal'        => $subtotal,
    'total_descuento' => $totalDescuento,
    'total_iva'       => $totalIva,
    'monto_final'     => $monto_final,
    'hora_final'      => $hora_final,
    'id_corte'        => $id_corte
]);


        // 4. Devolver la info lista para usar en JSON
       return [
    "monto_inicial"   => $monto_inicial,
    "subtotal"        => $subtotal,
    "total_descuento" => $totalDescuento,
    "total_iva"       => $totalIva,
    "total_ventas"    => $totalNeto,   // este será el neto
    "monto_final"     => $monto_final,
    "hora_inicial"    => $hora_inicial,
    "hora_final"      => $hora_final,
    "fecha"           => $fecha
];

    }

    // === Revisar si hay caja abierta ===
    public function cajaAbierta($id_usuario) {
        $query = $this->connect()->prepare("
            SELECT * FROM corte_caja 
            WHERE Id_Usuario = :usuario AND Hora_Final = '00:00:00' LIMIT 1
        ");
        $query->execute(['usuario' => $id_usuario]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }
}
?>