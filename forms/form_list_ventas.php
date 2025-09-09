<?php
/********************** VALIDAMOS QUE ESTA PAGINA SEA PARA LA SESION INICIADA ****************/


/********************** CAPTURA DE FILTROS ****************/
error_reporting(0);
$filtro1 = isset($_POST['filtrar_ticket']) ? trim($_POST['filtrar_ticket']) : '';
$filtro2 = isset($_POST['filtrar_codigo_venta']) ? trim($_POST['filtrar_codigo_venta']) : '';
$filtro3 = isset($_POST['Filtrar_Venta']) ? trim($_POST['Filtrar_Venta']) : '';
?>

   
   <script language='javascript'>
      
        function regresar() {
            location.href = 'index.php';
        }
        function limpiarFiltros() {
            document.getElementById('filtrar_ticket').value = '';
            document.getElementById('filtrar_codigo_venta').value = '';
            document.getElementById('Filtrar_Venta').selectedIndex = 0;
            document.getElementById('form_filtro_listar_ventas').submit();
        }
        function filtrarPorSelect() {
            document.getElementById('form_filtro_listar_ventas').submit();
        }
    </script>

  

   

    <div id="filtro">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" name="form_filtro_listar_ventas" id="form_filtro_listar_ventas">
            <table class="table-primary" border="1">
                <tr>
                    <td width="100%" style="text-align: right;">
                        <input name="filtrar_ticket" type="text" placeholder="Buscar por ticket" id="filtrar_ticket" onkeyup="this.value = this.value.toUpperCase()" value="<?php echo htmlspecialchars($filtro1); ?>">
                        <input name="filtrar_codigo_venta" type="text" title="Busqueda por vendedor" placeholder="Buscar por id vendedor" id="filtrar_codigo_venta" onkeyup="this.value = this.value.toUpperCase()" value="<?php echo htmlspecialchars($filtro2); ?>">
                        <select name="Filtrar_Venta" id="Filtrar_Venta" onchange="filtrarPorSelect()">
                            <option value="" disabled <?php echo ($filtro3 === '') ? 'selected' : ''; ?>>Tipo Pago</option>
                            <option value="EFECTIVO" <?php echo ($filtro3 === 'EFECTIVO') ? 'selected' : ''; ?>>Efectivo</option>
                            <option value="TARJETA DE CREDITO" <?php echo ($filtro3 === 'TARJETA DE CREDITO') ? 'selected' : ''; ?>>Credito</option>
                            <option value="TARJETA DE DEBITO" <?php echo ($filtro3 === 'TARJETA DE DEBITO') ? 'selected' : ''; ?>>Debito</option>
                            <option value="CREDITO DE LA TIENDA" <?php echo ($filtro3 === 'CREDITO DE LA TIENDA') ? 'selected' : ''; ?>>Credito de la tienda</option>
                        </select>
                        <br>
                        <input type="submit" value="Buscar">
                        <input type="button" value="Limpiar" onclick="limpiarFiltros()">
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <div id="listado">
        <form method="post" action="" name="listar_ventas" id="listar_ventas" class="form-list">
          
            <?php
            include_once 'clases/venta.php';
            $venta = new Ventas();
            $ventas = $venta->consultarDatosVenta();
            $encontroResultados = false;

            if ($ventas) {
                echo "<table class='table table-bordered border-primary table-hover tabla-datos'><thead>
                        <tr>
        <th style='text-align:center'>No_Ticet</th>
         <th style='text-align:center'>Fecha</th>
        <th style='text-align:center'>Vendedor</th>
        <th style='text-align:center'>Cliente</th>
        <th style='text-align:center'>Produto</th>
        <th style='text-align:center'>Precio al dia</th>
        <th style='text-align:center'>Cantidad</th>  
        <th style='text-align:center'>Descuento</th>  
        <th style='text-align:center'>Pago con:</th>              
                        </tr></thead>";

                if ($filtro1 !== '' || $filtro2 !== '' || $filtro3 !== '') {
                    foreach ($ventas as $venta) {
                        $coincideCdg = ($filtro1 === '' || $filtro1 == $venta['No_venta']);
                        $coincideNombre = ($filtro2 === '' || strtoupper($filtro2) == strtoupper($venta['Id_Vendedor']));
                        $coincideEstatus = ($filtro3 === '' || intval($filtro3) === intval($venta['Tipo_Pago']));

                        if ($coincideCdg && $coincideNombre && $coincideEstatus) {
                            $encontroResultados = true;
                            echo "<tr>
                                    
                                        <td>".$venta['No_venta']."</td>
                                        <td>".$venta['Fecha_Venta']."</td>
                                        <td>".$venta['Vendedor_Nombre']."</td> 
                                        <td>".$venta['Cliente_Nombre']."</td>
                                        <td>".$venta['Producto']."</td>
                                        <td>".$venta['Precio_al_dia']."</td>
                                        <td>".$venta['Cantidad']."</td>
                                        <td>".$venta['Descuento']."</td>
                                         <td>".$venta['Tipo_Pago']."</td>
                                       
                                   
                                </tr>";
                        }
                    }
                    if (!$encontroResultados) {
                        echo "<tr><td colspan='13' style='text-align:center'>No se encontraron resultados</td></tr>";
                    }
                } else {
                    foreach ($ventas as $venta) {
                        echo "<tr>
                               
                                        <td>".$venta['No_venta']."</td>
                                        <td>".$venta['Fecha_Venta']."</td>
                                        <td>".$venta['Vendedor_Nombre']."</td> 
                                        <td>".$venta['Cliente_Nombre']."</td>
                                        <td>".$venta['Producto']."</td>
                                        <td>".$venta['Precio_al_dia']."</td>
                                        <td>".$venta['Cantidad']."</td>
                                        <td>".$venta['Descuento']."</td>
                                         <td>".$venta['Tipo_Pago']."</td>
                                
                            </tr>";
                    }
                }

                echo "</table>";
            } else {
                echo "<p>No hay ventas registrados en la base de datos</p>";
            }
            ?>
        </form>
    </div>

    <div id="boton-centrado">
        <input type="button" onClick="location='menuAdmin.php'" value="Regresar" />
    </div>

    
