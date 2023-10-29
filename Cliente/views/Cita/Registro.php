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
    <link rel="stylesheet" href="css/registro.css">
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
    <section class="banner_citas">
        <?php
        include 'fragments/banner.php'
        ?>
    </section>
    <!-- final banner -->



    <section id="registro" class="registro">

        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="cuadro-beige2">
                        <form method="POST" action="procesar_registro.php">
                            <h2>Registrarse</h2>

                            <div class="input-box">
                                <h3> <span class="aste">*</span> Campos Requeridos</h3>
                                <input type="text" name="nombre" placeholder="Nombre*" required>
                            </div>

                            <div class="input-box">
                                <input type="text" name="apellido" placeholder="Apellido*" required>
                            </div>

                            <div class="input-box">
                                <input type="email" name="correo" placeholder="Correo Electrónico*" required>
                            </div>

                            <div class="input-box">
                                <input type="password" name="contrasena" placeholder="Contraseña*" required>
                            </div>

                            <div class="input-box">
                                <input type="text" name="telefono" placeholder="Teléfono*" required>
                            </div>

                            <div class="input-box-fechas">
                                <h3>Fecha de nacimiento</h3>
                                <div class="fecha_nacimiento">
                                    <input type="text" name="dia" placeholder="Día">
                                    <input type="text" name="mes" placeholder="Mes">
                                    <input type="text" name="ano" placeholder="Año">
                                </div>
                            </div>

                            <div class="input-box">
                                <button type="submit" class="btn">Registrarse</button>
                            </div>

                            <p id="parrafo">
                                Al continuar, acepta la Política de privacidad.
                            </p>
                        </form>
                    </div>
                </div>

                <div class="col-md-6">
                    <div id="titulo" class="titulo">
                        <a href="#"><img src="../imageslogo.png" alt="#" class="imag_medio" /></a>
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
    </section>



    <!-- final servicios -->

    <!--  footer -->
    <footer id="contacto">
        <?php
        include 'fragments/footer.php'
        ?>
    </footer>
    <!-- final footer -->


</body>