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
error_reporting(0);//para que no me muestre errores
$filtro1 = $_POST['FiltarId_actualizar_usuario']; //para obtener la curp a buscar del fitro
$filtro2 = $_POST['FiltarNom_actualizar_usuario'];
$filtro3 = $_POST['FiltarPater_actualizar_usuario'];
?>
</!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/navbarYmenu.css">
    <link rel="stylesheet" href="css/modulos.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    <script src="js/modulos.js" type="text/javascript"></script>



        	<script language='javascript'>
		          function consultar(Id_Usuario) {
                 document.lista_actualizar_usuario.miIdUsuario.value = Id_Usuario;
			           // alert(codigo);
                   document.lista_actualizar_usuario.submit();
	      	  }
		        function regresar(){
		      	location.href='index.php'
		        }
        </script>

    </head>
    <body>
        
     
        
        <!-- Encabezado de la pagina-->
            <?php include_once 'modulos/mdl_header.php'; ?>
        <!-- fin Encabezado de la pagina-->
         <div class="container">
    <h1 class="text-center mt-4">Modificaciones</h1>
    <p class="text-center">Elija de la lista al usuario que desea actualizar haciendo clic en el icono. <img src="img/Actualizar.png" width="30" height="30" alt="Actualizar" title="Actualizar producto"></p>

              <form method="post" action="listActualizarUsuarios.php" name="form_filtro_actualizar_usuario" id="form_filtro_actualizar_usuario" style="align-items: center; background:rgba(0,0,0,0.0);">
                <table class="table-primary"  border="1">

              <tr>
                <td width="100%" style="text-align: right;">

                  <input name="FiltarId_actualizar_usuario" type="text"  placeholder="Buscar por Código" id ="FiltarId_actualizar_usuario" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" >
                  <input name="FiltarNom_actualizar_usuario" type="text" title="Busqueda por nombre"  placeholder="Buscar por Nombre" id ="FiltarNom_actualizar_usuario" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" >
                  <input name="FiltarPater_actualizar_usuario" type="text" title="Busqueda por Descripción" placeholder="Buscar por descripcion" id ="FiltarPater_actualizar_usuario" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">

                  
                      <br>
                      <input type="submit" value="Buscar">

                </td>
              </tr>
            </table>
          </form>
            <!--/*********************************FIN FORMULARIO PARA EL FILTRO*****************************************************/ -->



        <!-- contenido principal -->
       
           

                <!-- <div class="datagrid">-->
                 <form method="post" action="forms/form_act_usuario.php" name="lista_actualizar_usuario" id="lista_actualizar_usuario" style="width: auto; height: auto;">
                    <input type="hidden" id="miIdUsuario" name="miIdUsuario">
                     <?php
  include_once 'clases/usuario.php';
  $user2 = new Usuario();
  $usuarios = $user2->listar();
  if($usuarios){
    echo "
    
      <table class='table table-bordered border-primary table-hover'><thead>
      <tr>
        <th style='text-align:center'>Id</th>
        <th style='text-align:center'>Nombre</th>
        <th style='text-align:center'>Apellido Paterno</th>
        <th style='text-align:center'>Apellido Materno</th>
        <th style='text-align:center'>Fecha Nacimiento</th>
        <th style='text-align:center'>Telefono</th>
        <th style='text-align:center'>Email</th>
        <th style='text-align:center'>Domicilio</th>
        <th style='text-align:center'>Ingreso</th>
        <th style='text-align:center'>Tipo cuenta</th>
        <th style='text-align:center'>Modificar</th>
      </tr></thead>";
      if($filtro1 || $filtro2 || $filtro3){
        foreach ($usuarios as $user2) {
        
          if($filtro1 == $user2['Id_Usuario'] || $filtro2 == $user2['Nombre'] || $filtro3 == $user2['A_paterno']){
            echo "<tr>
            <td>".$user2['Id_Usuario']."</td>
            <td>".$user2['Nombre']."</td>
            <td>".$user2['A_paterno']."</td> 
            <td>".$user2['A_Materno']."</td>
            <td>".$user2['Fecha_Nacimiento']."</td>
            <td>".$user2['Telefono']."</td>
            <td>".$user2['Email']."</td>
            <td>".$user2['Domicilio']."</td> 
            <td>".$user2['Fecha_Registro']."</td>
            <td>".$user2['Puesto']."</td>
           <td style='text-align:center'><img width='30' height='30' src='img/Actualizar.png' onClick='consultar(\"".$user2['Id_Usuario']."\");'></td>
            </tr>";
          }

        }


      }else{
          foreach ($usuarios as $user2) {
           echo "<tr>
            <td>".$user2['Id_Usuario']."</td>
            <td>".$user2['Nombre']."</td>
            <td>".$user2['A_paterno']."</td> 
            <td>".$user2['A_Materno']."</td>
            <td>".$user2['Fecha_Nacimiento']."</td>
            <td>".$user2['Telefono']."</td>
            <td>".$user2['Email']."</td>
            <td>".$user2['Domicilio']."</td> 
            <td>".$user2['Fecha_Registro']."</td>
            <td>".$user2['Puesto']."</td>
             <td style='text-align:center'><img width='30' height='30' src='img/Actualizar.png' onClick='consultar(\"".$user2['Id_Usuario']."\");'></td>
            </tr>";
        }
      }

    echo "</table>";
  }
  else{
    echo " <p>No hay Productos registrados en la base de datos</p>";
  }
?>


           </form>
      

         
 <input type="button" onClick="location='menuAdmin.php'" value="Regresar" />
        <!-- Pie de pagina-->
            <?php include_once 'modulos/mdl_footer.php'; ?>

</div>
    </body> 
   
</html>
