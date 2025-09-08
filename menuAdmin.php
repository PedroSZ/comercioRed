<?php
include_once 'clases/auth_rol.php'; // Verifica sesión y rol
include_once 'clases/corte_caja.php';
include_once 'clases/usuario.php';

// Solo Administradores
$usuario = protegerPagina(['Administrador']); 

$codigo = $usuario->getUsuario_id();

// Usuario completo
$usuarioCompleto = new Usuario();
$miUsuario = $usuarioCompleto->consultarId($codigo);

// Corte de caja
$corte = new CorteCaja();
$cajaAbierta = $corte->cajaAbierta($codigo);

?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Menu Administrador</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/navbarYmenu.css">
    <link rel="stylesheet" href="css/contenedores.css">
    <link rel="stylesheet" href="css/modulos.css">
    <script src="js/modulos.js"></script>
</head>
<body>
<?php include_once 'modulos/mdl_header.php'; ?>
<?php include_once 'modulos/mdl_menuAdmin.php'; ?>

<div class="container mt-4">
    <h3>Bienvenido, <?php echo $usuario->getUsuario(); ?></h3>

    <div class="mt-3">
        <?php if (!$cajaAbierta): ?>
            <button id="btnCaja" class="btn btn-success" onclick="abrirCaja()">Abrir Caja</button>
        <?php else: ?>
            <button id="btnCaja" class="btn btn-danger" onclick="cerrarCaja(<?php echo $cajaAbierta['Id_Corte']; ?>)">Cerrar Caja</button>
        <?php endif; ?>
    </div>
</div>

<?php include_once 'modulos/mdl_footer.php'; ?>
</body>
</html>
