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
            <form method="POST" action="procesar_registro.php">
              <h2>Registrarse</h2>

              <div class="input-box">
                <h3> <span class="aste">*</span> Campos Requeridos</h3>
                <input type="text" name="nombre" placeholder="Nombre*">
              </div>

              <div class="input-box">
                <input type="text" name="apellido" placeholder="Apellido*">
              </div>

              <div class="input-box">
                <input type="email" name="correo" placeholder="Correo Electronico*">
              </div>

              <div class="input-box">
                <input type="password" name="contrasena" placeholder="Contraseña*">
              </div>

              <div class="input-box">
                <input type="text" name="telefono" placeholder="Telefono*">
              </div>

              <div class="input-box-fechas">
                <h3>Fecha de nacimiento </h3>
                <div class="fecha_nacimiento">
                  <input type="text" name="dia" placeholder="Dia">
                  <input type="text" name="mes" placeholder="Mes">
                  <input type="text" name="ano" placeholder="Año">
                </div>
              </div>

              <div class="input-box">
                <button type="submit" class="btn">Registrarse</button>
              </div>

              <p id="parrafo">
                Al continuar, acepta las Política de privacidad.
              </p>
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



</body>

</html>