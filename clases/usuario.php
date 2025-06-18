<?php
//******ALTA USUARIO ESTUDIANTE (RF-07)
include_once 'connection.php';
class Usuario extends DB {
	private $id_usuario;
	private $id_tipo;
	private $rfc;
	private $nombre;
	private $a_paterno;
    private $a_materno;
	private $fecha_registro;
	private $fecha_nacimiento;
    private $telefono;
    private $email;
    private $domicilio;


	//stters and getters ***********************************************
	public function setIdusuario($id_usuario){ $this->id_usuario = $id_usuario; }
	public function setIdtipo($id_tipo){ $this->id_tipo = $id_tipo; }
    public function setRfc($rfc){ $this->rfc = $rfc; }
	public function setNombre($nombre){ $this->nombre = $nombre; }
	public function setA_paterno($a_paterno){ $this->a_paterno = $a_paterno; }
    public function setA_materno($a_materno){ $this->a_materno = $a_materno; }
	public function setFecha_registro($fecha_registro){ $this->fecha_registro = $fecha_registro; }
	public function setFecha_nacimiento($fecha_nacimiento){ $this->fecha_nacimiento = $fecha_nacimiento; }
	public function setTelefono($telefono){ $this->telefono = $telefono; }
    public function setEmail($email){ $this->email = $email; }
    public function setDomicilio($domicilio){ $this->domicilio = $domicilio; }
	//public function setEstadoTaller($estado){ $this->estadotaller = $estadotaller; }


	public function getIdusuario(){ return $this->id_usuario; }
	public function getIdtipo(){ return $this->id_tipo; }
    public function getRfc(){ return $this->rfc; }
	public function getNombre(){ return $this->nombre; }
	public function getA_paterno(){ return $this->a_paterno; }
    public function getA_materno(){ return $this->a_materno; }
	public function getFecha_registro(){ return $this->fecha_registro; }
	public function getFecha_nacimiento(){ return $this->fecha_nacimiento; }
	public function getTelefono(){ return $this->telefono; }
    public function getEmail(){ return $this->email; }
    public function getDomicilio(){ return $this->domicilio; }
	//public function getEstadoTaller(){return $this->estadotaller; }

	//******************************************************************

	public function listar(){
		$query = $this->connect()->prepare('SELECT * FROM usuario INNER JOIN tipo_usuario WHERE usuario.Id_Tipo = tipo_usuario.Usuario_id');
		$query->execute();
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

	public function listarConsultaCompleta(){
		$query = $this->connect()->prepare('SELECT estudiante.curp,
			estudiante.nombre as nomest,
			estudiante.apellidos,
			estudiante.carrera,
			estudiante.grado,
			estudiante.grupo,
			taller.nombre as tallnom,
			taller.area,
			taller.horario
			FROM estudiante
			LEFT join estudiante_por_taller on estudiante.curp = estudiante_por_taller.estudiante
			left join taller on estudiante_por_taller.taller = taller.id');
					$query->execute();
					return $query->fetchAll(PDO::FETCH_ASSOC);
				}



	public function consultarId($id_usuario){
		$query = $this->connect()->prepare('SELECT * FROM usuario INNER JOIN tipo_usuario ON Usuario.Id_Usuario = tipo_usuario.Usuario_id WHERE Id_Usuario = :user');
		$query->execute(['user' => $id_usuario]);
		return $query->fetch(PDO::FETCH_ASSOC);
	}

	public function consultarEmail($email){
		$query = $this->connect()->prepare('SELECT * FROM usuario WHERE Email = :user');
		$query->execute(['user' => $email]);
		return $query->fetch(PDO::FETCH_ASSOC);
	}

	public function eliminar($codigo){
		$query = $this->connect()->prepare('DELETE FROM estudiante WHERE curp = :user');
		$query->execute(['user' => $codigo]);
	}

	public function actualizar(){
		$sql = "UPDATE usuario SET Id_Usuario = :nuevo_id, Id_Tipo = :id_tipo, Rfc = :rfc, 
			Nombre = :nombre, A_paterno = :a_paterno, A_Materno = :a_materno, 
			Fecha_Registro = :fecha_registro, Fecha_Nacimiento = :fecha_nacimiento, 
			Telefono = :telefono, Email = :email, Domicilio = :domicilio WHERE Id_Usuario = :id_actual";
		$query = $this->connect()->prepare($sql);
		$query->execute([
    'nuevo_id' => $this->id_usuario,  // nuevo valor (si cambia)
    'id_actual' => $this->id_usuario, // identificador original
    'id_tipo' => $this->id_tipo,
    'rfc' => $this->rfc,
    'nombre' => $this->nombre,
    'a_paterno' => $this->a_paterno,
    'a_materno' => $this->a_materno,
    'fecha_registro' => $this->fecha_registro,
    'fecha_nacimiento' => $this->fecha_nacimiento,
    'telefono' => $this->telefono,
    'email' => $this->email,
    'domicilio' => $this->domicilio
  		  ]);	
  	}







public function guardar() {
	echo "aqui entramos a la funcion guardar";
		try{
			
		$sql = "INSERT INTO usuario (Id_tipo, Rfc, Nombre, A_paterno, A_Materno, Fecha_Registro, Fecha_Nacimiento, Telefono, Email, Domicilio) VALUES(:id_tipo, :rfc, :nombre, :a_paterno, :a_materno, :fecha_registro, :fecha_nacimiento, :telefono, :email, :domicilio)";
		$query = $this->connect()->prepare($sql);
		$query->execute([
			'id_tipo' => $this->id_tipo,
			'rfc' => $this->rfc,
			'nombre' => $this->nombre,
			'a_paterno' => $this->a_paterno,
			'a_materno' => $this->a_materno,
			'fecha_registro' => $this->fecha_registro,
			'fecha_nacimiento' => $this->fecha_nacimiento,
			'telefono' => $this->telefono,
			'email' => $this->email,
			'domicilio' => $this->domicilio
		]);
		//echo "$query";
		//$query->execute();
}catch (Exception $e){
	 echo 'el usuario que quieres registrar ya se encuentra registrado en la base de datos: '.$e->getMessage()."\n";
}
	}

	/*public function guardar() {
		$sql = "INSERT INTO estudiante (curp, nombre, apellidos, carrera, grado, grupo) VALUES(:codigo, :nombre, :apellidos, :carrera, :grado, :grupo)";
		$query = $this->connect()->prepare($sql);
		$query->execute([
			'codigo' => $this->codigo,
			'nombre' => $this->nombre,
			'apellidos' => $this->apellidos,
			'carrera' => $this->carrera,
			'grado' => $this->grado,
			'grupo' => $this->grupo]);
	}*/
}

?>