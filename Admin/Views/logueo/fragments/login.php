<div class="login-box">
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="../../index3.html" class="h1">
                <img src="../../../Cliente\views\images\logo.png" alt="Logo" width="300">
                <a href="../../index3.html" class="h1"><b></b></a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Sign in to start your session</p>
            <form name="modulos_verif" id="login" method="POST">
                <!-- Email input -->
                <div class="form-outline mb-4">
                    <input name="correo" type="email" id="form2Example1" class="form-control" required />
                    <label class="form-label" for="form2Example1">Email address</label>
                </div>

                <div class="form-outline mb-4">
                    <input name="contrasena" type="password" id="form2Example2" class="form-control" required />
                    <label class="form-label" for="form2Example2">
                        Contraseña
                        <span class="toggle-password" id="togglePassword"
                              onclick="togglePasswordVisibility()">&#128065;</span>
                    </label>

                </div>

                <style>
                    .toggle-password {
                        cursor: pointer;
                    }
                </style>

                <!-- 2 column grid layout for inline styling -->
                <div class="row mb-4">
                    <div class="col d-flex justify-content-center">
                        <!-- Checkbox -->
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
                            <label class="form-check-label" for="form2Example31"> Remember me </label>
                        </div>
                    </div>

                    <div class="col">
                        <!-- Simple link -->
                        <a href="#!">Forgot password?</a>

                    </div>
                </div>

                <!-- Submit button -->
                <button type="submit" id="btnlogin" class="btn btn-primary btn-block mb-4">Sign in</button>
            </form>

        </div>

    </div>

    <div/>