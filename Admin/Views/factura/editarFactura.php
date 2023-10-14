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

    <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">

    <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <link rel="stylesheet" href="../plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">

    <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

    <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">

    <link rel="stylesheet" href="../dist/css/adminlte.min.css?v=3.2.0">

    <link rel="stylesheet" href="../dist/css/style.css">


</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand ">
            <?php
            include '../fragments/navbar.php'
            ?>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar elevation-4 color-custom">

            <?php
            include '../fragments/aside.php'
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
                                <li class="breadcrumb-item active">Facturas</li>
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
                                            <h3 class="card-title">Editar Factura</h3>
                                        </div>
                                        <!-- EMPIEZA EL FORMULARIO -->
                                        <form method="POST" action="editar_factura.php">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="Nombre">Nombre</label>
                                                            <input type="text" class="form-control" id="Nombre" name="Nombre" placeholder="Primer Nombre">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="Apellido">Apellido</label>
                                                            <input type="text" class="form-control" id="Apellido" name="Apellido" placeholder="Apellido">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="correoCliente">Correo Electrónico</label>
                                                            <input type="email" class="form-control" id="correoCliente" name="correoCliente" placeholder="Ingresar Correo">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="Telefono">Teléfono</label>
                                                            <input type="text" class="form-control" id="Telefono" name="Telefono" placeholder="Teléfono">
                                                        </div>

                                                        <div class="form-check mb-3">
                                                            <input type="checkbox" class="form-check-input" id="EmpleadoCheck" name="EmpleadoCheck">
                                                            <label class="form-check-label" for="EmpleadoCheck">Empleado</label>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="FechaCita">Fecha de la Cita</label>
                                                            <input type="date" class="form-control" id="FechaCita" name="FechaCita">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="HoraCita">Hora de la Cita</label>
                                                            <input type="time" class="form-control" id="HoraCita" name="HoraCita">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
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

                                                        <div class="form-group">
                                                            <label for="MetodoPago">Método de Pago</label>
                                                            <select class="select2 select2-hidden-accessible" id="MetodoPago" name="MetodoPago" data-placeholder="Seleccionar Pago" data-dropdown-css-class="select2-danger" style="width: 100%;" aria-hidden="true">
                                                                <option value="Efectivo">Efectivo</option>
                                                                <option value="Tarjeta de Crédito">Tarjeta de Crédito</option>
                                                                <option value="Tarjeta de Débito">Tarjeta de Débito</option>
                                                                <option value="Transferencia Bancaria">Transferencia Bancaria</option>
                                                                <option value="Otro">Otro</option>
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="estilista">Estilista</label>
                                                            <select class="select2 select2-hidden-accessible" id="estilista" name="estilista" data-placeholder="Seleccionar Estilista" data-dropdown-css-class="select2-danger" style="width: 100%;" tabindex="1" aria-hidden="true">
                                                                <option value="Carol Mejias">Carol Mejias</option>
                                                                <option value="Marta Delgado">Marta Delgado</option>
                                                                <option value="Sofia Vargas">Sofia Vargas</option>

                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="total">Total a Pagar</label>
                                                            <input type="text" class="form-control" id="total" name="total" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 mb-4">
                                                <a href="#" class="btn btn-secondary">Volver</a>
                                                <input type="submit" value="Actualizar Facturas" class="btn float-right" style="background-color: #202126; color: #F7F4ED;">
                                            </div>
                                        </form>

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
            include '../fragments/footer.php'
            ?>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>


    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="../plugins/chart.js/Chart.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
    <!-- Page specific script -->

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
            
            //-------------
            //- BAR CHART -
            //-------------
            var barChartCanvas = $('#barChart').get(0).getContext('2d')
            var barChartData = $.extend(true, {}, areaChartData)
            var temp0 = areaChartData.datasets[0]
            var temp1 = areaChartData.datasets[1]
            barChartData.datasets[0] = temp1
            barChartData.datasets[1] = temp0

            var barChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                datasetFill: false
            }

            new Chart(barChartCanvas, {
                type: 'bar',
                data: barChartData,
                options: barChartOptions
            })
            
        })
    </script>

    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()

        })
    </script>
</body>


</html>