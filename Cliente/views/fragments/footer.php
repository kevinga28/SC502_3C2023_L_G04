<div class="footer">
   <div class="container">
      <div class="row">
         <div class="col-lg-6 col-md-12 evolve-logo-footer ">
            <div class="col-md-7 padd_bottom">
               <div class="heading3">
                  <a href="index.php"><img src="images/logo.png" alt="#" /></a>
                  <p>
                     Evolve es un salón de belleza especializado en cuidado capilar que se destaca por ofrecer
                     una amplia gama de servicios de alta calidad.
                     Su misión es realzar la belleza natural de los clientes a través de tratamientos avanzados
                     como el botox capilar y cortes curly personalizados.
                  </p>
               </div>
            </div>
         </div>
         <div class="col-lg-6 col-md-12">
            <div class="row">
               <div class="col-md-6 offset-md-1 padd_bottom">
                  <div class="heading3">
                     <h3>Información</h3>
                     <ul class="informacion">
                        <li><a href="servicioCortes.php">Cortes de Cabello </a></li>
                        <li><a href="servicioColor.php">Color</a></li>
                        <li><a href="servicioCapilar.php">Servicios Capilares</a></li>
                        <li><a href="servicioBotox.php">Botox Capilar</a></li>
                     </ul>
                  </div>
               </div>
               <div class="col-md-5">
                  <div class="heading3">
                     <h3>Mi Cuenta</h3>
                     <ul class="informacion">

                        <?php
                        if (isset($_SESSION['usuarioCliente'])) {
                           // Usuario autenticado, muestra el formulario de logout
                           echo '<form name="logout" id="logout" method="POST" class="form-inline">
                                 <input type="hidden">
             <button name="btnlogout" type="submit"  class="btn btn-outline-secondary btn-sm" >Logout</button>
         </form>';
                        } else {
                           // Usuario no autenticado, muestra el enlace de login
                           echo '<li><a href="login/register.php">Registrarse </a></li>';
                           echo '<li><a href="login/login.php">Iniciar Sesión</a></li>';
                        }

                        ?>

                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="copyright">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <p>© 2023 Derechos Reservados. <a href="">Evolve</a></p>
            </div>
         </div>
      </div>
   </div>
</div>