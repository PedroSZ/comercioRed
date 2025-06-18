<?php
/********************** VALIDAMOS QUE ESTA PAGINA SEA PARA LA SESION INICIADA ****************/
    include_once 'clases/tipo_usuario.php';
    //include_once 'clases/sesion.php';
    
    //MADAR A INDEX SI NO HAY SESION INICIADA
    
    /*if (!isset($_SESSION['user'])){
    header("location: index.php");
    }

    if (!isset($_SESSION['user'])){
    header("location: index.php");
    }

    if(isset($_SESSION['user'])){
        $user = new Tipo_Usuario();
        $user->establecerDatos($userSession->getCurrentUser());
        $tipo = $user->getTipo();
      
*/

		//mensaje de que no tiene privilegios
      //  if($tipo <> "Administrador") header('location: index.php');
        /*////////////////////////SIERRE POR INACTIVIDAD/////////////////////////*/
      /*  if (!isset($_SESSION['tiempo'])) {
            $_SESSION['tiempo']=time();
        }
        else if (time() - $_SESSION['tiempo'] > 500) {
            session_destroy();
            /* Aquí redireccionas a la url especifica */
     /*       header("location: index.php");
            die();
        }/*
        $_SESSION['tiempo']=time(); //Si hay actividad seteamos el valor al tiempo actual
        /*////////////////////FIN SIERRE POR INACTIVIDAD/////////////////////////*/
/*
    }
    else{
        $userSession->closeSession();
         header("location: index.php");
    }
*/
/**********************************************************************************************/
error_reporting(0);//para que no me muestre errores
$filtro1 = $_POST['FiltarId_actualizar_usuario']; //para obtener la curp a buscar del fitro
$filtro2 = $_POST['FiltarNom_actualizar_usuario'];
$filtro3 = $_POST['FiltarPater_actualizar_usuario'];
$filtro4 = $_POST['FiltarMater'];
$filtro5 = $_POST['FiltarFechaR'];
$filtro6 = $_POST['FiltarFechaN'];
?>
</!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">

        	<script language='javascript'>
		          function consultar(codigo) {
                 document.lista_actualizar_usuario.micodigo.value = codigo;
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

              <form method="post" action="actualizarUsuarios.php" name="form_filtro_actualizar_usuario" id="form_filtro_actualizar_usuario" style="align-items: center; background:rgba(0,0,0,0.0);">
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
                    <input type="hidden" id="micodigo" name="micodigo">
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
      if($filtro1 || $filtro2 || $filtro3 || $filtro4 || $filtro5 || $filtro6){
        foreach ($usuarios as $user2) {
        
          if($filtro1 == $user2['Id_Usuario'] || $filtro2 == $user2['Nombre'] || $filtro3 == $user2['A_paterno'] || $filtro4 == $user2['A_Materno'] || $filtro5 == $user2['Fecha_Registro'] || $filtro6 == $user2['Fecha_Nacimiento']){
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

 
    </body> 
   
</html>
