<?php
/********************** VALIDAMOS QUE ESTA PAGINA SEA PARA LA SESION INICIADA ****************/


/********************** CAPTURA DE FILTROS ****************/
error_reporting(0);
$filtro1 = isset($_POST['$$Filtrar_sucursal_Id']) ? trim($_POST['$$Filtrar_sucursal_Id']) : '';
$filtro2 = isset($_POST['$$Filtrar_sucursal_Nombre']) ? trim($_POST['$$Filtrar_sucursal_Nombre']) : '';

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/navbarYmenu.css">
    <link rel="stylesheet" href="css/modulos.css">
    <link rel="stylesheet" href="css/formularios.css">
    <link rel="stylesheet" href="css/contenedores.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    <script language='javascript'>
        function consultar(Id_Comercio) {
            document.lista_sucursales.miIdSucursal.value = Id_Comercio;
            document.lista_sucursales.submit();
        }
        function regresar() {
            location.href = 'index.php';
        }
        function limpiarFiltros() {
            document.getElementById('$$Filtrar_sucursal_Id').value = '';
            document.getElementById('$$Filtrar_sucursal_Nombre').value = '';
            document.getElementById('form_filtro_$lista_sucursales').submit();
        }
    </script>
</head>
<body>
    <?php include_once 'modulos/mdl_header.php'; ?>
    <div class="superponer">
        <h1 class="text-center mt-4">Modificaciones de Sucursales</h1>
        <p class="text-center">Elija de la lista la sucursal que desea actualizar haciendo clic en el icono. <img src="img/Actualizar.png" width="30" height="30" alt="Actualizar" title="Actualizar producto"></p>
    </div>
   
    <div id="filtro">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" name="form_filtro_$lista_sucursales" id="$form_filtro_$lista_sucursales">
            <table class="table-primary" border="1">
                <tr>
                    <td width="100%" style="text-align: right;">
                        <input name="$$Filtrar_sucursal_Id" type="text" placeholder="Buscar por Id" id="Filtrar_sucursal_Id" onkeyup="this.value = this.value.toUpperCase()" value="<?php echo htmlspecialchars($filtro1); ?>">
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
        <form method="post" action="forms/form_act_sucursal.php" name="lista_sucursales" id="lista_sucursales" class="form-list">
            <input type="hidden" id="miIdSucursal" name="miIdSucursal">
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
                            <th style='text-align:center'>Modificar</th>
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
                                    <td style='background-color: #938F96; text-align: center; vertical-align: middle;'>
                                    <img id='logotipo' src='{$lugar['Logotipo']}' height='100' width='100'/>
                                    </td>
                                    <td style='text-align:center'><img width='30' height='30' src='img/Actualizar.png' onClick='consultar(\"{$lugar['Id_Comercio']}\");'></td>
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
                                     <td style='background-color: #938F96; text-align: center; vertical-align: middle;'>
                                    <img id='logotipo' src='{$lugar['Logotipo']}' height='100' width='100'/>
                                    <td style='text-align:center'><img width='30' height='30' src='img/Actualizar.png' onClick='consultar(\"{$lugar['Id_Comercio']}\");'></td>
                                    </td>
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

      <?php include_once 'modulos/mdl_footer.php'; ?>
</body>
</html>

