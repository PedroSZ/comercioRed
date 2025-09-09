<?php
/********************** VALIDAMOS QUE ESTA PAGINA SEA PARA LA SESION INICIADA ****************/


/********************** CAPTURA DE FILTROS ****************/
error_reporting(0);
$filtro1 = isset($_POST['FiltarId_actualizar_usuario']) ? trim($_POST['FiltarId_actualizar_usuario']) : '';
$filtro2 = isset($_POST['FiltarNom_actualizar_usuario']) ? trim($_POST['FiltarNom_actualizar_usuario']) : '';
$filtro3 = isset($_POST['Filtrar_Status']) ? trim($_POST['Filtrar_Status']) : '';
?>

   
   <script language='javascript'>
      
        function regresar() {
            location.href = 'index.php';
        }
        function limpiarFiltros() {
            document.getElementById('FiltarId_actualizar_usuario').value = '';
            document.getElementById('FiltarNom_actualizar_usuario').value = '';
            document.getElementById('Filtrar_Status').selectedIndex = 0;
            document.getElementById('form_filtro_listar_usuarios').submit();
        }
        function filtrarPorSelect() {
            document.getElementById('form_filtro_listar_usuarios').submit();
        }
    </script>

  

   

    <div id="filtro">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" name="form_filtro_listar_usuarios" id="form_filtro_listar_usuarios">
            <table class="table-primary" border="1">
                <tr>
                    <td width="100%" style="text-align: right;">
                        <input name="FiltarId_actualizar_usuario" type="text" placeholder="Buscar por Código" id="FiltarId_actualizar_usuario" onkeyup="this.value = this.value.toUpperCase()" value="<?php echo htmlspecialchars($filtro1); ?>">
                        <input name="FiltarNom_actualizar_usuario" type="text" title="Busqueda por Nombre" placeholder="Buscar por Nombre" id="FiltarNom_actualizar_usuario" onkeyup="this.value = this.value.toUpperCase()" value="<?php echo htmlspecialchars($filtro2); ?>">
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
        <form method="post" action="" name="listar_usuarios" id="listar_usuarios" class="form-list">
          
            <?php
            include_once 'clases/usuario.php';
            $user2 = new Usuario();
            $usuarios = $user2->listar();
            $encontroResultados = false;

            if ($usuarios) {
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
                            <th style='text-align:center'>Ingreso</th>
                            <th style='text-align:center'>Tipo cuenta</th>
                            <th style='text-align:center'>Estatus</th>
                          
                        </tr></thead>";

                if ($filtro1 !== '' || $filtro2 !== '' || $filtro3 !== '') {
                    foreach ($usuarios as $user2) {
                        $coincideId = ($filtro1 === '' || $filtro1 == $user2['Id_Usuario']);
                        $coincideNombre = ($filtro2 === '' || strtoupper($filtro2) == strtoupper($user2['Nombre']));
                        $coincideEstatus = ($filtro3 === '' || intval($filtro3) === intval($user2['Estatus_u']));

                        if ($coincideId && $coincideNombre && $coincideEstatus) {
                            $encontroResultados = true;
                            echo "<tr>
                                    <td>{$user2['Id_Usuario']}</td>
                                    <td>{$user2['Nombre']}</td>
                                    <td>{$user2['A_paterno']}</td>
                                    <td>{$user2['A_Materno']}</td>
                                    <td>{$user2['Fecha_Nacimiento']}</td>
                                    <td>{$user2['Rfc']}</td>
                                    <td>{$user2['Telefono']}</td>
                                    <td>{$user2['Email']}</td>
                                    <td>{$user2['Domicilio']}</td>
                                    <td>{$user2['Fecha_Registro']}</td>
                                    <td>{$user2['Puesto']}</td>
                                    <td>" . ($user2['Estatus_u'] == 1 ? 'Activo' : 'Inactivo') . "</td>
                                   
                                </tr>";
                        }
                    }
                    if (!$encontroResultados) {
                        echo "<tr><td colspan='13' style='text-align:center'>No se encontraron resultados</td></tr>";
                    }
                } else {
                    foreach ($usuarios as $user2) {
                        echo "<tr>
                                <td>{$user2['Id_Usuario']}</td>
                                <td>{$user2['Nombre']}</td>
                                <td>{$user2['A_paterno']}</td>
                                <td>{$user2['A_Materno']}</td>
                                <td>{$user2['Fecha_Nacimiento']}</td>
                                <td>{$user2['Rfc']}</td>
                                <td>{$user2['Telefono']}</td>
                                <td>{$user2['Email']}</td>
                                <td>{$user2['Domicilio']}</td>
                                <td>{$user2['Fecha_Registro']}</td>
                                <td>{$user2['Puesto']}</td>
                                <td>" . ($user2['Estatus_u'] == 1 ? 'Activo' : 'Inactivo') . "</td>
                                
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

    

