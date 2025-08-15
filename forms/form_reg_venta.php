<?php
/********************** VALIDAMOS QUE ESTA PAGINA SEA PARA LA SESION INICIADA ****************/
include_once 'clases/tipo_usuario.php';
include_once 'clases/sesion.php';
$userSession = new Sesion();

if (!isset($_SESSION['user'])) {
    header("location: index.php");
}

if (isset($_SESSION['user'])) {
    $user = new Tipo_Usuario();
    $user->establecerDatos($userSession->getCurrentUser());
    $tipo = $user->getPuesto();
    $id = $user->getUsuario_id();

    if ($tipo != "Administrador" && $tipo != "Cajero") {
        header('location: index.php');
        exit;
    }

    if (!isset($_SESSION['tiempo'])) {
        $_SESSION['tiempo'] = time();
    } else if (time() - $_SESSION['tiempo'] > 500) {
        session_destroy();
        header("location: index.php");
        die();
    }
    $_SESSION['tiempo'] = time();
} else {
    $userSession->closeSession();
    header("location: index.php");
}

error_reporting(0);
$item = $_POST['Stock'];

if (!empty($_POST['codigoPro'])) {
    include_once './clases/producto.php';
    $codigo = $_POST['codigoPro'];
    $produ = new Producto();
    $item = $produ->consultarCodigo($codigo);
}

include_once 'clases/venta.php';
$ve = new Ventas();
$ventas = $ve->consultarUltimo();
$no_venta_maximo = $ventas[0]["MAX(No_venta)"];
/******************************termina validacion de secsion ************************************* */
?>

<style>
/* Oculta las columnas deseadas */
.ocultar {
    display: none;
}
</style>


<script>
let existenciasOriginal = 0;
let nombreProductoGlobal = '';

function consultar(codigo) {
    if (codigo === '') {
        document.getElementById('existencias').innerText = '0';
        document.getElementById('precio_v').value = '';
        document.getElementById('codigoOculto').value = '';
        existenciasOriginal = 0;
        return;
    }

    fetch('modulos/consultar_producto.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'codigoPro=' + encodeURIComponent(codigo)
        })
        .then(response => response.json())
        .then(data => {
            if (data) {
                document.getElementById('precio_v').value = data.Precio;
                document.getElementById('codigoOculto').value = data.Codigo;
                document.getElementById('existencias').innerText = data.Stock;
                existenciasOriginal = parseInt(data.Stock);
            } else {
                alert('Producto no encontrado');
                document.getElementById('existencias').innerText = '0';
                document.getElementById('precio_v').value = '';
                document.getElementById('codigoOculto').value = '';
                existenciasOriginal = 0;
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

function previsualizarStock() {
    let cantidadIngresada = parseInt(document.getElementById('cantidad_v').value);

    if (isNaN(cantidadIngresada) || cantidadIngresada <= 0) {
        document.getElementById('existencias').innerText = existenciasOriginal;
        return;
    }

    if (cantidadIngresada > existenciasOriginal) {
        alert('La cantidad ingresada supera el stock disponible.');
        document.getElementById('cantidad_v').value = '';
        document.getElementById('existencias').innerText = existenciasOriginal;
        return;
    }

    let stockRestante = existenciasOriginal - cantidadIngresada;
    document.getElementById('existencias').innerText = stockRestante;
}


function consultarYEnfocar(codigo) {

    fetch('modulos/consultar_producto.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'codigoPro=' + encodeURIComponent(codigo)
        })
        .then(response => response.json())
        .then(data => {
            if (data) {
                document.getElementById('precio_v').value = data.Precio;
                document.getElementById('codigoOculto').value = data.Codigo;
                document.getElementById('existencias').innerText = data.Stock;
                existenciasOriginal = parseInt(data.Stock);
                nombreProductoGlobal = data.Nombre; // Guardar el nombre aquí ✅

                // ✅ Mover el foco al campo de cantidad
                document.getElementById('cantidad_v').focus();
                document.getElementById('cantidad_v').select();
            } else {
                alert('Producto no encontrado');

                // Limpiar campos
                document.getElementById('precio_v').value = '';
                document.getElementById('codigoOculto').value = '';
                document.getElementById('existencias').innerText = '0';
                existenciasOriginal = 0;

                // ✅ Regresar el foco al campo código
                document.getElementById('codigo').focus();
                document.getElementById('codigo').select();
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

window.onload = function() {
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

    campo.addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault(); // Evita que el formulario se envíe
            let codigo = this.value.trim();
            if (codigo !== '') {
                consultarYEnfocar(codigo);
            }
        }
    });



    document.getElementById('cantidad_v').addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            document.getElementById('tipo_pago').focus();
        }
    });

    document.getElementById('cantidad_v').addEventListener('input', function() {
        previsualizarStock();
    });

    document.getElementById('tipo_pago').addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            document.getElementById('agregar').click();
        }
    });

     document.getElementById('referencia').addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            document.getElementById('agregar').click();
        }
    });

    document.getElementById('agregar').addEventListener('click', function(event) {
        agregarProductoYResetear();
    });

    document.getElementById('cancelar').addEventListener('click', function() {
        if (confirm('¿Estás seguro de que deseas cancelar la venta?')) {
            cancelarVenta();
        }
    });

    document.getElementById('regresar').addEventListener('click', function() {
        location.href = 'index.php';
    });
};



