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


//consulta el ultimo registro en el taller
	public function ultimoRegistro(){
		$query = $this->connect()->prepare('SELECT MAX(id) as registro from taller');
		$query->execute();
		return $query->fetch();

	}

//obtener taller por instructo
	public function obtenerMiTaller($codigo){
		$query = $this->connect()->prepare('SELECT id from taller WHERE instructor = :user');
		$query->execute(['user' => $codigo]);
		return $query->fetch();

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

	public function consultarTaller($codigo){
		$sql='SELECT * FROM taller WHERE instructor = "'.$codigo.'"';
		//echo $sql;
		$query = $this->connect()->prepare($sql);
		$query->execute();
		return $query->fetch(PDO::FETCH_ASSOC);
	}

	public function consultarSupervisorPorInstructor($instructor){
		$query = $this->connect()->prepare('SELECT supervisor from taller
INNER JOIN estudiante_por_taller on taller.id = estudiante_por_taller.taller where estudiante = :user');
		$query->execute(['user' => $instructor]);
		return $query->fetch(PDO::FETCH_ASSOC);
	}

	public function consultarTallerActual($codigo){
		$query = $this->connect()->prepare('SELECT instructor.clave as claveInst, instructor.nombre as nombreInst, instructor.apellidos as apellidosInst, docente_supervisor.rfc as rfcSup, docente_supervisor.nombre as nombreSup, docente_supervisor.apellidos as apellidosSup  from taller INNER join instructor on instructor.clave = taller.instructor
INNER JOIN docente_supervisor on docente_supervisor.rfc = taller.supervisor
where id = :user');
		$query->execute(['user' => $codigo]);
		return $query->fetch(PDO::FETCH_ASSOC);
	}

//elimina taller por id del taller
	public function eliminar($codigo){
		$query = $this->connect()->prepare('DELETE FROM taller WHERE id = :user');
		$query->execute(['user' => $codigo]);
	}

//elimina taller por instructor
	public function eliminarPorInstructor($instructor){
		$query = $this->connect()->prepare('DELETE FROM taller WHERE instructor = :user');
		$query->execute(['user' => $instructor]);
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

	public function guardarSolicitado() {
		$sql = "INSERT INTO taller (id, nombre, area, horario, instructor, estado) VALUES(:codigo, :nombre, :area :horario, :instructor, :estado)";
		//echo $sql;
		$query = $this->connect()->prepare($sql);
		$query->execute([
				'codigo' => $this->codigo,
			'nombre' => $this->nombre,
			'area' => $this->area,
			'horario' => $this->horario,
			'instructor' => $this->instructor,
			 'estado' => $this->estado]);
	}
}

?>
