<form  style="width: 65vw; height:auto;" id="frm_agregar_producto_a_vender">
    <input name="fecha_venta" type="text" id="fecha_venta" required>
    <input name="id_vendedor" type="text" id="id_vendedor" required placeholder="id del vendedor">
    <input name="no_venta" type="text" id="no_venta" required placeholder="no de venta">

    <table border="0" style="font-weight: 600; font-size: 17px;">

        <tr>
            <td COLSPAN=2 style="text-align: right;">
                <p><label>Cliente:</label></p>
            </td>
            <td>
                <p>
                    <select name="Cliente" type="text" id="Cliente" required>
                        <option value="" disabled selected>Seleccione:</option>

                        <option value="CLIENTE GENERAL">CLIENTE GENERAL</option>

                        <option value="ALGUNO DE LA DB">ALGUNO DE LA DB</option>
                    </select>
                </p>

            </td>

            <td COLSPAN=2 style="text-align: right;">
                <p><label>Codigo:</label></p>
            </td>
            <td>
                <p><input name="codigo" type="text"
                        onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()"
                        placeholder="Código del producto" id="codigo" title="Campo obligatorio " required></p>
            </td>

            <td COLSPAN=2 style="text-align: right;">
                <p><label>Cantidad:</label></p>
            </td>
            <td>
                <p><input name="stock" type="text"
                        onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()"
                        placeholder="Ingresar la cantidad" id="cantidad_v" title="Ingresa la cantidad de productos "
                        required></p>
            </td>
        </tr>

        <tr>

            <td COLSPAN=2 style="text-align: right;">
                <p><label>Precio:</label></p>
            </td>
            <td>
                <p><input name="precio" type="text" placeholder="Ingresar precio" id="precio_v" title="Ingresa el precio del producto por favor "></p>
            </td>

            <td COLSPAN=2 style="text-align: right;">
                <p><label>Tipo de Pago:</label></p>
            </td>
            <td>
                <p>
                    <select name="tipo_pago" type="text" id="tipo_pago" required>
                        <option value="" disabled selected>Seleccione:</option>
                        <option value="EFECTIVO">EFECTIVO</option>
                        <option value="TARGETA DE CREDITO">TARGETA DE CREDITO</option>
                        <option value="TARGETA DE DEBITO">TARGETA DE DEBITO</option>
                        <option value="CREDITO DE LA TIENDA">CREDITO DE LA TIENDA</option>
                    </select>
                </p>

            </td>
        </tr>
        <tr>
            <td COLSPAN=5 style="text-align: center;">
                <BR>
                <input type="button" id="agregar" value="Agregar">
                
            </td>
        </tr>
    </table>

    <script>
  document.getElementById('agregar').addEventListener('click', function(event) {
    event.preventDefault(); // Evita que el formulario se envíe

    let v_fecha_venta = document.getElementById('fecha_venta').value;
    let v_id_vendedor = document.getElementById('id_vendedor').value;
    let v_no_venta = document.getElementById('no_venta').value;
    let v_Cliente = document.getElementById('Cliente').value;
    let v_codigo = document.getElementById('codigo').value;
    let v_cantidad = document.getElementById('cantidad_v').value;
    let v_precio = document.getElementById('precio_v').value;
    let v_tipo_pago = document.getElementById('tipo_pago').value;

    let tabla = document.getElementById('miTabla').getElementsByTagName('tbody')[0];
    let nuevaFila = tabla.insertRow();

    let celda_fecha_venta = nuevaFila.insertCell();
    celda_fecha_venta.innerHTML = v_fecha_venta;

    let celda_id_vendedor = nuevaFila.insertCell();
    celda_id_vendedor.innerHTML = v_id_vendedor;  

    let celda_no_venta = nuevaFila.insertCell();
    celda_no_venta.innerHTML = v_no_venta;    

    let celda_Cliente = nuevaFila.insertCell();
    celda_Cliente.innerHTML = v_Cliente;

    let celda_codigo = nuevaFila.insertCell();
    celda_codigo.innerHTML = v_codigo;

    let celda_cantidad = nuevaFila.insertCell();    
    celda_cantidad.innerHTML = v_cantidad;
   
    let celda_precio = nuevaFila.insertCell();
    celda_precio.innerHTML = v_precio;

    let celda_tipo_pago = nuevaFila.insertCell();   
    celda_tipo_pago.innerHTML = v_tipo_pago;



    document.getElementById('fecha_venta').value = '';
    document.getElementById('id_vendedor').value = '';
    document.getElementById('no_venta').value = '';
    document.getElementById('Cliente').value = '';     
    document.getElementById('codigo').value = '';
    document.getElementById('cantidad_v').value = '';
    document.getElementById('precio_v').value = '';
    document.getElementById('tipo_pago').value = '';

    //AQUI RECETEAMOS LA FECHA ACTUAL PARA EL CAMPO FECHA_VENTA
        var fecha = new Date(); //Fecha actual
        var mes = fecha.getMonth()+1; //obteniendo mes
        var dia = fecha.getDate(); //obteniendo dia
        var ano = fecha.getFullYear(); //obteniendo año
            if(dia<10)
                 dia='0'+dia; //agrega cero si el menor de 10
                if(mes<10)
                     mes='0'+mes //agrega cero si el menor de 10
                     document.getElementById('fecha_venta').value = ano+"-"+mes+"-"+dia;//ponemos la fecha actual
                    });
</script>

</form>


<form method="post" style="width: 65vw; height:auto;"  action="modulos/mdl_reg_venta.php" id="Ventas" >
  <!--<table border="0" style=font-weight: 600; font-size: 17px;"> -->  
    <table id="miTabla" class="table">
  <thead>
    <tr>
      <th scope="col">Fecha</th>
      <th scope="col">Vendedor</th>
      <th scope="col">No. de venta</th>
      <th scope="col">Cliente</th>
      <th scope="col">Codigo</th>
      <th scope="col">Cantidad</th>
      <th scope="col">Precio</th>
      <th scope="col">Tipo de Pago</th>
    </tr>
  </thead>
  <tbody>
 
  </tbody>
</table>
      
        <input type="submit" value="Registrar Venta">
        <input type="button" value="Cancelar" onclick="limpiar()">
        <input type="button" onclick="location='menuAdmin.php'" value="Regresar" />
    
  </table>
</form>