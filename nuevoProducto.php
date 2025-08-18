
<!doctype html>
<!-- menuAdmin.php -->
<html lang="en">
  <head>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/navbarYmenu.css">
    <link rel="stylesheet" href="css/formRegistro.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    <script src="js/modulos.js" type="text/javascript"></script>

   <style>
  .requerido {
    color: red;
    font-weight: bold;
  }

  .input-error {
    border: 2px solid red;
  }
</style>

    <script>
    window.onload = function () {
    var fecha = new Date(); // Fecha actual
    var mes = fecha.getMonth() + 1;
    var dia = fecha.getDate();
    var ano = fecha.getFullYear();

    if (dia < 10) dia = '0' + dia;
    if (mes < 10) mes = '0' + mes;

    // Coloca la fecha actual en el campo de registro
    var fechaRegistro = document.getElementById('fecha_registro_p');
    if (fechaRegistro) {
        fechaRegistro.value = ano + "-" + mes + "-" + dia;
    }

    // Coloca el foco en el campo código
    var campoCodigo = document.getElementById('codigoid');
    if (campoCodigo) {
        campoCodigo.focus();
    }

    // Calcular fecha de caducidad (+5 días)
    var fechaCaducidad = new Date();
    fechaCaducidad.setDate(fechaCaducidad.getDate() + 5); // suma 5 días

    var cadAno = fechaCaducidad.getFullYear();
    var cadMes = fechaCaducidad.getMonth() + 1;
    var cadDia = fechaCaducidad.getDate();

    if (cadDia < 10) cadDia = '0' + cadDia;
    if (cadMes < 10) cadMes = '0' + cadMes;

    var campoCaducidad = document.getElementById('fecha_caducidad');
    if (campoCaducidad) {
        campoCaducidad.value = cadAno + "-" + cadMes + "-" + cadDia;
    }
};


  </script>



  </head>
  <body>
     <?php include_once 'modulos/mdl_header.php'; ?>
   <div class="superponer">
    <h1 class="text-center mt-4">Nuevo Producto</h1>
    <p class="text-center">Por favor, complete el formulario a continuación para registrar un nuevo producto.</p>
    
    <?php include_once 'forms/form_reg_producto.php' ?>
  </div>
    
   

    <?php include_once 'modulos/mdl_footer.php'; ?>
  </body>
</html>