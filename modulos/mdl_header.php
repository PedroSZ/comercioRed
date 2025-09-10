<?php
include_once __DIR__ . '/../clases/helpers.php';
include_once __DIR__ . '/../clases/usuario.php'; // evita "class not found"

$usuario = getUsuarioLogueado();

// Detectar automáticamente la URL base del proyecto
$baseUrl = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
if ($baseUrl === '' || $baseUrl === '.') {
    $baseUrl = '';
}

// Ruta física en servidor para verificar existencia
$logotiposDir = __DIR__ . '/../logotipos/'; 

// Ruta por defecto (logo genérico)
$logo = $baseUrl . "/logotipos/Logotipo.png";

if ($usuario) {
    $consulta = new Usuario();
    $miUsuario = $consulta->consultarSucursalPorIdUsuario($usuario->getUsuario_id());

    if ($miUsuario) {
        $colorPrincipal  = $miUsuario["color_header_principal"];
        $colorRadial     = $miUsuario["color_radial"];
        $colorSecundario = $miUsuario["color_header_secundario"];

        // Validar logo de la BD
        if (!empty($miUsuario["Logotipo"])) {
            $logoFile = basename($miUsuario["Logotipo"]); // solo nombre del archivo
            $logoPath = $logotiposDir . $logoFile;       // ruta física en servidor
            if (file_exists($logoPath)) {
                $logo = $baseUrl . "/logotipos/" . $logoFile; // usar logo real
            }
        }
    } else {
        // Usuario sin sucursal → usar colores y logo genérico
        $colorPrincipal  = "#AD2537";
        $colorRadial     = "#E0E0E0";
        $colorSecundario = "#F0F0F0";
    }
} else {
    // Usuario no logueado → usar colores genéricos
    $colorPrincipal  = "#1F12D4";
    $colorRadial     = "#BBBBBB";
    $colorSecundario = "#DDDDDD";
}

echo "
<nav class='navbar' style='background: linear-gradient(to right, $colorPrincipal, $colorRadial, $colorSecundario);' data-bs-theme='light'>
    <a class='navbar-brand' href='#'>
        <img id='logotipo' src='$logo' height='100' width='100' alt='Logotipo'/>
    </a>
</nav>
";
?>












    
