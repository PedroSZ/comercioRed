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
$filtro2 = $_POST['FiltarProducto'];

?>

    <style>
  .tabla-productos th {
    font-size: 14px;
    text-align: center;
    
  }
  .tabla-productos td {
    font-size: 11px;
  }
</style> 
      <div id="filtro"> 
       
              <form method="post" action="listProductos.php" name="form_filtro" id="form_filtro" style="align-items: center; background:rgba(0,0,0,0.0);">
                <table class="table-primary"  border="1">

              <tr>
                <td width="100%" style="text-align: right;">

                  <input name="FiltarCodigo" type="text"  placeholder="Buscar por Código" id ="FiltarCodigo" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" >
                  <input name="FiltarProducto" type="text" title="Busqueda por Producto"  placeholder="Buscar por Producto" id ="FiltrarNombre" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" >
                
                  
                      <br>
                      <div id="boton-centrado">
          <input type="submit" value="Buscar">
          </div>

                </td>
              </tr>
            </table>
          </form> </div>
            <!--/*********************************FIN FORMULARIO PARA EL FILTRO*****************************************************/ -->



        <!-- contenido principal -->
      

                 <div id="listado">
                 <form method="post" action="" name="frm_listProductos" id="frm_listProductos" style="width: auto; height: auto;">
					
                     <?php
  include_once 'clases/producto.php';
  $doc = new Producto();
  $productos = $doc->listar();
  if($productos){
    echo "
    <div style='width: 100%; overflow-x: auto;'>
      <table class='table table-bordered border-primary table-hover tabla-productos'><thead>
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
      if($filtro1 || $filtro2){
        foreach ($productos as $producto) {
        //  if($filtro1 == $alumno['curp'] || $filtro2 == $alumno['nombre'] || $filtro3 == $alumno['apellidos']){
          if($filtro1 == $producto['Codigo'] || $filtro2 == $producto['Nombre']){
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

    echo "</table> </div>";
  }
  else{
    echo " <p>No hay Productos registrados en la base de datos</p>";
  }
?>


           </form></div>
        <div id="boton-centrado">
          <input type="button" onClick="location='menuAdmin.php'" value="Regresar" />
          </div>

         

     