<?php
	
/********************** VALIDAMOS QUE ESTA PAGINA SEA PARA LA SESION INICIADA ****************/
/*  include_once '../clases/tipo_usuario.php';
    include_once '../clases/sesion.php';
    
    
    
if (!isset($_SESSION['user'])){
    header("location: index.php");
    }

    if (!isset($_SESSION['user'])){
    header("location: index.php");
    }

    if(isset($_SESSION['user'])){
        $user = new Tipo_Usuario();
        $user->establecerDatos($userSession->getCurrentUser());
        $tipo = $user->getTipo();
      


		
        if($tipo <> "Administrador") header('location: index.php');
       
        if (!isset($_SESSION['tiempo'])) {
            $_SESSION['tiempo']=time();
        }
        else if (time() - $_SESSION['tiempo'] > 500) {
            session_destroy();
          
           header("location: index.php");
            die();
        }
        $_SESSION['tiempo']=time();
      

    }
    else{
        $userSession->closeSession();
         header("location: index.php");
    }
*/
/**********************************************************************************************/

	if(!empty($_POST['micodigo'])){
		include_once '../clases/usuario.php';
		include_once '../clases/tipo_usuario.php';
		$codigo = $_POST['micodigo'];
		$user = new Usuario();
    $tipo = new Tipo_Usuario();
		$tipo->establecerDatos($codigo);
		$tipo_user = $tipo->getPuesto();
		$miUsuario = $user->consultarId($codigo);
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
    <link rel="stylesheet" href="../css/modulos.css">
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
        <div id="contenedor">

               <form method="post" style="width: auto; height:auto;"  action="modulos/mdl_ActualizarUsuarios.php" id="frm_Actualizarusuarios" >

  <table border="0" style="color:#FFFFFF; font-weight: 600; font-size: 17px;">
  <?php
echo '
      
     
    
  <tr>
    <td COLSPAN=2 style="text-align: right;"><p  class = "negrita"><label>Nombre:</label></p></td>
    <td><p><input name="nombre" type="text" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" placeholder="Ingresar Nombre" id ="nombre" required pattern="[A-ZÑ ]+" title="Ingresa al menos un nombre por favor " required value="'.$miUsuario["Nombre"].'"></p></td>
     <td COLSPAN=2  width="50%" style="text-align: right;"><p class = "negrita"><label>Apellido Paterno:</label></p></td>
    <td><p><input name="a_paterno" type="text" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" placeholder="Ingresar Apellido Paterno" id ="a_paterno" required pattern="[A-ZÑ ]+" title="Ingresa al menos un apellido por favor " required value="'.$miUsuario["A_paterno"].'"></p></td>
  </tr>
 
  <tr>
    <td COLSPAN=2 style="text-align: right;"><p class = "negrita"><label>Apellido Materno:</label></p></td>
    <td><p><input name="a_materno" type="text" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" placeholder="Ingresar Apellido Materno" id ="a_materno" required pattern="[A-ZÑ ]+" title="Ingresa al menos un apellido por favor " value="'.$miUsuario["A_Materno"].'"></p></td>
    <td COLSPAN=2 style="text-align: right;"><p class = "negrita"><label>Fecha de Nacimiento:</label></p></td>
    <td><p><input name="fecha_nacimiento" type="date" id ="fecha_nacimiento" required value="'.$miUsuario["Fecha_Nacimiento"].'"></p></td>
   
  </tr>

  <tr>
      <td COLSPAN=2 style="text-align: right;"><p class = "negrita"><label>RFC:</label></p></td>
      <td><p><input name="rfc" type="text"  placeholder="Ingresar RFC" id ="rfc" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" required pattern="^[A-ZÑ&]{3,4}[0-9]{2}(0[1-9]|1[0-2])(0[1-9]|[12][0-9]|3[01])[A-Z0-9]{3}$" title="Por favor ingresa solo un formato RFC por ejemplo SAJG990112000" required value="'.$miUsuario["Rfc"].'"></p></td>
      <td COLSPAN=2 style="text-align: right;"><p class = "negrita"><label>Fecha de registro:</label></p></td>
      <td><p><input name="fecha_registro" type="date" id ="fecha_registro" required value="'.$miUsuario["Fecha_Registro"].'"></p></td>
  </tr>

   <tr>
    <td COLSPAN=2 style="text-align: right;"><p class = "negrita"><label>Telefono:</label></p></td><td>
    <p><input name="telefono" type="number" placeholder="Ingresar Telefono" id ="telefono" required pattern="[0-9]+" title="Ingresa al menos un numero por favor " value="'.$miUsuario["Telefono"].'"></p></td>
     <td COLSPAN=2 style="text-align: right;"><p class = "negrita"><label>E-Mail:</label></p></td>
    <td> <p><input name="email"  type="email" placeholder="Ingresar Email" id ="email" required pattern="^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$" title="Por favor ingresa un correo con el formato nombre@sitio.dominio" required value="'.$miUsuario["Email"].'"></p></td>
  </tr>

   <tr>
        <td COLSPAN=2 style="text-align: right;"><p class = "negrita"><label>Tipo de Usuario:</label></p></td>
            <td><p><select name="tipo_usuario" type="text" id ="tipo_usuario" required>
            <option value="'.$miUsuario["Puesto"].'" disabled selected>'.$miUsuario["Puesto"].'</option>
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
    <td COLSPAN=5 style="text-align: center;">
      <BR>
      <input type="submit" value="Registrar">
      <input type="button" value="Cancelar" onclick="limpiar()">
       <input type="button" onclick="location='../menuAdmin.php'" value="Regresar" />
    </td>
  </tr>
  </table>
</form>
          
        <!-- Pie de pagina-->
            <?php include_once '../modulos/mdl_footer.php'; ?>

    </div>
    </body>
</html>
