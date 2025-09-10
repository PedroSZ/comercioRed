<?php
include_once '../clases/auth.php'; // Verifica sesión y redirige si no hay
include_once '../modulos/mdl_header.php';
?>
<!doctype html>
<!-- menuAdmin.php -->
<html lang="en">
  <head>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/navbarYmenu.css">
    <link rel="stylesheet" href="../css/formRegistro.css">
     <link rel="stylesheet" href="../css/contenedores.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    <script src="../js/modulos.js" type="text/javascript"></script>


  </head>
  <body class="form-page">
    <div class="superponer">
    <h1 class="text-center mt-4">Actualizacion de Sucursal</h1>
    <p class="text-center">Puede personalizar los colores, logotipo y datos de su sistema.</p>
    </div>
<?php
    	if(!empty($_POST['miIdSucursal'])){
   
		include_once '../clases/sucursal.php';
		$codigo = $_POST['miIdSucursal'];
		$tienda = new Sucursal();
		$sucursal = $tienda->consultarCodigo($codigo);
	}
	else{
 echo "POST BACIO";
	}
?>

<form method="post" class="form_registro" action="../modulos/mdl_acttualizarSucursal.php" id="frm_reg_Sucursales" enctype="multipart/form-data">
   <input name="idS"  id="idS" type="hidden" value="<?php echo htmlspecialchars($_POST['miIdSucursal']); ?>">
   <input name="fecha_registro" type="hidden" id="fecha_registro">

   <div class="container" id="container-sucursal">

       <!-- Sucursal -->
       <div class="grid-item">
           <div class="container-grid">
               <div class="grid-item-container"><p><label>Sucursal:</label></p></div>
               <div class="grid-item-container"><p><input name="sucursal" type="text" value="<?php echo htmlspecialchars($sucursal['Nombre_Sucursal']); ?>"></p></div>
           </div>
       </div>

       <!-- Domicilio -->
       <div class="grid-item">
           <div class="container-grid">
               <div class="grid-item-container"><p><label>Domicilio:</label></p></div>
               <div class="grid-item-container"><p><input name="domicilio" type="text" value="<?php echo htmlspecialchars($sucursal['Domicilio']); ?>"></p></div>
           </div>
       </div>

       <!-- Teléfono -->
       <div class="grid-item">
           <div class="container-grid">
               <div class="grid-item-container"><p><label>Teléfono:</label></p></div>
               <div class="grid-item-container"><p><input name="telefono" type="text" value="<?php echo htmlspecialchars($sucursal['Telefono']); ?>"></p></div>
           </div>
       </div>

       <!-- Email -->
       <div class="grid-item">
           <div class="container-grid">
               <div class="grid-item-container"><p><label>E-Mail:</label></p></div>
               <div class="grid-item-container"><p><input name="email" type="email" value="<?php echo htmlspecialchars($sucursal['Email']); ?>"></p></div>
           </div>
       </div>

       <!-- Logotipo -->
       <div class="grid-item">
           <div class="container-grid">
               <div class="grid-item-container"><p><label>Logotipo:</label></p></div>
               <div class="grid-item-container">
                   <p><input name="logotipo" type="file" accept="image/*"></p>
                   <?php if(!empty($sucursal['Logotipo']) && file_exists('../' . $sucursal['Logotipo'])): ?>
                       <img src="../<?php echo $sucursal['Logotipo']; ?>" width="120" alt="Logo actual">
                   <?php else: ?>
                       <p>No hay logotipo cargado</p>
                   <?php endif; ?>
               </div>
           </div>
       </div>

       <!-- Colores -->
       <?php
       $colores = [
           'c_primario' => 'color_background_principal',
           'c_secundario' => 'color_background_secundario',
           'radial' => 'color_radial',
           'c_texto_principal' => 'color_texto_principal',
           'c_texto_secundario' => 'color_texto_secundario',
           'color_header_principal' => 'color_header_principal',
           'color_header_secundario' => 'color_header_secundario',
           'color_footer_principal' => 'color_footer_principal',
           'color_footer_secundario' => 'color_footer_secundario',
           'color_texto_header_principal' => 'color_texto_header_principal',
           'color_texto_header_secundario' => 'color_texto_header_secundario',
           'color_texto_footer_principal' => 'color_texto_footer_principal',
           'color_texto_footer_secundario' => 'color_texto_footer_secundario',
           'color_boton_principal' => 'color_boton_principal',
           'color_boton_secundario' => 'color_boton_secundario',
           'color_boton_texto_principal' => 'color_boton_texto_principal',
           'color_boton_texto_secundario' => 'color_boton_texto_secundario',
       ];
       foreach($colores as $input => $dbField):
       ?>
           <div class="grid-item">
               <div class="container-grid">
                   <div class="grid-item-container"><p><label><?php echo ucwords(str_replace('_',' ', $input)); ?>:</label></p></div>
                   <div class="grid-item-container"><p><input name="<?php echo $input; ?>" type="color" value="<?php echo htmlspecialchars($sucursal[$dbField]); ?>"></p></div>
               </div>
           </div>
       <?php endforeach; ?>

   </div>  

   <!-- Botones -->
   <div id="boton-centrado">
       <input type="submit" value="Actualizar">
       <input type="button" value="Cancelar" onclick="limpiar()">
       <input type="button" onclick="location='menuAdmin.php'" value="Regresar">
   </div>
</form>

<script>
window.onload = function() {
    let fecha = new Date();
    let dia  = ("0" + fecha.getDate()).slice(-2);
    let mes  = ("0" + (fecha.getMonth() + 1)).slice(-2);
    let ano  = fecha.getFullYear();
    document.getElementById('fecha_registro').value = ano + "-" + mes + "-" + dia;
};
</script>
    </div>
   <?php include_once '../modulos/mdl_footer.php'; ?>
  </body>
</html>