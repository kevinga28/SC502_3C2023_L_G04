<?php

// Iniciar la sesión
session_start();


// Comprobar si el usuario ha iniciado sesión y si se han almacenado los datos del usuario en la sesión
if (isset($_SESSION['usuario'])) {
   $usuario = $_SESSION['usuario'];
} else {
   $usuario = null;
}

// Cerrar la sesión
if (isset($_GET['cerrar_sesion'])) {
   session_unset();
   session_destroy();
   $usuario = null;
}
?>



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
                        <a class="nav-link" href="index.php">Inicio</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="nosotros.php">Nosotros</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="#servicio">Servicios</a>
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
                     <a href="index.php"><img src="images/logo.png" alt="#" /></a>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5">
            <ul class="email">
               <li><a href="#">Telefono: (+506) 0000-3211</a></li>
               <li><a href="#">Correo: evolvecitas@gmail.com</a></li>
               <li>


                  <a href="#" data-bs-toggle="modal" data-bs-target="#myModal">
                     <i class="fas fa-user-circle fa-lg"></i>
                  </a>

                  <!-- 
                  <?php

                  if (isset($_SESSION['usuario_logueado'])) {
                     // El usuario ha iniciado sesión, muestra el enlace al perfil.
                     echo '<a href="#" data-bs-toggle="modal" data-bs-target="#myModal"><i class="fas fa-user-circle fa-lg"></i></a>';
                  } else {
                     // El usuario no ha iniciado sesión, muestra un enlace de inicio de sesión en su lugar.
                     echo '<a href="login/login.php"><i class="fas fa-user-circle fa-lg"></i></a>';
                  }

                  ?>
                  -->

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

               $nombreCliente = "Nombre del Cliente";
               $correoCliente = "correo@example.com";
               $telefonoCliente = "(123) 456-7890";
               ?>
               <?php
               if (isset($usuario)) {

                  echo '<h6 class="nombre-cliente-modal">Cliente:' . $usuario->getNombre() . '</h6>';
                  echo '<p class="correo-cliente-modal">Correo: ' . $usuario->getCorreo() . '</p>';
                  echo '<p class="telefono-cliente-modal">Teléfono: ' . $usuario->getTelefono() . '</p>';
               } else {

                  echo '<h6 class="nombre-cliente-modal">Cliente: No hay datos registrados</h6>';
                  echo '<p class="correo-cliente-modal">Correo: No hay datos registrados</p>';
                  echo '<p class="telefono-cliente-modal">Teléfono: No hay datos registrados</p>';
               }
               ?>
            </div>
         </div>
         <div class="modal-footer" style="justify-content: space-between;">
            <button type="button" class="btn btn-editar-modal" data-bs-toggle="modal" data-bs-target="#editarModal">Editar</button>

            <button type="button" class="btn btn-citas-modal" data-bs-toggle="modal" data-bs-target="#facturaModal">Citas Y Facturas</button>
         </div>
      </div>
   </div>
</div>


<!-- MODAL PARA INICIAR SESION Y TENER LA CUENTA INICIADA Y REVISAR SUS FACTURAS Y CITAS DESDEL VISTA CLIENTE -->

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
                      <!-- ... Código HTML anterior ... -->

                        <label for="nombreCliente">Nombre:</label>
                        <input type="email" id="correoCliente" name="correoCliente" value="<?php echo isset($usuario) ? $usuario->getNombre() : ''; ?>" class="form-control">
                     </div>
                     <div class="form-group">
                        <label for="correoCliente">Correo:</label>
                        <input type="email" id="correoCliente" name="correoCliente" value="<?php echo isset($usuario) ? $usuario->getCorreo() : ''; ?>" class="form-control">
                     </div>
                     <div class="form-group">
                        <label for="password">Contraseña:</label>
                        <input type="password" id="password" name="password" value="<?php echo $password; ?>" class="form-control">
                     </div>
                     <div class="form-group">
                        <label for="telefonoCliente">Teléfono:</label>
                        <input type="email" id="correoCliente" name="correoCliente" value="<?php echo isset($usuario) ? $usuario->getTelefono() : ''; ?>" class="form-control">
                     </div>

                  </div>
                  <div class="col-md-6">

                     <div class="form-group">
                        <label for="provincia">Provincia:</label>
                        <input type="text" id="provincia" name="provincia"  value="<?php echo isset($_SESSION['usuarioCliente']) ? $_SESSION['usuarioCliente']->getProvincia() : ''; ?>" class="form-control">
                     </div>
                     <div class="form-group">
                        <label for="distrito">Distrito:</label>
                        <input type="text" id="distrito" name="distrito"  value="<?php echo isset($_SESSION['usuarioCliente']) ? $_SESSION['usuarioCliente']->getDistrito() : ''; ?>" class="form-control">
                     </div>
                     <div class="form-group">
                        <label for="canton">Canton:</label>
                        <input type="text" id="canton" name="canton"  value="<?php echo isset($_SESSION['usuarioCliente']) ? $_SESSION['usuarioCliente']->getCanton() : ''; ?>" class="form-control">
                     </div>
                     <div class="form-group">
                        <label for="otros">Otros:</label>
                        <input type="text" id="otros" name="otros"  value="<?php echo isset($_SESSION['usuarioCliente']) ? $_SESSION['usuarioCliente']->getOtros() : ''; ?>" class="form-control">
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

<!-- MODAL FACTURA-->

<div class="modal fade" id="facturaModal" tabindex="-1" aria-labelledby="facturaModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content" style="background-color: #F7F4ED;">
         <div class="modal-header">
            <h4 class="modal-title" id="facturaModalLabel">Información de Factura</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="margin-right: 20px;"></button>
         </div>
         <div class="modal-body" style="max-height: 500px; overflow-y: auto;">
            <?php foreach ($facturas as $factura) : ?>
               <div class="text-modal">
                  <div class="form-group">
                     <label for="tratamiento">Tratamiento:</label>
                     <input type="text" id="tratamiento" name="tratamiento" class="form-control" readonly>
                  </div>
                  <div class="form-group">
                     <label for="precio">Precio con IVA:</label>
                     <input type="text" id="precio" name="precio" class="form-control" value="<?php echo $factura['precio']; ?>" readonly>
                  </div>
                  <div class="form-group">
                     <label for="fecha">Fecha:</label>
                     <div class="row">
                        <div class="col">
                           <input type="text" id="dia" name="dia" class="form-control" value="<?php echo date('d', strtotime($factura['fecha'])); ?>" readonly>
                        </div>
                        <div class="col">
                           <input type="text" id="mes" name="mes" class="form-control" value="<?php echo date('m', strtotime($factura['fecha'])); ?>" readonly>
                        </div>
                        <div class="col">
                           <input type="text" id="año" name="año" class="form-control" value="<?php echo date('Y', strtotime($factura['fecha'])); ?>" readonly>
                        </div>
                     </div>
                  </div>
               </div>
            <?php endforeach; ?>
         </div>
         <div class="modal-footer" style="justify-content: space-between;">
            <button type="button" class="btn btn-citas-modal" data-bs-toggle="modal" data-bs-target="#myModal">Volver</button>
         </div>
      </div>
   </div>
</div>