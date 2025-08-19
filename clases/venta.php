<?php
//******ALTA USUARIO ESTUDIANTE (RF-07)
include_once 'connection.php';
class Ventas extends DB {
	private $id_venta;
	private $codigo_pro;
	private $id_vendedor;
	private $cliente_id;
	private $feca_venta;
	private $no_venta;
	private $cantidad;
	private $precio_al_dia;
	private $tipo_pago;


	//stters and getters ***********************************************
	public function setId_venta($id_venta){ $this->id_venta = $id_venta; }
    public function setCodigo_pro($codigo_pro){ $this->codigo_pro = $codigo_pro; }
    public function setId_vendedor($id_vendedor){ $this->id_vendedor = $id_vendedor; }
    public function setCliente_id($cliente_id){ $this->cliente_id = $cliente_id; }
    public function setFeca_venta($feca_venta){ $this->feca_venta = $feca_venta; }
	public function setNo_venta($no_venta){ $this->no_venta = $no_venta; }
    public function setCantidad($cantidad){ $this->cantidad = $cantidad; }
    public function setPrecio_al_dia($precio_al_dia){ $this->precio_al_dia = $precio_al_dia; }
    public function setTipo_pago($tipo_pago){ $this->tipo_pago = $tipo_pago; }
	

	public function getId_venta(){return $this->id_venta; }
    public function getCodigo_pro(){return $this->codigo_pro; }
    public function getId_vendedor(){return $this->id_vendedor; }
    public function getCliente_id(){return $this->cliente_id; }
    public function getFeca_venta(){return $this->feca_venta; }
	public function getNo_venta(){return $this->no_venta; }
    public function getCantidad(){return $this->cantidad; }
    public function getPrecio_al_dia(){return $this->precio_al_dia; }
    public function getTipo_pago(){return $this->tipo_pago; }

	//******************************************************************
    public function consultarUltimo(){
		$query = $this->connect()->prepare('SELECT MAX(No_venta) FROM ventas;');
		$query->execute();
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}


	public function guardar() {
    $sql = "INSERT INTO ventas (Codigo_pro, Id_Vendedor, Cliente_Id, Fecha_Venta, No_venta, Cantidad, Precio_al_dia, Tipo_Pago)
            VALUES (:codigo_producto, :id_vendedor, :cliente_id, :fecha_venta, :no_venta, :cantidad, :precio_al_dia, :tipo_pago)";
    
    $query = $this->connect()->prepare($sql);
    $query->execute([
        'codigo_producto' => $this->codigo_pro,
        'id_vendedor'     => $this->id_vendedor,
        'cliente_id'      => $this->cliente_id,
        'fecha_venta'     => $this->feca_venta,
        'no_venta'        => $this->no_venta,
        'cantidad'        => $this->cantidad,
        'precio_al_dia'   => $this->precio_al_dia,
        'tipo_pago'       => $this->tipo_pago
    ]);
}

public function consultarPorNoVenta($noVenta) {
    $query = $this->connect()->prepare('SELECT * FROM ventas WHERE No_venta = :no_venta');
    $query->execute(['no_venta' => $noVenta]);
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

public function eliminarVenta($noVenta) {
    $query = $this->connect()->prepare('DELETE FROM ventas WHERE No_venta = :no_venta');
    $query->execute(['no_venta' => $noVenta]);
}


 public function consultarDatosVenta(){
		$query = $this->connect()->prepare('SELECT 
    v.Id_Venta,
    v.No_venta,
    v.Fecha_Venta,
    -- Datos del vendedor
    u.Nombre AS Vendedor_Nombre,
    u.A_paterno AS Vendedor_ApellidoP,
    u.A_Materno AS Vendedor_ApellidoM,
    -- Datos del cliente
    c.Nombre AS Cliente_Nombre,
    c.A_paterno AS Cliente_ApellidoP,
    c.A_Materno AS Cliente_ApellidoM,
    -- Datos del producto
    p.Nombre AS Producto,
    p.Descripcion,
    v.Cantidad,
    v.Precio_al_dia,
    -- Descuento (si existe)
    IFNULL(d.Descuento, 0) AS Descuento,
    v.Tipo_Pago
FROM ventas v
INNER JOIN usuario u ON v.Id_Vendedor = u.Id_Usuario
INNER JOIN cliente c ON v.Cliente_Id = c.Id_cliente
INNER JOIN productos p ON v.Codigo_pro = p.Codigo
LEFT JOIN descuentos d ON v.No_venta = d.No_venta AND v.Cliente_Id = d.Id_De_cliente;');
		$query->execute();
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}



}

?>
