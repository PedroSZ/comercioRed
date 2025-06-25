<?php
//******ALTA cliente (RF-07)
	include_once '../clases/cliente.php';
	
        
        $codigo = $_POST['idC'];
	        if(!empty($_POST['idC'])){
		$cliente = new Cliente();
		$cliente->setCliente($_POST['idC']);
		$cliente->setRfc($_POST['rfc']);
		$cliente->setNombre($_POST['nombre']);
		$cliente->setA_paterno($_POST['a_paterno']);
		$cliente->setA_materno($_POST['a_materno']);
		$cliente->setFecha_registro($_POST['fecha_registro']);
		$cliente->setFecha_nacimiento($_POST['fecha_nacimiento']);
		$cliente->setTelefono($_POST['telefono']);
		$cliente->setEmail($_POST['email']);
		$cliente->setDomicilio($_POST['domicilio_c']);
		$cliente->setLimite_credito($_POST['limite']);
		$cliente->setCredito_usado($_POST['credito']);

		$cliente->actualizar();

			echo '<script type="text/javascript">
								alert("MIDIFICACION EXITOSSA");
								window.location.href="../listActualizarclientes.php";
						</script>';
			

			
		}


?>
