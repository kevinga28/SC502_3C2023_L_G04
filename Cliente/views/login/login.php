<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Logueo Evolve</title>
    <!-- bootstrap css -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="../css/style.css">
    <!-- style css -->
    <link rel="stylesheet" href="css/login.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="../css/responsive.css">
    <!-- fevicon -->
    <link rel="icon" href="../images/fevicon.png" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="../css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


</head>

<body>

    <header>
        <!-- header inicio-->

        <?php
        include 'fragments/header.php'
        ?>
    </header>


    <section class="banner_logueo">
        <div>

            <div class="col-md-12">
                <div class="box-log text-bg-logueo">
                    <form name="modulos_verif" id="login" method="POST" >
                        <h2>Registrar o Iniciar Sesion</h2>
                        <a class="registrarse" href="register.php">Crear una cuenta</a>
                        <div class="input-box">
                            <input type="email" id="correo" name="correo" placeholder="Correo Electronico">
                        </div>
                        <div class="input-box">
                            <input  type="password" id="contrasena"   name="contrasena" placeholder="Contraseña">
                        </div>
                        <div class="input-box">
                            <button name="btnlogin" type="submit" class="btn">Iniciar Sesion</button>
                        </div>
                    </form>
                </div>
            </div>

            <div>
    </section>

    <footer id="contacto">
        <?php
        include 'fragments/footer.php'
        ?>
    </footer>

    <script src="../js/jquery.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/jquery-3.0.0.min.js"></script>
    <script src="js/inicioSesion.js"></script>
    <script src="../../../Admin/Views/plugins/sweetalert2/sweetalert2.all.min.js"></script>

</body>

</html>