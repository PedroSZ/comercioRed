
<?php
	/********************** VALIDAMOS QUE ESTA PAGINA SEA PARA LA SESION INICIADA ****************/
    include_once 'clases/tipo_usuario.php';
    include_once 'clases/sesion.php';
    $userSession = new Sesion();
    //MADAR A INDEX SI NO HAY SESION INICIADA
    
    if (!isset($_SESSION['user'])){
    header("location: index.php");
    }

    if(isset($_SESSION['user'])){
        $user = new Tipo_Usuario();
        $user->establecerDatos($userSession->getCurrentUser());
        $tipo = $user->getPuesto();
///////////////////AQUI SE OBTIENE EL ID DEL USUARIO ACTUAL///////////////////////////////////
		$id = $user->getUsuario_id();
      //  echo $id;
        
//////////////////////////////////////////////////////////////////////////////////////////////   
		//mensaje de que no tiene privilegios
        if($tipo <> "Administrador") header('location: index.php');
        /*////////////////////////SIERRE POR INACTIVIDAD/////////////////////////*/
        if (!isset($_SESSION['tiempo'])) {
            $_SESSION['tiempo']=time();
        }
        else if (time() - $_SESSION['tiempo'] > 500) {
            session_destroy();
            /* Aquí redireccionas a la url especifica */
            header("location: index.php");
            die();
        }
        $_SESSION['tiempo']=time(); //Si hay actividad seteamos el valor al tiempo actual
        /*////////////////////FIN SIERRE POR INACTIVIDAD/////////////////////////*/

    }
    else{
        $userSession->closeSession();
         header("location: index.php");
    }


	/**********************************************************************************************/
error_reporting(0);//para que no me muestre errores
$item = $_POST['Stock']; //para obtener la curp a buscar del fitro
	

      	if(!empty($_POST['codigoPro'])){
		include_once './clases/producto.php';
		$codigo = $_POST['codigoPro'];
		$produ = new Producto();
		$item = $produ->consultarCodigo($codigo);
        //echo $item["Stock"];
	}
	else{

	} 
	?>

    <style>
    /* Oculta las columnas deseadas */
    .ocultar {
        display: none;
    }
</style>

	   <script>