function limpiarCampos() {
    document.getElementById('codigo').value = '';
    document.getElementById('codigoOculto').value = '';
    document.getElementById('cantidad_v').value = '';
    document.getElementById('precio_v').value = '';
    document.getElementById('existencias').innerText = existenciasOriginal;
    document.getElementById('codigo').focus();
    document.getElementById('codigo').select();
}

function cancelarVenta() {
    let tabla = document.getElementById('miTabla').getElementsByTagName('tbody')[0];
    tabla.innerHTML = '';
    document.getElementById('total_general').innerText = '0.00';
    limpiarCampos();
}

function calcularTotalGeneral() {
    let tabla = document.getElementById('miTabla').getElementsByTagName('tbody')[0];
    let filas = tabla.getElementsByTagName('tr');
    let total = 0;

    for (let i = 0; i < filas.length; i++) {
        let subtotal = parseFloat(filas[i].cells[9].getElementsByTagName('input')[0].value);
        total += subtotal;
    }

    document.getElementById('total_general').innerText = total.toFixed(2);
    document.getElementById('total_general_input').value = total.toFixed(2);
}

function agregarProductoYResetear() {
    let v_fecha_venta = document.getElementById('fecha_venta').value;
    let v_id_vendedor = document.getElementById('id_vendedor').value;
    let v_no_venta = document.getElementById('no_venta').value;
    let v_Cliente = document.getElementById('Cliente').value;
    let v_codigo = document.getElementById('codigoOculto').value;
    let v_cantidad = parseInt(document.getElementById('cantidad_v').value);
    let v_precio = parseFloat(document.getElementById('precio_v').value);
    let v_tipo_pago = document.getElementById('tipo_pago').value;
    let v_existencias = parseInt(document.getElementById('existencias').innerText);

    if (v_existencias === 0) {
        alert('El producto se ha agotado.');
        limpiarCampos();
        return;
    }

    if (v_cantidad > existenciasOriginal) {
        alert('La cantidad ingresada supera las existencias disponibles.');
        return;
    }

    let tabla = document.getElementById('miTabla').getElementsByTagName('tbody')[0];
    let filas = tabla.getElementsByTagName('tr');
    let productoExiste = false;

    for (let i = 0; i < filas.length; i++) {
        let codigoEnTabla = filas[i].cells[4].getElementsByTagName('input')[0].value;

        if (codigoEnTabla === v_codigo) {
            let cantidadActual = parseInt(filas[i].cells[6].getElementsByTagName('input')[0].value);
            let precioActual = parseFloat(filas[i].cells[7].getElementsByTagName('input')[0].value);
            let nuevaCantidad = cantidadActual + v_cantidad;

            if (precioActual !== v_precio) {
                let precioPromedio = ((precioActual * cantidadActual) + (v_precio * v_cantidad)) / nuevaCantidad;
                precioPromedio = precioPromedio.toFixed(2);
                filas[i].cells[6].getElementsByTagName('input')[0].value = precioPromedio;
            }

            filas[i].cells[5].getElementsByTagName('input')[0].value = nuevaCantidad;
            let precioFinal = parseFloat(filas[i].cells[7].getElementsByTagName('input')[0].value);
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
                celda.classList.add('ocultar');
            }
            celda.innerHTML =
                `<input type="text" name="${nombre}[]" value="${valor}" readonly style="outline: none; border: none; background: transparent;">`;

        }

        function crearCeldaConBoton() {
            let celda = nuevaFila.insertCell();
            let boton = document.createElement("button");
            boton.type = "button";
            boton.textContent = "Quitar";
            boton.addEventListener("click", function() {
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
        crearCeldaConInput(nombreProductoGlobal, 'nombreOculto', false);
        crearCeldaConInput(v_cantidad, 'cantidad', false);
        crearCeldaConInput(v_precio, 'precio', false);
        crearCeldaConInput(v_tipo_pago, 'tipo_pago', true);
        crearCeldaConInput((v_precio * v_cantidad).toFixed(2), 'subtotal');
        crearCeldaConBoton();
    }

    calcularTotalGeneral();
    limpiarCampos();
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
<form class="form_venta" action="modulos/mdl_reg_descuento.php" style="width: 65vw; height:auto;" id="frm_agregar_producto_a_vender"
    name="frm_agregar_producto_a_vender">
    <input name="fecha_venta" type="hidden" id="fecha_venta" required>
    <input name="id_vendedor" type="hidden" id="id_vendedor" required placeholder="id del vendedor"
        value="<?php echo $id ?>">
    <input name="no_venta" type="hidden" id="no_venta" required placeholder="no de venta"
        value="<?php echo $no_venta_maximo + 1; ?>">
    <input name="codigoOculto" placeholder="codigo oculto" type="hidden" id="codigoOculto"
        value="<?php echo $item["Codigo"]; ?>">
        <input type="hidden" name="referencia_envio" id="referencia_envio">


    <table border="0" style="font-weight: 600; font-size: 17px;">

        <tr>
            <td COLSPAN=2 style="text-align: right;">
                <p><label>Cliente:</label></p>
            </td>



            <td>
                <p><select name="Cliente" type="text" id="Cliente" required>

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
                </p>
            </td>




            <td COLSPAN=2 style="text-align: right;">
                <p><label>Codigo:</label></p>
            </td>
            <td>
                <p><input name="codigo" type="text" placeholder="Código del producto" id="codigo"
                        title="Campo obligatorio " required></p>

            </td>

            <td COLSPAN=2 style="text-align: right;">
                <p><label>Cantidad:</label></p>
            </td>
            <td>
                <p><input name="stock" type="text" placeholder="Ingresar la cantidad" id="cantidad_v"
                        title="Ingresa la cantidad de productos" required></p>
            </td>
        </tr>
        <tr>

            <td COLSPAN=2 style="text-align: right;">
                <p><label>Existencias:</label></p>
            </td>
            <td>
                <p id="existencias">
                    <?= $item["Stock"]; ?>
                </p>
            </td>
        </tr>
        <tr></tr>

        <td COLSPAN=2 style="text-align: right;">
            <p><label>Precio: $</label></p>
        </td>
        <td>
            <p><input name="precio" type="text" style="outline: none; border: none; background: transparent;" readonly placeholder="" id="precio_v"
                    title="" value="<?php echo $item["Precio"]; ?>"></p>
        </td>

        <td COLSPAN=2 style="text-align: right;">
            <p><label>Tipo de Pago:</label></p>
        </td>
        <!-- Campo tipo_pago -->
<td>
    <p>
        <select name="tipo_pago" id="tipo_pago" required>
            <option value="" disabled>Seleccione:</option>
            <option value="EFECTIVO" selected>EFECTIVO</option>
            <option value="TARJETA DE CREDITO">TARJETA DE CRÉDITO</option>
            <option value="TARJETA DE DEBITO">TARJETA DE DÉBITO</option>
            <option value="CREDITO DE LA TIENDA">CREDITO DE LA TIENDA</option>
        </select>
    </p>
</td>

<!-- Campo referencia (todo dentro de una sola celda con colspan) -->
<td colspan="2" id="grupoReferencia" style="display: none; text-align: right;">
    <p><label for="referencia">Referencia:</label>
    
        <input name="referencia" type="text" placeholder="Ingresar referencia de pago" id="referencia"
               title="Ingrese la referencia de pago">
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
<form action="modulos/mdl_reg_venta.php" method="post" style="width: 85vw; height:auto;" id="enviar_ventas">
    <div id="listaVentas">
        <table id="miTabla" class="table">
            <thead>
                <tr>
                    <th class="ocultar">Fecha</th>
                    <th class="ocultar">Vendedor</th>
                    <th class="ocultar">No. de venta</th>
                    <th class="ocultar">Cliente</th>
                    <th>Codigo</th>
                    <th>Nombre</th>
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
    </div>

    <!-- Mostramos el total general -->
    <h2>Total: $<span id="total_general">0.00</span></h2>
    <input type="text" name="total_general_input" id="total_general_input" value="0.00">

    <input type="submit" value="Registrar Venta">
    <input type="button" id="cancelar" value="Cancelar">
    <input type="button" id="regresar" value="Regresar" />


    <!-- Modal Bootstrap -->
    <div class="modal fade" id="miModal" tabindex="-1" aria-labelledby="miModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="miModalLabel">Resumen de Venta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <p>Total a pagar: $<span id="totalPagarModal"></span></p>

                    <label>Pagó con:</label>
                    <input type="number" id="pagoCliente" min="0" class="form-control mb-2">

                    <label>Descuento (%):</label>
                    <input type="number" id="descuentoPorcentaje" min="0" max="100" value="0" class="form-control mb-2">

                    <label>IVA (%):</label>
                    <input type="number" id="ivaPorcentaje" min="0" max="100" value="0" class="form-control mb-2">

                    <p>Cambio: $<span id="cambioCliente">0.00</span></p>
                </div>
                <div class="modal-footer">
                    <button id="confirmarModal" type="button" class="btn btn-primary">Proceder</button>
                    <button type="button" class="btn btn-secondary" id="cancelarModal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Campos ocultos adicionales -->
    <input type="hidden" name="descuento" id="descuentoInput">
    <input type="hidden" name="iva" id="ivaInput">
    <input type="hidden" name="pago" id="pagoInput">




</form>
<script>
document.querySelector('input[type="submit"]').addEventListener('click', function(event) {
    event.preventDefault();

    let total = parseFloat(document.getElementById('total_general_input').value);
    document.getElementById('totalPagarModal').innerText = total.toFixed(2);

    // Mostrar el modal usando Bootstrap 5
    let modal = new bootstrap.Modal(document.getElementById('miModal'));
    modal.show();
});


document.getElementById('pagoCliente').addEventListener('input', calcularCambio);
document.getElementById('descuentoPorcentaje').addEventListener('input', calcularCambio);
document.getElementById('ivaPorcentaje').addEventListener('input', calcularCambio);

function calcularCambio() {
    let total = parseFloat(document.getElementById('total_general_input').value);
    let descuento = parseFloat(document.getElementById('descuentoPorcentaje').value) || 0;
    let iva = parseFloat(document.getElementById('ivaPorcentaje').value) || 0;
    let pago = parseFloat(document.getElementById('pagoCliente').value) || 0;

    let totalConDescuento = total - (total * (descuento / 100));
    let totalConIVA = totalConDescuento + (totalConDescuento * (iva / 100));

    let cambio = pago - totalConIVA;

    document.getElementById('cambioCliente').innerText = cambio >= 0 ? cambio.toFixed(2) : "Pago insuficiente";
}

document.getElementById('confirmarModal').addEventListener('click', function() {
    // Insertar los valores al formulario antes de enviarlo
    document.getElementById('descuentoInput').value = document.getElementById('descuentoPorcentaje').value;
    document.getElementById('ivaInput').value = document.getElementById('ivaPorcentaje').value;
    document.getElementById('pagoInput').value = document.getElementById('pagoCliente').value;
    document.getElementById('referencia_envio').value = document.getElementById('referencia').value || '';

    // Clonar el formulario original
    const form = document.getElementById('enviar_ventas');
    const clone = form.cloneNode(true);
    clone.style.display = 'none';
    clone.target = '_blank'; // 🔁 Abrir en nueva pestaña
    clone.action = 'imprimir_ticket.php';

    document.body.appendChild(clone);
    // Asegúrate de que el campo 'referencia' esté presente y actualizado en el formulario clonado
let referenciaOriginal = document.getElementById('referencia').value || '';
let inputRef = document.createElement('input');
inputRef.type = 'hidden';
inputRef.name = 'referencia';
inputRef.value = referenciaOriginal;
clone.appendChild(inputRef);
let tipoPago = document.getElementById('tipo_pago').value.trim().toUpperCase();
let referencia = document.getElementById('referencia').value.trim();

if ((tipoPago === "TARJETA DE CREDITO" || tipoPago === "TARJETA DE DEBITO") && referencia === "") {
    alert("Por favor, ingresa una referencia de pago para tarjetas.");
    return; // Detener el submit
}

    clone.submit(); // 🔁 Enviar directamente a imprimir_ticket.php

    // Finalmente, envía también los datos reales a mdl_reg_venta.php
    form.submit();
});


document.getElementById('cancelarModal').addEventListener('click', function() {
    document.getElementById('modalResumenVenta').style.display = 'none';
    document.getElementById('filtroModal').style.display = 'none';
});

document.addEventListener('DOMContentLoaded', function() {
    const tipoPago = document.getElementById('tipo_pago');
    const grupoReferencia = document.getElementById('grupoReferencia');

    tipoPago.addEventListener('change', function() {
        const valor = tipoPago.value;
        if (valor === 'TARJETA DE CREDITO' || valor === 'TARJETA DE DEBITO') {
            grupoReferencia.style.display = 'block';
        } else {
            grupoReferencia.style.display = 'none';
        }
    });

    // Por si ya hay valor preseleccionado
    tipoPago.dispatchEvent(new Event('change'));
});
</script>