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
$filtro1 = $_POST['FiltarId']; //para obtener la curp a buscar del fitro
$filtro2 = $_POST['FiltarNom'];
$filtro3 = $_POST['FiltarPater'];
$filtro4 = $_POST['FiltarMater'];
$filtro5 = $_POST['FiltarFechaR'];
$filtro6 = $_POST['FiltarFechaN'];
?>

 <style>
  .tabla-usuarios th {
    font-size: 14px;
    text-align: center;
    
  }
  .tabla-usuarios td {
    font-size: 11px;
  }
</style>

     <div id="filtro">     
      
              <form method="post" action="listUsuarios.php" name="form_filtro_usuarios" id="form_filtro_usuarios" style="align-items: center; background:rgba(0,0,0,0.0);">
                <table class="table-primary"  border="1">

              <tr>
                <td width="100%" style="text-align: right;">

                  <input name="FiltarId" type="text"  placeholder="Buscar por Código" id ="FiltarId" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" >
                  <input name="FiltarNom" type="text" title="Busqueda por Nombre"  placeholder="Buscar por Nombre" id ="FiltarNom" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" >
                  <input name="FiltarPater" type="text" title="Busqueda por Apellido Paterno" placeholder="Buscar por Apellido Paterno" id ="FiltarPater" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">

                  
                      <br>
                     <div id="boton-centrado">
        
          
          <input type="submit" value="Buscar">
          </div>

                </td>
              </tr>
            </table>
          </form></div>
            <!--/*********************************FIN FORMULARIO PARA EL FILTRO*****************************************************/ -->



        <!-- contenido principal -->
       
           

                <!-- <div class="datagrid">-->
                  <div id="listado">
                 <form method="post" action="" name="frm_listUsuarios" id="frm_listUsuarios" style="width: auto; height: auto;">
					
                     <?php
  include_once 'clases/usuario.php';
  $user2 = new Usuario();
  $usuarios = $user2->listar();
  if($usuarios){
    echo "
     <div style='width: 100%; overflow-x: auto;'>
      <table class='table table-bordered border-primary table-hover tabla-usuarios'><thead>
      <tr>
        <th style='text-align:center'>Id</th>
        <th style='text-align:center'>Nombre</th>
        <th style='text-align:center'>Apellido Paterno</th>
        <th style='text-align:center'>Apellido Materno</th>
        <th style='text-align:center'>Fecha Nacimiento</th>
        <th style='text-align:center'>RFC</th>
        <th style='text-align:center'>Telefono</th>
        <th style='text-align:center'>Email</th>
        <th style='text-align:center'>Domicilio</th>
        <th style='text-align:center'>Ingreso</th>
        <th style='text-align:center'>Tipo cuenta</th>
      </tr></thead>";
      if($filtro1 || $filtro2 || $filtro3 || $filtro4 || $filtro5 || $filtro6){
        foreach ($usuarios as $user2) {
        //  if($filtro1 == $alumno['curp'] || $filtro2 == $alumno['nombre'] || $filtro3 == $alumno['apellidos']){
          if($filtro1 == $user2['Id_Usuario'] || $filtro2 == $user2['Nombre'] || $filtro3 == $user2['A_paterno'] || $filtro4 == $user2['A_Materno'] || $filtro5 == $user2['Fecha_Registro'] || $filtro6 == $user2['Fecha_Nacimiento']){
            echo "<tr>
            <td>".$user2['Id_Usuario']."</td>
            <td>".$user2['Nombre']."</td>
            <td>".$user2['A_paterno']."</td> 
            <td>".$user2['A_Materno']."</td>
            <td>".$user2['Fecha_Nacimiento']."</td>
             <td>".$user2['Rfc']."</td>
            <td>".$user2['Telefono']."</td>
             <td>".$user2['Email']."</td>
            <td>".$user2['Domicilio']."</td> 
            <td>".$user2['Fecha_Registro']."</td>
            <td>".$user2['Puesto']."</td>
           
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
             <td>".$user2['Rfc']."</td>
            <td>".$user2['Telefono']."</td>
             <td>".$user2['Email']."</td>
            <td>".$user2['Domicilio']."</td> 
            <td>".$user2['Fecha_Registro']."</td>
            <td>".$user2['Puesto']."</td>
            
            </tr>";
        }
      }

    echo "</table> </div>";
  }
  else{
    echo " <p>No hay Usuarios registrados en la base de datos</p>";
  }
?>

<!--<td style='text-align:center'><img width='30' height='30' src='imgs/delete.png' onClick='borrar(\"".$alumno['curp']."\");'></td> -->
         
           </form></div>
           <div id="boton-centrado">
   <input type="button" onClick="location='menuAdmin.php'" value="Regresar" />
</div>
      

         

 
  
