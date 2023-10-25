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
 
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


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
    <section class="banner_servicios">

        <div class="carousel-inner-servicios">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="text-bg-servicios">
                        <h1>Nuestros Servicios</h1>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- final banner -->

    <!-- servicios -->
    <div id="nuestro_servicio" class="nuestro_servicio">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titulo_servicio">
                        <h2 style="color: #593326;">Servicios Capilares</h2>
                        <hr style="background-color: #593326;">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div id="hover_nuestro_servicio" class="nuestro_servicio_box">
                    <h3>Terapia Capilar</h3>
                        <p>
                            Precio: ¢15.000 IVI
                        </p>
                        <p>
                            Condiciones: Marca AlterEgo Incluye Aplicación
                        </p>
                        <div class="boton">
                            <div class="citas_servicio_icono">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                            </div>
                            <div class="citas_servicio_text">
                                <a href="#">Citas</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- final servicios -->

    <footer id="contacto">
        <?php
        include 'fragments/footer.php'
        ?>
    </footer>


</body>