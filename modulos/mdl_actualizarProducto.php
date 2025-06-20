<?php
//******ALTA PRODUCTO*******
	include_once '../clases/producto.php';
	
    
		$dato = $_POST['codigo'];
        if(!empty($_POST['codigo'])){
		 

		$producto = new Producto();
		$producto->setCodigo($_POST['codigo']);
		$producto->setNombre($_POST['producto_nombre']);
		$producto->setDescripcion($_POST['descripcion']);
		$producto->setStock($_POST['stock']);
		$producto->setFecha_Caducidad($_POST['fecha_caducidad']);
		$producto->setFecha_Registro($_POST['fecha_registro_p']);
		$producto->setCosto($_POST['costo']);
		$producto->setPrecio($_POST['precio']);
		$producto->actualizar();
		echo '<script type="text/javascript">
							alert("Actualización exitosa");
							window.location.href="../listActualizarProductos.php";	
					</script>';
		//header("Location:".$_SERVER['HTTP_REFERER']);//regresa al pagina que estaba
	} 
else {
        echo '<script type="text/javascript">
                            alert("Error al actualizar el producto, verifique los datos ingresados");
                            window.location.href="../listActualizarProductos.php";	
                    </script>';
    }
?>
