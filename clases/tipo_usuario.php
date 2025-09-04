<?php
include_once 'connection.php';
class Tipo_Usuario extends DB{
    private $usuario_id; 
    private $usuario;
    private $pasword;
    private $puesto;
    private $estatus_u;
    private $configuracion;
   
    
    //stters and getters ***********************************************
    public function setUsuario_id($usuario_id){ $this->usuario_id = $usuario_id; }
    public function setUsuario($usuario){ $this->usuario = $usuario; }
    public function setPasword($pasword){ $this->pasword = $pasword; } 
    public function setPuesto($puesto){ $this->puesto = $puesto; }
    public function setEstatus_u($estatus_u){ $this->estatus_u = $estatus_u; }
    public function setConfiguracion($configuracion){ $this->configuracion = $configuracion; }
    //******************************************************************    
    public function getUsuario_id(){ return $this->usuario_id; }
    public function getUsuario(){ return $this->usuario; }
    public function getPasword(){ return $this->pasword; }
    public function getPuesto(){ return $this->puesto; }
    public function getEstatus_u(){ return $this->estatus_u; }
    public function getConfiguracion(){ return $this->configuracion; }
    //******************************************************************


    public function verificarPsw($user, $pass){
        $md5pass = md5($pass);
        $query = $this->connect()->prepare('SELECT * FROM tipo_usuario WHERE Usuario = :user AND Pasword = :pass');
        $query->execute(['user' => $user, 'pass' => $md5pass]);
        if($query->rowCount()){
            return true;
        }else{
            return false;
        }
    }

     
    public function consultarCodigo($codigo){
  		$query = $this->connect()->prepare('SELECT * FROM tipo_usuario WHERE Usuario = :user');
  		$query->execute(['user' => $codigo]);
  		return $query->fetch(PDO::FETCH_ASSOC);
  	}

     public function consultarUltimoCodigo() {
    $query = $this->connect()->prepare('SELECT MAX(Usuario_id) AS id FROM tipo_usuario');
    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC);
}
//SELECT nombre FROM tipo_usuario INNER JOIN usuario ON tipo_usuario.usuario_id = usuario.Id_Usuario WHERE Usuario_id = 1;
     public function consultarNombre($user){
  		$query = $this->connect()->prepare('SELECT nombre FROM tipo_usuario INNER JOIN usuario ON tipo_usuario.usuario_id = usuario.Id_Usuario WHERE Usuario_id = :user');
  		$query->execute(['user' => $user]);
  		return $query->fetch(PDO::FETCH_ASSOC);
  	}

     public function establecerDatos($user){
        $query = $this->connect()->prepare('SELECT * FROM tipo_usuario WHERE Usuario = :user');
        $query->execute(['user' => $user]);
        foreach ($query as $currentUser) {
           $this->usuario_id = $currentUser['Usuario_Id'];
           $this->usuario =$currentUser['Usuario'];
            $this->pasword = $currentUser['Pasword'];
            $this->puesto = $currentUser['Puesto'];
            $this->estatus_u = $currentUser['Estatus_u'];
            $this->configuracion = $currentUser['configuracion'];

        }
    }

    public function eliminarTipoUsuario($usuario_id){
        $query = $this->connect()->prepare('DELETE FROM tipo_usuario WHERE Usuario_id = :user');
        $query->execute(['user' => $usuario_id]);
    }

    public function guardar(){
        $sql = "INSERT INTO tipo_usuario (Usuario, Pasword, Puesto, Estatus_u, configuracion) VALUES(:usuario, :psw, :tipo, 1, :configuracion)";
        $query = $this->connect()->prepare($sql);
        $query->execute([
            'usuario' => $this->usuario,
            'psw' => $this->pasword,
            'tipo' => $this->puesto,
            'configuracion' => $this->configuracion]);
    }

	public function actualizar(){
		$sql = "UPDATE tipo_usuario SET pasword = :pasworD, puesto = :puestO, usuario = :usuariO, Estatus_u = :estatus_u WHERE Usuario_id = :usuario_ID";
		$query = $this->connect()->prepare($sql);
		$query->execute([
			'usuario_ID' => $this->usuario_id,
            'usuariO' => $this->usuario,    
            'pasworD' => $this->pasword,
            'puestO' => $this->puesto,
            'estatus_u' => $this->estatus_u
        ]);
	}

}
?>
