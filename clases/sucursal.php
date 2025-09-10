<?php
include_once 'connection.php';
class Sucursal extends DB {
    private $id_comercio;
    private $nombre_sucursal;
    private $telefono;
    private $email;
    private $domicilio;
    private $logotipo;
    private $color_background_principal;
    private $color_background_secundario;
    private $color_radial;
    private $color_texto_principal;
    private $color_texto_secundario;
    private $color_header_principal;
    private $color_header_secundario;
    private $color_footer_principal;
    private $color_footer_secundario;
    private $color_texto_header_principal;
    private $color_texto_header_secundario;
    private $color_texto_footer_principal;
    private $color_texto_footer_secundario;
    private $color_boton_principal;
    private $color_boton_secundario;
    private $color_boton_texto_principal;
    private $color_boton_texto_secundario;
    //stters and getters ***********************************************
    public function setId_comercio($id_comercio){ $this->id_comercio = $id_comercio; }
    public function setNombre_sucursal($nombre_sucursal){ $this->nombre_sucursal = $nombre_sucursal; }
    public function setTelefono($telefono){ $this->telefono = $telefono; }  
    public function setEmail($email){ $this->email = $email; }
    public function setDomicilio($domicilio){ $this->domicilio = $domicilio; }
    public function setLogotipo($logotipo){ $this->logotipo = $logotipo; }
    public function setColor_background_principal($color_background_principal){ $this->color_background_principal = $color_background_principal; }
    public function setColor_background_secundario($color_background_secundario){ $this->color_background_secundario = $color_background_secundario; }
    public function setColor_radial($color_radial){ $this->color_radial = $color_radial; }
    public function setColor_texto_principal($color_texto_principal){ $this->color_texto_principal = $color_texto_principal; }
    public function setColor_texto_secundario($color_texto_secundario){ $this->color_texto_secundario = $color_texto_secundario; }
    public function setColor_header_principal($color_header_principal){ $this->color_header_principal = $color_header_principal; }
    public function setColor_header_secundario($color_header_secundario){ $this->color_header_secundario = $color_header_secundario; }
    public function setColor_footer_principal($color_footer_principal){ $this->color_footer_principal = $color_footer_principal; }
    public function setColor_footer_secundario($color_footer_secundario){ $this->color_footer_secundario = $color_footer_secundario; }
    public function setColor_texto_header_principal($color_texto_header_principal){ $this->color_texto_header_principal = $color_texto_header_principal; }
    public function setColor_texto_header_secundario($color_texto_header_secundario){ $this->color_texto_header_secundario = $color_texto_header_secundario; }
    public function setColor_texto_footer_principal($color_texto_footer_principal){ $this->color_texto_footer_principal = $color_texto_footer_principal; }
    public function setColor_texto_footer_secundario($color_texto_footer_secundario){ $this->color_texto_footer_secundario = $color_texto_footer_secundario; }
    public function setColor_boton_principal($color_boton_principal){ $this->color_boton_principal = $color_boton_principal; }
    public function setColor_boton_secundario($color_boton_secundario){ $this->color_boton_secundario = $color_boton_secundario; }
    public function setColor_boton_texto_principal($color_boton_texto_principal){ $this->color_boton_texto_principal = $color_boton_texto_principal; }
    public function setColor_boton_texto_secundario($color_boton_texto_secundario){ $this->color_boton_texto_secundario = $color_boton_texto_secundario; }  
    
