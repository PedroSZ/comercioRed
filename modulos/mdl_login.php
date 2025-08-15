<?php
include_once 'clases/tipo_usuario.php';
include_once 'clases/sesion.php';
$userSession = new Sesion(); //INICIA EL SESION START


if(isset($_SESSION['user'])){
    $user = new Tipo_Usuario();//******AUTENTICAR USUARIOS (RF-01) (RF-02) (RF-03)
   	$user->establecerDatos($userSession->getCurrentUser());
    switch ($user->getPuesto()) {
    	case 'Administrador': echo "<script>window.location.href = 'menuAdmin.php';</script>"; exit; break;
        case 'Cajero': echo "<script>window.location.href = 'menuUser.php';</script>"; exit; break;
        case 'Cliente': echo "<script>window.location.href = 'menuCliente.php';</script>"; exit; break;


	}
}else if(isset($_POST['codigo']) && isset($_POST['password'])){
    $userForm = $_POST['codigo'];
    $passForm = $_POST['password'];
    $user = new Tipo_Usuario();
    if($user->verificarPsw($userForm, $passForm)){
        echo "Existe el usuario";
        $userSession->setCurrentUser($userForm);
        $user->establecerDatos($userForm);
    switch ($user->getPuesto()) {
    	case 'Administrador': echo "<script>window.location.href = 'menuAdmin.php';</script>"; exit; break;
    	case 'Cajero': echo "<script>window.location.href = 'menuUser.php';</script>"; exit; break;
        case 'Cliente': echo "<script>window.location.href = 'menuCliente.php';</script>"; exit; break;
      default: echo "Usuario no exie";

    	//default:header('location: ../index.php');				break;
    }
    }else{
        //echo "No existe el usuario";
        $alert = "Nombre de usuario y/o password incorrecto";
    }
}else{
    	$alert = "debe ingresar un usuario y password";
}

?>



            
        


            
        