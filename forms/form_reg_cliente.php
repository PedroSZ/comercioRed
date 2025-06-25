
<form method="post" style="width: 65vw; height:auto;"  action="modulos/mdl_reg_cliente.php" id="frm_reg_clientes" >
   <input name="fecha_registro_c" type="hidden" id ="fecha_registro_c" required >

<table border="0" style=font-weight: 600; font-size: 17px;">
 
  <tr>
    <td COLSPAN=2 style="text-align: right;">
      <p><label>Nombre:</label></p>
    </td>
    <td>
      <p><input name="cliente_nombre" type="text" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" placeholder="Ingresar Nombre" id ="cliente_nombre" title="Ingresa al menos un nombre por favor " required></p>
    </td>

     <td COLSPAN=2 width="50%" style="text-align: right;">
      <p><label>Apellido Paterno:</label></p>
    </td>
    <td>
      <p><input name="cliente_a_paterno" type="text" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" placeholder="Ingresar Apellido Paterno" id ="cliente_cliente_a_paterno"title="Ingresa al menos un apellido por favor "  ></p>
    </td>
  </tr>
 
  <tr>
    <td COLSPAN=2 style="text-align: right;">
      <p><label>Apellido Materno:</label></p>
    </td>
    <td>
      <p><input name="cliente_a_materno" type="text" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" placeholder="Ingresar Apellido Materno" id ="cliente_a_materno"  title="Ingresa al menos un apellido por favor " ></p>
    </td>
     <td COLSPAN=2 style="text-align: right;">
      <p><label>Fecha de Nacimiento:</label></p>
    </td>
    <td>
      <p><input name="cliente_fecha_nacimiento" type="date" id ="cliente_fecha_nacimiento"></p>
    </td>
  </tr>


   <tr>
    <td COLSPAN=2 style="text-align: right;">
      <p><label>Telefono:</label></p>
    </td>
    <td>
      <p><input name="cliente_telefono" type="number" placeholder="Ingresar Telefono" id ="cliente_telefono" pattern="[0-9]+" title="Ingresa al menos un numero por favor " ></p>
    </td>
     <td COLSPAN=2 style="text-align: right;">
      <p><label>E-Mail:</label></p>
    </td>
    <td>
      <p><input name="cliente_email"  type="email" placeholder="Ingresar Email" id ="cliente_email" pattern="^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$" title="Por favor ingresa un correo con el formato nombre@sitio.dominio" require></p>
    </td>
  </tr>

   <tr>
     <td COLSPAN=2 style="text-align: right;">
      <p><label>Domicilio:</label></p>
    </td>
    <td>
      <p><input name="cliente_domicilio" type="text" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" placeholder="Ingresar Dirección" id ="cliente_domicilio" title="Ingresa al menos una dirección por favor"></p>
    </td>

     <td COLSPAN=2  style="text-align: right;">
      <p>RFC:</p>
    </td>
    <td>
      <p><input name="cliente_rfc" type="text"  placeholder="Ingresar RFC" id ="cliente_rfc" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()"  pattern="^[A-ZÑ&]{3,4}[0-9]{2}(0[1-9]|1[0-2])(0[1-9]|[12][0-9]|3[01])[A-Z0-9]{3}$" title="Por favor ingresa solo un formato RFC por ejemplo SAJG990112000"></p>
    </td>
  </tr>

 
     <tr>
    <td COLSPAN=2 style="text-align: right;">
      <p><label>Limite de Credito:</label></p>
    </td>
    <td>
      <p><input name="limite" type="number" placeholder="Ingresar limite de credito" id ="limite"  pattern="[0-9]+" title="Limite de credito" ></p>
    </td>
     <td COLSPAN=2 style="text-align: right;">
      <p><label>Credito Disponible:</label></p>
    </td>
    <td>
      <p><input name="disponible"  type="number" placeholder="Ingresar credito disponible" id ="disponible"  pattern="[0-9]+" title="Credito disponible" ></p>
    </td>
  </tr>
  <tr>  
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