function consultar(codigo) {
    if (codigo === '') return;

    fetch('modulos/consultar_producto.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'codigoPro=' + encodeURIComponent(codigo)
    })
    .then(response => response.json())
    .then(data => {
        if (data) {
            document.getElementById('precio_v').value = data.Precio;
            document.getElementById('codigoOculto').value = data.Codigo;
            // Aquí puedes mostrar las existencias si quieres
            // document.getElementById('existencias').innerText = data.Stock;
        } else {
            alert('Producto no encontrado');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
  
}
</script>
 
 
 <?php
       include_once 'clases/venta.php';
        $ve = new Ventas();
        $ventas = $ve->consultarUltimo();
        $no_venta_maximo = $ventas[0]["MAX(No_venta)"];
// Imprimir el valor
//echo "El número de venta más alto es: " . $no_venta_maximo;   
	?>

</p>
<form  action="modulos/mdl_reg_venta.php"  style="width: 65vw; height:auto;" id="frm_agregar_producto_a_vender" name="frm_agregar_producto_a_vender">
    <input name="fecha_venta" type="hidden" id="fecha_venta" required>
    <input name="id_vendedor" type="hidden" id="id_vendedor" required placeholder="id del vendedor" value="<?php echo $id ?>">
    <input name="no_venta" type="hidden" id="no_venta" required placeholder="no de venta" value="<?php echo $no_venta_maximo + 1; ?>">
    <input name="codigoOculto" placeholder="codigo oculto" type="hidden" id="codigoOculto" value="<?php echo $item["Codigo"]; ?>">
    <table border="0" style="font-weight: 600; font-size: 17px;">

        <tr>
            <td COLSPAN=2 style="text-align: right;">
                <p><label>Cliente:</label></p>
            </td>

                         
            
    <td>
       <p><select name="Cliente" type="text" id ="Cliente" required>

     <?php
        include_once 'clases/cliente.php';
        $doc = new Cliente();
        $clientees = $doc->listar();
        if($clientees){
            echo "<option value='1' selected>CLIENTE GENERAL</option>";
                foreach ($clientees as $cliente) {
                        echo "<option value='".$cliente['Id_Cliente']."'>".$cliente['Nombre']." ".$cliente['A_paterno']."</option>";

                                                }
  	        }
 	        else{
   		        echo "<option value='1' disabled selected style='color:red;'>Debe agregar algún cliente antes de poder realizar una venta:</option>";
  		}
	?>
     </p> </td>




            <td COLSPAN=2 style="text-align: right;">
                <p><label>Codigo:</label></p>
            </td>
            <td>
                <p><input name="codigo" type="text" onKeyUp="consultar(this.value)"
                        placeholder="Código del producto" id="codigo" title="Campo obligatorio " required></p>
                        
            </td>

            <td COLSPAN=2 style="text-align: right;">
                <p><label>Cantidad:</label></p>
            </td>
            <td>
                <p><input name="stock" type="text" placeholder="Ingresar la cantidad" id="cantidad_v" title="Ingresa la cantidad de productos" required></p>
            </td>
        </tr>
        <tr>

        <td COLSPAN=2 style="text-align: right;">
                <p><label>Existencias:</label></p>
            </td>
            <td>
                <p>
                    <?= $item["Stock"]; ?>
                </p>
            </td>
        </tr>
        <tr></tr>

            <td COLSPAN=2 style="text-align: right;">
                <p><label>Precio:</label></p>
            </td>
            <td>
                <p><input name="precio" type="text" readonly placeholder="Ingresar precio" id="precio_v" title="Ingresa el precio del producto por favor " value="<?php echo $item["Precio"]; ?>"></p>
            </td>

            <td COLSPAN=2 style="text-align: right;">
                <p><label>Tipo de Pago:</label></p>
            </td>
            <td>
                <p>
                    <select name="tipo_pago" type="text" id="tipo_pago" required>
                        <option value="" disabled>Seleccione:</option>
                        <option value="EFECTIVO" selected>EFECTIVO</option>
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
</form>
  

 <!--<table border="0" style=font-weight: 600; font-size: 17px;"> -->  
    <form  action="modulos/mdl_reg_venta.php" method="post" style="width: 65vw; height:auto;" id="enviar_ventas">
 <table id="miTabla" class="table">
  <thead>
    <tr>
        <th class="ocultar">Fecha</th>
      <th class="ocultar">Vendedor</th>
      <th class="ocultar">No. de venta</th>
      <th class="ocultar">Cliente</th>
      <th>Codigo</th>
      <th>Cantidad</th>
      <th>Precio</th>
      <th class="ocultar">Tipo de Pago</th>
      <th>Subtotal</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
  </tbody>
</table>

<!-- Mostramos el total general -->
<h2>Total: $<span id="total_general">0.00</span></h2>
      
        <input type="submit" value="Registrar Venta">
        <input type="button" id="cancelar" value="Cancelar">
        <input type="button" onclick="location='menuAdmin.php'" value="Regresar" />
    
  </table>
<script>
    window.onload = function () {
    var fecha = new Date();
    var mes = fecha.getMonth() + 1;
    var dia = fecha.getDate();
    var ano = fecha.getFullYear();
    if (dia < 10) dia = '0' + dia;
    if (mes < 10) mes = '0' + mes;
    document.getElementById('fecha_venta').value = ano + "-" + mes + "-" + dia;

    let campo = document.getElementById('codigo');
    campo.focus();
    campo.select();

    campo.addEventListener('keydown', function (event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            document.getElementById('cantidad_v').focus();
            document.getElementById('cantidad_v').select();
        }
    });

    document.getElementById('cantidad_v').addEventListener('keydown', function (event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            document.getElementById('tipo_pago').focus();
        }
    });

    document.getElementById('tipo_pago').addEventListener('keydown', function (event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            document.getElementById('agregar').click();
        }
    });

    document.getElementById('agregar').addEventListener('click', function (event) {
        agregarProductoYResetear();
    });

    function agregarProductoYResetear() {
        let v_fecha_venta = document.getElementById('fecha_venta').value;
        let v_id_vendedor = document.getElementById('id_vendedor').value;
        let v_no_venta = document.getElementById('no_venta').value;
        let v_Cliente = document.getElementById('Cliente').value;
        let v_codigo = document.getElementById('codigoOculto').value;
        let v_cantidad = parseInt(document.getElementById('cantidad_v').value);
        let v_precio = parseFloat(document.getElementById('precio_v').value);
        let v_tipo_pago = document.getElementById('tipo_pago').value;

        let tabla = document.getElementById('miTabla').getElementsByTagName('tbody')[0];
        let filas = tabla.getElementsByTagName('tr');
        let productoExiste = false;

        for (let i = 0; i < filas.length; i++) {
            let codigoEnTabla = filas[i].cells[4].getElementsByTagName('input')[0].value;

            if (codigoEnTabla === v_codigo) {
                let cantidadActual = parseInt(filas[i].cells[5].getElementsByTagName('input')[0].value);
                let precioActual = parseFloat(filas[i].cells[6].getElementsByTagName('input')[0].value);

                let nuevaCantidad = cantidadActual + v_cantidad;

                if (precioActual !== v_precio) {
                    let precioPromedio = ((precioActual * cantidadActual) + (v_precio * v_cantidad)) / nuevaCantidad;
                    precioPromedio = precioPromedio.toFixed(2);
                    filas[i].cells[6].getElementsByTagName('input')[0].value = precioPromedio;
                }

                filas[i].cells[5].getElementsByTagName('input')[0].value = nuevaCantidad;

                // Actualizar subtotal
                let precioFinal = parseFloat(filas[i].cells[6].getElementsByTagName('input')[0].value);
                let subtotal = (precioFinal * nuevaCantidad).toFixed(2);
                filas[i].cells[8].getElementsByTagName('input')[0].value = subtotal;

                productoExiste = true;
                break;
            }
        }

        if (!productoExiste) {
            let nuevaFila = tabla.insertRow();

          function crearCeldaConInput(valor, nombre, ocultar) {
    let celda = nuevaFila.insertCell();
    if (ocultar) {
        celda.classList.add('ocultar'); // Aplica la clase solo si debe estar oculta
    }
    celda.innerHTML = `<input type="text" name="${nombre}[]" value="${valor}" readonly>`;
}


            function crearCeldaConBoton() {
                let celda = nuevaFila.insertCell();
                let boton = document.createElement("button");
                boton.type = "button";
                boton.textContent = "Quitar";
                boton.addEventListener("click", function () {
                    this.closest("tr").remove();
                    calcularTotalGeneral();
                });
                celda.appendChild(boton);
            }

           crearCeldaConInput(v_fecha_venta, 'fecha_venta', true);
crearCeldaConInput(v_id_vendedor, 'id_vendedor', true);
crearCeldaConInput(v_no_venta, 'no_venta', true);
crearCeldaConInput(v_Cliente, 'cliente', true);
crearCeldaConInput(v_codigo, 'codigoOculto', false);
crearCeldaConInput(v_cantidad, 'cantidad', false);
crearCeldaConInput(v_precio, 'precio', false);
crearCeldaConInput(v_tipo_pago, 'tipo_pago', true);
//crearCeldaSubtotal(subtotal);
 crearCeldaConInput((v_precio * v_cantidad).toFixed(2), 'subtotal'); // Subtotal
crearCeldaConBoton();
        }

        calcularTotalGeneral();

        document.getElementById('codigo').value = '';
        document.getElementById('codigoOculto').value = '';
        document.getElementById('cantidad_v').value = '';
        document.getElementById('precio_v').value = '';
       // document.getElementById('tipo_pago').selectedIndex = 0;

        document.getElementById('codigo').focus();
        document.getElementById('codigo').select();
    }

    function calcularTotalGeneral() {
        let tabla = document.getElementById('miTabla').getElementsByTagName('tbody')[0];
        let filas = tabla.getElementsByTagName('tr');
        let total = 0;

        for (let i = 0; i < filas.length; i++) {
            let subtotal = parseFloat(filas[i].cells[8].getElementsByTagName('input')[0].value);
            total += subtotal;
        }

        document.getElementById('total_general').innerText = total.toFixed(2);
    }
};

</script>

</form>