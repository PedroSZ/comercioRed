<?php
	/********************** VALIDAMOS QUE ESTA PAGINA SEA PARA LA SESION INICIADA ****************/



/**********************************************************************************************/
error_reporting(0);
$filtro1 = isset($_POST['FiltarId_actualizar_cliente']) ? trim($_POST['FiltarId_actualizar_cliente']) : '';
$filtro2 = isset($_POST['FiltarNom_actualizar_cliente']) ? trim($_POST['FiltarNom_actualizar_cliente']) : '';
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

             function consultar(Id_Cliente) {
                 document.lista_actualizar_cliente.miIdCliente.value = Id_Cliente;
			           //alert(Id_Cliente);
                   document.lista_actualizar_cliente.submit();
	      	  }
      
        function regresar() {
            location.href = 'index.php';
        }
        function limpiarFiltros() {
            document.getElementById('FiltarId_actualizar_cliente').value = '';
            document.getElementById('FiltarNom_actualizar_cliente').value = '';
            document.getElementById('Filtrar_Status').selectedIndex = 0;
            document.getElementById('form_filtro_listar_clientes').submit();
        }
        function filtrarPorSelect() {
            document.getElementById('form_filtro_listar_clientes').submit();
        }
    </script>

    </head>
    <body>
        
     
        
        <!-- Encabezado de la pagina-->
            <?php include_once 'modulos/mdl_header.php'; ?>
        <!-- fin Encabezado de la pagina-->
   <div class="superponer">
    <h1 class="text-center mt-4">Modificar Cliente</h1>
    <p class="text-center">Elija de la lista al Cliente que desea actualizar haciendo clic en el icono. <img src="img/Actualizar.png" width="30" height="30" alt="Actualizar" title="Actualizar cliente"></p>
 </div>
           
 <div id="filtro">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" name="form_filtro_listar_clientes" id="form_filtro_listar_clientes">
            <table class="table-primary" border="1">
                <tr>
                    <td width="100%" style="text-align: right;">
                        <input name="FiltarId_actualizar_cliente" type="text" placeholder="Buscar por Código" id="FiltarId_actualizar_cliente" onkeyup="this.value = this.value.toUpperCase()" value="<?php echo htmlspecialchars($filtro1); ?>">
                        <input name="FiltarNom_actualizar_cliente" type="text" title="Busqueda por Nombre" placeholder="Buscar por Nombre" id="FiltarNom_actualizar_cliente" onkeyup="this.value = this.value.toUpperCase()" value="<?php echo htmlspecialchars($filtro2); ?>">
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
        <form method="post" action="forms/form_act_cliente.php" name="lista_actualizar_cliente" id="lista_actualizar_cliente" class="form-list">
                    <input type="hidden" id="miIdCliente" name="miIdCliente">
            <?php
            include_once 'clases/cliente.php';
            $cliente = new Cliente();
            $clientes = $cliente->listar();
            $encontroResultados = false;

            if ($clientes) {
                echo "<table class='table table-bordered border-primary table-hover tabla-datos'><thead>
                        <tr>
                           <th style='text-align:center'>Id</th>
                            <th style='text-align:center'>Nombre</th>
                            <th style='text-align:center'>Apellido Paterno</th>
                            <th style='text-align:center'>Apellido Materno</th>
                            <th style='text-align:center'>Fecha Nacimiento</th>
                            <th style='text-align:center'>RFC</th>
                            <th style='text-align:center'>Telefono</th>
                            <th style='text-align:center'>Email</th>
                            <th style='text-align:center'>Domicilio</th>
                            <th style='text-align:center'>Cliente desde</th>
                            <th style='text-align:center'>limite de credito</th>
                            <th style='text-align:center'>Credito Utilizado</th>
                            <th style='text-align:center'>Estatus</th>
                             <th style='text-align:center'>Modificar</th>

                          
                        </tr></thead>";

                if ($filtro1 !== '' || $filtro2 !== '' || $filtro3 !== '') {
                    foreach ($clientes as $cliente) {
                        $coincideId = ($filtro1 === '' || $filtro1 == $cliente['Id_cliente']);
                        $coincideNombre = ($filtro2 === '' || strtoupper($filtro2) == strtoupper($cliente['Nombre']));
                        $coincideEstatus = ($filtro3 === '' || intval($filtro3) === intval($cliente['Estatus_c']));

                        if ($coincideId && $coincideNombre && $coincideEstatus) {
                            $encontroResultados = true;
                            echo "<tr>
                                <td>{$cliente['Id_cliente']}</td>
                                <td>{$cliente['Nombre']}</td>
                                <td>{$cliente['A_paterno']}</td>
                                <td>{$cliente['A_Materno']}</td>
                                <td>{$cliente['Fecha_Nacimiento']}</td>
                                <td>{$cliente['Rfc']}</td>
                                <td>{$cliente['Telefono']}</td>
                                <td>{$cliente['Email']}</td>
                                <td>{$cliente['Domicilio']}</td>
                                <td>{$cliente['Fecha_Registro']}</td>
                                <td>{$cliente['Limite_credito']}</td>
                                <td>{$cliente['Credito_Usado']}</td>
                                <td>" . ($cliente['Estatus_c'] == 1 ? 'Activo' : 'Inactivo') . "</td>
                                 <td style='text-align:center'><img width='30' height='30' src='img/Actualizar.png' onClick='consultar(\"".$cliente['Id_Cliente']."\");'></td>
                                   
                                </tr>";
                        }
                    }
                    if (!$encontroResultados) {
                        echo "<tr><td colspan='13' style='text-align:center'>No se encontraron resultados</td></tr>";
                    }
                } else {
                    foreach ($clientes as $cliente) {
                        echo "<tr>
                                <td>{$cliente['Id_cliente']}</td>
                                <td>{$cliente['Nombre']}</td>
                                <td>{$cliente['A_paterno']}</td>
                                <td>{$cliente['A_Materno']}</td>
                                <td>{$cliente['Fecha_Nacimiento']}</td>
                                <td>{$cliente['Rfc']}</td>
                                <td>{$cliente['Telefono']}</td>
                                <td>{$cliente['Email']}</td>
                                <td>{$cliente['Domicilio']}</td>
                                <td>{$cliente['Fecha_Registro']}</td>
                                <td>{$cliente['Limite_credito']}</td>
                                <td>{$cliente['Credito_Usado']}</td>
                                <td>" . ($cliente['Estatus_c'] == 1 ? 'Activo' : 'Inactivo') . "</td>
                                 <td style='text-align:center'><img width='30' height='30' src='img/Actualizar.png' onClick='consultar(\"".$cliente['Id_Cliente']."\");'></td>
                                
                            </tr>";
                    }
                }

                echo "</table>";
            } else {
                echo "<p>No hay Clientes registrados en la base de datos</p>";
            }
            ?>
        </form>
    </div>

         
 
        <!-- Pie de pagina-->
          

<div id="boton-centrado">
   <input type="button" onClick="location='menuAdmin.php'" value="Regresar" />
</div>
 <?php include_once 'modulos/mdl_footer.php'; ?>

    </body> 
   
</html>
