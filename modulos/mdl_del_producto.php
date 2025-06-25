<?php
//echo $_POST["micodigo"];
	include_once '../clases/producto.php';
	if(!empty($_POST['micodigo'])){
		$codigo = $_POST['micodigo'];
		$producto = new Producto();
		$producto-> eliminar($codigo);
		header("Location:".$_SERVER['HTTP_REFERER']);//regresa al pagina que estaba
	}
?>