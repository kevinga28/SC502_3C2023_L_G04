<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">

  <!-- mobile metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="initial-scale=1, maximum-scale=1">
  <!-- site metas -->
  <title>Registro</title>
  <!-- bootstrap css -->
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <!-- style css -->
  <link rel="stylesheet" href="../css/style.css">

  <link rel="stylesheet" href="css/register.css">
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
        <div class="text-bg-logueo">
          <div class="box-log">
            <form name="modulos_add" id="usuario_add" method="POST">
              <h2>Registrarse</h2>
              <div class="row">


                <div class="input-box">
                  <h3> <span class="aste">*</span> Campos Requeridos</h3>
                  <input type="text" name="nombre" id="nombre" placeholder="Nombre*" required>
                </div>

                <div class="input-box">
                  <input type="text" name="apellido" id="apellido" placeholder="Apellido*">
                </div>

                <div class="input-box">
                  <input type="email" name="correo" id="correo" required placeholder="Correo Electronico*">
                </div>

                <div class="input-box">
                  <input type="password" name="contrasena" id="contrasena" required placeholder="Contraseña*">
                </div>

                <div class="input-box">
                  <input type="text" name="provincia" id="provincia" placeholder="Provincia*">
                </div>

                <div class="input-box">
                  <input type="text" name="canton" id="canton" placeholder="Canton*">
                </div>

                <div class="input-box">
                  <input type="text" name="distrito" id="distrito" placeholder="Distrito*">
                </div>

                <div class="input-box">
                  <input type="text" name="otros" id="otros" placeholder="Otros*">
                </div>

                <div class="input-box">
                  <input type="hidden" class="form-check-input" value="false" id="tipoCliente" name="tipoCliente">
                </div>

                <div class="input-box">
                  <button id="btnRegistar" type="submit" class="btn" value="registrar">Registrarse</button>
                </div>




                <p id="parrafo">
                  Al continuar, acepta las Política de privacidad.
                </p>
              </div>
            </form>
          </div>
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

  <script src="../../../Admin/views/plugins/sweetalert2/sweetalert2.all.min.js"></script>

  <script src="js/register.js"></script>

</body>

</html>