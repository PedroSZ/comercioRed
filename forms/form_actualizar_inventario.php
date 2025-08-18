<?php
/********************** VALIDAMOS QUE ESTA PAGINA SEA PARA LA SESION INICIADA ****************/
include_once 'clases/tipo_usuario.php';
include_once 'clases/sesion.php';
$userSession = new Sesion();

if (!isset($_SESSION['user'])) {
    header("location: index.php");
    exit();
}

if (isset($_SESSION['user'])) {
    $user = new Tipo_Usuario();
    $user->establecerDatos($userSession->getCurrentUser());
    $tipo = $user->getPuesto();
    $codigo = $user->getUsuario_id();

    if ($tipo !== "Administrador" && $tipo !== "Cajero") {
        header('location: index.php');
        exit();
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
    exit();
}

/********************** CAPTURA DE FILTROS ****************/


/********************** CAPTURA DE FILTROS ****************/
error_reporting(0);
$filtro1 = isset($_POST['FiltrarCodigo_actualizarProducto']) ? trim($_POST['FiltrarCodigo_actualizarProducto']) : '';
$filtro2 = isset($_POST['FiltarNom_actualizar_producto']) ? trim($_POST['FiltarNom_actualizar_producto']) : '';
?>

   
   <script language='javascript'>
let stockActual = 0;

document.addEventListener('keydown', function(event) {
    if (event.key === 'Enter' && document.getElementById('modalStock').classList.contains('show')) {
        event.preventDefault(); // Evita que el formulario se intente enviar
        guardarNuevoStock();
    }
});


function abrirModalStock(codigo, stock) {
    document.getElementById('codigoProducto').value = codigo;
    document.getElementById('nuevoStock').value = stock;
    stockActual = parseInt(stock);
    let modal = new bootstrap.Modal(document.getElementById('modalStock'));
    modal.show();
}

function modificarStock(cambio) {
    let stockInput = document.getElementById('nuevoStock');
    let nuevoStock = parseInt(stockInput.value) + cambio;
    if (nuevoStock >= 0) { // No permitir stock negativo
        stockInput.value = nuevoStock;
    }
}

function guardarNuevoStock() {
    let codigo = document.getElementById('codigoProducto').value;
    let stock = parseInt(document.getElementById('nuevoStock').value);

    // Validación básica
    if (stock < 0 || isNaN(stock)) {
        mostrarToast('El stock no puede ser negativo ni vacío.');
        return;
    }

    // Puedes mostrar un spinner aquí si quieres:
    // document.getElementById('spinner').style.display = 'block';

    // AJAX
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'modulos/mdl_actualizarStock.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        // Ocultar el spinner si lo agregaste
        // document.getElementById('spinner').style.display = 'none';

        if (xhr.status === 200) {
            let respuesta = JSON.parse(xhr.responseText);

            if (respuesta.success) {
                // Actualizar la celda directamente
                document.getElementById('stock-' + codigo).innerText = stock;

                // Animación de celda actualizada
                let celda = document.getElementById('stock-' + codigo);
                celda.classList.add('celda-actualizada');

                setTimeout(() => {
                    celda.classList.remove('celda-actualizada');
                }, 1000);

                // Cerrar el modal
                let modal = bootstrap.Modal.getInstance(document.getElementById('modalStock'));
                modal.hide();

                mostrarToast('Stock actualizado correctamente');
            } else {
                mostrarToast(respuesta.message || 'Error al actualizar el stock');
            }
        } else {
            mostrarToast('Error al actualizar el stock. Código de error: ' + xhr.status);
        }
    };

    xhr.onerror = function() {
        // Si ocurre un error de red
        mostrarToast('Error de conexión con el servidor.');
    };

    xhr.send('codigo=' + encodeURIComponent(codigo) + '&stock=' + encodeURIComponent(stock));
}

