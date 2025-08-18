<script>
    window.onload = function() {
        //AQUI RECETEAMOS LA FECHA ACTUAL PARA EL CAMPO FECHA_VENTA
        var fecha = new Date(); //Fecha actual
        var mes = fecha.getMonth()+1; //obteniendo mes
        var dia = fecha.getDate(); //obteniendo dia
        var ano = fecha.getFullYear(); //obteniendo año
            if(dia<10)
                 dia='0'+dia; //agrega cero si el menor de 10
                if(mes<10)
                     mes='0'+mes //agrega cero si el menor de 10
                     document.getElementById('fecha_registro').value = ano+"-"+mes+"-"+dia;//ponemos la fecha actual
    };
  </script>

<form method="post" class="form_registro"  action="modulos/mdl_reg_usuario.php" id="frm_reg_Usuarios" >
<input name="fecha_registro" type="hidden" id ="fecha_registro" required >
<div class="container">
   <div class= "grid-item"><div class= "container-grid"><div class= "grid-item-container"><p><label>Nombre:</label></p></div><div class= "grid-item-container"><p><input name="nombre" type="text" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" placeholder="Ingresar Nombre" id ="nombre" required pattern="[A-ZÑ ]+" title="Ingresa al menos un nombre por favor " required></p></div></div></div>
   <div class= "grid-item"><div class= "container-grid"><div class= "grid-item-container"><p><label>Apellido Paterno:</label></p></div><div class= "grid-item-container"><p><input name="a_paterno" type="text" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" placeholder="Ingresar Apellido Paterno" id ="a_paterno"  title="Ingresa al menos un apellido por favor " ></p></div></div></div>
   <div class= "grid-item"><div class= "container-grid"><div class= "grid-item-container"><p><label>Apellido Materno:</label></p></div><div class= "grid-item-container"><p><input name="a_materno" type="text" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" placeholder="Ingresar Apellido Materno" id ="a_materno"  title="Ingresa al menos un apellido por favor " ></p></div></div></div>    
   <div class= "grid-item"><div class= "container-grid"><div class= "grid-item-container"><p><label>Fecha de Nacimiento:</label></p></div><div class= "grid-item-container"><p><input name="fecha_nacimiento" type="date" id ="fecha_nacimiento" ></p></div></div></div>
   <div class= "grid-item"><div class= "container-grid"><div class= "grid-item-container"><p><label>RFC:</label></p></div><div class= "grid-item-container"><p><input name="rfc" type="text"  placeholder="Ingresar RFC" id ="rfc" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()"></p></div></div></div>
   <div class= "grid-item"><div class= "container-grid"><div class= "grid-item-container"><p><label>Telefono:</label></p></div><div class= "grid-item-container"><p><input name="telefono" type="number" placeholder="Ingresar Telefono" id ="telefono" pattern="[0-9]+" title="Ingresa al menos un numero por favor " ></p></div></div></div>   
   <div class= "grid-item"><div class= "container-grid"><div class= "grid-item-container"><p><label>Nombre de Usuario:</label></p></div><div class= "grid-item-container"><p><input name="email"  type="text" placeholder="Ingresar Usuario" id ="email" required></p></div></div></div>    
   <div class= "grid-item"><div class= "container-grid"><div class= "grid-item-container"><p><label>Tipo de Usuario:</label></p></div><div class= "grid-item-container"><p><select name="tipo_usuario" type="text" id ="tipo_usuario" required>
    <option value="" disabled selected>Seleccione:</option> 
    <option value="Administrador">ADMINISTRADOR</option>
    <option value="Cajero">USUARIO</option>
    </select></p></div></div></div>     
   <div class= "grid-item"><div class= "container-grid"><div class= "grid-item-container"><p><label>Domicilio:</label></p></div><div class= "grid-item-container"><p><input name="domicilio" type="text" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" placeholder="Ingresar Dirección" id ="domicilio" title="Ingresa al menos una dirección por favor" ></p></div></div></div>       
   <div class= "grid-item"><div class= "container-grid"><div class= "grid-item-container"><p><label>Contraseña:</label></p></div><div class= "grid-item-container"><p><input name="psw1" type="password" placeholder="Ingresar Contraseña"  id ="psw1"  title="Por favor ingresa una contraseña que inicie con una letra y tenga al menos 8 caracteres y un número como mínimo" required ></p></div></div></div>         
   <div class= "grid-item"><div class= "container-grid"><div class= "grid-item-container"><p><label>Confirmar Contraseña:</label></p></div><div class= "grid-item-container"><p><input name="pasword" type="password" placeholder="Vuelve a escribir la Contraseña"  id ="psw2" required ></p></div></div></div>
             
   
   
  <div class= "grid-item">  
    <input type="submit" value="Registrar">
    <input type="button" value="Cancelar" onclick="limpiar()">
    <input type="button" onclick="location='menuAdmin.php'" value="Regresar" />
  </div>
  
  </div>

</form>
