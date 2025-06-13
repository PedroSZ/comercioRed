<?php
	/********************** VALIDAMOS QUE ESTA PAGINA SEA PARA LA SESION INICIADA ****************/
    include_once 'clases/tipo_usuario.php';
    include_once 'clases/sesion.php';
    $userSession = new Sesion();
    //MADAR A INDEX SI NO HAY SESION INICIADA
   
    if (!isset($_SESSION['user'])){
    header("location: index.php");
    }

    if(isset($_SESSION['user'])){
        $user = new Tipo_Usuario();
        $user->establecerDatos($userSession->getCurrentUser());
        $tipo = $user->getTipo();
		//mensaje de que no tiene privilegios
        if($tipo <> "Usuario") header('location: index.php');
        /*////////////////////////SIERRE POR INACTIVIDAD/////////////////////////*/
        if (!isset($_SESSION['tiempo'])) {
            $_SESSION['tiempo']=time();
        }
        else if (time() - $_SESSION['tiempo'] > 300) {
            session_destroy();
            /* Aquí redireccionas a la url especifica */
            header("location: index.php");
            die();
        }
        $_SESSION['tiempo']=time(); //Si hay actividad seteamos el valor al tiempo actual
        /*////////////////////FIN SIERRE POR INACTIVIDAD/////////////////////////*/

    }
    else{
        $userSession->closeSession();
    }


	/**********************************************************************************************/
?>


<!doctype html>
<html lang="en">
  <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/navbarYmenu.css">
    <link rel="stylesheet" href="css/modulos.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    <script src="js/modulos.js" type="text/javascript"></script>
  </head>
  <body>
     <?php include_once 'modulos/mdl_header.php'; ?>
     <?php include_once 'modulos/mdl_menuUser.php'; ?>
  </body>
</html>