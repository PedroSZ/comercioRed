<form method="post" class="form_registro" action="modulos/mdl_reg_sucursal.php" 
      id="frm_reg_Sucursales" enctype="multipart/form-data">

  <!-- Fecha -->
  <input name="fecha_registro" type="hidden" id="fecha_registro" >

  <div class="container" id="container-sucursal">

    <!-- Sucursal -->
    <div class="grid-item">
      <div class="container-grid">
        <div class="grid-item-container"><p><label>Sucursal:</label></p></div>
        <div class="grid-item-container"><p>
          <input name="sucursal" type="text" value="Patria" >
        </p></div>
      </div>
    </div>

    <!-- Domicilio -->
    <div class="grid-item">
      <div class="container-grid">
        <div class="grid-item-container"><p><label>Domicilio:</label></p></div>
        <div class="grid-item-container"><p>
          <input name="domicilio" type="text" 
                 value="Av. Patria No. , Colonia Santuario, C.P. 46620. Am" >
        </p></div>
      </div>
    </div>

    <!-- Teléfono -->
    <div class="grid-item">
      <div class="container-grid">
        <div class="grid-item-container"><p><label>Teléfono:</label></p></div>
        <div class="grid-item-container"><p>
          <input name="telefono" type="text" value="375 100 3330" >
        </p></div>
      </div>
    </div>

    <!-- Email -->
    <div class="grid-item">
      <div class="container-grid">
        <div class="grid-item-container"><p><label>E-Mail:</label></p></div>
        <div class="grid-item-container"><p>
          <input name="email" type="email" value="lapiconeria@gmail.com" >
        </p></div>
      </div>
    </div>

    <!-- Logotipo -->
    <div class="grid-item">
      <div class="container-grid">
        <div class="grid-item-container"><p><label>Logotipo:</label></p></div>
        <div class="grid-item-container"><p>
          <input name="logotipo" type="file" accept="image/*" >
          <br>
          <img src="img/logotipos/1756919785_Logotipo.png" width="120" alt="Logo actual">
        </p></div>
      </div>
    </div>

    <!-- Colores -->
    <div class="grid-item"><div class="container-grid"><div class="grid-item-container"><p><label>Color de Fondo Principal:</label></p></div><div class="grid-item-container"><p><input name="c_primario" type="color" value="#fcf8f8" ></p></div></div></div>
    <div class="grid-item"><div class="container-grid"><div class="grid-item-container"><p><label>Color de Fondo Secundario:</label></p></div><div class="grid-item-container"><p><input name="c_secundario" type="color" value="#f7f7f7" ></p></div></div></div>
    <div class="grid-item"><div class="container-grid"><div class="grid-item-container"><p><label>Color Radial:</label></p></div><div class="grid-item-container"><p><input name="radial" type="color" value="#69b894" ></p></div></div></div>
    <div class="grid-item"><div class="container-grid"><div class="grid-item-container"><p><label>Color de Texto Principal:</label></p></div><div class="grid-item-container"><p><input name="c_texto_principal" type="color" value="#000000" ></p></div></div></div>
    <div class="grid-item"><div class="container-grid"><div class="grid-item-container"><p><label>Color de Texto Secundario:</label></p></div><div class="grid-item-container"><p><input name="c_texto_secundario" type="color" value="#4e4b4b" ></p></div></div></div>
    <div class="grid-item"><div class="container-grid"><div class="grid-item-container"><p><label>Color de Header Principal:</label></p></div><div class="grid-item-container"><p><input name="color_header_principal" type="color" value="#2259f2" ></p></div></div></div>
    <div class="grid-item"><div class="container-grid"><div class="grid-item-container"><p><label>Color de Header Secundario:</label></p></div><div class="grid-item-container"><p><input name="color_header_secundario" type="color" value="#eddd53" ></p></div></div></div>
    <div class="grid-item"><div class="container-grid"><div class="grid-item-container"><p><label>Color de Footer Principal:</label></p></div><div class="grid-item-container"><p><input name="color_footer_principal" type="color" value="#ad8225" ></p></div></div></div>
    <div class="grid-item"><div class="container-grid"><div class="grid-item-container"><p><label>Color de Footer Secundario:</label></p></div><div class="grid-item-container"><p><input name="color_footer_secundario" type="color" value="#2259f2" ></p></div></div></div>
    <div class="grid-item"><div class="container-grid"><div class="grid-item-container"><p><label>Color Principal de Texto en Header:</label></p></div><div class="grid-item-container"><p><input name="color_texto_header_principal" type="color" value="#000000" ></p></div></div></div>
    <div class="grid-item"><div class="container-grid"><div class="grid-item-container"><p><label>Color Secundario de Texto en Header:</label></p></div><div class="grid-item-container"><p><input name="color_texto_header_secundario" type="color" value="#7d7d7d" ></p></div></div></div>
    <div class="grid-item"><div class="container-grid"><div class="grid-item-container"><p><label>Color Principal de Texto de Footer:</label></p></div><div class="grid-item-container"><p><input name="color_texto_footer_principal" type="color" value="#fafafa" ></p></div></div></div>
    <div class="grid-item"><div class="container-grid"><div class="grid-item-container"><p><label>Color Secundario de Texto Footer:</label></p></div><div class="grid-item-container"><p><input name="color_texto_footer_secundario" type="color" value="#666060" ></p></div></div></div>
    <div class="grid-item"><div class="container-grid"><div class="grid-item-container"><p><label>Color Principal de Botones:</label></p></div><div class="grid-item-container"><p><input name="color_boton_principal" type="color" value="#4665e2" ></p></div></div></div>
    <div class="grid-item"><div class="container-grid"><div class="grid-item-container"><p><label>Color Secundario de Botones:</label></p></div><div class="grid-item-container"><p><input name="color_boton_secundario" type="color" value="#394660" ></p></div></div></div>
    <div class="grid-item"><div class="container-grid"><div class="grid-item-container"><p><label>Color Principal de Texto en Botones:</label></p></div><div class="grid-item-container"><p><input name="color_boton_texto_principal" type="color" value="#fefbfb" ></p></div></div></div>
    <div class="grid-item"><div class="container-grid"><div class="grid-item-container"><p><label>Color Secundario de Texto en Botones:</label></p></div><div class="grid-item-container"><p><input name="color_boton_texto_secundario" type="color" value="#fcfcfc" ></p></div></div></div>

  </div>  

  <!-- Botones -->
  <div id="boton-centrado">
    <input type="submit" value="Registrar">
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
