

<?php
	include_once '../clases/cliente.php';
	if(!empty($_POST['miIdCliente'])){
		$id = $_POST['miIdCliente'];
		$cliente = new Cliente();
		$cliente-> eliminar($id);
		header("Location:".$_SERVER['HTTP_REFERER']);//regresa al pagina que estaba
	}
?>
