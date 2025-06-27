

<?php
	
	include_once '../clases/tipo_usuario.php';
	include_once '../clases/usuario.php';

	if(!empty($_POST['miIdUsuario'])){
		$id = $_POST['miIdUsuario'];

		$tipo_usuario = new Tipo_Usuario();
		//$usuario = new Usuario();
		
 		//$usuario-> eliminarUsuarioPorIdTipo($id);
		$tipo_usuario-> eliminarTipoUsuario($id);
	


  header("Location:".$_SERVER['HTTP_REFERER']);//regresa al pagina que estaba
	}
?>