<div class="header">
   <div class="container">
      <div class="row">
         <div class="col-xl-5 col-lg-5 col-md-9 col-sm-9">
            <nav class="navigation navbar navbar-expand-md navbar-dark ">
               <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarEvolve" aria-controls="navbarEvolve" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
               </button>
               <div class="collapse navbar-collapse" id="navbarEvolve">
                  <ul class="navbar-nav mr-auto">
                     <li class="nav-item active">
                        <a class="nav-link" href="../index.php">Inicio</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="../nosotros.php">Nosotros</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="../servicios.php">Servicios</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="#estilista">Estilistas</a>
                     </li>
                  </ul>
               </div>
            </nav>
         </div>
         <div class="col-xl-2 col-lg-2 col-md-3 col-sm-3 col logo_section">
            <div class="full">
               <div class="center-desk">
                  <div class="logo">
                     <a href="../index.php"><img src="../images/logo.png" alt="#" /></a>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5">
            <ul class="email">
               <li><a href="#">Telefono: (+506) 0000-3211</a></li>
               <li><a href="#">Correo: evolvecitas@gmail.com</a></li>
               <li>
                  <?php
                  session_start(); // iniciar la sesión 
                  if (isset($_SESSION['usuario_logueado'])) {
                     // El usuario ha iniciado sesión, muestra el enlace al perfil.
                     echo '<a href="#" data-bs-toggle="modal" data-bs-target="#myModal"><i class="fas fa-user-circle fa-lg"></i></a>';
                  } else {
                     // El usuario no ha iniciado sesión, muestra un enlace de inicio de sesión en su lugar.
                     echo '<a href="../login/login.php"><i class="fas fa-user-circle fa-lg"></i></a>';
                  }
                  ?>
               </li>
            </ul>
         </div>
      </div>
   </div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content" style="background-color: #F7F4ED;">
         <div class="modal-header">
            <h4 class="modal-title">Perfil Cliente</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="margin-right: 20px;"></button>
         </div>
         <div class="modal-body">
            <div class="text-modal">
               <?php
               // Datos del cliente (puedes obtener estos valores desde tu base de datos o donde los tengas)
               $nombreCliente = "Nombre del Cliente";
               $correoCliente = "correo@example.com";
               $telefonoCliente = "(123) 456-7890";
               ?>

               <h6 class="nombre-cliente-modal">Cliente: <?php echo $nombreCliente; ?></h6>
               <p class="correo-cliente-modal">Correo: <?php echo $correoCliente; ?></p>
               <p class="telefono-cliente-modal">Teléfono: <?php echo $telefonoCliente; ?></p>
            </div>
         </div>
         <div class="modal-footer" style="justify-content: space-between;">
            <button type="button" class="btn btn-editar-modal" data-bs-toggle="modal" data-bs-target="#editarModal">Editar</button>

            <button type="button" class="btn btn-citas-modal" data-bs-toggle="modal" data-bs-target="#facturaModal">Citas Y Facturas</button>
         </div>
      </div>
   </div>
</div>

<div class="modal fade" id="editarModal" tabindex="-1" aria-labelledby="editarModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content" style="background-color: #F7F4ED;">
         <div class="modal-header">
            <h4 class="modal-title" id="editarModalLabel">Editar Perfil</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="margin-right: 20px;"></button>
         </div>
         <div class="modal-body">
            <form action="procesar_edicion.php" method="post">
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label for="nombreCliente">Nombre:</label>
                        <input type="text" id="nombreCliente" name="nombreCliente" value="<?php echo $nombreCliente; ?>" class="form-control">
                     </div>
                     <div class="form-group">
                        <label for="correoCliente">Correo:</label>
                        <input type="email" id="correoCliente" name="correoCliente" value="<?php echo $correoCliente; ?>" class="form-control">
                     </div>
                     <div class="form-group">
                        <label for="password">Contraseña:</label>
                        <input type="password" id="password" name="password" value="<?php echo $password; ?>" class="form-control">
                     </div>
                     <div class="form-group">
                        <label for="telefonoCliente">Teléfono:</label>
                        <input type="text" id="telefonoCliente" name="telefonoCliente" value="<?php echo $telefonoCliente; ?>" class="form-control">
                     </div>

                  </div>
                  <div class="col-md-6">

                     <div class="form-group">
                        <label for="provincia">Provincia:</label>
                        <input type="text" id="provincia" name="provincia" value="<?php echo $provincia; ?>" class="form-control">
                     </div>
                     <div class="form-group">
                        <label for="distrito">Distrito:</label>
                        <input type="text" id="distrito" name="distrito" value="<?php echo $distrito; ?>" class="form-control">
                     </div>
                     <div class="form-group">
                        <label for="canton">Canton:</label>
                        <input type="text" id="canton" name="canton" value="<?php echo $telefonoCcantonliente; ?>" class="form-control">
                     </div>
                     <div class="form-group">
                        <label for="otros">Otros:</label>
                        <input type="text" id="otros" name="otros" value="<?php echo $otros; ?>" class="form-control">
                     </div>
                  </div>
               </div>
               <div class="modal-footer" style="justify-content: space-between;">
                  <button type="button" class="btn btn-citas-modal" data-bs-toggle="modal" data-bs-target="#myModal">Volver</button>
                  <button type="submit" class="btn btn-editar-modal">Guardar Cambios</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

<div class="modal fade" id="facturaModal" tabindex="-1" aria-labelledby="facturaModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content" style="background-color: #F7F4ED;">
         <div class="modal-header">
            <h4 class="modal-title" id="facturaModalLabel">Información de Factura</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="margin-right: 20px;"></button>
         </div>
         <div class="modal-body">
            <div class="text-modal">
               <div class="form-group">
                  <label for="tratamiento">Tratamiento:</label>
                  <input type="text" id="tratamiento" name="tratamiento" class="form-control" readonly>
               </div>
               <div class="form-group">
                  <label for="precio">Precio con IVA:</label>
                  <input type="text" id="precio" name="precio" class="form-control" readonly>
               </div>
               <div class="form-group">
                  <label for="fecha">Fecha:</label>
                  <div class="row">
                     <div class="col">
                        <input type="text" id="dia" name="dia" class="form-control" readonly>
                     </div>
                     <div class="col">
                        <input type="text" id="mes" name="mes" class="form-control" readonly>
                     </div>
                     <div class="col">
                        <input type="text" id="año" name="año" class="form-control" readonly>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-footer" style="justify-content: space-between;">
            <button type="button" class="btn btn-citas-modal" data-bs-toggle="modal" data-bs-target="#myModal">Volver</button>
         </div>
      </div>
   </div>
<<<<<<< HEAD
</div>
=======
</div>
>>>>>>> 4aa3b769a5fd3d633c0452d905602e70cff06de4
