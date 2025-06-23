<?php
//******ALTA USUARIO ESTUDIANTE (RF-07)
include_once 'connection.php';
class Producto extends DB {
	private $codigo;
	private $nombre;
	private $descripcion;
	private $stock;
	private $fecha_caducidad;
	private $fecha_registro;
	private $costo;
	private $precio;
	private $codigo_actual; // Para actualizar el producto


	//stters and getters ***********************************************
	public function setCodigo($codigo){ $this->codigo = $codigo; }
	public function setNombre($nombre){ $this->nombre = $nombre; }
	public function setDescripcion($descripcion){ $this->descripcion = $descripcion; }
	public function setStock($stock){ $this->stock = $stock; }
	public function setFecha_Caducidad($fecha_caducidad){ $this->fecha_caducidad = $fecha_caducidad; }
	public function setFecha_Registro($fecha_registro){ $this->fecha_registro = $fecha_registro; }
	public function setCosto($costo){ $this->costo = $costo; }
	public function setPrecio($precio){ $this->precio = $precio; }
	public function setCodigoActual($codigo_actual){ $this->codigo_actual = $codigo_actual; }

	public function getCodigo(){return $this->codigo; }
	public function getNombre(){return $this->nombre; }
	public function getDescripcion(){return $this->descripcion; }
	public function getStoc(){return $this->stock; }
	public function getfecha_Caducidad(){return $this->fecha_caducidad; }
	public function getFecha_Registro(){return $this->fecha_registro; }
	public function getCosto(){return $this->costo; }
	public function getPrecio(){return $this->precio; }

	//******************************************************************

	public function listar(){
		$query = $this->connect()->prepare('SELECT * FROM productos');
		$query->execute();
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}




	public function consulta($sql){
		$query = $this->connect()->prepare($sql);
		$query->execute();
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

	public function consultarCodigo($codigo){
		$query = $this->connect()->prepare('SELECT * FROM productos WHERE Codigo = :user');
		$query->execute(['user' => $codigo]);
		return $query->fetch(PDO::FETCH_ASSOC);
	}

	
//elimina taller por id del taller
	public function eliminar($codigo){
		$query = $this->connect()->prepare('DELETE FROM taller WHERE id = :user');
		$query->execute(['user' => $codigo]);
	}


	public function actualizar(){
		$sql = "UPDATE productos SET 
			Codigo = :codigo_nuevo, 
			Nombre = :nombre, 
			Descripcion = :descripcion, 
			Stock = :stock, 
			Fecha_Caducidad = :fecha_caducidad, 
			Fecha_Registro = :fecha_registro, 
			Costo = :costo, 
			Precio = :precio	
			WHERE Codigo = :codigo_actual";
		
		$query = $this->connect()->prepare($sql);
		$query->execute([
			'codigo_nuevo' => $this->codigo,
			'nombre' => $this->nombre,
			'descripcion' => $this->descripcion,
			'stock' => $this->stock,
			'fecha_caducidad' => $this->fecha_caducidad,
			'fecha_registro' => $this->fecha_registro,
			'costo' => $this->costo,
			'precio' => $this->precio,
			'codigo_actual' => $this->codigo_actual,
		]);
	}
	

	public function guardar() {
		$sql = "INSERT INTO productos (Codigo, Nombre, Descripcion, Stock, Fecha_Caducidad, Fecha_Registro, Costo, Precio) VALUES(:codigo, :nombre, :descripcion, :stock, :fecha_caducidad , :fecha_registro_p, :costo, :precio)";
		$query = $this->connect()->prepare($sql);
		$query->execute([
			'codigo' => $this->codigo,
			'nombre' => $this->nombre,
			'descripcion' => $this->descripcion,
			'stock' => $this->stock,
			'fecha_caducidad' => $this->fecha_caducidad,
			'fecha_registro_p' => $this->fecha_registro,
			'costo' => $this->costo,
		   'precio' => $this->precio]);
	}


	public function actualizarStock() {
    // Consultar el stock actual
    $query = $this->connect()->prepare('SELECT Stock FROM productos WHERE Codigo = :codigo');
    $query->execute(['codigo' => $this->codigo]);
    $resultado = $query->fetch(PDO::FETCH_ASSOC);

    if ($resultado) {
        $stockActual = $resultado['Stock'];

        // Validación: No permitir vender más de lo disponible
        if ($this->stock > $stockActual) {
            return false; // Venta inválida, no hay suficiente stock
        }

        $nuevoStock = $stockActual - $this->stock;

        // Actualizar el stock
        $update = $this->connect()->prepare('UPDATE productos SET Stock = :stock WHERE Codigo = :codigo');
        $update->execute(['stock' => $nuevoStock, 'codigo' => $this->codigo]);

        return true; // Actualización exitosa
    }

    return false; // Producto no encontrado
}

	
}

?>
