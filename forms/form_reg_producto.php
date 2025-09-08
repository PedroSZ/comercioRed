
<form method="post"  action="modulos/mdl_reg_producto.php" id="frm_reg_Productos" >
  <input name="fecha_registro_p" type="hidden" id ="fecha_registro_p" required >
   
  <div class="container">
   <div class= "grid-item"><div class= "container-grid"><div class= "grid-item-container"><p><label>Código: <span class="requerido">*</span></label></p></div><div class= "grid-item-container"><p><input name="codigo" type="text" id="codigoid" required></p></div></div></div>
   <div class= "grid-item"><div class= "container-grid"><div class= "grid-item-container"><p><label>Nomre del producto: <span class="requerido">*</span></label></p></div><div class= "grid-item-container"><p><input name="producto_nombre" type="text" id="producto_nombre" required></p></div></div></div>
   <div class= "grid-item"><div class= "container-grid"><div class= "grid-item-container"><p><label>Descripción:</label></p></div><div class= "grid-item-container"><p><input name="descripcion" type="text" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" placeholder="Ingresar descripción del producto" id ="descripcion" title="Agrega una breve descripción por favor " ></p></div></div></div>
   <div class= "grid-item"><div class= "container-grid"><div class= "grid-item-container"><p><label>Cantidad: <span class="requerido">*</span></label></p></div><div class= "grid-item-container"><p><input name="stock" type="text" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" placeholder="Ingresar la cantidad" id ="cantidad" title="Ingresa la cantidad de productos " required ></p></div></div></div>
   <div class= "grid-item"><div class= "container-grid"><div class= "grid-item-container"><p><label>Fecha de Caducidad:</label></p></div><div class= "grid-item-container"><p><input name="fecha_caducidad" type="date" id ="fecha_caducidad" title="Fecha de caducidad 5 dias despues del registro"></p></div></div></div>
   <div class= "grid-item"><div class= "container-grid"><div class= "grid-item-container"><p><label>Costo:</label></p></div><div class= "grid-item-container"> <p><input name="costo" type="text"  placeholder="Ingresar costo" id ="costo" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" title="Por favor especifica costo de producción" ></p></div></div></div>
   <div class= "grid-item"><div class= "container-grid"><div class= "grid-item-container"><p><label>Precio: <span class="requerido">*</span></label></p></div><div class= "grid-item-container"><p><input name="precio" type="text" placeholder="Ingresar precio" id ="precio" title="Ingresa el precio del producto por favor " ></p></div></div></div>
   
   
   <div class= "grid-item">
   <input type="submit" value="Registrar">
      <input type="button" value="Cancelar" onclick="limpiar()">
       <input type="button" onclick="location='menuAdmin.php'" value="Regresar" />
      </div>
  </div>

</form>