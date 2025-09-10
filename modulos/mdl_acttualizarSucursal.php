<?php
include_once '../clases/sucursal.php';

if (empty($_POST['idS'])) {
    die("Error: No se especificó la sucursal a actualizar.");
}

$idS = intval($_POST['idS']);
$sucursal = new Sucursal();

// Campos básicos
$campos = [
    'Nombre_Sucursal' => $_POST['sucursal'] ?? '',
    'Domicilio' => $_POST['domicilio'] ?? '',
    'Telefono' => $_POST['telefono'] ?? '',
    'Email' => $_POST['email'] ?? ''
];

// Manejo del logotipo
if (isset($_FILES['logotipo']) && $_FILES['logotipo']['error'] === UPLOAD_ERR_OK) {
    $ruta = 'logotipos/';
    $nombreArchivo = time() . '_' . basename($_FILES['logotipo']['name']);
    $destino = $ruta . $nombreArchivo;

    if (move_uploaded_file($_FILES['logotipo']['tmp_name'], '../' . $destino)) {
        $campos['Logotipo'] = $destino;
    } else {
        die("Error al subir el logotipo.");
    }
} else {
    $sucursalDB = $sucursal->consultarCodigo($idS);
    $campos['Logotipo'] = $sucursalDB['Logotipo'];
}

// Campos de color (automático según nombres de input)
$colores = [
    'color_background_principal' => 'c_primario',
    'color_background_secundario' => 'c_secundario',
    'color_radial' => 'radial',
    'color_texto_principal' => 'c_texto_principal',
    'color_texto_secundario' => 'c_texto_secundario',
    'color_header_principal' => 'color_header_principal',
    'color_header_secundario' => 'color_header_secundario',
    'color_footer_principal' => 'color_footer_principal',
    'color_footer_secundario' => 'color_footer_secundario',
    'color_texto_header_principal' => 'color_texto_header_principal',
    'color_texto_header_secundario' => 'color_texto_header_secundario',
    'color_texto_footer_principal' => 'color_texto_footer_principal',
    'color_texto_footer_secundario' => 'color_texto_footer_secundario',
    'color_boton_principal' => 'color_boton_principal',
    'color_boton_secundario' => 'color_boton_secundario',
    'color_boton_texto_principal' => 'color_boton_texto_principal',
    'color_boton_texto_secundario' => 'color_boton_texto_secundario'
];

foreach ($colores as $campoDB => $inputName) {
    $campos[$campoDB] = $_POST[$inputName] ?? '';
}

// Generar SQL dinámico
$setPart = implode(', ', array_map(fn($c) => "$c = ?", array_keys($campos)));
$valores = array_values($campos);
$valores[] = $idS; // para el WHERE

try {
    $pdo = $sucursal->connect();
    $sql = "UPDATE sucursal SET $setPart WHERE Id_Comercio = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($valores);

    echo "<script>alert('Sucursal actualizada correctamente'); window.location='../menuAdmin.php';</script>";
} catch (PDOException $e) {
    die("Error al actualizar la sucursal: " . $e->getMessage());
}
