<?php
// Script para actualizar repositorio con webhook de GitHub

// Cambia esta ruta por la ruta de tu repositorio en el servidor
$repo_dir = '/home3/danie384/public_html/lapiconeria/sucursales';

// Solo permite solicitudes POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Cambia al directorio del repositorio
    chdir($repo_dir);
    // Ejecuta git pull para actualizar
    $output = shell_exec('git pull 2>&1');
    // Puedes guardar el resultado en un archivo de log si quieres
    file_put_contents('git_pull.log', date('Y-m-d H:i:s') . "\n" . $output . "\n", FILE_APPEND);
    echo 'Repositorio actualizado';
} else {
    echo 'Método no permitido';
}

/*
https://lapiconeria.com/sucursales/update_repo.php
*/
?>