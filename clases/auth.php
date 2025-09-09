<?php
include_once __DIR__ . '/../clases/helpers.php';

// Verifica si hay un usuario logueado
$usuario = getUsuarioLogueado();

if (!$usuario) {
    // No hay usuario en sesión, redirige al login
    header("Location: login.php");
    exit;
}
?>
