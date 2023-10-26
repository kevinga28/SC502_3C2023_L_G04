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
    <!-- fevicon -->
    <link rel="icon" href="../images/fevicon.png" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="../css/jquery.mCustomScrollbar.min.css">
</head>


<body>
    <!-- header -->
    <header>
        <!-- header inicio-->

        <?php
        include 'fragments/header.php'
        ?>
    </header>
    <!-- final header -->

    <!-- banner -->
    <section class="banner_nosotros">

        <div class="carousel-inner-nosotros">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="text-bg-nosotros">
                        <h1>Agenda de citas</h1> 
                    </div>
                </div>
            </div>
        </div>

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
                            <label for="user" class="label">Usuario*</label>
                            <input id="user" type="text" class="input" name="user" required>
                        </div>
                        <div class="group">
                            <label for="pass" class="label">Constraseña*</label>
                            <input id="pass" type="password" class="input" data-type="password" name="password" required>
                        </div>
                        <div class="group">
                            <input name="Inicio" type="submit" class="button" value="Iniciar Sesion">
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