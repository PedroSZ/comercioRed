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
        $tipo = $user->getPuesto();
<<<<<<< HEAD
        $codigo = $user->getUsuario_id();
=======
      
>>>>>>> 1efdc3e56d1fdc9aa858b46e4330cd2541dba0b7


		//mensaje de que no tiene privilegios
        if($tipo <> "Administrador") header('location: index.php');
        /*////////////////////////SIERRE POR INACTIVIDAD/////////////////////////*/
        if (!isset($_SESSION['tiempo'])) {
            $_SESSION['tiempo']=time();
        }
        else if (time() - $_SESSION['tiempo'] > 500) {
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
         header("location: index.php");
    }


	/**********************************************************************************************/
?>


<!doctype html>
<!-- menuAdmin.php -->
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
     <?php include_once 'modulos/mdl_menuAdmin.php'; ?>
    <div class="container">
      <h3>Bienvenido</h3>
<<<<<<< HEAD
      <p> <?php 
     // echo $user->getUsuario(); 
		include_once 'clases/usuario.php';
		$idUs = $codigo;
		$user2 = new Usuario();
		$miUsuario = $user2->consultarId($codigo);
		echo $miUsuario["Nombre"]. " " . $miUsuario["A_paterno"]. " " . $miUsuario["A_Materno"];
  ?></p>





=======
      <p> <?php echo $user->getUsuario(); ?></p>
>>>>>>> 1efdc3e56d1fdc9aa858b46e4330cd2541dba0b7

      <div id="RegUsuario" class="modulo">
        <h4>Registrar Usuario</h4>
        <?php include_once 'forms/form_reg_usuario.php'; ?> 
      </div>
      
    
      <div id="RegProducto" class="modulo">
        <h4>Registrar Producto</h4>
       <?php include_once 'forms/form_reg_producto.php'; ?> 
      </div>

      <div id="RegCliente" class="modulo">
      <h2>Registrar Clientes</h2>
       <?php include_once 'forms/form_reg_cliente.php'; ?> 
      </div>

      <div id="RegVenta" class="modulo">
      <h2>Nueva Venta</h2>
       <?php include_once 'forms/form_reg_venta.php'; ?> 
      </div>

      <div id="ConUsuario" class="modulo">
      <h2>Consulta de Usuario</h2>
       <?php include_once 'listUsuarios.php'; ?> 
      </div>

      <div id="ConProducto" class="modulo">
      <h2>Consulta de Productos</h2>
      <?php include_once 'listProductos.php'; ?> 
      </div>

      <div id="ConCliente" class="modulo">
      <h2>Consulta de Clientes</h2>
      <?php include_once 'listClientes.php'; ?>
      </div>

      <div id="ModUsuario" class="modulo">
      <h2>Modificar Usuario</h2>
<<<<<<< HEAD
      <?php include_once 'listActualizarUsuarios.php'; ?>
=======
      <?php include_once 'actualizarUsuarios.php'; ?>
>>>>>>> 1efdc3e56d1fdc9aa858b46e4330cd2541dba0b7
      </div>

      <div id="ModProducto" class="modulo">
      <h2>Modificar Productos</h2>
      <H1 style="color: red;">MODULO EN CONSTRUCCIÓN</H1>
      </div>

      <div id="ModCliente" class="modulo">
      <h2>Modificar Clientes</h2>
      <H1 style="color: red;">MODULO EN CONSTRUCCIÓN</H1>
      </div>

      <div id="DelUsuario" class="modulo">
      <h2>Eliminar Usuario</h2>
      <H1 style="color: red;">MODULO EN CONSTRUCCIÓN</H1>
      </div>

      <div id="DelProducto" class="modulo">
      <h2>Eliminar Productos</h2>
      <H1 style="color: red;">MODULO EN CONSTRUCCIÓN</H1>
      </div>

      <div id="DelCliente" class="modulo">
      <h2>Eliminar Clientes</h2>
      <H1 style="color: red;">MODULO EN CONSTRUCCIÓN</H1>
      </div>
    </div>
    <?php include_once 'modulos/mdl_footer.php'; ?>
  </body>
</html>