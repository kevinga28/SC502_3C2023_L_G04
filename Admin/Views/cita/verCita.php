<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Evolve</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">

    <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">

    <link rel="stylesheet" href="../dist/css/adminlte.min.css?v=3.2.0">

    <link rel="stylesheet" href="../dist/css/style.css">


</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand ">
            <?php
            include 'fragments/navbar.php'
            ?>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar elevation-4 color-custom">

            <?php
            include 'fragments/aside.php'
            ?>
        </aside>

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Sistema de Facturas</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                                <li class="breadcrumb-item active">Ver Cita</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="callout callout-info">
                                <h5><i class="fas fa-info"></i> Nota:</h5>
                                Esta pagina sera configurada con el mvc
                            </div>


                            <!-- FORMULARIO PARA CREAR UN PAGO O FACTURA -->
                            <div class="row">
                                <div class="col-sm-12">
                                    <!-- TITULO DEL FORMULARIO -->
                                    <div class="card card-primary">
                                        <div class="card-header" style="background-color: #F7F4ED; color: #202126;">
                                            <h3 class="card-title">Ver Factura</h3>
                                        </div>
                                        <!-- Para lograr ver el formulario sin poder editar desde php  -->
                                        <form method="POST" action="guardar_factura.php">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">

                                                        <div class="form-group">
                                                            <label for="Nombre">Nombre</label>
                                                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Primer Nombre" readonly>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="apellido">Apellido</label>
                                                            <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido" readonly>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="correo">Correo Electrónico</label>
                                                            <input type="email" class="form-control" id="correo" name="correo" placeholder="correo" readonly>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="tratamiento">Tratamiento</label>
                                                            <select class="select2 select2-hidden-accessible" multiple="multiple" id="tratamiento" name="tratamiento[]" data-placeholder="Seleccionar Tratamiento" data-dropdown-css-class="select2-danger" style="width: 100%;" tabindex="1" aria-hidden="true">
                                                                <option value="CorteMujer" data-precio="30">Corte Mujer - $30</option>
                                                                <option value="LargoLavadoMujer" data-precio="40">Largo + Lavado Mujer - $40</option>
                                                                <option value="CortoLavadoMujer" data-precio="35">Corto + Lavado Mujer - $35</option>
                                                                <option value="LargoHombre" data-precio="25">Largo Hombre - $25</option>
                                                                <option value="CortoHombre" data-precio="20">Corto Hombre - $20</option>
                                                                <option value="LargoLavadoHombre" data-precio="30">Largo + Lavado Hombre - $30 </option>
                                                                <option value="CortoLavadoHombre" data-precio="25">Corto + Lavado Hombre - $25</option>
                                                                <option value="NinioNinia" data-precio="15">Niño - Niña - $15</option>
                                                            </select>
                                                        </div>

                                                    </div>
                                                    <div class=" col-md-6">

                                                        <div class="form-group">
                                                            <label for="estilista">Estilista</label>
                                                            <select class="select2 select2-hidden-accessible" id="estilista" name="estilista" data-placeholder="Seleccionar Estilista" data-dropdown-css-class="select2-danger" style="width: 100%;" tabindex="1" aria-hidden="true">
                                                                <option>Carol Mejias</option>
                                                                <option>Marta Delgado</option>
                                                                <option>Sofia Vargas</option>
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="fechaCita">Fecha de la Cita</label>
                                                            <input type="date" class="form-control" id="fechaCita" name="fechaCita" readonly>
                                                        </div>

<<<<<<< HEAD
                                            <br>
                                        </div>
                                        <div class="col-12 mb-4">
                                            <a href="modificarCita.php" class="btn btn-secondary">Modificar cita</a>
                                            <a href="crearCita.php" class="btn btn-secondary">Volver</a>
                                            <input type="submit" class="btn float-right"
                                                style="background-color: #202126; color: #F7F4ED;">
                                        </div>
                                         <!-- Agrega la lógica de carga de imagen aquí si es necesario -->
=======
                                                        <div class="form-group">
                                                            <label for="horaCita">Hora de la Cita</label>
                                                            <input type="time" class="form-control" id="horaCita" name="horaCita" readonly>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="pagoTotal">Total a Pagar</label>
                                                            <input type="text" class="form-control" id="pagoTotal" name="pagoTotal" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
>>>>>>> ee9e5a670a935b397fc353d6b6f913eef78c8751
                                        </form>
                                        <div class="col-12 mb-4">
                                                <a href="historialCitas.php" class="btn btn-secondary">Volver</a>
                                            </div>

                                    </div>
                                </div>

                            </div>


                        </div>
                    </div>
                </div>
            </section>

        </div>

        <footer class="main-footer no-print">
            <?php
            include 'fragments/footer.php'
            ?>
        </footer>

    </div>

    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="../plugins/chart.js/Chart.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>


    <script src="../plugins/select2/js/select2.full.min.js"></script>

    <script>
        // Captura el cambio en la selección de tratamientos
        $('#tratamiento').on('change', function() {
            var total = 0;
            // Suma los precios de los tratamientos seleccionados
            $('#tratamiento option:selected').each(function() {
                total += parseInt($(this).data('precio'));
            });
            // Muestra el total en el campo correspondiente
            $('#total').val('$' + total);
        });
    </script>


    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()

        })
    </script>
</body>


</html>