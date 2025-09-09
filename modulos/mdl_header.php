<?php
include_once __DIR__ . '/../clases/helpers.php';
include_once __DIR__ . '/../clases/usuario.php'; // evita "class not found"
$usuario = getUsuarioLogueado();

if ($usuario) {
    $consulta = new Usuario();
    $miUsuario = $consulta->consultarSucursalPorIdUsuario($usuario->getUsuario_id());

    if ($miUsuario) {
        $colorPrincipal  = $miUsuario["color_header_principal"];
        $colorRadial     = $miUsuario["color_radial"];
        $colorSecundario = $miUsuario["color_header_secundario"];
        $logo            = $miUsuario["Logotipo"];
    } else {
        $colorPrincipal = "#AD2537";
        $colorRadial    = "#E0E0E0";
        $colorSecundario= "#F0F0F0";
        $logo = "img/Logotipo.png";
    }
} else {
    $colorPrincipal = "#1F12D4";
    $colorRadial    = "#BBBBBB";
    $colorSecundario= "#DDDDDD";
    $logo = "img/Logotipo.png";
}

echo "
<nav class='navbar' style='background: linear-gradient(to right, $colorPrincipal, $colorRadial, $colorSecundario);' data-bs-theme='light'>
    <a class='navbar-brand' href='#'>
        <img id='logotipo' src='$logo' height='100' width='100'/>
    </a>
</nav>
";
?>









    
