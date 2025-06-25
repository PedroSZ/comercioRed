<?php
	/********************** VALIDAMOS QUE ESTA PAGINA SEA PARA LA SESION INICIADA ****************/
    include_once '../clases/tipo_usuario.php';
    include_once '../clases/sesion.php';
    $userSession = new Sesion();
    //MADAR A INDEX SI NO HAY SESION INICIADA
    
    if (!isset($_SESSION['user'])){
    header("location: index.php");
    }
    if(isset($_SESSION['user'])){
        $user = new Tipo_Usuario();
        $user->establecerDatos($userSession->getCurrentUser());
        $tipo = $user->getPuesto();
        $codigo = $user->getUsuario_id();


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

	if(!empty($_POST['miIdCliente'])){
		include_once '../clases/cliente.php';
		$id = $_POST['miIdCliente'];
		$cliente = new Cliente();
		$cli = $cliente->consultarId($id);
	}
	else{


	}
?>
</!DOCTYPE html>
<html>
    <head>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/navbarYmenu.css">
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    <script src="../js/modulos.js" type="text/javascript"></script>  
    <link rel="stylesheet" href="../css/formularios.css">
   
        <script language='javascript'>
		function regresar(){
			location.href='actualizarUsuarios.php'
		}
        </script>

         <meta charset="UTF-8">
           
    </head>
    <body>   
    <?php include_once '../modulos/mdl_header.php'; ?>
        <div class="container">
    <h1 class="text-center mt-4">Actualizar Usuario</h1>
    <p class="text-center">Edite la información de los campos que desee modificar y luego presione el boton actualizar.</p>

               <form method="post" style="width: auto; height:auto;"  action="../modulos/mdl_ActualizarCliente.php" id="frm_Actualizarusuarios" >
 <input name="idC"  id="idC" type="hidden" value=" <?php echo $_POST['miIdCliente'];?>">

  <table  class="table">
  <?php
echo '
      
     
    
  <tr>
    <td COLSPAN=2 style="text-align: right;"><p  class = "negrita"><label>Nombre:</label></p></td>
    <td><p><input name="nombre" type="text" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" placeholder="Ingresar Nombre" id ="nombre" required pattern="[A-ZÑ ]+" title="Ingresa al menos un nombre por favor " required value="'.$cli["Nombre"].'"></p></td>
     <td COLSPAN=2  width="50%" style="text-align: right;"><p class = "negrita"><label>Apellido Paterno:</label></p></td>
    <td><p><input name="a_paterno" type="text" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" placeholder="Ingresar Apellido Paterno" id ="a_paterno" required pattern="[A-ZÑ ]+" title="Ingresa al menos un apellido por favor " required value="'.$cli["A_paterno"].'"></p></td>
  </tr>
 
  <tr>
    <td COLSPAN=2 style="text-align: right;"><p class = "negrita"><label>Apellido Materno:</label></p></td>
    <td><p><input name="a_materno" type="text" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" placeholder="Ingresar Apellido Materno" id ="a_materno" required pattern="[A-ZÑ ]+" title="Ingresa al menos un apellido por favor " value="'.$cli["A_Materno"].'"></p></td>
    <td COLSPAN=2 style="text-align: right;"><p class = "negrita"><label>Fecha de Nacimiento:</label></p></td>
    <td><p><input name="fecha_nacimiento" type="date" id ="fecha_nacimiento" required value="'.$cli["Fecha_Nacimiento"].'"></p></td>
   
  </tr>

  <tr>
      <td COLSPAN=2 style="text-align: right;"><p class = "negrita"><label>RFC:</label></p></td>
      <td><p><input name="rfc" type="text"  placeholder="Ingresar RFC" id ="rfc" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" required value="'.$cli["Rfc"].'"></p></td>
      <td COLSPAN=2 style="text-align: right;"><p class = "negrita"><label>Fecha de registro:</label></p></td>
      <td><p><input name="fecha_registro" type="date" id ="fecha_registro" required value="'.$cli["Fecha_Registro"].'"></p></td>
  </tr>

   <tr>
    <td COLSPAN=2 style="text-align: right;"><p class = "negrita"><label>Telefono:</label></p></td>
    <td><p><input name="telefono" type="number" placeholder="Ingresar Telefono" id ="telefono" required pattern="[0-9]+" title="Ingresa al menos un numero por favor " value="'.$cli["Telefono"].'"></p></td>
    <td COLSPAN=2 style="text-align: right;"><p class = "negrita"><label>Nombre de Usuario:</label></p></td>
    <td><p><input name="email"  type="text" placeholder="Ingresar Email o nombre de usuario" id ="email" required title="Por favor ingresa un correo o un nombre de usuario" required value="'.$cli["Email"].'"></p></td>
     
    </tr> 
    <tr>
    
    
    <td COLSPAN=2 style="text-align: right;"><p class = "negrita"><label>Domicilio:</label></p></td>
    <td><p><input name="domicilio_c" type="text" placeholder="Ingresar domicilio" id ="domicilio_c"   value="'.$cli["Domicilio"].'"></p></td>
   
    
    </tr>


   <tr>
    <td COLSPAN=2 style="text-align: right;"><p class = "negrita"><label>Limite de Credito:</label></p></td><td>
    <p><input name="limite" type="number" placeholder="Ingresar limite de credito" id ="limite" pattern="[0-9]+"  value="'.$cli["Limite_Credito"].'"></p></td>
     <td COLSPAN=2 style="text-align: right;"><p class = "negrita"><label>Credito Utilizado:</label></p></td>
    <td> <p><input name="credito"  type="number" placeholder="Ingresar Credito Usado" id ="credito"  value="'.$cli["Credito_Usado"].'"></p></td>
  </tr>
  ';?>
    <td COLSPAN=6 style="text-align: center;">
      <BR>
      <input type="submit" value="Actualizar">
      <input type="button" value="Cancelar" onclick="limpiar()">
       <input type="button" onclick="location='../listActualizarUsuarios.php'" value="Regresar" />
    </td>
  </tr>
  </table>
</form>
          
        <!-- Pie de pagina-->
            <?php include_once '../modulos/mdl_footer.php'; ?>

    </div>
    </body>
</html>
