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
    <!-- CSS DEL CALENDARIO-->
    <link rel="stylesheet" href="css/calendar.css">
    <!-- style css -->
    <link rel="stylesheet" href="css/citaRegistro.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="../css/responsive.css">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="../css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
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
    <section class="banner_citas">

        <?php
        include 'fragments/banner.php'
        ?>

    </section>
    <!-- final banner -->

    <!-- servicios -->
    <div id="servicio" class="servicio">
        <div class="container">
            <div class="row">
                <!-- CALENDARIO -->
                <div class="col-md-6">
                    <div class="elegant-calencar d-md-flex">
                        <div class="wrap-header d-flex align-items-center img" style="background-image: url(img/bg.jpg);">
                            <p id="reset">Hoy</p>
                            <div id="header" class="p-0">
                              
                                <div class="head-info">
                                    <div class="head-month"></div>
                                    <div class="head-day"></div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="calendar-wrap">
                            <div class="w-100 button-wrap">
                                <div class="pre-button d-flex align-items-center justify-content-center"><i class="fa fa-chevron-left"></i></div>
                                <div class="next-button d-flex align-items-center justify-content-center"><i class="fa fa-chevron-right"></i></div>
                            </div>
                            <table id="calendar">
                                <thead>
                                    <tr>
                                        <th>Dom</th>
                                        <th>Lun</th>
                                        <th>Mar</th>
                                        <th>Mie</th>
                                        <th>Jue</th>
                                        <th>Vie</th>
                                        <th>Sab</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- FIN DEL CALENDARIO -->



                <div class="opciones-hora">
                    <h3>Mañana</h3>
                    <div class="opcion">
                        <button type="button" value="8:00 am">8:00 am</button>
                    </div>
                    <div class="opcion">
                        <button type="button" value="9:30 am">9:30 am</button>
                    </div>
                    <div class="opcion">
                        <button type="button" value="10:30 am">10:30 am</button>
                    </div>
                </div>
                <div class="opciones-hora">
                    <h3>Tarde</h3>
                    <div class="opcion">
                        <button type="button" value="2:00 pm">2:00 pm</button>
                    </div>
                    <div class="opcion">
                        <button type="button" value="3:00 pm">3:00 pm</button>
                    </div>
                    <div class="opcion">
                        <button type="button" value="5:00 pm">5:00 pm</button>
                    </div>
                </div>
                <div class="opciones-hora">
                    <h3>Noche</h3>
                    <div class="opcion">
                        <button type="button" value="6:00 pm">6:00 pm</button>
                    </div>
                    <div class="opcion">
                        <button type="button" value="7:00 pm">7:00 pm</button>
                    </div>
                    <div class="opcion">
                        <button type="button" value="8:00 pm">8:00 pm</button>
                    </div>
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
                <button class="boton-siguiente">Siguiente</button>
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
    <!-- final footer -->

    <script src="../js/jquery.min.js"></script>
    <script src="../js/popper.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/main.js"></script>

</body>