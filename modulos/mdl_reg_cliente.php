<?php
//******ALTA CLIENTE (RF-07)
	include_once '../clases/cliente.php';
	


	if(!empty($_POST['cliente_email'])){
		$dato = $_POST['cliente_email'];
		 echo "REGISTRADO"; 
		 echo $dato;

		$cliente = new Cliente();
		$cli = $cliente->consultarEmail($dato);
		$dato2 = $cli['Email'];
		echo $dato2;

		if($dato == $dato2){

			echo '<script type="text/javascript">
								alert("Ya hay un cliente registrado con este email, intente registrarlo con otro email");
								window.location.href="../menuAdmin.php";
								activarModulo("RegUsuario");
						</script>';
						

		}else{


			
			$cliente = new Cliente();
			$cliente->setRfc($_POST['cliente_rfc']);
            $cliente->setNombre($_POST['cliente_nombre']);
            $cliente->setA_paterno($_POST['cliente_a_paterno']);
            $cliente->setA_materno($_POST['cliente_a_materno']);
            $cliente->setFecha_registro($_POST['fecha_registro_c']);
            $cliente->setFecha_nacimiento($_POST['cliente_fecha_nacimiento']);
            $cliente->setTelefono($_POST['cliente_telefono']);
            $cliente->setEmail($_POST['cliente_email']);
            $cliente->setDomicilio($_POST['cliente_domicilio']);
			$cliente->setLimite_credito($_POST['limite']);
			$cliente->setCredito_usado($_POST['disponible']);
			$cliente->guardar();
		
			echo '<script type="text/javascript">
								alert("CLIENTE REGISTRADO CON EXITO");
								window.location.href="../nuevoCliente.php";
						</script>';


			

			
			

			//header("Location:".$_SERVER['HTTP_REFERER']);//regresa al pagina que estaba
		}
//header("Location:".$_SERVER['HTTP_REFERER']);//regresa al pagina que estaba


	}
?>
