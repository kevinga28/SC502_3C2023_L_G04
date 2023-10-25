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
                              <a href="Nosotros.php">Leer Más </a> <a href="servicios.php">Servicios</a>
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
            <div class="carousel-item">
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
                              <a href="Nosotros.php">Leer Más </a> <a href="servicios.php">Servicios</a>
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
            <div class="carousel-item">
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
                              <a href="Nosotros.php">Leer Más </a> <a href="servicios.php">Servicios</a>
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
         <a class="carousel-control-prev" type="button" data-bs-target="#banner1" data-bs-slide="prev">
            <i class="fa fa-long-arrow-left" aria-hidden="true"></i>
         </a>
         <a class="carousel-control-next" type="button" data-bs-target="#banner1" data-bs-slide="next">
            <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
         </a>
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
                  <p> Descubre un oasis de belleza y relajación en nuestro salón de belleza. Nuestros
                     expertos estilistas
                     y esteticistas están dedicados a realzar tu belleza natural. Te ofrecemos una amplia
                     gama de servicios
                     de belleza y tratamientos personalizados para que te sientas renovada y radiante.
                     Ven y déjate consentir en un ambiente de lujo y tranquilidad.
                  </p>
               </div>
               <a class="leer_mas" href="servicioCortes.php">Ver</a>
            </div>

            <div class="col-md-4">
               <div id="hover_servicio" class="servicio_box">
                  <i><img src="images/thr1.png" alt="#" /></i>
                  <h3>Color</h3>
                  <p> Descubre un oasis de belleza y relajación en nuestro salón de belleza. Nuestros
                     expertos estilistas
                     y esteticistas están dedicados a realzar tu belleza natural. Te ofrecemos una amplia
                     gama de servicios
                     de belleza y tratamientos personalizados para que te sientas renovada y radiante.
                     Ven y déjate consentir en un ambiente de lujo y tranquilidad.
                  </p>
               </div>
               <a class="leer_mas" href="servicioColor.php">Ver</a>
            </div>

            <div class="col-md-4">
               <div id="hover_servicio" class="servicio_box">
                  <i><img src="images/thr2.png" alt="#" /></i>
                  <h3>Capilares</h3>
                  <p> Descubre un oasis de belleza y relajación en nuestro salón de belleza. Nuestros
                     expertos estilistas
                     y esteticistas están dedicados a realzar tu belleza natural. Te ofrecemos una amplia
                     gama de servicios
                     de belleza y tratamientos personalizados para que te sientas renovada y radiante.
                     Ven y déjate consentir en un ambiente de lujo y tranquilidad.
                  </p>
               </div>
               <a class="leer_mas" href="servicioCapilar.php">Ver</a>
            </div>
         </div>

         <div class="col-md-4 mt-5">
            <div id="hover_servicio" class="servicio_box">
               <i><img src="images/thr2.png" alt="#" /></i>
               <h3>Botox Capilar</h3>
               <p> Descubre un oasis de belleza y relajación en nuestro salón de belleza. Nuestros
                  expertos estilistas
                  y esteticistas están dedicados a realzar tu belleza natural. Te ofrecemos una amplia
                  gama de servicios
                  de belleza y tratamientos personalizados para que te sientas renovada y radiante.
                  Ven y déjate consentir en un ambiente de lujo y tranquilidad.
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
                              Su enfoque especializado en el botox capilar y los cortes curly la
                              distingue como una profesional de confianza que transforma y realza
                              la belleza de cada cliente.
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
                              Habilidad para transformar el cabello en un lienzo de colores vibrantes.
                              Sus servicios de tintes incluyen una gama impresionante de tonos desde los más sutiles
                              hasta los más atrevidos.
                              Te ayudará a encontrar el color que refleje tu personalidad única.
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
                  <h2><img src="images/head.h.png" alt="#" />Ubicacion <span class="white"> Salon</span></h2>
               </div>
            </div>
         </div>
         <div class="row">
            
            <!-- PONER LA DIRECCION DEL LUGAR -->
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
               <div class="map-responsive">
                  <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d491.16345198274337!2d-84.23657056276095!3d9.99142869423163!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses-419!2scr!4v1698255468449!5m2!1ses-419!2scr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" width="600" height="432" frameborder="0" style="border:0; width: 100%;" allowfullscreen></iframe>
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


</body>

</html>