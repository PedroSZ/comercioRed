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
$filtro1 = isset($_POST['FiltarId_actualizar_cliente']) ? trim($_POST['FiltarId_actualizar_cliente']) : '';
$filtro2 = isset($_POST['FiltarNom_actualizar_cliente']) ? trim($_POST['FiltarNom_actualizar_cliente']) : '';
$filtro3 = isset($_POST['Filtrar_Status']) ? trim($_POST['Filtrar_Status']) : '';
?>

   
   <script language='javascript'>
      
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
 
   <div id="listado">
        <form method="post" action="" name="listar_clientes" id="listar_clientes" class="form-list">
          
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

    <div id="boton-centrado">
        <input type="button" onClick="location='menuAdmin.php'" value="Regresar" />
    </div>

    