    //getters *******************************************************
    public function getId_comercio(){ return $this->id_comercio; }  
    public function getNombre_sucursal(){ return $this->nombre_sucursal; }
    public function getTelefono(){ return $this->telefono; }
    public function getEmail(){ return $this->email; }
    public function getDomicilio(){ return $this->domicilio; }
    public function getLogotipo(){ return $this->logotipo; }
    public function getColor_background_principal(){ return $this->color_background_principal; }
    public function getColor_background_secundario(){ return $this->color_background_secundario; }
    public function getColor_radial(){ return $this->color_radial; }
    public function getColor_texto_principal(){ return $this->color_texto_principal; }
    public function getColor_texto_secundario(){ return $this->color_texto_secundario; }
    public function getColor_header_principal(){ return $this->color_header_principal; }
    public function getColor_header_secundario(){ return $this->color_header_secundario; }
    public function getColor_footer_principal(){ return $this->color_footer_principal; }
    public function getColor_footer_secundario(){ return $this->color_footer_secundario; }
    public function getColor_texto_header_principal(){ return $this->color_texto_header_principal; }
    public function getColor_texto_header_secundario(){ return $this->color_texto_header_secundario; }
    public function getColor_texto_footer_principal(){ return $this->color_texto_footer_principal; }
    public function getColor_texto_footer_secundario(){ return $this->color_texto_footer_secundario; }
    public function getColor_boton_principal(){ return $this->color_boton_principal; }
    public function getColor_boton_secundario(){ return $this->color_boton_secundario; }
    public function getColor_boton_texto_principal(){ return $this->color_boton_texto_principal; }
    public function getColor_boton_texto_secundario(){ return $this->color_boton_texto_secundario; }
    //******************************************************************
public function registrarSucursal() {
        try {
            $query = $this->connect()->prepare("
                INSERT INTO sucursal (
                    Nombre_Sucursal, Telefono, Email, Domicilio, Logotipo,
                    color_background_principal, color_background_secundario, color_radial,
                    color_texto_principal, color_texto_secundario, color_header_principal,
                    color_header_secundario, color_footer_principal, color_footer_secundario,
                    color_texto_header_principal, color_texto_header_secundario,
                    color_texto_footer_principal, color_texto_footer_secundario,
                    color_boton_principal, color_boton_secundario,
                    color_boton_texto_principal, color_boton_texto_secundario
                ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)
            ");

            $query->execute([
                $this->nombre_sucursal,
                $this->telefono,
                $this->email,
                $this->domicilio,
                $this->logotipo,
                $this->color_background_principal,
                $this->color_background_secundario,
                $this->color_radial,
                $this->color_texto_principal,
                $this->color_texto_secundario,
                $this->color_header_principal,
                $this->color_header_secundario,
                $this->color_footer_principal,
                $this->color_footer_secundario,
                $this->color_texto_header_principal,
                $this->color_texto_header_secundario,
                $this->color_texto_footer_principal,
                $this->color_texto_footer_secundario,
                $this->color_boton_principal,
                $this->color_boton_secundario,
                $this->color_boton_texto_principal,
                $this->color_boton_texto_secundario
            ]);

            return true;
        } catch (PDOException $e) {
            echo "Error al registrar sucursal: " . $e->getMessage();
            return false;
        }
    }

   
   // ================== MÉTODOS ==================
    public function obtenerSucursalPorId(int $id) {
        $sql = "SELECT Id_Comercio, Nombre_Sucursal, Domicilio, Telefono, Email, Logotipo 
                FROM sucursal 
                WHERE Id_Comercio = :id 
                LIMIT 1";
        $query = $this->connect()->prepare($sql);
        $query->execute(['id' => $id]);
        $row = $query->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->id_comercio = $row['Id_Comercio'];
            $this->nombre_sucursal = $row['Nombre_Sucursal'];
            $this->domicilio = $row['Domicilio'];
            $this->telefono = $row['Telefono'];
            $this->email = $row['Email'];
            $this->logotipo = $row['Logotipo'];
            return $row; // 🔥 devuelve array asociativo con todos los datos
        } else {
            return null;
        }
    }

    // Por si quieres listar todas las sucursales en el sistema
    public function listarSucursales() {
        $sql = "SELECT Id_Comercio, Nombre_Sucursal, Domicilio, Telefono, Email, Logotipo FROM sucursal";
        $query = $this->connect()->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function consultarCodigo($id_comercio){
		$query = $this->connect()->prepare('SELECT * FROM sucursal WHERE Id_Comercio = :user');
		$query->execute(['user' => $id_comercio]);
		return $query->fetch(PDO::FETCH_ASSOC);
	}


}




   


?>