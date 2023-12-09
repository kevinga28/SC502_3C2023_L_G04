<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Evolve | Logueo</title>

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">

    <link rel="stylesheet" href="../plugins/bootstrap/bootstrap.min.css">

    <link rel="stylesheet" href="css/login.css">

</head>


<body class="hold-transition login-page">

    <div class="d-lg-flex half">
        <div class="bg order-1 order-md-2" style="background-image: url('../dist/img/calendar_bg.jpg');"></div>
        <div class="contents order-2 order-md-1">

            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-7">
                        <h3>Logueo <strong>Evolve Salon</strong></h3>
                        <p class="mb-4">Bievenido a Administracion de Evolve Salon</p>
                        <form name="modulos_verif" id="loginForm" method="POST" action="../../../Admin/controllers/loginController.php">
                            <div class="form-group first">
                                <label for="cedula">Cedula</label>
                                <input name="cedula" type="text" id="cedula" class="form-control" required />
                            </div>
                            <div class="form-group last mb-3">
                                <label for="contrasena">Contraseña</label>
                                <input name="contrasena" type="password" id="contrasena" class="form-control" required />
                            </div>
                            <input type="submit" id="btnLogin" value="Iniciar Sesion" class="btn btn-block btn-primary">

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../plugins/jquery/jquery.min.js"></script>
    <script src="../plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- SWEETALERT -->
    <script src="../plugins/sweetalert2/sweetalert2.all.min.js"></script>


</body>

</html>