function mostrarToast(mensaje) {
    let toastBody = document.getElementById('toastBody');
    toastBody.innerText = mensaje;

    let toast = new bootstrap.Toast(document.getElementById('toastMensaje'));
    toast.show();
}



      function consultar(Codigo) {
            document.listar_productos.micodigo.value = Codigo;
            document.listar_productos.submit();
            //alert ("Se ha seleccionado el producto con código: " + Codigo);
        }
        function regresar() {
           // location.href = 'index.php';
            window.location.href="index.php";
        }
        function limpiarFiltros() {
            document.getElementById('FiltrarCodigo_actualizarProducto').value = '';
            document.getElementById('FiltarNom_actualizar_producto').value = '';
            document.getElementById('form_filtro_listar_productos').submit();
        }
        function filtrarPorSelect() {
            document.getElementById('form_filtro_listar_productos').submit();
        }
    </script>

  

   

    <div id="filtro">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" name="form_filtro_listar_productos" id="form_filtro_listar_productos">
            <table class="table-primary" border="1">
                <tr>
                    <td width="100%" style="text-align: right;">
                        <input name="FiltrarCodigo_actualizarProducto" type="text" placeholder="Buscar por Código" id="FiltrarCodigo_actualizarProducto" onkeyup="this.value = this.value.toUpperCase()" value="<?php echo htmlspecialchars($filtro1); ?>" autocomplete="off">
                        <div id="resultadosCodigo" class="resultado-busqueda"></div>

                        <input name="FiltarNom_actualizar_producto" type="text" title="Busqueda por Nombre" placeholder="Buscar por Nombre" id="FiltarNom_actualizar_producto" onkeyup="this.value = this.value.toUpperCase()" value="<?php echo htmlspecialchars($filtro2); ?>" autocomplete="off">
                        <div id="resultadosNombre" class="resultado-busqueda"></div>
                        <br>
                        <input type="submit" value="Buscar">
                        <input type="button" value="Limpiar" onclick="limpiarFiltros()">
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <div id="listado">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" name="listar_productos" id="listar_productos" class="form-list">
          <input type="hidden" name="accion" name="micodigo" id="micodigo">
            <?php
            include_once 'clases/producto.php';
            $producto = new Producto();
            $productos = $producto->listar();
            $encontroResultados = false;

            if ($productos) {
                echo "<table class='table table-bordered border-primary table-hover tabla-datos'><thead>
                        <tr>
        <th style='text-align:center'>Codigo</th>
        <th style='text-align:center'>Producto</th>
        <th style='text-align:center'>Descripcion</th>
        <th style='text-align:center'>Existencias</th>
        <th style='text-align:center'>Modificar</th>
       
                          
                        </tr></thead>";

                if ($filtro1 !== '' || $filtro2 !== '') {
                    foreach ($productos as $producto) {
                        $coincideCdg = ($filtro1 === '' || $filtro1 == $producto['Codigo']);
                        $coincideNombre = ($filtro2 === '' || strtoupper($filtro2) == strtoupper($producto['Nombre']));
                     

                        if ($coincideCdg && $coincideNombre) {
                            $encontroResultados = true;
                            echo "<tr>
                                        <td>".$producto['Codigo']."</td>
                                        <td>".$producto['Nombre']."</td>
                                        <td>".$producto['Descripcion']."</td>
                                        <td id='stock-".$producto['Codigo']."' style='text-align:center; color:blue'>".$producto['Stock']."</td>
                                        
                                       <td style='text-align:center'>
                                        <img width='30' height='30' src='img/add.png' onClick='abrirModalStock(\"".$producto['Codigo']."\",\"".$producto['Stock']."\");'>

                                        </td>
                                </tr>";
                        }
                    }
                   if (!$encontroResultados) {
                        echo "<tr><td colspan='13' style='text-align:center'>No se encontraron resultados</td></tr>";
                    }
                } else {
                    foreach ($productos as $producto) {
                        echo "<tr>

                                        <td>".$producto['Codigo']."</td>
                                        <td>".$producto['Nombre']."</td>
                                        <td>".$producto['Descripcion']."</td>
                                        <td id='stock-".$producto['Codigo']."' style='text-align:center; color:blue'>".$producto['Stock']."</td>
                                        
                                       <td style='text-align:center'>
                                        <img width='30' height='30' src='img/add.png' onClick='abrirModalStock(\"".$producto['Codigo']."\",\"".$producto['Stock']."\");'>

                                        </td></tr>";
                    }
                }

                echo "</table>";
            } else {
                echo "<p>No hay productos registrados en la base de datos</p>";
            }
            ?>
        </form>
    </div>

    <!-- Modal -->
<div class="modal fade" id="modalStock" tabindex="-1" aria-labelledby="modalStockLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm modal-md modal-lg">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalStockLabel">Actualizar Stock</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="codigoProducto">
        <div class="mb-3">
          <label for="nuevoStock" class="form-label">Stock:</label>
          <div class="input-group">
            <button class="btn btn-outline-danger" type="button" onclick="modificarStock(-1)">-</button>
            <input type="number" id="nuevoStock" class="form-control text-center">
            <button class="btn btn-outline-success" type="button" onclick="modificarStock(1)">+</button>
          </div>
        </div>
        <div class="d-grid gap-2">
          <button class="btn btn-primary" type="button" onclick="guardarNuevoStock()">Guardar Cambios</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Toast -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
  <div id="toastMensaje" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
      <div class="toast-body" id="toastBody">
        Stock actualizado correctamente.
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Cerrar"></button>
    </div>
  </div>
</div>
   
<script>
function debounce(func, delay) {
    let timeout;
    return function(...args) {
        clearTimeout(timeout);
        timeout = setTimeout(() => func.apply(this, args), delay);
    };
}

document.getElementById('FiltrarCodigo_actualizarProducto').addEventListener('keyup', debounce(function() {
    buscarProducto(this.value, 'codigo');
}, 300));

document.getElementById('FiltarNom_actualizar_producto').addEventListener('keyup', debounce(function() {
    buscarProducto(this.value, 'nombre');
}, 300));

function buscarProducto(query, tipo) {
    if (query.length === 0) {
        if (tipo === 'codigo') document.getElementById('resultadosCodigo').innerHTML = '';
        if (tipo === 'nombre') document.getElementById('resultadosNombre').innerHTML = '';
        return;
    }

    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'modulos/mdl_buscar_productos.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
        if (xhr.status === 200) {
            let resultados = JSON.parse(xhr.responseText);
            let html = '';
            if(resultados.length > 0) {
                resultados.forEach(producto => {
                    html += `<div onclick="seleccionarProducto('${producto.Codigo}', '${producto.Nombre}')">
                                ${producto.Codigo} - ${producto.Nombre}
                            </div>`;
                });
            } else {
                html = '<div>No se encontraron resultados</div>';
            }

            if (tipo === 'codigo') {
                document.getElementById('resultadosCodigo').innerHTML = html;
            }
            if (tipo === 'nombre') {
                document.getElementById('resultadosNombre').innerHTML = html;
            }
        }
    };

    xhr.send('query=' + encodeURIComponent(query));
}

function seleccionarProducto(codigo, nombre) {
    document.getElementById('FiltrarCodigo_actualizarProducto').value = codigo;
    document.getElementById('FiltarNom_actualizar_producto').value = nombre;
    document.getElementById('resultadosCodigo').innerHTML = '';
    document.getElementById('resultadosNombre').innerHTML = '';

    document.getElementById('form_filtro_listar_productos').submit();
}

</script>
    
