
    <div class="d-lg-flex half">
    <div class="bg order-1 order-md-2" style="background-image: url('images/bg_1.jpg');"></div>
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
              
              <div class="d-flex mb-5 align-items-center">
                <label class="control control--checkbox mb-0"><span class="caption">Recordarme</span>
                  <input type="checkbox" checked="checked"/>
                  <div class="control__indicator"></div>
                </label>
                <span class="ml-auto"><a href="#" class="forgot-pass">Restablecer Contraseña</a></span> 
              </div>

              <input type="submit" id="btnLogin"  value="Iniciar Sesion" class="btn btn-block btn-primary">

            </form>
          </div>
        </div>
      </div>
    </div>

    
  </div>