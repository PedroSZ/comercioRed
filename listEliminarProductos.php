<?php
	/********************** VALIDAMOS QUE ESTA PAGINA SEA PARA LA SESION INICIADA ****************/
 

/**********************************************************************************************/
error_reporting(0);
$filtro1 = isset($_POST['FiltrarCodigo_actualizarProducto']) ? trim($_POST['FiltrarCodigo_actualizarProducto']) : '';
$filtro2 = isset($_POST['FiltarNom_actualizar_producto']) ? trim($_POST['FiltarNom_actualizar_producto']) : '';
$filtro3 = isset($_POST['Filtrar_Status']) ? trim($_POST['Filtrar_Status']) : '';
?>
</!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/navbarYmenu.css">
    <link rel="stylesheet" href="css/modulos.css">
     <link rel="stylesheet" href="css/formularios.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
     <link rel="stylesheet" href="css/contenedores.css">
 
        <script language='javascript'>

          
                function borrar(codigo) {
                              var mensaje;
                              var opcion = confirm("El producto será eliminado definitivamente de la base de datos, ¿seguro que desea continuar con esta acción?");
                                 if (opcion == true) {
                                      document.lista_eliminar_producto.micodigo.value = codigo;
			                                alert(codigo);
                                      document.lista_eliminar_producto.submit();
                                      mensaje = "Producto eliminado con éxito.";
                                            } else {
                                                mensaje = "No se realizado ninguna acción.";
                                            }
		              }
      
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

    </head>
    <body>
        
     
        
        <!-- Encabezado de la pagina-->
            <?php include_once 'modulos/mdl_header.php'; ?>
        <!-- fin Encabezado de la pagina-->
 <div class="superponer"> 
    <h1 class="text-center mt-4">Eliminación de Productos</h1>
    <p class="text-center">Elija de la lista el producto que desea eliminar haciendo clic en el icono. <img src="img/delete.png" width="30" height="30" alt="eliminar" title="eliminar producto"></p>
          </div>   
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
            <!--/*********************************FIN FORMULARIO PARA EL FILTRO*****************************************************/ -->


                 <div id="listado">
        <form method="post" action="modulos/mdl_del_producto.php" name="lista_eliminar_producto" id="lista_eliminar_producto" class="form-list">
            <input type="hidden" id="micodigo" name="micodigo">
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
        <th style='text-align:center'>Eliminar</th>
                          
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
                                        <td style='text-align:center'><img width='30' height='30' src='img/delete.png' onClick='borrar(\"".$producto['Codigo']."\");'></td>
                                   
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
              <td style='text-align:center'><img width='30' height='30' src='img/delete.png' onClick='borrar(\"".$producto['Codigo']."\");'></td>                   
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
        <!-- Pie de pagina--> 

           
 <?php include_once 'modulos/mdl_footer.php'; ?>
 
    </body> 
   
</html>
