
<footer>
<?php
// Verificamos si existe el código del usuario (sesión iniciada)
if (isset($codigo) && !empty($codigo)) {
    $consultaFooter = new Usuario();
    $miUsuario = $consultaFooter->consultarSucursalPorIdUsuario($codigo);

    // Verificamos si la consulta devolvió resultados
    if ($miUsuario) {
        echo $miUsuario["Nombre_Sucursal"] . "<br>";
        echo $miUsuario["Domicilio"] . "<br>";
        echo $miUsuario["Telefono"] . " " . $miUsuario["Email"];
    } else {
        echo "No se encontraron datos de la empresa para este usuario.";
    }

} else {
    // Si no hay usuario logueado
       echo "  <p>Nombre de su sucursal<br>
             domicilio de su sucursal <br>
    <b>Tel: 000 00 00 000. sucorreo@dominio.com</p>
    ";
   
}
?>
</footer>


