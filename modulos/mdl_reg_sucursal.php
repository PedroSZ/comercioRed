<?php
include_once '../clases/sucursal.php';

// Crear objeto
$sucursal = new Sucursal();

// --- Recibir datos del formulario ---
$sucursal->setNombre_sucursal($_POST['sucursal']);
$sucursal->setTelefono($_POST['telefono']);
$sucursal->setEmail($_POST['email']);
$sucursal->setDomicilio($_POST['domicilio']);

$sucursal->setColor_background_principal($_POST['c_primario']);
$sucursal->setColor_background_secundario($_POST['c_secundario']);
$sucursal->setColor_radial($_POST['radial']);
$sucursal->setColor_texto_principal($_POST['c_texto_principal']);
$sucursal->setColor_texto_secundario($_POST['c_texto_secundario']); // corregí el name
$sucursal->setColor_header_principal($_POST['color_header_principal']);
$sucursal->setColor_header_secundario($_POST['color_header_secundario']);
$sucursal->setColor_footer_principal($_POST['color_footer_principal']);
$sucursal->setColor_footer_secundario($_POST['color_footer_secundario']);
$sucursal->setColor_texto_header_principal($_POST['color_texto_header_principal']);
$sucursal->setColor_texto_header_secundario($_POST['color_texto_header_secundario']);
$sucursal->setColor_texto_footer_principal($_POST['color_texto_footer_principal']);
$sucursal->setColor_texto_footer_secundario($_POST['color_texto_footer_secundario']);
$sucursal->setColor_boton_principal($_POST['color_boton_principal']);
$sucursal->setColor_boton_secundario($_POST['color_boton_secundario']);
$sucursal->setColor_boton_texto_principal($_POST['color_boton_texto_principal']);
$sucursal->setColor_boton_texto_secundario($_POST['color_boton_texto_secundario']);

/// --- SUBIR LOGOTIPO ---
// Carpeta física (desde el punto de vista de este archivo en /modulos/)
$carpetaFisica = dirname(__DIR__) . "/logotipos/";

// Carpeta relativa que quieres guardar en BD
$carpetaRelativa = "logotipos/";

if (!file_exists($carpetaFisica)) {
    mkdir($carpetaFisica, 0777, true);
}

$nombreArchivo = $_FILES['logotipo']['name'];
$tmpArchivo    = $_FILES['logotipo']['tmp_name'];
$nombreFinal   = time() . "_logo" . strrchr($nombreArchivo, '.'); // mantiene extensión

// Ruta física donde se guarda el archivo
$rutaDestinoFisica = $carpetaFisica . $nombreFinal;

// Ruta relativa que se guardará en la BD
$rutaDestinoRelativa = $carpetaRelativa . $nombreFinal;

if (move_uploaded_file($tmpArchivo, $rutaDestinoFisica)) {
    // Guardamos en BD solo la ruta relativa
    $sucursal->setLogotipo($rutaDestinoRelativa);
} else {
    die("Error al subir el logotipo");
}

// --- GUARDAR EN BD ---
if ($sucursal->registrarSucursal()) {
    echo "<script>alert('Sucursal registrada correctamente'); window.location='../menuAdmin.php';</script>";
} else {
    echo "<script>alert('Error al registrar la sucursal'); history.back();</script>";
}
