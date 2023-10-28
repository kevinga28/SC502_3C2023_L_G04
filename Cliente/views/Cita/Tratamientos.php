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
                            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                                <li class="container-tratamientos">
                                    <a href="#" class="nav-link">
                                        <p id="sub-tratamientos" style="font-size: 20px; color: #593326">
                                            Cabello
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview" style="display: none;">
                                        <li class="nav-item">
                                            <p href="#" class="item-tratamiento">
                                                <i class="far fa-circle nav-icon"></i>
                                                <a href="#">Largo Mujer</a>
                                            </p>
                                        </li>
                                        <br>
                                        <li class="nav-item">
                                            <p href="#" class="item-tratamiento">
                                                <i class="far fa-circle nav-icon"></i>
                                                <a href="#">Corto Mujer</a>
                                            </p>
                                        </li>
                                        <br>
                                        <li class="nav-item">
                                            <p href="#" class="item-tratamiento">
                                                <i class="far fa-circle nav-icon"></i>
                                                <a href="#">Largo + Lavado Mujer</a>
                                            </p>
                                        </li>
                                        <br>
                                        <li class="nav-item">
                                            <p href="#" class="item-tratamiento">
                                                <i class="far fa-circle nav-icon"></i>
                                                <a href="#">Corto + Lavado Mujer</a>
                                            </p>
                                        </li>
                                        <br>
                                        <li class="nav-item">
                                            <p href="#" class="item-tratamiento">
                                                <i class="far fa-circle nav-icon"></i>
                                                <a href="#">Largo Hombre</a>
                                            </p>
                                        </li>
                                        <br>
                                        <li class="nav-item">
                                            <p href="#" class="item-tratamiento">
                                                <i class="far fa-circle nav-icon"></i>
                                                <a href="#">Corto Hombre</a>
                                            </p>
                                        </li>
                                        <br>
                                        <li class="nav-item">
                                            <p href="#" class="item-tratamiento">
                                                <i class="far fa-circle nav-icon"></i>
                                                <a href="#">Largo + Lavado Hombre</a>
                                            </p>
                                        </li>
                                        <br>
                                        <li class="nav-item">
                                            <p href="#" class="item-tratamiento">
                                                <i class="far fa-circle nav-icon"></i>
                                                <a href="#">Corto + Lavado Hombre</a>
                                            </p>
                                        </li>
                                        <br>
                                        <li class="nav-item">
                                            <p href="#" class="item-tratamiento">
                                                <i class="far fa-circle nav-icon"></i>
                                                <a href="#">Niño - Niña</a>
                                            </p>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
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

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Selecciona el enlace "Cabello" por su ID
        const cabelloLink = document.getElementById("sub-tratamientos");

        // Selecciona el menú desplegable por su clase
        const menuCabello = document.querySelector(".nav.nav-treeview");

        // Agrega un controlador de eventos al enlace "Cabello"
        cabelloLink.addEventListener("click", function() {
            // Cambia la visibilidad del menú desplegable
            menuCabello.style.display = (menuCabello.style.display === "none") ? "block" : "none";
        });
    });
</script>


</body>