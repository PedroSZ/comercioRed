<?php
    include_once '../clases/sesion.php';
    $userSession = new Sesion();
    $userSession->closeSession();
    header("location: ../login.php");
?>
