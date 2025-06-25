<?php
//******ALTA USUARIO (RF-07)
	include_once '../clases/tipo_usuario.php';
	include_once '../clases/usuario.php';
	
        
        $codigo = $_POST['idU'];
	        if(!empty($_POST['idU'])){
	
			$tipo_usuario = new Tipo_Usuario();
			$tipo_usuario->setUsuario_id($_POST['idU']);
			$tipo_usuario->setUsuario($_POST['email']);
			$tipo_usuario->setPuesto($_POST['tipo_usuario']);
			$tipo_usuario->setPasword(md5($_POST['pasword']));
			$tipo_usuario->actualizar();
				
			
					
			// Actualizar usuario (datos personales)
		$usuario = new Usuario();
		$usuario->setIdusuario($_POST['idU']);
		$usuario->setIdtipo($_POST['idU']);
		$usuario->setRfc($_POST['rfc']);
		$usuario->setNombre($_POST['nombre']);
		$usuario->setA_paterno($_POST['a_paterno']);
		$usuario->setA_materno($_POST['a_materno']);
		$usuario->setFecha_registro($_POST['fecha_registro']);
		$usuario->setFecha_nacimiento($_POST['fecha_nacimiento']);
		$usuario->setTelefono($_POST['telefono']);
		$usuario->setEmail($_POST['email']);
		$usuario->setDomicilio($_POST['domicilio']);
		$usuario->actualizar();

			echo '<script type="text/javascript">
								alert("MIDIFICACION EXITOSSA");
								window.location.href="../listActualizarUsuarios.php";
						</script>';
			

			
		}


?>
