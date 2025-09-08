<!--<nav class="navbar navbar-expand-lg bg-body-tertiary">-->
 <?php

   $consulta = new Usuario();
    $miUsuario = $consulta->consultarSucursalPorIdUsuario($codigo);

    // Verificamos si la consulta devolvió resultados
 if ($miUsuario) {
    // Extraer colores desde la BD
    $colorPrincipal  = $miUsuario["color_header_principal"];
    $colorRadial     = $miUsuario["color_radial"];
    $colorSecundario = $miUsuario["color_header_secundario"];

   echo "
<nav class='navbar navbar-expand-lg bg-body-tertiary' 
     style='background: linear-gradient(to right, $colorPrincipal, $colorRadial, $colorSecundario);'>
";}
  ?> 

<ul class='menu'>
     
    <li class='nav-item dropdown'>
      <a class='nav-link dropdown-toggle1' href='#' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
      </a>
      <ul class='dropdown-menu'>

      </ul>
    </li>
<!--
    <li class='nav-item dropdown'>
      <a class='dropdown-item' onclick="activarModulo('NuevaVenta')">Nueva Venta</a>
    </li>

-->

    <li class='dropdown-item'>
     <li><a class='dropdown-item' title="" href="nuevaVenta.php">Ventas</a></li>
    </li>

     <li class='dropdown-item'>
      <li><a class='dropdown-item' href="actualizarVenta.php">Modificar Venta</a><li>
    </li>



      <li class='nav-item dropdown'>
        <a class='dropdown-item' href="actualizarInventario.php">Inventario</a>
        </li>


        

          <li class='nav-item dropdown'>
        <a class='nav-link dropdown-toggle' href='#' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
          Salir
        </a>
        <ul class='dropdown-menu'>
          
          <li><a class='dropdown-item' href="modulos/mdl_logout.php">Serrar Sesión</a></li>
        </ul>
      </li>


    </ul>


 
</nav>