<?php
/********************** VALIDAMOS QUE ESTA PAGINA SEA PARA LA SESION INICIADA ****************/
   /* include_once 'clases/tipo_usuario.php';
    include_once 'clases/sesion.php';
    
   
    
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
        $_SESSION['tiempo']=time(); /
       

    }
    else{
        $userSession->closeSession();
         header("location: index.php");
    }*/

/**********************************************************************************************/
error_reporting(0);//para que no me muestre errores
$filtro1 = $_POST['FiltarCodigo']; //para obtener la curp a buscar del fitro
$filtro2 = $_POST['FiltarNombre'];
$filtro3 = $_POST['FiltarDescripcoin'];
$filtro4 = $_POST['FiltarFechaR'];
$filtro5 = $_POST['FiltarFechaC'];
$filtro6 = $_POST['FiltarPrecio'];
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

              <form method="post" action="listProductos.php" name="form_filtro" id="form_filtro" style="align-items: center; background:rgba(0,0,0,0.0);">
                <table class="table-primary"  border="1">

              <tr>
                <td width="100%" style="text-align: right;">

                  <input name="FiltarCodigo" type="text"  placeholder="Buscar por Código" id ="FiltarCodigo" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" >
                  <input name="FiltarNombre" type="text" title="Busqueda por nombre"  placeholder="Buscar por Nombre" id ="FiltrarNombre" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" >
                  <input name="FiltarDescripcion" type="text" title="Busqueda por Descripción" placeholder="Buscar por descripcion" id ="FiltrarDescripcion" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">

                  
                      <br>
                      <input type="submit" value="Buscar">

                </td>
              </tr>
            </table>
          </form>
            <!--/*********************************FIN FORMULARIO PARA EL FILTRO*****************************************************/ -->



        <!-- contenido principal -->
      

                
                 <form method="post" action="" name="frm_listProductos" id="frm_listProductos" style="width: auto; height: auto;">
					
                     <?php
  include_once 'clases/producto.php';
  $doc = new Producto();
  $productos = $doc->listar();
  if($productos){
    echo "
    
      <table class='table table-bordered border-primary table-hover'><thead>
      <tr>
        <th style='text-align:center'>Codigo</th>
        <th style='text-align:center'>Producto</th>
        <th style='text-align:center'>Descripcion</th>
        <th style='text-align:center'>Existencias</th>
        <th style='text-align:center'>Registro</th>
        <th style='text-align:center'>Caducidad</th>
        <th style='text-align:center'>Costo producción</th>
        <th style='text-align:center'>Precio al Público</th>
      </tr></thead>";
      if($filtro1 || $filtro2 || $filtro3 || $filtro4 || $filtro5 || $filtro6){
        foreach ($productos as $producto) {
        //  if($filtro1 == $alumno['curp'] || $filtro2 == $alumno['nombre'] || $filtro3 == $alumno['apellidos']){
          if($filtro1 == $producto['Codigo'] || $filtro2 == $producto['Nombre'] || $filtro3 == $producto['Descripcion'] || $filtro4 == $producto['Fecha_Caducidad'] || $filtro5 == $producto['Fecha_Registro'] || $filtro6 == $producto['Precio']){
            echo "<tr>
            <td>".$producto['Codigo']."</td>
            <td>".$producto['Nombre']."</td>
            <td>".$producto['Descripcion']."</td>
            <td>".$producto['Stock']."</td> 
            <td>".$producto['Fecha_Registro']."</td>
            <td>".$producto['Fecha_Caducidad']."</td>
            <td>".$producto['Costo']."</td>
            <td>".$producto['Precio']."</td>
            </tr>";
          }

        }


      }else{
        foreach ($productos as $producto) {
           echo "<tr>
            <td>".$producto['Codigo']."</td>
            <td>".$producto['Nombre']."</td>
            <td>".$producto['Descripcion']."</td>
            <td>".$producto['Stock']."</td>
            <td>".$producto['Fecha_Registro']."</td>
             <td>".$producto['Fecha_Caducidad']."</td>
            <td>".$producto['Costo']."</td>
            <td>".$producto['Precio']."</td>
            </tr>";
        }
      }

    echo "</table>";
  }
  else{
    echo " <p>No hay Productos registrados en la base de datos</p>";
  }
?>

<!--<td style='text-align:center'><img width='30' height='30' src='imgs/delete.png' onClick='borrar(\"".$alumno['curp']."\");'></td> -->
         
           </form>
      

          <input type="button" onClick="location='menuAdmin.php'" value="Regresar" />

        <!-- Pie de pagina-->
            <?php include_once 'modulos/mdl_footer.php'; ?>

 
    </body>
</html>
