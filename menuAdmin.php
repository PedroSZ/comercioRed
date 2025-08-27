<?php
include_once 'clases/tipo_usuario.php';
include_once 'clases/sesion.php';
include_once 'clases/usuario.php';

$userSession = new Sesion();

// Redirigir si no hay sesión
if (!isset($_SESSION['user'])){
    header("location: index.php");
    exit;
}

// Obtener datos del usuario
$user = new Tipo_Usuario();
$user->establecerDatos($userSession->getCurrentUser());
$tipo = $user->getPuesto();
$codigo = $user->getUsuario_id();

// Validar privilegios
if($tipo !== "Administrador") header('location: index.php');

// Control de inactividad
if (!isset($_SESSION['tiempo'])) {
    $_SESSION['tiempo'] = time();
} else if (time() - $_SESSION['tiempo'] > 500) {
    session_destroy();
    header("location: index.php");
    exit;
}
$_SESSION['tiempo'] = time(); // actualizar tiempo actividad

// Usuario completo
$user2 = new Usuario();
$miUsuario = $user2->consultarId($codigo);

// Corte de caja
include_once 'clases/corte_caja.php';
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
    <script src="js/modulos.js" type="text/javascript"></script>

    <script>
    function abrirCaja() {
        let monto = prompt("Ingrese el monto inicial en la caja:");
        if (monto && !isNaN(monto)) {
            fetch("modulos/mdl_corteCaja.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: new URLSearchParams({
                    accion: "abrir",
                    monto: monto
                })
            })
            .then(res => res.json())
            .then(data => {
                console.log("Respuesta PHP:", data);
                if (data.status === "ok") {
                    alert("Caja abierta correctamente con monto inicial: " + monto);

                    // Actualizar botón sin recargar
                    let btn = document.querySelector("#btnCaja");
                    btn.classList.remove("btn-success");
                    btn.classList.add("btn-danger");
                    btn.textContent = "Cerrar Caja";
                    btn.setAttribute("onclick", "cerrarCaja(" + data.id_corte + ")");
                } else {
                    alert("Error al abrir caja: " + (data.msg ?? "Desconocido"));
                }
            })
            .catch(err => console.error("Error fetch:", err));
        }
    }

    function cerrarCaja(id_corte) {
        if (confirm("¿Seguro que deseas cerrar la caja?")) {
            fetch("modulos/mdl_corteCaja.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: new URLSearchParams({
                    accion: "cerrar",
                    id_corte: id_corte
                })
            })
            .then(res => res.json())
            .then(data => {
                console.log("Respuesta PHP:", data);
               if (data.status === "ok") {
   alert("Caja cerrada correctamente.\n" +
      "Monto inicial: " + data.monto_inicial +
      "\nSubtotal ventas: " + data.subtotal +
      "\nDescuentos aplicados: -" + data.total_descuento +
      "\nIVA aplicado: +" + data.total_iva +
      "\nTotal ventas neto: " + data.total_ventas +
      "\nMonto final en caja: " + data.monto_final);


    let btn = document.querySelector("#btnCaja");
    btn.classList.remove("btn-danger");
    btn.classList.add("btn-success");
    btn.textContent = "Abrir Caja";
    btn.setAttribute("onclick", "abrirCaja()");
}
 else {
                    alert("Error al cerrar caja: " + (data.msg ?? "Desconocido"));
                }
            })
            .catch(err => console.error("Error fetch:", err));
        }
    }
</script>

</head>
<body>

<?php include_once 'modulos/mdl_header.php';?>
<?php include_once 'modulos/mdl_menuAdmin.php'; ?>

<div class="container mt-4">
    <h3>Bienvenido, <?php echo $miUsuario["Nombre"]. " " . $miUsuario["A_paterno"]. " " . $miUsuario["A_Materno"]; ?></h3>

    <div class="mt-3">
        <?php if (!$cajaAbierta): ?>
        <button id="btnCaja" class="btn btn-success" onclick="abrirCaja()">Abrir Caja</button>
        <?php else: ?>
        <button id="btnCaja" class="btn btn-danger" onclick="cerrarCaja(<?php echo $cajaAbierta['Id_Corte']; ?>)">Cerrar Caja</button>
        <?php endif; ?>
    </div>
</div>
<?php 
date_default_timezone_set("America/Mexico_City");
echo "PHP hora actual: " . date("Y-m-d H:i:s");
?>

<?php include_once 'modulos/mdl_footer.php'; ?>
</body>
</html>
