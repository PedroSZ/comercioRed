<?php include_once 'modulos/mdl_login.php'; ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/navbarYmenu.css">
    <title>LA PICONERIA</title>
</head>
<body>
<?php include_once 'modulos/mdl_header.php'; ?>

<div id="contenedor">
    <section id="contenidoLogin">
        <article style="text-align: center; max-width: 400px; margin: auto;">
            <form action="login.php" method="POST">
                <h2>Iniciar sesión</h2>

                <div class="mb-3">
                    <label for="codigo" class="form-label">Usuario:</label>
                    <input type="text" class="form-control" id="codigo" name="codigo" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
            </form>

            <p class="mt-3 text-danger">
                <?php if(isset($alert)) echo $alert; ?>
            </p>
        </article>
    </section>
</div>

<?php include_once 'modulos/mdl_footer.php'; ?>
</body>
</html>