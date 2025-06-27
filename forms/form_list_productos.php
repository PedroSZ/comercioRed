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
    $codigo = $user->getUsuario_id();

    if ($tipo <> "Administrador") header('location: index.php');

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

/********************** CAPTURA DE FILTROS ****************/
error_reporting(0);
$filtro1 = isset($_POST['FiltrarCodigo_actualizarProducto']) ? trim($_POST['FiltrarCodigo_actualizarProducto']) : '';
$filtro2 = isset($_POST['FiltarNom_actualizar_producto']) ? trim($_POST['FiltarNom_actualizar_producto']) : '';
$filtro3 = isset($_POST['Filtrar_Status']) ? trim($_POST['Filtrar_Status']) : '';
?>

   
   <script language='javascript'>
      
        function regresar() {
            location.href = 'index.php';
        }
        function limpiarFiltros() {
            document.getElementById('FiltrarCodigo_actualizarProducto').value = '';
            document.getElementById('FiltarNom_actualizar_producto').value = '';
            document.getElementById('Filtrar_Status').selectedIndex = 0;
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
                        <input name="FiltrarCodigo_actualizarProducto" type="text" placeholder="Buscar por Código" id="FiltrarCodigo_actualizarProducto" onkeyup="this.value = this.value.toUpperCase()" value="<?php echo htmlspecialchars($filtro1); ?>">
                        <input name="FiltarNom_actualizar_producto" type="text" title="Busqueda por Nombre" placeholder="Buscar por Nombre" id="FiltarNom_actualizar_producto" onkeyup="this.value = this.value.toUpperCase()" value="<?php echo htmlspecialchars($filtro2); ?>">
                        <select name="Filtrar_Status" id="Filtrar_Status" onchange="filtrarPorSelect()">
                            <option value="" disabled <?php echo ($filtro3 === '') ? 'selected' : ''; ?>>Buscar por estatus</option>
                            <option value="1" <?php echo ($filtro3 === '1') ? 'selected' : ''; ?>>Activo</option>
                            <option value="0" <?php echo ($filtro3 === '0') ? 'selected' : ''; ?>>Inactivo</option>
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
        <form method="post" action="" name="listar_productos" id="listar_productos" class="form-list">
          
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
        <th style='text-align:center'>Registro</th>
        <th style='text-align:center'>Caducidad</th>
        <th style='text-align:center'>Costo producción</th>
        <th style='text-align:center'>Precio al Público</th>
        <th style='text-align:center'>Estatus</th>
                          
                        </tr></thead>";

                if ($filtro1 !== '' || $filtro2 !== '' || $filtro3 !== '') {
                    foreach ($productos as $producto) {
                        $coincideCdg = ($filtro1 === '' || $filtro1 == $producto['Codigo']);
                        $coincideNombre = ($filtro2 === '' || strtoupper($filtro2) == strtoupper($producto['Nombre']));
                        $coincideEstatus = ($filtro3 === '' || intval($filtro3) === intval($producto['Estatus_p']));

                        if ($coincideCdg && $coincideNombre && $coincideEstatus) {
                            $encontroResultados = true;
                            echo "<tr>
                                     <td>".$producto['Codigo']."</td>
                                        <td>".$producto['Nombre']."</td>
                                        <td>".$producto['Descripcion']."</td>
                                        <td>".$producto['Stock']."</td> 
                                        <td>".$producto['Fecha_Registro']."</td>
                                        <td>".$producto['Fecha_Caducidad']."</td>
                                        <td>".$producto['Costo']."</td>
                                        <td>".$producto['Precio']."</td>
                                        <td>".($producto['Estatus_p'] == 1 ? 'Activo' : 'Inactivo')."</td>
                                       
                                   
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
            <td>".$producto['Stock']."</td> 
            <td>".$producto['Fecha_Registro']."</td>
            <td>".$producto['Fecha_Caducidad']."</td>
            <td>".$producto['Costo']."</td>
            <td>".$producto['Precio']."</td>
            <td>".($producto['Estatus_p'] == 1 ? 'Activo' : 'Inactivo')."</td>
                                
                            </tr>";
                    }
                }

                echo "</table>";
            } else {
                echo "<p>No hay productos registrados en la base de datos</p>";
            }
            ?>
        </form>
    </div>

    <div id="boton-centrado">
        <input type="button" onClick="location='menuAdmin.php'" value="Regresar" />
    </div>

    
