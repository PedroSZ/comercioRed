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

	if(!empty($_POST['miIdUsuario'])){
		include_once '../clases/usuario.php';
		include_once '../clases/tipo_usuario.php';
		$id = $_POST['miIdUsuario'];
		$user = new Usuario();
    $tipo = new Tipo_Usuario();
		$tipo->establecerDatos($id);
		$tipo_user = $tipo->getPuesto();
		$miUsuario = $user->consultarId($id);
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

               <form method="post" style="width: auto; height:auto;"  action="../modulos/mdl_ActualizarUsuarios.php" id="frm_Actualizarusuarios" >
 <input name="idU"  id="idU" type="hidden" value=" <?php echo $_POST['miIdUsuario'];?>">

  <table  class="table">

  <?php
  // Evaluamos el estatus para mostrar el texto correspondiente
$estatusTexto = ($miUsuario["Estatus_u"] == 1) ? 'Activo' : 'Inactivo';
echo '
      <tr>
       <td COLSPAN=2 style="text-align: right;"><p class = "negrita"><label>Inhabilitar:</label></p></td>
            <td><p><select name="estatus_u" type="text" id ="estatus_u" required>
            <option value="'.$miUsuario["Estatus_u"].'"  selected>'.$estatusTexto.'</option>
            <option value="1">Activo</option>
            <option value="0">Inactivo</option>
             </select></p></td>
      </tr>
     
    
  <tr>

    <td COLSPAN=2 style="text-align: right;"><p  class = "negrita"><label>Nombre:</label></p></td>
    <td><p><input name="nombre" type="text" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" placeholder="Ingresar Nombre" id ="nombre"  title="Ingresa al menos un nombre por favor " required value="'.$miUsuario["Nombre"].'"></p></td>
     <td COLSPAN=2  width="50%" style="text-align: right;"><p class = "negrita"><label>Apellido Paterno:</label></p></td>
    <td><p><input name="a_paterno" type="text" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" placeholder="Ingresar Apellido Paterno" id ="a_paterno" title="Ingresa al menos un apellido por favor " required value="'.$miUsuario["A_paterno"].'"></p></td>
  </tr>
 
  <tr>
    <td COLSPAN=2 style="text-align: right;"><p class = "negrita"><label>Apellido Materno:</label></p></td>
    <td><p><input name="a_materno" type="text" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" placeholder="Ingresar Apellido Materno" id ="a_materno" title="Ingresa al menos un apellido por favor " value="'.$miUsuario["A_Materno"].'"></p></td>
    <td COLSPAN=2 style="text-align: right;"><p class = "negrita"><label>Fecha de Nacimiento:</label></p></td>
    <td><p><input name="fecha_nacimiento" type="date" id ="fecha_nacimiento"  value="'.$miUsuario["Fecha_Nacimiento"].'"></p></td>
   
  </tr>

  <tr>
      <td COLSPAN=2 style="text-align: right;"><p class = "negrita"><label>RFC:</label></p></td>
      <!-- <td><p><input name="rfc" type="text"  placeholder="Ingresar RFC" id ="rfc" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()"  pattern="^[A-ZÑ&]{3,4}[0-9]{2}(0[1-9]|1[0-2])(0[1-9]|[12][0-9]|3[01])[A-Z0-9]{3}$" title="Por favor ingresa solo un formato RFC por ejemplo SAJG990112000"  value=""></p></td> -->
       <td><p><input name="rfc" type="text"  placeholder="Ingresar RFC" id ="rfc" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()"  value="'.$miUsuario["Rfc"].'"></p></td>
      <td COLSPAN=2 style="text-align: right;"><p class = "negrita"><label>Fecha de registro:</label></p></td>
      <td><p><input name="fecha_registro" type="date" id ="fecha_registro" required value="'.$miUsuario["Fecha_Registro"].'"></p></td>
  </tr>

   <tr>
    <td COLSPAN=2 style="text-align: right;"><p class = "negrita"><label>Telefono:</label></p></td><td>
    <p><input name="telefono" type="number" placeholder="Ingresar Telefono" id ="telefono" required pattern="[0-9]+" title="Ingresa al menos un numero por favor " value="'.$miUsuario["Telefono"].'"></p></td>
     <td COLSPAN=2 style="text-align: right;"><p class = "negrita"><label>Nombre de Usuario:</label></p></td>
    <td> <p><input name="email"  type="text" placeholder="Ingresar Email" id ="email" title="Por favor ingresa un nomre de usuario que servira para acceder al sistema posteriormente" required value="'.$miUsuario["Email"].'"></p></td>
  </tr>

   <tr>
        <td COLSPAN=2 style="text-align: right;"><p class = "negrita"><label>Tipo de Usuario:</label></p></td>
            <td><p><select name="tipo_usuario" type="text" id ="tipo_usuario" required>
            <option value="'.$miUsuario["Puesto"].'" selected>'.$miUsuario["Puesto"].'</option>
            <option value="Administrador">ADMINISTRADOR</option>
            <option value="Usuario">USUARIO</option>
             </select></p></td>
     <td COLSPAN=2 style="text-align: right;"><p class = "negrita"><label>Domicilio:</label></p></td><td>
      <p><input name="domicilio" type="text" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" placeholder="Ingresar Dirección" id ="domicilio" title="Ingresa al menos una dirección por favor" required value="'.$miUsuario["Domicilio"].'"></p></td>
  </tr>';?>
 <tr>
    <td COLSPAN=2 style="text-align: right;">
      <p class = "negrita"><label>Contraseña:</label></p>
    </td>
    <td>
      <p><input name="psw1" type="password" placeholder="Ingresar Contraseña"  id ="psw1"  title="Por favor ingresa una contraseña que inicie con una letra y tenga al menos 8 caracteres y un número como mínimo" required ></p>


    </td>
    <td COLSPAN=2 style="text-align: right;">
      <p class = "negrita"><label>Confirmar Contraseña:</label></p>
    </td>
    <td>
      <p><input name="pasword" type="password" placeholder="Vuelve a escribir la Contraseña"  id ="psw2" required ></p>
    </td>
  </tr>
  <tr>
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
