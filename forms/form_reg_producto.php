
<form method="post" style="width: 65vw; height:auto;"  action="modulos/mdl_reg_producto.php" id="frm_reg_Productos" >
  <input name="fecha_registro_p" type="hidden" id ="fecha_registro_p" required >

<table border="0" style=font-weight: 600; font-size: 17px;">
 
  <tr>
    <td COLSPAN=2 style="text-align: right;">
      <p><label>Código: <span class="requerido">*</span></label></p>
    </td>
    <td>
      <!--<p><input name="codigo"  type="text" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" placeholder="Código del producto" id ="codigoid"  title="Campo obligatorio " required></p>-->
      <p><input name="codigo" type="text" id="codigoid" required></p>
    </td>

     <td COLSPAN=2 width="50%" style="text-align: right;">
      <p><label>Nomre del producto: <span class="requerido">*</span></label></p>
    </td>
    <td>
      <p><input name="producto_nombre" type="text" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" placeholder="Ingresar nombre del producto" id ="producto_nombre" title="Ingresa nombre del producto " required ></p>
    </td>
  </tr>
 
  <tr>
    <td COLSPAN=2 style="text-align: right;">
      <p><label>Descripción:</label></p>
    </td>
    <td>
      <p><input name="descripcion" type="text" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" placeholder="Ingresar descripción del producto" id ="descripcion" title="Agrega una breve descripción por favor " ></p>
    </td>
      <td COLSPAN=2 style="text-align: right;">
      <p><label>Cantidad: <span class="requerido">*</span></label></p>
    </td>
    <td>
      <p><input name="stock" type="text" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" placeholder="Ingresar la cantidad" id ="cantidad" title="Ingresa la cantidad de productos " required ></p>
    </td>
  </tr>

  <tr>
    <td COLSPAN=2 style="text-align: right;">
      <p><label>Fecha de Caducidad:</label></p>
    </td>
    <td>
      <p><input name="fecha_caducidad" type="date" id ="fecha_caducidad" title="Fecha de caducidad 5 dias despues del registro"></p>
    </td>

     
  </tr>

   <tr>
     <td COLSPAN=2  style="text-align: right;">
      <p>Costo:</p>
    </td>
    <td>
      <p><input name="costo" type="text"  placeholder="Ingresar costo" id ="costo" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" title="Por favor especifica costo de producción" ></p>
    </td>
    <td COLSPAN=2 style="text-align: right;">
      <p><label>Precio: <span class="requerido">*</span></label></p>
    </td>
    <td>
      <p><input name="precio" type="text" placeholder="Ingresar precio" id ="precio" title="Ingresa el precio del producto por favor " ></p>
    </td>
    </tr>  
  <tr>
    <td COLSPAN=5 style="text-align: center;">
      <BR>
      <input type="submit" value="Registrar">
      <input type="button" value="Cancelar" onclick="limpiar()">
       <input type="button" onclick="location='menuAdmin.php'" value="Regresar" />
    </td>
  </tr>
  </table>

</form>