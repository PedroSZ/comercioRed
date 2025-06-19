
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

	
?>
 
  <?php
       include_once 'clases/venta.php';
        $ve = new Ventas();
        $ventas = $ve->consultarUltimo();
        $no_venta_maximo = $ventas[0]["MAX(No_venta)"];
// Imprimir el valor
//echo "El número de venta más alto es: " . $no_venta_maximo;   
	?>

</p>
<form  action="modulos/mdl_reg_venta.php"  style="width: 65vw; height:auto;" id="frm_agregar_producto_a_vender">
    <input name="fecha_venta" type="text" id="fecha_venta" required>
    <input name="id_vendedor" type="text" id="id_vendedor" required placeholder="id del vendedor" value="<?php echo $id ?>">
    <input name="no_venta" type="text" id="no_venta" required placeholder="no de venta" value="<?php echo $no_venta_maximo + 1; ?>">

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
                <p><input name="codigo" type="text" onKeyUp="document.getElementById(this.id).value"
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
    <script>
        document.getElementById('agregar').addEventListener('click', function(event) {
    event.preventDefault();

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

    function crearCeldaConInput(valor, nombre) {
        let celda = nuevaFila.insertCell();
        celda.innerHTML = `<input type="text" name="${nombre}[]" value="${valor}" readonly>`;
    }

     function crearCeldaConBoton() {
    let celda = nuevaFila.insertCell();
    let boton = document.createElement("button");
    boton.type = "button";
    boton.textContent = "Quitar";
    boton.addEventListener("click", function () {
        // Elimina la fila (row) que contiene este botón
        this.closest("tr").remove();
    });
    celda.appendChild(boton);
}

    crearCeldaConInput(v_fecha_venta, 'fecha_venta');
    crearCeldaConInput(v_id_vendedor, 'id_vendedor');
    crearCeldaConInput(v_no_venta, 'no_venta');
    crearCeldaConInput(v_Cliente, 'cliente');
    crearCeldaConInput(v_codigo, 'codigo');
    crearCeldaConInput(v_cantidad, 'cantidad');
    crearCeldaConInput(v_precio, 'precio');
    crearCeldaConInput(v_tipo_pago, 'tipo_pago');
    crearCeldaConBoton('Quitar', 'boton');

    // Limpiar los campos de entrada
    document.getElementById('fecha_venta').value = '';
    document.getElementById('codigo').value = '';
    document.getElementById('cantidad_v').value = '';
    document.getElementById('precio_v').value = '';
   

   
// Reestablecer la fecha a hoy
    let fecha = new Date();
    let dia = fecha.getDate().toString().padStart(2, '0');
    let mes = (fecha.getMonth() + 1).toString().padStart(2, '0');
    let ano = fecha.getFullYear();
    document.getElementById('fecha_venta').value = `${ano}-${mes}-${dia}`;
    
    //resetear la tabla de ventas
     function limpiarTabla() {
    let tabla = document.getElementById('miTabla').getElementsByTagName('tbody')[0];
    tabla.innerHTML = '';  // Elimina todas las filas dentro del tbody
    
    }

  // Asocia la función limpiarTabla al botón cancelar
  document.getElementById('cancelar').addEventListener('click', function() {
    limpiarTabla();
   
   
  });



 
});

    
    </script>

 <!--<table border="0" style=font-weight: 600; font-size: 17px;"> -->  
    <form  action="modulos/mdl_reg_venta.php" method="post" style="width: 65vw; height:auto;" id="enviar_ventas">
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
        <input type="button" id="cancelar" value="Cancelar">
        <input type="button" onclick="location='menuAdmin.php'" value="Regresar" />
    
  </table>
</form>