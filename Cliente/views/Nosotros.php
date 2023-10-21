<!DOCTYPE html>
<html lang="es">

<head>
    <!-- basic -->
    <meta charset="utf-8">

    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Salon Evolve</title>
    <!-- bootstrap css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- fevicon -->
    <link rel="icon" href="images/fevicon.png" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
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

        <div class="carousel-inner-nosotros">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="text-bg-nosotros">
                        <h1>Sobre Nosotros</h1>
                        <p>
                            Potenciar tu confianza a través de servicios capilares excepcionales.
                            Creemos en la importancia de escuchar a nuestros clientes,
                            comprender sus deseos y necesidades, y trabajar juntos para lograr
                            resultados sorprendentes. Ya sea que estés buscando un cambio de imagen
                            completo, un corte de pelo elegante, un tratamiento de color personalizado o un
                            peinado para una ocasión especial,
                            estamos aquí para satisfacer todas tus necesidades capilares.
                        </p>
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
                    <div class="titulo">
                        <h2> <img src="images/head.png" alt="#" />Nuestros Servicios</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div id="hover_servicio" class="servicio_box">
                        <i><img src="images/thr.png" alt="#" /></i>
                        <h3>Cortes de cabello</h3>
                        <p>some form, by injected humour, or randomised words which don't look even slightly believable.
                            If
                            you are </p>
                    </div>
                    <a class="leer_mas" href="#">Ver</a>
                </div>

                <div class="col-md-4">
                    <div id="hover_servicio" class="servicio_box">
                        <i><img src="images/thr1.png" alt="#" /></i>
                        <h3>Color</h3>
                        <p>some form, by injected humour, or randomised words which don't look even slightly believable.
                            If
                            you are </p>
                    </div>
                    <a class="leer_mas" href="#">Ver</a>
                </div>

                <div class="col-md-4">
                    <div id="hover_servicio" class="servicio_box">
                        <i><img src="images/thr2.png" alt="#" /></i>
                        <h3>Capilares</h3>
                        <p>some form, by injected humour, or randomised words which don't look even slightle </p>
                    </div>
                    <a class="leer_mas" href="#">Ver</a>
                </div>

                <div class="col-md-4 mt-5">
                    <div id="hover_servicio" class="servicio_box">
                        <i><img src="images/thr2.png" alt="#" /></i>
                        <h3>Botox Capilar</h3>
                        <p>some form, by injected humour, or randomised words which don't look even slightle </p>
                    </div>
                    <a class="leer_mas" href="#">Ver</a>
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


</body>