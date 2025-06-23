<?php
//******ALTA USUARIO (RF-07)
	include_once '../clases/tipo_usuario.php';
	include_once '../clases/usuario.php';
	


	if(!empty($_POST['email'])){
		$dato = $_POST['email'];
		 echo "REGISTRADO"; 
		 echo $dato;

		$usuario = new Usuario();
		$usr = $usuario->consultarEmail($dato);
		$dato2 = $usr['Email'];
		echo $dato2;

		if($dato == $dato2){

			echo '<script type="text/javascript">
								alert("Ya hay un usuario registrado con este email, intente registrarlo con otro email");
								window.location.href="../menuAdmin.php";
								activarModulo("RegUsuario");
						</script>';
						

		}else{


			$tipo_usuario = new Tipo_Usuario();
			//$tipo_usuario->setCodigo($_POST['usuario_id']);
			$tipo_usuario->setUsuario($_POST['email']);
			$tipo_usuario->setPuesto($_POST['tipo_usuario']);
			$tipo_usuario->setPasword(md5($_POST['pasword']));
			$tipo_usuario->guardar();
				
				$tipo_u = $tipo_usuario->consultarUltimoCodigo();
				echo($tipo_u['id']);
				
					
			$usuario = new Usuario();
			$usuario->setIdtipo($tipo_u['id']);
			$usuario->setRfc($_POST['rfc']);
            $usuario->setNombre($_POST['nombre']);
            $usuario->setA_paterno($_POST['a_paterno']);
            $usuario->setA_materno($_POST['a_materno']);
            $usuario->setFecha_registro($_POST['fecha_registro']);
            $usuario->setFecha_nacimiento($_POST['fecha_nacimiento']);
            $usuario->setTelefono($_POST['telefono']);
            $usuario->setEmail($_POST['email']);
            $usuario->setDomicilio($_POST['domicilio']);
			$usuario->guardar();

			echo '<script type="text/javascript">
								alert("USUARIO REGISTRADO CON EXITO");
								window.location.href="../menuAdmin.php";
								
						</script>';
			

			//header("Location:".$_SERVER['HTTP_REFERER']);//regresa al pagina que estaba
		}
//header("Location:".$_SERVER['HTTP_REFERER']);//regresa al pagina que estaba


	}
?>
