



<!DOCTYPE html>
<html lang="es">

<head>
   <!-- basic -->
   <meta charset="utf-8">

   <!-- mobile metas -->
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="viewport" content="initial-scale=1, maximum-scale=1">
   <!-- site metas -->
   <title>Salon De Belleza</title>
   <!-- bootstrap css -->
   <link rel="stylesheet" href="css/bootstrap.min.css">
   <!-- style css -->
   <link rel="stylesheet" href="css/style.css">
   <!-- Responsive-->
   <link rel="stylesheet" href="css/responsive.css">
   <!-- Scrollbar Custom CSS -->
   <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">



</head>
<!-- body -->

<body class="main-layout">
   <!-- header -->
   <header>

      <?php
      include 'fragments/header.php'
      ?>
   </header>
   <!-- final header -->

   <!-- banner -->
   <section class="banner_main">
      <div id="banner1" class="carousel slide" data-ride="carousel">
         <ol class="carousel-indicators">
            <li data-bs-target="#banner1" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#banner1" data-bs-slide-to="1"></li>
            <li data-bs-target="#banner1" data-bs-slide-to="2"></li>
         </ol>
         <div class="carousel-inner">
            <div class="carousel-item active">
               <div class="container-fluid">
                  <div class="carousel-caption">
                     <div class="row">
                        <div class="col-md-6">
                           <div class="text-bg">
                              <span>Bienvenidos a</span>
                               <h1>Evolve</h1>
                              <p>
                                 Descubre un oasis de belleza y relajación en nuestro salón de belleza. Nuestros
                                 expertos estilistas
                                 y esteticistas están dedicados a realzar tu belleza natural. Te ofrecemos una amplia
                                 gama de servicios
                                 de belleza y tratamientos personalizados para que te sientas renovada y radiante.
                                 Ven y déjate consentir en un ambiente de lujo y tranquilidad.
                              </p>
                              <a href="Nosotros.php">Leer Más </a> <a href="#servicio">Servicios</a>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="text_img">
                              <figure><img src="images/girl.png" alt="#" /></figure>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
      </div>
   </section>
   <!-- final banner -->

   <!-- servicios -->
   <div id="servicio" class="servicio">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="titulo">
                  <h2> <img src="images/head.png" alt="#" />Nuestros Servicios</h2>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-4">
               <div id="hover_servicio" class="servicio_box">
                  <i><img src="images/thr.png" alt="#" /></i>
                  <h3>Cortes de cabello</h3>
                  <p>
                     En nuestro salón de belleza, nuestros expertos estilistas son maestros en la creación de cortes de cabello que resalten tu estilo y personalidad.
                     Ya sea que desees un corte clásico, un estilo moderno o algo único y atrevido, estamos aquí para transformar tu cabello y hacerte sentir renovada
                     y segura de ti misma.
                  </p>
               </div>
               <a class="leer_mas" href="servicioCortes.php">Ver</a>
            </div>

            <div class="col-md-4">
               <div id="hover_servicio" class="servicio_box">
                  <i><img src="images/thr1.png" alt="#" /></i>
                  <h3>Color</h3>
                  <p>
                     ¿Quieres darle vida a tu cabello con un toque de color? Nuestros estilistas especializados en servicios de color te ayudarán a encontrar
                     el tono perfecto que refleje tu estilo y personalidad. Desde sutiles reflejos hasta audaces transformaciones, estamos listos para realzar
                     tu belleza y hacer que tu cabello destaque.
                  </p>
               </div>
               <a class="leer_mas" href="servicioColor.php">Ver</a>
            </div>

            <div class="col-md-4">
               <div id="hover_servicio" class="servicio_box">
                  <i><img src="images/thr2.png" alt="#" /></i>
                  <h3>Capilares</h3>
                  <p>
                     En nuestro salón, cuidamos la salud y belleza de tu cabello. Nuestros expertos estilistas ofrecen una variedad de tratamientos capilares
                     diseñados para mejorar la textura y la apariencia de tu cabello. Desde hidrataciones profundas hasta tratamientos reparadores, te garantizamos
                     una experiencia rejuvenecedora para tu cabello.
                  </p>
               </div>
               <a class="leer_mas" href="servicioCapilar.php">Ver</a>
            </div>
         </div>

         <div class="col-md-4 mt-5 mx-auto">
            <div id="hover_servicio" class="servicio_box">
               <i><img src="images/thr3.png" alt="#" /></i>
               <h3>Botox Capilar</h3>
               <p>
                  Experimenta la magia del botox capilar en nuestro salón. Este tratamiento revolucionario está diseñado para restaurar
                  y fortalecer tu cabello, dejándolo suave y manejable. Nuestros expertos estilistas aplicarán este tratamiento con precisión
                  para brindarte resultados sorprendentes y un cabello espectacularmente hermoso.
               </p>
            </div>
            <a class="leer_mas" href="servicioBotox.php">Ver</a>
         </div>

      </div>
   </div>
   <!-- final servicios -->
   <!-- sobre nosotros -->
   <div id="about" class="about">
      <div class="container">
         <div class="row">
            <div class="col-md-9">
               <div class="titulo">
                  <h2><img src="images/head.h.png" alt="#" />Sobre Nosotros</h2>
                  <p>
                     Somos más que un simple salón de belleza; somos un destino de transformación capilar, un lugar
                     donde tus sueños de cabello se hacen realidad.
                     Con un equipo de talentosos estilistas y una pasión por la belleza, te damos la bienvenida a
                     nuestra casa de la elegancia y la creatividad.
                  </p>
                  <a class="leer_mas" href="Nosotros.php">Leer Más</a>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- final sobre nosotros-->

   <!-- estilistas -->
   <div id="estilista" class="estilista">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="titulo">
                  <h2><img src="images/head.png" alt="#" />Estilistas</h2>
               </div>
            </div>
         </div>
         <div id="myCarousel" class="carousel slide estilista_Carousel" data-bs-ride="carousel">
            <ol class="carousel-indicators">
               <li data-bs-target="#myCarousel" data-bs-slide-to="0" class="active"></li>
               <li data-bs-target="#myCarousel" data-bs-slide-to="1"></li>
               <li data-bs-target="#myCarousel" data-bs-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
               <div class="carousel-item active">
                  <div class="container">
                     <div class="carousel-caption">
                        <div class="persona_box">
                           <i><img src="images/Sofia Vargas.png" alt="#" /></i>
                           <h4>Sofia Vargas</h4>
                           <span>Estilista Curly</span>
                           <p>
                              Sofia Vargas es una estilista especializada en cabello rizado. Su enfoque especializado en el botox capilar y los cortes curly la
                              distingue como una profesional de confianza que transforma y realza
                              la belleza de cada cliente. Con su experiencia y pasión por los rizos, te ayudará a lucir tus rizos de la mejor manera posible.
                           </p>
                           <img src="images/icon.png" alt="#" />
                        </div>
                     </div>
                  </div>
               </div>
               <div class="carousel-item">
                  <div class="container">
                     <div class="carousel-caption">
                        <div class="persona_box">
                           <i><img src="images/Carol Mejias.png" alt="#" /></i>
                           <h4>Carol Mejias</h4>
                           <span>Estilista</span>
                           <p>
                              Carol Mejias es conocida por su habilidad para transformar el cabello en un lienzo de colores vibrantes.
                              Sus servicios de tintes incluyen una gama impresionante de tonos desde los más sutiles
                              hasta los más atrevidos. Te ayudará a encontrar el color que refleje tu personalidad única, y su creatividad
                              te hará lucir espectacular.
                           </p>
                           <img src="images/icon.png" alt="#" />
                        </div>
                     </div>
                  </div>
               </div>
               <div class="carousel-item">
                  <div class="container">
                     <div class="carousel-caption">
                        <div class="persona_box">
                           <i><img src="images/Marta Delgado.png" alt="#" /></i>
                           <h4>Marta Delgado</h4>
                           <span>Estilista</span>
                           <p>
                              Marta Delgado es una estilista talentosa con una pasión por la belleza. Su enfoque está en
                              resaltar la belleza natural de sus clientes. Con su habilidad y atención al detalle,
                              te brindará un servicio excepcional y te ayudará a lucir radiante en cualquier ocasión.
                           </p>
                           <img src="images/icon.png" alt="#" />
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <a class="carousel-control-prev" href="#myCarousel" role="button" data-bs-slide="prev">
               <i class="fa fa-chevron-left" aria-hidden="true"></i>
            </a>
            <a class="carousel-control-next" href="#myCarousel" role="button" data-bs-slide="next">
               <i class="fa fa-chevron-right" aria-hidden="true"></i>
            </a>


         </div>
      </div>
   </div>
   <!-- final estilistas -->
   </div>
   <!--  contacto -->
   <div id="contacto" class="contacto">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="titulo">
                  <h2><img src="images/head.h.png" alt="#" />Ubicación <span class="white">Salon</span></h2>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-12">
               <div class="map-responsive">
                  <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d491.16345198274337!2d-84.23657056276095!3d9.99142869423163!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses-419!2scr!4v1698255468449!5m2!1ses-419!2scr" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" frameborder="0"></iframe>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- final contactoo -->

   <!--  footer -->
   <footer id="contacto">
      <?php
      include 'fragments/footer.php'
      ?>
   </footer>
   <!-- final footer -->
   <!-- Javascript archivos-->
   <script src="js/jquery.min.js"></script>
   <script src="js/popper.min.js"></script>
   <script src="js/bootstrap.bundle.min.js"></script>
   <script src="js/jquery-3.0.0.min.js"></script>
   <script src="login/js/logout.js"></script>
   <script src="../../Admin/views/plugins/sweetalert2/sweetalert2.all.min.js"></script>

   <script src="js/cliente.js"></script>


</body>

</html>