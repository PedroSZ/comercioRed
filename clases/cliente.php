<?php
//******ALTA USUARIO CLIENTE (RF-07)
include_once 'connection.php';
class Cliente extends DB {
	private $id_cliente;
	private $rfc;
	private $nombre;
	private $a_paterno;
    private $a_materno;
	private $fecha_registro;
	private $fecha_nacimiento;
    private $telefono;
    private $email;
    private $domicilio;
	private $limite_credito;
	private $credito_usado;


	//stters and getters ***********************************************
	public function setCliente($id_cliente){ $this->id_cliente = $id_cliente; }
    public function setRfc($rfc){ $this->rfc = $rfc; }
	public function setNombre($nombre){ $this->nombre = $nombre; }
	public function setA_paterno($a_paterno){ $this->a_paterno = $a_paterno; }
    public function setA_materno($a_materno){ $this->a_materno = $a_materno; }
	public function setFecha_registro($fecha_registro){ $this->fecha_registro = $fecha_registro; }
	public function setFecha_nacimiento($fecha_nacimiento){ $this->fecha_nacimiento = $fecha_nacimiento; }
	public function setTelefono($telefono){ $this->telefono = $telefono; }
    public function setEmail($email){ $this->email = $email; }
    public function setDomicilio($domicilio){ $this->domicilio = $domicilio; }
	public function setLimite_credito($limite_credito){ $this->limite_credito = $limite_credito; }
	public function setCredito_usado($credito_usado){ $this->credito_usado = $credito_usado; }


	public function getCliente(){ return $this->id_cliente; }
    public function getRfc(){ return $this->rfc; }
	public function getNombre(){ return $this->nombre; }
	public function getA_paterno(){ return $this->a_paterno; }
    public function getA_materno(){ return $this->a_materno; }
	public function getFecha_registro(){ return $this->fecha_registro; }
	public function getFecha_nacimiento(){ return $this->fecha_nacimiento; }
	public function getTelefono(){ return $this->telefono; }
    public function getEmail(){ return $this->email; }
    public function getDomicilio(){ return $this->domicilio; }
	public function getLimite_credito(){ return $this->limite_credito; }
	public function getCredito_usado(){ return $this->credito_usado; }
	//******************************************************************

	public function listar(){
		$query = $this->connect()->prepare('SELECT * FROM cliente');
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



	public function consultarCodigo($codigo){
		$query = $this->connect()->prepare('SELECT * FROM estudiante WHERE curp = :user');
		$query->execute(['user' => $codigo]);
		return $query->fetch(PDO::FETCH_ASSOC);
	}

	public function consultarEmail($email){
		$query = $this->connect()->prepare('SELECT * FROM cliente WHERE Email = :user');
		$query->execute(['user' => $email]);
		return $query->fetch(PDO::FETCH_ASSOC);
	}

	public function eliminar($codigo){
		$query = $this->connect()->prepare('DELETE FROM estudiante WHERE curp = :user');
		$query->execute(['user' => $codigo]);
	}

	public function actualizar(){
		$sql = "UPDATE estudiante SET nombre = :nombre, apellidos = :apellidos, carrera = :carrera, grado = :grado, grupo = :grupo	WHERE curp = :codigo";
		$query = $this->connect()->prepare($sql);
		$query->execute([
			'codigo' => $this->codigo,
			'nombre' => $this->nombre,
			'apellidos' => $this->apellidos,
			'carrera' => $this->carrera,
			'grado' => $this->grado,
			'grupo' => $this->grupo]);
	}







public function guardar() {
	echo "aqui entramos a la funcion guardar";
		try{
			
		$sql = "INSERT INTO cliente (Rfc, Nombre, A_paterno, A_Materno, Fecha_Registro, Fecha_Nacimiento, Telefono, Email, Domicilio, Limite_Credito, Credito_Usado) VALUES(:rfc, :nombre, :a_paterno, :a_materno, :fecha_registro, :fecha_nacimiento, :telefono, :email, :domicilio, :limite_credito, :credito_usado)";
		$query = $this->connect()->prepare($sql);
		$query->execute([
			'rfc' => $this->rfc,
			'nombre' => $this->nombre,
			'a_paterno' => $this->a_paterno,
			'a_materno' => $this->a_materno,
			'fecha_registro' => $this->fecha_registro,
			'fecha_nacimiento' => $this->fecha_nacimiento,
			'telefono' => $this->telefono,
			'email' => $this->email,
			'domicilio' => $this->domicilio,
			'limite_credito' => $this->limite_credito,
			'credito_usado' => $this->credito_usado
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