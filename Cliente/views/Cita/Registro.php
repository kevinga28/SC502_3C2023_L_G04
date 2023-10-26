<!DOCTYPE html>
<html lang="es">

<head>
    <!-- basic -->
    <meta charset="utf-8">

    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Salon Evolve - Estilos</title>
    <!-- bootstrap css -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="../css/style.css">
    <!-- style css -->
    <link rel="stylesheet" href="css/citaRegistro.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="../css/responsive.css">

    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="../css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>


<body>
    <!-- header -->
    <header>
        <?php
        include 'fragments/header.php'
        ?>
    </header>
    <!-- final header -->

    <!-- banner -->
    <section class="banner_nosotros">
        <?php
        include 'fragments/banner.php'
        ?>
    </section>
    <!-- final banner -->

    <!-- servicios -->
    <div id="servicio" class="servicio">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="cuadro-beige2">
                        <h3>Inicio de sesion o registro</h3>
                        <div class="group">
                            <label for="nombre" class="label">Nombre</label>
                            <input id="nombre" type="text" class="input" required>
                        </div>
                        <div class="group">
                            <label for="apellido" class="label">Apellido</label>
                            <input id="apellido" type="text" class="input" required>
                        </div>
                        <div class="group">
                            <label for="user" class="label">Username</label>
                            <input id="user" type="text" class="input" required>
                        </div>
                        <div class="group">
                            <label for="pass" class="label">Password</label>
                            <input id="pass" type="password" class="input" data-type="password" required>
                        </div>
                        <div class="group">
                            <label for="telefono" class="label">Teléfono</label>
                            <input id="telefono" type="text" class="input" required>
                        </div>

                        <div class="group">
                            <label for="cumpleanos" class="label">Nacimiento</label>
                            <input id="cumpleanos" type="text" class="input">
                        </div>

                        <div class="group">
                            <input href="InicioSesion.html" type="submit" class="button" value="Registrarse">
                        </div>

                    </div>

                    <div class="titulo">
                        <a href="#"><img src="../images/logo.png" alt="#" class="imag_medio" /></a>
                    </div>
                    <div class="bloque-gris">
                        <p>Servicios</p>
                        <div class="cuadro-blanco">
                            <textarea placeholder="Introduce tu texto aquí"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- final servicios -->

    <!--  footer -->
    <footer id="contacto">
        <?php
        include 'fragments/footer.php'
        ?>
    </footer>
    <!-- final footer -->


</body>