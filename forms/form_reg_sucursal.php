<form method="post" class="form_registro" action="modulos/mdl_reg_sucursal.php" 
      id="frm_reg_Sucursales" enctype="multipart/form-data">

  <input name="fecha_registro" type="hidden" id="fecha_registro" required>

  <div class="container" id="container-sucursal">

    <!-- Sucursal -->
    <div class="grid-item">
      <div class="container-grid">
        <div class="grid-item-container"><p><label>Sucursal:</label></p></div>
        <div class="grid-item-container"><p><input name="sucursal" type="text" required></p></div>
      </div>
    </div>

    <!-- Domicilio -->
    <div class="grid-item">
      <div class="container-grid">
        <div class="grid-item-container"><p><label>Domicilio:</label></p></div>
        <div class="grid-item-container"><p><input name="domicilio" type="text" required></p></div>
      </div>
    </div>

    <!-- Teléfono -->
    <div class="grid-item">
      <div class="container-grid">
        <div class="grid-item-container"><p><label>Teléfono:</label></p></div>
        <div class="grid-item-container"><p><input name="telefono" type="text" required></p></div>
      </div>
    </div>

    <!-- Email -->
    <div class="grid-item">
      <div class="container-grid">
        <div class="grid-item-container"><p><label>E-Mail:</label></p></div>
        <div class="grid-item-container"><p><input name="email" type="email" required></p></div>
      </div>
    </div>

    <!-- Logotipo -->
    <div class="grid-item">
      <div class="container-grid">
        <div class="grid-item-container"><p><label>Logotipo:</label></p></div>
        <div class="grid-item-container"><p><input name="logotipo" type="file" accept="image/*" required></p></div>
      </div>
    </div>

    <!-- Colores -->
    <div class="grid-item"><div class="container-grid"><div class="grid-item-container"><p><label>Color de Fondo Principal:</label></p></div><div class="grid-item-container"><p><input name="c_primario" type="color" required></p></div></div></div>
    <div class="grid-item"><div class="container-grid"><div class="grid-item-container"><p><label>Color de Fondo Secundario:</label></p></div><div class="grid-item-container"><p><input name="c_secundario" type="color" required></p></div></div></div>
    <div class="grid-item"><div class="container-grid"><div class="grid-item-container"><p><label>Color Radial:</label></p></div><div class="grid-item-container"><p><input name="radial" type="color" required></p></div></div></div>
    <div class="grid-item"><div class="container-grid"><div class="grid-item-container"><p><label>Color de Texto Principal:</label></p></div><div class="grid-item-container"><p><input name="c_texto_principal" type="color" required></p></div></div></div>
    <div class="grid-item"><div class="container-grid"><div class="grid-item-container"><p><label>Color de Texto Secundario:</label></p></div><div class="grid-item-container"><p><input name="c_textp_secundario" type="color" required></p></div></div></div>
    <div class="grid-item"><div class="container-grid"><div class="grid-item-container"><p><label>Color de Header Principal:</label></p></div><div class="grid-item-container"><p><input name="color_header_principal" type="color" required></p></div></div></div>
    <div class="grid-item"><div class="container-grid"><div class="grid-item-container"><p><label>Color de Header Secundario:</label></p></div><div class="grid-item-container"><p><input name="color_header_secundario" type="color" required></p></div></div></div>
    <div class="grid-item"><div class="container-grid"><div class="grid-item-container"><p><label>Color de Footer Principal:</label></p></div><div class="grid-item-container"><p><input name="color_footer_principal" type="color" required></p></div></div></div>
    <div class="grid-item"><div class="container-grid"><div class="grid-item-container"><p><label>Color de Footer Secundario:</label></p></div><div class="grid-item-container"><p><input name="color_footer_secundario" type="color" required></p></div></div></div>
    <div class="grid-item"><div class="container-grid"><div class="grid-item-container"><p><label>Color Principal de Texto en Header:</label></p></div><div class="grid-item-container"><p><input name="color_texto_header_principal" type="color" required></p></div></div></div>
    <div class="grid-item"><div class="container-grid"><div class="grid-item-container"><p><label>Color Secundario de Texto en Header:</label></p></div><div class="grid-item-container"><p><input name="color_texto_header_secundario" type="color" required></p></div></div></div>
    <div class="grid-item"><div class="container-grid"><div class="grid-item-container"><p><label>Color Principal de Texto de Footer:</label></p></div><div class="grid-item-container"><p><input name="color_texto_footer_principal" type="color" required></p></div></div></div>
    <div class="grid-item"><div class="container-grid"><div class="grid-item-container"><p><label>Color Secundario de Texto Footer:</label></p></div><div class="grid-item-container"><p><input name="color_texto_footer_secundario" type="color" required></p></div></div></div>
    <div class="grid-item"><div class="container-grid"><div class="grid-item-container"><p><label>Color Principal de Botones:</label></p></div><div class="grid-item-container"><p><input name="color_boton_principal" type="color" required></p></div></div></div>
    <div class="grid-item"><div class="container-grid"><div class="grid-item-container"><p><label>Color Secundario de Botones:</label></p></div><div class="grid-item-container"><p><input name="color_boton_secundario" type="color" required></p></div></div></div>
    <div class="grid-item"><div class="container-grid"><div class="grid-item-container"><p><label>Color Principal de Texto en Botones:</label></p></div><div class="grid-item-container"><p><input name="color_boton_texto_principal" type="color" required></p></div></div></div>
    <div class="grid-item"><div class="container-grid"><div class="grid-item-container"><p><label>Color Secundario de Texto en Botones:</label></p></div><div class="grid-item-container"><p><input name="color_boton_texto_secundario" type="color" required></p></div></div></div>

  </div>  

  <!-- Botones -->
  <div id="boton-centrado">
    <input type="submit" value="Registrar">
    <input type="button" value="Cancelar" onclick="limpiar()">
    <input type="button" onclick="location='menuAdmin.php'" value="Regresar">
  </div>

</form>
