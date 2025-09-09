<?php

include_once __DIR__ . '/../clases/sesion.php';
include_once __DIR__ . '/../clases/tipo_usuario.php';
/**
 * Devuelve un objeto Tipo_Usuario con los datos del usuario logueado.
 * Retorna null si no hay sesión iniciada.
 */
function getUsuarioLogueado() {
    $sesion = new Sesion();

    if ($sesion->getCurrentUser()) {
        $userId = $sesion->getCurrentUser();
        $usuario = new Tipo_Usuario();
        $usuario->establecerDatosPorId($userId); 
        return $usuario;
    }

    return null;
}
?>