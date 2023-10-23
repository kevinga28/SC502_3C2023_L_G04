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
                                <li class="breadcrumb-item active">Ver Factura</li>
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

                            <!-- FORMULARIO PARA CREAR UN EMPLEADO -->
                            <div class="row">
                                <div class="col-sm-12">
                                    <!-- TITULO DEL FORMULARIO -->
                                    <div class="card card-primary">
                                        <div class="card-header" style="background-color: #F7F4ED; color: #202126; ">
                                            <h3 class="card-title">Agregar Empleado</h3>
                                        </div>
                                        <!-- EMPIEZA EL FORMULARIO -->
                                        <form method="POST" action="guardar_factura.php">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">

                                                        <div class="form-group">
                                                            <label for="Nombre">Nombre</label>
                                                            <input type="text" class="form-control" id="Nombre" name="Nombre" placeholder="Primer Nombre" required readonly>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="Apellido">Apellido</label>
                                                            <input type="text" class="form-control" id="Apellido" name="Apellido" placeholder="Apellido" required readonly>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="correoCliente">Correo Electrónico</label>
                                                            <input type="email" class="form-control" id="correoCliente" name="correoCliente" placeholder="Ingresar Correo" required readonly>
                                                        </div>


                                                        <div class="form-group">
                                                            <label for="MetodoPago">Método de Pago</label>
                                                            <select class="select2 select2-hidden-accessible" id="MetodoPago" name="MetodoPago" data-placeholder="Seleccionar Pago" data-dropdown-css-class="select2-danger" style="width: 100%;" aria-hidden="true">
                                                                <option>Efectivo</option>
                                                                <option>Tarjeta de Crédito</option>
                                                                <option>Tarjeta de Débito</option>
                                                                <option>Transferencia Bancaria</option>
                                                                <option>Otro</option>
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
                                                            <label for="FechaCita">Fecha de la Cita</label>
                                                            <input type="date" class="form-control" id="FechaCita" name="FechaCita" readonly>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="HoraCita">Hora de la Cita</label>
                                                            <input type="time" class="form-control" id="HoraCita" name="HoraCita" readonly>
                                                        </div>



                                                        <div class="form-group">
                                                            <label for="total">Total a Pagar</label>
                                                            <input type="text" class="form-control" id="total" name="total" readonly>
                                                        </div>


                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 mb-4">
                                                <a href="facturas.php" class="btn btn-secondary">Volver</a>
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
            include 'fragments/footer.php'
            ?>
        </footer>

    </div>

    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>

    <script src="../plugins/select2/js/select2.full.min.js"></script>

    <!-- Page specific script -->
    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()

        })
    </script>

</body>


</html>