
<!doctype html>
<!-- menuAdmin.php -->
<html lang="en">
  <head>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/navbarYmenu.css">
    <link rel="stylesheet" href="css/modulos.css">
    <link rel="stylesheet" href="css/contenedores.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    <script src="js/modulos.js" type="text/javascript"></script>
     <script src="js/teclasRapidas.js" type="text/javascript"></script>

    <script>
    window.onload = function() {
        //AQUI RECETEAMOS LA FECHA ACTUAL PARA EL CAMPO FECHA_VENTA
        var fecha = new Date(); //Fecha actual
        var mes = fecha.getMonth()+1; //obteniendo mes
        var dia = fecha.getDate(); //obteniendo dia
        var ano = fecha.getFullYear(); //obteniendo año
            if(dia<10)
                 dia='0'+dia; //agrega cero si el menor de 10
                if(mes<10)
                     mes='0'+mes //agrega cero si el menor de 10
                     document.getElementById('fecha_venta').value = ano+"-"+mes+"-"+dia;//ponemos la fecha actual
    };
  </script>



  </head>
  <body>
     <?php include_once 'modulos/mdl_header.php'; ?>
    <div class="container">
      <div class="superponer">
    <h1 class="text-center mt-4">Actualizar venta</h1>
    
    </div>
    <?php include_once 'forms/form_act_venta.php' ?>
  
    </div>
    <div id="teclasRapidas">
    <strong>Teclas Rápidas:</strong><br>
    F1: Registrar Venta<br>
    F2: Cancelar<br>
    F3: Regresar<br>
    F1 (Modal): Confirmar<br>
    F2 (Modal): Cancelar Modal
</div>
   

    
  </body>
</html>