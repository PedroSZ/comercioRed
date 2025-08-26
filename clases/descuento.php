<?php
include_once 'connection.php';
class Descuento extends DB {
    private $id_descuento;
    private $id_de_cliente;
    private $no_venta;
    private $descuento;
    private $iva;

   public function setCodigo($id_descuento){ $this->id_descuento = $id_descuento; }
   public function setIdCliente($id_de_cliente){ $this->id_de_cliente = $id_de_cliente; }
   public function setNoVenta($no_venta){ $this->no_venta = $no_venta; }
   public function setDescuento($descuento){ $this->descuento = $descuento; }  
   public function setIva($iva){ $this->iva = $iva; }

    public function getCodigo(){ return $this->id_descuento; }
    public function getIdCliente(){ return $this->id_de_cliente; }
    public function getNoVenta(){ return $this->no_venta; }
    public function getDescuento(){ return $this->descuento; }
    public function getIva(){ return $this->iva; }  
   

       public function guardar() {
        $sql = "INSERT INTO descuentos (Id_De_Cliente, No_venta, Descuento, Iva) VALUES (:cliente_id, :no_venta, :descuento, :iva)";
        $query = $this->connect()->prepare($sql);
        $query->execute([
            'cliente_id' => $this->cliente_id,
            'no_venta' => $this->no_venta,
            'descuento' => $this->descuento,
            'iva' => $this->iva
        ]);
    }


}
?>