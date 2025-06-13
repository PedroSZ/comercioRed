
<?php include_once 'modulos/mdl_login.php'; ?>
<!doctype html>
<!-- login.php -->
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

   
    <title>LA PICONERIA</title>
  </head>
  <body>
     <?php include_once 'modulos/mdl_header.php'; ?>

 <script src="js/fecha.js"></script>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
    -->
    <div id="contenedor">

 <section>
         <section id="contenidoLogin">
             <article style="text-align: center;">

                	<form action="login.php" method="POST" style="margin: 0px; width: 100%; height: 80%">

                     <h2>Iniciar sesión</h2>
                     <p>Usuario: <br>
                     <input type="text" name="codigo"></p>
                     <p>Password: <br>
                     <input type="password" name="password"></p>
                     <p class="center"><input type="submit" value="Iniciar Sesión"></p>
                 </form>

                 <p style="color: RED;">
                     <?php if(isset($alert)) echo $alert; ?>
                 </p>


             </article>
         </section>
 </section>


     </div>











     <?php include_once 'modulos/mdl_footer.php'; ?>
  </body>
</html>
