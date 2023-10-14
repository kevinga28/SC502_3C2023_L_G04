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
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- style css -->
  <link rel="stylesheet" href="css/style.css">

  <link rel="stylesheet" href="css/register.css">
  <!-- Responsive-->
  <link rel="stylesheet" href="css/responsive.css">
  <!-- fevicon -->
  <link rel="icon" href="images/fevicon.png" type="image/gif" />
  <!-- Scrollbar Custom CSS -->
  <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
</head>

<body>

  <header>
    <!-- header inicio-->
    <?php
    include 'fragments/header.php'
    ?>
  </header>


  <section class="banner_nosotros">
    <div class="carousel-inner-nosotros">
      <div class="container-fluid">
        <div class="col-md-12">
          <div class="text-bg-nosotros">
            <div class="box-log">
              <form class="">
                <h2>Registrar o Iniciar Sesion</h2>
                <h3>Crear una cuenta</h3>

                <div class="input-box">
                  <input type="text" placeholder="Nombre*">
                </div>

                <div class="input-box">
                  <input type="text" placeholder="Apellido*">
                </div>

                <div class="input-box">
                  <input type="email" placeholder="Correo Electronico*">
                </div>

                <div class="input-box">
                  <input type="password" placeholder="Contraseña*">
                </div>


                <div class="input-box">
                  <input type="text" placeholder="Telefono*">
                </div>

                <div class="input-box">
                  <h3>Fecha de nacimiento </h3>
                  <div class="fecha_nacimiento">
                    <input type="text" placeholder="Dia">
                    <input type="text" placeholder="Mes">
                    <input type="text" placeholder="Año">
                  </div>

                </div>
                <div class="input-box">
                  <button type="submit" class="btn">Registrar</button>
                </div>
              </form>

              <p>

              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <footer id="contacto">
    <?php
    include 'fragments/footer.php'
    ?>
  </footer>



</body>

</html>