<!DOCTYPE html>
<html lang="es">

<head>
    <!-- basic -->
    <meta charset="utf-8">

    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Salon Evolve - Tratamientos</title>
    <!-- bootstrap css -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="../css/style.css">
    <!-- style css -->
    <link rel="stylesheet" href="css/estilistaCita.css">
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
                        <h3><b>Tratamientos</b></h3>
                        <ul class="estilistasJD">
                            <h4 class="sub-tratamientos"><b>Cabello</b></h4>
                            <li class="nav-item">
                                <div class="container-tratamientos">
                                <img src="https://cdn-icons-png.flaticon.com/512/20/20079.png" alt="#" class="perfilEstilista">
                                </div>
                                <p class="estilistaJD">Sofia Vargas </p> 
                                <div class="col_vacia"></div>
                                <button class="boton-estilista">Seleccionar</button>
                            </li>
                            <br>
                            <li class="nav-item">
                                <div class="container-tratamientos">
                                <img src="https://cdn-icons-png.flaticon.com/512/20/20079.png" alt="#" class="perfilEstilista">
                                </div>
                                <p class="estilistaJD">Carol Mejias</p> 
                                <div class="col_vacia"></div>
                                <button class="boton-estilista">Seleccionar</button>
                            </li>
                            <br>
                            <li class="nav-item">
                            <div class="container-tratamientos">
                                <img src="https://cdn-icons-png.flaticon.com/512/20/20079.png" alt="#" class="perfilEstilista">
                                </div>
                                <p class="estilistaJD">Marta Delgado </p> 
                                <div class="col_vacia"></div>
                                <button class="boton-estilista">Seleccionar</button>
                            </li>
                        </ul>
                        <div class="col_vacia"></div>
                    </div>
                    <div class="titulo">
                        <a href="#"><img src="../images/logo.png" alt="#" class="imag_medio" /></a>
                    </div>
                    <div class="bloque-gris">
                        <p>Servicios</p>
                        <div class="cuadro-blanco">
                            <textarea placeholder="Mediante PHP"></textarea>
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