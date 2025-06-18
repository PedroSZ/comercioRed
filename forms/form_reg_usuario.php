
<form method="post" style="width: 65vw; height:auto;"  action="modulos/mdl_reg_usuario.php" id="frm_reg_Usuarios" >
  <table border="0" style=font-weight: 600; font-size: 17px;">
 
      <input name="fecha_registro" type="hidden" id ="fecha_registro" required >
       <!--<input name="id_tipo" type="text" id ="id_tipo" required > -->
     
    
  <tr>
    <td COLSPAN=2 style="text-align: right;"><p><label>Nombre:</label></p></td>
    <td><p><input name="nombre" type="text" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" placeholder="Ingresar Nombre" id ="nombre" required pattern="[A-ZÑ ]+" title="Ingresa al menos un nombre por favor " required></p></td>

     <td COLSPAN=2  width="50%" style="text-align: right;"><p><label>Apellido Paterno:</label></p></td>
    <td><p><input name="a_paterno" type="text" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" placeholder="Ingresar Apellido Paterno" id ="a_paterno" required pattern="[A-ZÑ ]+" title="Ingresa al menos un apellido por favor " required ></p></td>
  </tr>
 
  <tr>
    <td COLSPAN=2 style="text-align: right;"><p><label>Apellido Materno:</label></p></td>
    <td><p><input name="a_materno" type="text" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" placeholder="Ingresar Apellido Materno" id ="a_materno" required pattern="[A-ZÑ ]+" title="Ingresa al menos un apellido por favor " ></p></td>
    <td COLSPAN=2 style="text-align: right;"><p><label>Fecha de Nacimiento:</label></p></td>
    <td><p><input name="fecha_nacimiento" type="date" id ="fecha_nacimiento" required ></p></td>

  </tr>

  <tr>
    
     <td COLSPAN=2 style="text-align: right;">
      <p><label>RFC:</label></p>
    </td>
    <td>
      <p><input name="rfc" type="text"  placeholder="Ingresar RFC" id ="rfc" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" required pattern="^[A-ZÑ&]{3,4}[0-9]{2}(0[1-9]|1[0-2])(0[1-9]|[12][0-9]|3[01])[A-Z0-9]{3}$" title="Por favor ingresa solo un formato RFC por ejemplo SAJG990112000" required></p>
    </td>

  </tr>

   <tr>
    <td COLSPAN=2 style="text-align: right;">
      <p><label>Telefono:</label></p>
    </td>
    <td>
      <p><input name="telefono" type="number" placeholder="Ingresar Telefono" id ="telefono" required pattern="[0-9]+" title="Ingresa al menos un numero por favor " ></p>
    </td>
     <td COLSPAN=2 style="text-align: right;">
      <p><label>E-Mail:</label></p>
    </td>
    <td>
      <p><input name="email"  type="email" placeholder="Ingresar Email" id ="email" required pattern="^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$" title="Por favor ingresa un correo con el formato nombre@sitio.dominio" required></p>
    </td>
  </tr>

   <tr>
        <td COLSPAN=2 style="text-align: right;">
        <p><label>Tipo de Usuario:</label></p>
          </td>
            <td>
             <p>
             <select name="tipo_usuario" type="text" id ="tipo_usuario" required>
             <option value="" disabled selected>Seleccione:</option>

             <option value="Administrador">ADMINISTRADOR</option>

              <option value="Cajero">USUARIO</option>
             </select>
            </p>
        </td>
     <td COLSPAN=2 style="text-align: right;">
      <p><label>Domicilio:</label></p>
      </td>
      <td>
      <p><input name="domicilio" type="text" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" placeholder="Ingresar Dirección" id ="domicilio" title="Ingresa al menos una dirección por favor" required></p>
      </td>
  </tr>

  <tr>
    <td COLSPAN=2 style="text-align: right;">
      <p><label>Contraseña:</label></p>
    </td>
    <td>
      <p><input name="psw1" type="password" placeholder="Ingresar Contraseña"  id ="psw1"  title="Por favor ingresa una contraseña que inicie con una letra y tenga al menos 8 caracteres y un número como mínimo" required ></p>


    </td>
    <td COLSPAN=2 style="text-align: right;">
      <p><label>Confirmar Contraseña:</label></p>
    </td>
    <td>
      <p><input name="pasword" type="password" placeholder="Vuelve a escribir la Contraseña"  id ="psw2" required ></p>
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