<?php
	/********************** VALIDAMOS QUE ESTA PAGINA SEA PARA LA SESION INICIADA ****************/


/**********************************************************************************************/
error_reporting(0);
$filtro1 = isset($_POST['FiltarId_actualizar_usuario']) ? trim($_POST['FiltarId_actualizar_usuario']) : '';
$filtro2 = isset($_POST['FiltarNom_actualizar_usuario']) ? trim($_POST['FiltarNom_actualizar_usuario']) : '';
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



              function consultar(Id_Usuario) {
                  var mensaje;
                  var opcion = confirm("El Usuario será eliminado totalmente de la base de datos, ¿seguro que desea continuar con esta acción?");
                    if (opcion == true) {
                        document.lista_eliminar_usuario.miIdUsuario.value = Id_Usuario;
                        
                         document.lista_eliminar_usuario.submit();
	      	             mensaje = "Usuario eliminado con éxito.";
                             } else {
                                    mensaje = "No se realizado ninguna acción.";
                                     }
		            }
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

    </head>
    <body>
        
     
        
        <!-- Encabezado de la pagina-->
            <?php include_once 'modulos/mdl_header.php'; ?>
        <!-- fin Encabezado de la pagina-->
   <div class="superponer">
    <h1 class="text-center mt-4">Eliminar Usuarios</h1>
    <p class="text-center">Elija de la lista al usuario que desea eliminar haciendo clic en el icono. <img src="img/delete.png" width="30" height="30" alt="eliminar" title="eliminar producto"></p>
 </div>
           
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
            <!--/*********************************FIN FORMULARIO PARA EL FILTRO*****************************************************/ -->


<div id="listado">
        <form method="post" action="modulos/mdl_del_usuario.php" name="lista_eliminar_usuario" id="lista_eliminar_usuario" class="form-list">
                    <input type="hidden" id="miIdUsuario" name="miIdUsuario">
            <?php
            include_once 'clases/usuario.php';
            $user2 = new Usuario();
            $usuarios = $user2->listar();
            $encontroResultados = false;

            if ($usuarios) {
                echo "<table class='table table-bordered border-primary table-hover tabla-datos'><thead>
                        <tr>
                            <th style='text-align:center'>Id</th>
                             <th style='text-align:center'>Idtipo</th>
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
                            <th style='text-align:center'>Eliminar</th>
                        </tr></thead>";

                if ($filtro1 !== '' || $filtro2 !== '' || $filtro3 !== '') {
                    foreach ($usuarios as $user2) {
                        $coincideId = ($filtro1 === '' || $filtro1 == $user2['Id_usuario']);
                        $coincideNombre = ($filtro2 === '' || strtoupper($filtro2) == strtoupper($user2['Nombre']));
                        $coincideEstatus = ($filtro3 === '' || intval($filtro3) === intval($user2['Estatus_u']));

                        if ($coincideId && $coincideNombre && $coincideEstatus) {
                            $encontroResultados = true;
                            echo "<tr>
                                    <td>{$user2['Id_Usuario']}</td>
                                     <td>{$user2['Usuario_Id']}</td>
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
                                     <td style='text-align:center'><img width='30' height='30' src='img/delete.png' onClick='consultar(\"".$user2['Id_Usuario']."\");'></td>
                                   
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
                                 <td>{$user2['Usuario_Id']}</td>
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
                                 <td style='text-align:center'><img width='30' height='30' src='img/delete.png' onClick='consultar(\"".$user2['Id_Usuario']."\");'></td>
                                
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

     

         
 
        <!-- Pie de pagina-->
          

<div id="boton-centrado">
   <input type="button" onClick="location='menuAdmin.php'" value="Regresar" />
</div>

 <?php include_once 'modulos/mdl_footer.php'; ?>
    </body> 
   
</html>
