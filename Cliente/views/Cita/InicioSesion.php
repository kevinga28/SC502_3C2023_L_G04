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
    <link rel="stylesheet" href="css/inicio.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="../css/responsive.css">
    <!-- fevicon -->
    <link rel="icon" href="../images/fevicon.png" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="../css/jquery.mCustomScrollbar.min.css">
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

    <section class="banner_citas">
        <?php
        include 'fragments/banner.php'
        ?>
    </section>
    <!-- final banner -->

    <!-- servicios -->
    <section id="inicioSesion" class="inicioSesion">

        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="cuadro-beige2">
                        <form method="POST" action="procesar_inicio.php">
                            <h2>Registrar o Iniciar Sesion</h2>
                            <a class="registrarse" href="registro.php">Crear una cuenta</a>
                            <div class="input-box">
                                <input type="email" name="correo" placeholder="Correo Electronico">
                            </div>
                            <div class="input-box">
                                <input type="password" name="contrasena" placeholder="Contraseña">
                            </div>
                            <div class="input-box">
                                <button type="submit" class="btn">Iniciar Sesion</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-6">
                    <div id="titulo" class="titulo">
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