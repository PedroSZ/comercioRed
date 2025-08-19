
<!doctype html>
<!-- menuAdmin.php -->
<html lang="en">
  <head>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/navbarYmenu.css">
    <link rel="stylesheet" href="css/modulos.css">
    <link rel="stylesheet" href="css/formularios.css">
    <link rel="stylesheet" href="css/contenedores.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    <script src="js/modulos.js" type="text/javascript"></script>

  


  </head>
  <body>
     <?php include_once 'modulos/mdl_header.php'; ?>
   <div class="superponer">
    <h1 class="text-center mt-4">Lista de Ventas</h1>
  </div>
    <?php include_once 'forms/form_list_ventas.php' ?>
   
    
   

    <?php include_once 'modulos/mdl_footer.php'; ?>
  </body>
</html>