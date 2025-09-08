<?php
include_once 'helpers.php';

/**
 * Protege una página según los roles permitidos.
 * @param array $rolesPermitidos Ej: ['Administrador','Cajero']
 */
function protegerPagina(array $rolesPermitidos = []) {
    $usuario = getUsuarioLogueado();

    if (!$usuario) {
        header("Location: login.php");
        exit;
    }

    if (!empty($rolesPermitidos) && !in_array($usuario->getPuesto(), $rolesPermitidos)) {
        // Redirige según su rol
        switch ($usuario->getPuesto()) {
            case 'Administrador': header("Location: menuAdmin.php"); exit;
            case 'Cajero':       header("Location: menuUser.php"); exit;
            case 'Cliente':      header("Location: menuCliente.php"); exit;
            default: header("Location: login.php"); exit;
        }
    }

    return $usuario;
}
?>
