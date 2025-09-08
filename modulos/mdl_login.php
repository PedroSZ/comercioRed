<?php
include_once 'clases/tipo_usuario.php';
include_once 'clases/sesion.php';
include_once 'clases/helpers.php';

$userSession = new Sesion();
$alert = '';

if ($userSession->getCurrentUser()) {
    $usuario = getUsuarioLogueado();
    switch ($usuario->getPuesto()) {
        case 'Administrador': header('Location: menuAdmin.php'); exit;
        case 'Cajero':       header('Location: menuUser.php'); exit;
        case 'Cliente':      header('Location: menuCliente.php'); exit;
    }
}

if(isset($_POST['codigo']) && isset($_POST['password'])){
    $userForm = $_POST['codigo'];
    $passForm = $_POST['password'];
    $user = new Tipo_Usuario();
    $datosUsuario = $user->verificarPsw($userForm, $passForm);

    if($datosUsuario){
        $userSession->setCurrentUser($datosUsuario['Usuario_Id']); // guardamos ID
        $user->establecerDatos($userForm);

        switch ($user->getPuesto()) {
            case 'Administrador': header('Location: menuAdmin.php'); exit;
            case 'Cajero':       header('Location: menuUser.php'); exit;
            case 'Cliente':      header('Location: menuCliente.php'); exit;
            default: $alert = "Usuario no existe"; break;
        }
    } else {
        $alert = "Nombre de usuario y/o password incorrecto";
    }
} else {
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $alert = "Debe ingresar un usuario y password";
    }
}
?>     