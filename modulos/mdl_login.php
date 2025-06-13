<?php
include_once 'clases/tipo_usuario.php';
include_once 'clases/sesion.php';
$userSession = new Sesion(); //INICIA EL SESION START


if(isset($_SESSION['user'])){
    $user = new Tipo_Usuario();//******AUTENTICAR USUARIOS (RF-01) (RF-02) (RF-03)
   	$user->establecerDatos($userSession->getCurrentUser());
    switch ($user->getTipo()) {
    	case 'Administrador': header('location: menuAdmin.php'); break;
    	case 'Usuario': header('location: menUser.php');	break;
    	case 'Cliente': header('location: menuEstudiante.php');	break;


	}
}else if(isset($_POST['codigo']) && isset($_POST['password'])){
    $userForm = $_POST['codigo'];
    $passForm = $_POST['password'];
    $user = new Tipo_Usuario();
    if($user->verificarPsw($userForm, $passForm)){
        echo "Existe el usuario";
        $userSession->setCurrentUser($userForm);
        $user->establecerDatos($userForm);
    switch ($user->getTipo()) {
    	case 'Administrador': header('location: menuAdmin.php'); break;
    	case 'Usuario': header('location: menuUser.php');	break;
    	case 'Cliente': header('location: menuEstudiante.php');	break;
      default: echo "Usuario no exie";

    	//default:header('location: ../index.php');				break;
    }
    }else{
        //echo "No existe el usuario";
        $alert = "Nombre de usuario y/o password incorrecto";
    }
}else{
    	$alert = "";
}
?>
