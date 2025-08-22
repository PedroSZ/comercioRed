<?php
ob_clean(); // limpia salida previa
session_start();
header('Content-Type: application/json');

include_once '../clases/corte_caja.php';
include_once '../clases/tipo_usuario.php';
include_once '../clases/sesion.php';

$response = ["status" => "error", "msg" => "Acción no válida"];

try {
    // Obtener usuario
    $userSession = new Sesion();
    $user = new Tipo_Usuario();
    $user->establecerDatos($userSession->getCurrentUser());
    $id_usuario = $user->getUsuario_id();

    $corte = new CorteCaja();

    if (isset($_POST['accion'])) {
        $accion = $_POST['accion'];

        if ($accion == "abrir") {
            $monto = $_POST['monto'] ?? 0;
            if ($corte->abrirCaja($id_usuario, $monto)) {
                $caja = $corte->cajaAbierta($id_usuario);
                $response = [
                    "status" => "ok",
                    "id_corte" => $caja['Id_Corte'],
                    "msg" => "Caja abierta"
                ];
            } else {
                $response["msg"] = "Ya hay una caja abierta";
            }
        }

      if ($accion == "cerrar") {
    $id_corte = $_POST['id_corte'] ?? 0;
    $resultado = $corte->cerrarCaja($id_corte, $id_usuario);

    if ($resultado) {
        $response = [
            "status" => "ok",
            "id_corte" => $id_corte,
            "monto_inicial" => $resultado["monto_inicial"],
            "total_ventas" => $resultado["total_ventas"],
            "monto_final" => $resultado["monto_final"],
            "hora_inicial" => $resultado["hora_inicial"],
            "hora_final" => $resultado["hora_final"],
            "fecha" => $resultado["fecha"],
            "msg" => "Caja cerrada"
        ];
    } else {
        $response["msg"] = "No se pudo cerrar la caja";
    }
}

    }
} catch (Exception $e) {
    $response = ["status" => "error", "msg" => $e->getMessage()];
}

echo json_encode($response);
exit;
