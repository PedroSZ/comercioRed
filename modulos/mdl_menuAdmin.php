<nav class="navbar navbar-expand-lg bg-body-tertiary">
  


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

    <li class='nav-item dropdown'>
      <a class='nav-link dropdown-toggle' href='#' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
        Registrar
      </a>
      <ul class='dropdown-menu'>
        
         <li><a class='dropdown-item' onclick="activarModulo('RegUsuario')">Usuarios</a></li>
        <li><a class='dropdown-item' onclick="activarModulo('RegProducto')">Productos</a></li>
         <li><a class='dropdown-item' onclick="activarModulo('RegCliente')">Clientes</a></li>
         <li><a class='dropdown-item' title="" href="nuevaVenta.php">Ventas</a></li>
       
      </ul>
    </li>

     <li class='nav-item dropdown'>
      <a class='nav-link dropdown-toggle' href='#' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
        Consultar
      </a>
      <ul class='dropdown-menu'>
         <li><a class='dropdown-item' onclick="activarModulo('ConUsuario')">Usuarios</a></li>
        <li><a class='dropdown-item' onclick="activarModulo('ConProducto')">Productos</a></li>
         <li><a class='dropdown-item' onclick="activarModulo('ConCliente')">Clientes</a></li>
         <li><a class='dropdown-item' onclick="activarModulo('ConVenta')">Ventas</a></li>
       
      </ul>
    </li>



      <li class='nav-item dropdown'>
          <a class='nav-link dropdown-toggle' href='#' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
            Modificar
          </a>
          <ul class='dropdown-menu'>
             <li><a class='dropdown-item' onclick="activarModulo('ModUsuario')">Usuarios</a></li>
        <li><a class='dropdown-item' onclick="activarModulo('ModProducto')">Productos</a></li>
         <li><a class='dropdown-item' onclick="activarModulo('ModCliente')">Clientes</a></li>
         <li><a class='dropdown-item' onclick="activarModulo('ModVenta')">Ventas</a></li>
          </ul>
        </li>


        <li class='nav-item dropdown'>
        <a class='nav-link dropdown-toggle' href='#' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
          Eliminar
        </a>
        <ul class='dropdown-menu'>
          <li><a class='dropdown-item' onclick="activarModulo('DelUsuario')">Usuarios</a></li>
        <li><a class='dropdown-item' onclick="activarModulo('DelProducto')">Productos</a></li>
         <li><a class='dropdown-item' onclick="activarModulo('DelCliente')">Clientes</a></li>
         <li><a class='dropdown-item' onclick="activarModulo('DelVenta')">Ventas</a></li>
        </ul>
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