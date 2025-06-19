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
</!DOCTYPE html>
<html>
    <head>
        
        
        <meta charset="UTF-8">

    </head>
    <body>
        
     
        
        <!-- Encabezado de la pagina-->
            <?php include_once 'modulos/mdl_header.php'; ?>
        <!-- fin Encabezado de la pagina-->

              <form method="post" action="listClientes.php" name="form_filtro_clientes" id="form_filtro_clientes" style="align-items: center; background:rgba(0,0,0,0.0);">
                <table class="table-primary"  border="1">

              <tr>
                <td width="100%" style="text-align: right;">

                  <input name="FiltarId" type="text"  placeholder="Buscar por Id" id ="FiltarId" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" >
                  <input name="FiltarNom" type="text" title="Busqueda por Nombre"  placeholder="Buscar por Nombre" id ="FiltarNom" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" >
                  <input name="FiltarPater" type="text" title="Busqueda por Apellido" placeholder="Buscar por Apellido" id ="FiltarPater" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">

                  
                      <br>
                      <input type="submit" value="Buscar">

                </td>
              </tr>
            </table>
          </form>
            <!--/*********************************FIN FORMULARIO PARA EL FILTRO*****************************************************/ -->



        <!-- contenido principal -->
       
           

                <!-- <div class="datagrid">-->
                 <form method="post" action="" name="frm_listCliente" id="frm_listCliente" style="width: auto; height: auto;">
					
                     <?php
  include_once 'clases/cliente.php';
  $varC = new Cliente();
  $clientes = $varC->listar();
  if($clientes){
    echo "
    
      <table class='table table-bordered border-primary table-hover'><thead>
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
        <th style='text-align:center'>Cliente desde</th>
        <th style='text-align:center'>limite de credito</th>
        <th style='text-align:center'>Credito Utilizado</th>
      </tr></thead>";
      if($filtro1 || $filtro2 || $filtro3 || $filtro4 || $filtro5 || $filtro6){
        foreach ($clientes as $cliente) {
        //  if($filtro1 == $alumno['curp'] || $filtro2 == $alumno['nombre'] || $filtro3 == $alumno['apellidos']){
          if($filtro1 == $cliente['Id_Cliente'] || $filtro2 == $cliente['Nombre'] || $filtro3 == $cliente['A_paterno'] || $filtro4 == $cliente['A_Materno'] || $filtro5 == $cliente['Fecha_Registro'] || $filtro6 == $cliente['Fecha_Nacimiento']){
            echo "<tr>
            <td>".$cliente['Id_Cliente']."</td>
            <td>".$cliente['Nombre']."</td>
            <td>".$cliente['A_paterno']."</td> 
            <td>".$cliente['A_Materno']."</td>
            <td>".$cliente['Fecha_Nacimiento']."</td>
            <td>".$cliente['Rfc']."</td>
            <td>".$cliente['Telefono']."</td>
            <td>".$cliente['Email']."</td>
            <td>".$cliente['Domicilio']."</td> 
            <td>".$cliente['Fecha_Registro']."</td>
            <td>".$cliente['Limite_Credito']."</td>
             <td>".$cliente['Credito_Usado']."</td>
           
            </tr>";
          }

        }


      }else{
          foreach ($clientes as $cliente) {
           echo "<tr>
            <td>".$cliente['Id_Cliente']."</td>
            <td>".$cliente['Nombre']."</td>
            <td>".$cliente['A_paterno']."</td> 
            <td>".$cliente['A_Materno']."</td>
            <td>".$cliente['Fecha_Nacimiento']."</td>
            <td>".$cliente['Rfc']."</td>
            <td>".$cliente['Telefono']."</td>
            <td>".$cliente['Email']."</td>
            <td>".$cliente['Domicilio']."</td> 
            <td>".$cliente['Fecha_Registro']."</td>
            <td>".$cliente['Limite_Credito']."</td>
             <td>".$cliente['Credito_Usado']."</td>
            
            </tr>";
        }
      }

    echo "</table>";
  }
  else{
    echo " <p>No hay Clientes registrados en la base de datos</p>";
  }
?>

<!--<td style='text-align:center'><img width='30' height='30' src='imgs/delete.png' onClick='borrar(\"".$alumno['curp']."\");'></td> -->
         
           </form>
      

         
 <input type="button" onClick="location='menuAdmin.php'" value="Regresar" />
        <!-- Pie de pagina-->
            <?php include_once 'modulos/mdl_footer.php'; ?>

 
    </body> 
   
</html>
