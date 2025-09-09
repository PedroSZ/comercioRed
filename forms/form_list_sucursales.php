<?php
/********************** VALIDAMOS QUE ESTA PAGINA SEA PARA LA SESION INICIADA ****************/


/********************** CAPTURA DE FILTROS ****************/
error_reporting(0);
$filtro1 = isset($_POST['$$Filtrar_sucursal_Id']) ? trim($_POST['$$Filtrar_sucursal_Id']) : '';
$filtro2 = isset($_POST['$$Filtrar_sucursal_Nombre']) ? trim($_POST['$$Filtrar_sucursal_Nombre']) : '';

?>

   
   <script language='javascript'>
      
        function regresar() {
            location.href = 'index.php';
        }
        function limpiarFiltros() {
            document.getElementById('$$Filtrar_sucursal_Id').value = '';
            document.getElementById('$$Filtrar_sucursal_Nombre').value = '';
            document.getElementById('$form_filtro_$lista_sucursales').submit();
        }
        
    </script>

  

   

    <div id="filtro">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" name="form_filtro_$lista_sucursales" id="$form_filtro_$lista_sucursales">
            <table class="table-primary" border="1">
                <tr>
                    <td width="100%" style="text-align: right;">
                        <input name="$$Filtrar_sucursal_Id" type="text" placeholder="Buscar por Id" id="$$Filtrar_sucursal_Id" onkeyup="this.value = this.value.toUpperCase()" value="<?php echo htmlspecialchars($filtro1); ?>">
                        <input name="$$Filtrar_sucursal_Nombre" type="text" title="Busqueda por Nombre" placeholder="Buscar por Nombre" id="$$Filtrar_sucursal_Nombre" onkeyup="this.value = this.value.toUpperCase()" value="<?php echo htmlspecialchars($filtro2); ?>">
                       
                        <br>
                        <input type="submit" value="Buscar">
                        <input type="button" value="Limpiar" onclick="limpiarFiltros()">
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <div id="listado">
        <form method="post" action="" name="$$lista_sucursales" id="$$lista_sucursales" class="form-list">
          
            <?php
            include_once 'clases/sucursal.php';
            $lugar = new Sucursal();
            $sucursales = $lugar->listarSucursales();
            $encontroResultados = false;

            if ($sucursales) {
              
                echo "<table class='table table-bordered border-primary table-hover tabla-datos'><thead>
                        <tr>
                            <th style='text-align:center'>Id</th>
                            <th style='text-align:center'>Sucursal</th>
                            <th style='text-align:center'>Telefono</th>
                            <th style='text-align:center'>Email</th>
                            <th style='text-align:center'>Domicilio</th>
                            <th style='text-align:center'>Logotipo</th>
                          
                        </tr></thead>";

                if ($filtro1 !== '' || $filtro2 !== '') {
                    foreach ($sucursales as $lugar) {
                        $coincideId = ($filtro1 === '' || $filtro1 == $lugar['Id_Comercio']);
                        $coincideNombre = ($filtro2 === '' || strtoupper($filtro2) == strtoupper($lugar['Nombre_Sucursal']));
                       

                        if ($coincideId && $coincideNombre) {
                            $encontroResultados = true;
                            echo "<tr>
                                    <td>{$lugar['Id_Comercio']}</td>
                                    <td>{$lugar['Nombre_Sucursal']}</td>
                                    <td>{$lugar['Telefono']}</td>
                                    <td>{$lugar['Email']}</td>
                                    <td>{$lugar['Domicilio']}</td>
                                    <td>{$lugar['Logotipo']}</td>
                                   
                                </tr>";
                        }
                    }
                    if (!$encontroResultados) {
                        echo "<tr><td colspan='13' style='text-align:center'>No se encontraron resultados</td></tr>";
                    }
                } else {
                    foreach ($sucursales as $lugar) {
                        echo "<tr>
                                <td>{$lugar['Id_Comercio']}</td>
                                    <td>{$lugar['Nombre_Sucursal']}</td>
                                    <td>{$lugar['Telefono']}</td>
                                    <td>{$lugar['Email']}</td>
                                    <td>{$lugar['Domicilio']}</td>
                                    <td>{$lugar['Logotipo']}</td>
                                
                            </tr>";
                    }
                }

                echo "</table>";
            } else {
                echo "<p>No hay Usuarios registrados en la base de datos</p>";
            }
            ?>
        </form>
    </div>

    <div id="boton-centrado">
        <input type="button" onClick="location='menuAdmin.php'" value="Regresar" />
    </div>

    

