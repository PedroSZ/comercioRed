<?php
//******ALTA PRODUCTO*******
	include_once '../clases/producto.php';
	if(!empty($_POST['codigo'])){
		

		$dato = $_POST['codigo'];
		 echo "REGISTRADO"; 
		 echo $dato;

		$producto = new Producto();
		$pro = $producto->consultarCodigo($dato);
		$dato2 = $pro['Codigo'];
		echo $dato2;

		if($dato == $dato2){

			echo '<script type="text/javascript">
								alert("Ya hay un producto registrado con este codigo, intente registrarlo con otro codigo");
								window.location.href="../menuAdmin.php";
								activarModulo("RegUsuario");
						</script>';
						

		}else{
		$producto->setCodigo($_POST['codigo']);
		$producto->setNombre($_POST['producto_nombre']);
		$producto->setDescripcion($_POST['descripcion']);
		$producto->setStock($_POST['stock']);
		$producto->setFecha_Caducidad($_POST['fecha_caducidad']);
		$producto->setFecha_Registro($_POST['fecha_registro_p']);
		$producto->setCosto($_POST['costo']);
		$producto->setPrecio($_POST['precio']);


		$producto->guardar();
		echo '<script type="text/javascript">
							alert("Producto registrado con éxito");
							window.location.href="../nuevoProducto.php";
								
					</script>';
		//header("Location:".$_SERVER['HTTP_REFERER']);//regresa al pagina que estaba
	}
}
?>
