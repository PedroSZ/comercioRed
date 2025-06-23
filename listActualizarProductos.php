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
$filtro1 = $_POST['FiltarId_actualizar_producto']; //para obtener la curp a buscar del fitro
$filtro2 = $_POST['FiltarNom_actualizar_producto'];
$filtro3 = $_POST['FiltarPater_actualizar_producto'];

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
     <link rel="stylesheet" href="css/formularios.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
     <link rel="stylesheet" href="css/contenedores.css">
 
        	<script language='javascript'>
		          function consultar(codigo) {
                 document.lista_actualizar_producto.micodigo.value = codigo;
			           // alert(codigo);
                   document.lista_actualizar_producto.submit();
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
 <div class="superponer"> 
    <h1 class="text-center mt-4">Modificaciones</h1>
    <p class="text-center">Elija de la lista el producto que desea actualizar haciendo clic en el icono. <img src="img/Actualizar.png" width="30" height="30" alt="Actualizar" title="Actualizar producto"></p>
          </div>   
           <div id="filtro">   
    <form method="post" action="listActualizarProductos.php" name="form_filtro_actualizar_producto" id="form_filtro_actualizar_producto" style="align-items: center; background:rgba(0,0,0,0.0);">
                <table class="table-primary"  border="1">

              <tr>
                <td width="100%" style="text-align: right;">

                  <input name="FiltarId_actualizar_producto" type="text"  placeholder="Buscar por Código" id ="FiltarId_actualizar_producto" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" >
                  <input name="FiltarNom_actualizar_producto" type="text" title="Busqueda por nombre"  placeholder="Buscar por Nombre" id ="FiltarNom_actualizar_producto" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" >
                  <input name="FiltarPater_actualizar_producto" type="text" title="Busqueda por Descripción" placeholder="Buscar por descripcion" id ="FiltarPater_actualizar_producto" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()">

                  
                      <br>
                      <input type="submit" value="Buscar">

                </td>
              </tr>
            </table>
          </form>
        </div>
            <!--/*********************************FIN FORMULARIO PARA EL FILTRO*****************************************************/ -->


                <div id="listado">
                 <form method="post" action="forms/form_act_producto.php" name="lista_actualizar_producto" id="lista_actualizar_producto" style="width: auto; height: auto;">
                    <input type="hidden" id="micodigo" name="micodigo">
                     <?php
  include_once 'clases/producto.php';
  $produ = new Producto();
  $productos = $produ->listar();
  if($productos){
    echo "
    
      <table class='table table-bordered border-primary table-hover tabla-datos'><thead>
      <tr>
        <th style='text-align:center'>Codigo</th>
        <th style='text-align:center'>Producto</th>
        <th style='text-align:center'>Descripcion</th>
        <th style='text-align:center'>Existencias</th>
        <th style='text-align:center'>Feca de caducidad</th>
        <th style='text-align:center'>Registrado desde</th>
        <th style='text-align:center'>Costo producccion</th>
        <th style='text-align:center'>Precio al Púlico</th>
        <th style='text-align:center'>Modificar</th>
      </tr></thead>";
      if($filtro1 || $filtro2 || $filtro3){
        foreach ($productos as $produ) {
        
          if($filtro1 == $produ['Codigo'] || $filtro2 == $user2['Nombre'] || $filtro3 == $user2['Fecha_Registro'] ){
            echo "<tr>
            <td>".$produ['Codigo']."</td>
            <td>".$produ['Nombre']."</td>
            <td>".$produ['Descripcion']."</td> 
            <td>".$produ['Stock']."</td>
            <td>".$produ['Fecha_Caducidad']."</td>
            <td>".$produ['Fecha_Registro']."</td>
            <td>".$produ['Costo']."</td>
            <td>".$produ['Precio']."</td> 
           <td style='text-align:center'><img width='30' height='30' src='img/Actualizar.png' onClick='consultar(\"".$produ['Codigo']."\");'></td>
            </tr>";
          }

        }


      }else{
          foreach ($productos as $produ) {
           echo "<tr>
            <td>".$produ['Codigo']."</td>
            <td>".$produ['Nombre']."</td>
            <td>".$produ['Descripcion']."</td> 
            <td>".$produ['Stock']."</td>
            <td>".$produ['Fecha_Caducidad']."</td>
            <td>".$produ['Fecha_Registro']."</td>
            <td>".$produ['Costo']."</td>
            <td>".$produ['Precio']."</td> 
           <td style='text-align:center'><img width='30' height='30' src='img/Actualizar.png' onClick='consultar(\"".$produ['Codigo']."\");'></td>
            </tr>";
        }
      }

    echo "</table>";
  }
  else{
    echo " <p>No hay Productos registrados en la base de datos</p>";
  }
?>


           </form></div>
      

         <div id="boton-centrado">
 <input type="button" onClick="location='menuAdmin.php'" value="Regresar" />
 </div>
        <!-- Pie de pagina--> 

           

 
    </body> 
   
</html>
