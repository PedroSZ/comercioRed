
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
     <link rel="stylesheet" href="css/navbarYmenu.css">
    <title>LA PICONERIA</title>
  </head>
  <body>
     <?php include_once 'modulos/mdl_header.php'; ?>

 <script src="js/fecha.js"></script>
   <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script> -->
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
