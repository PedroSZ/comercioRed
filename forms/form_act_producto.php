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
		include_once '../clases/producto.php';
		$codigo = $_POST['micodigo'];
		$produ = new Producto();
		$item = $produ->consultarCodigo($codigo);
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
       <div class="container">
    <h1 class="text-center mt-4">Actualizacion de producto</h1>
    <p class="text-center">Edite la información de los campos que desee modificar y luego presione el boton actualizar.</p>

               <form method="post" style="width: auto; height:auto;"  action="../modulos/mdl_ActualizarProducto.php" id="frm_ActualizarProducto" >
            <input name="fecha_registro_p" type="hidden" id ="fecha_registro_p" required >

  <table border="0" style="color:#FFFFFF; font-weight: 600; font-size: 17px;">
  <?php
echo '
      
     
 

 
  <tr>
    <td COLSPAN=2 style="text-align: right;">
      <p  class = "negrita"><label>Codigo:</label></p>
    </td>
    <td>
      <p><input name="codigo" type="text" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" placeholder="Código del producto" id ="codigoid"  title="Campo obligatorio " required value="'.$item["Codigo"].'"></p>
    </td>

     <td COLSPAN=2 width="50%" style="text-align: right;">
      <p  class = "negrita"><label>Nombre del producto:</label></p>
    </td>
    <td>
      <p><input name="producto_nombre" type="text" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" placeholder="Ingresar nombre del producto" id ="producto_nombre" required pattern="[A-ZÑ ]+" title="Ingresa nombre del producto " required value="'.$item["Nombre"].'"></p>
    </td>
  </tr>
 
  <tr>
    <td COLSPAN=2 style="text-align: right;">
      <p  class = "negrita"><label>Descripción:</label></p>
    </td>
    <td>
      <p><input name="descripcion" type="text" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" placeholder="Ingresar descripción del producto" id ="descripcion" required pattern="[A-ZÑ ]+" title="Agrega una breve descripción por favor " value="'.$item["Descripcion"].'"></p>
    </td>
      <td COLSPAN=2 style="text-align: right;">
      <p  class = "negrita"><label>Cantidad:</label></p>
    </td>
    <td>
      <p><input name="stock" type="text" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" placeholder="Ingresar la cantidad" id ="cantidad" title="Ingresa la cantidad de productos " required value="'.$item["Stock"].'"></p>
    </td>
  </tr>

  <tr>
    <td COLSPAN=2 style="text-align: right;">
      <p  class = "negrita"><label>Fecha de Caducidad:</label></p>
    </td>
    <td>
      <p><input name="fecha_caducidad" type="date" id ="fecha_caducidad" required value="'.$item["Fecha_Caducidad"].'"></p>
    </td>

     
  </tr>

   <tr>
     <td COLSPAN=2  style="text-align: right;">
      <p  class = "negrita">Costo:</p>
    </td>
    <td>
      <p><input name="costo" type="text"  placeholder="Ingresar costo" id ="costo" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" title="Por favor especifica costo de producción" required value="'.$item["Costo"].'"></p>
    </td>
    <td COLSPAN=2 style="text-align: right;">
      <p  class = "negrita"><label>Precio:</label></p>
    </td>
    <td>
      <p><input name="precio" type="text" placeholder="Ingresar precio" id ="precio" title="Ingresa el precio del producto por favor " value="'.$item["Precio"].'"></p>
    </td>
    </tr>  
  '?>
  <tr>
    <td COLSPAN=5 style="text-align: center;">
      <BR>
      <input type="submit" value="Actualizar">
      <input type="button" value="Cancelar" onclick="limpiar()">
       <input type="button" onclick="location='../listActualizarProductos.php'" value="Regresar" />
    </td>
  </tr>
  </table>
</form>
          
        <!-- Pie de pagina-->
            <?php include_once '../modulos/mdl_footer.php'; ?>

    </div>
    </body>
</html>
