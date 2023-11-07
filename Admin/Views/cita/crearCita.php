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

    <link rel="stylesheet" href="../plugins/toastr/toastr.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand">
            <?php include 'fragments/navbar.php'; ?>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar elevation-4 color-custom">
            <?php include 'fragments/aside.php'; ?>
        </aside>

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Sistema de Citas</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                                <li class="breadcrumb-item active">Citas</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">


                            <!-- FORMULARIO PARA CREAR UNA CITA -->
                            <div class="card card-primary">
                                <div class="card-header" style="background-color: #F7F4ED; color: #202126;">
                                    <h3 class="card-title">Crear Cita</h3>
                                </div>
                                <!-- EMPIEZA EL FORMULARIO -->
                                <form method="POST" action="guardar_factura.php">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <label for="BusquedaCliente">Buscar Cliente</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="BusquedaCliente" name="BusquedaCliente" placeholder="Cedula Cliente">
                                                        <div class="input-group-append">
                                                            <button type="button" class="btn btn-primary" id="BuscarCliente">Buscar</button>
                                                        </div>
                                                    </div>
                                                </div>

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
                                                    <input type="date" class="form-control" id="fechaCita" name="fechaCita">
                                                </div>

                                                <div class="form-group">
                                                    <label for="horaCita">Hora de la Cita</label>
                                                    <input type="time" class="form-control" id="horaCita" name="horaCita">
                                                </div>

                                                <div class="form-group">
                                                    <label for="pagoTotal">Total a Pagar</label>
                                                    <input type="text" class="form-control" id="pagoTotal" name="pagoTotal" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <button type="submit" class="btn" style="background-color: #202126; color: #F7F4ED;">Crear Cita</button>
                                    </div>
                                </form>

                            </div>

                            </div>

                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer no-print">
            <?php
            include 'fragments/footer.php';
            ?>
        </footer>
    </div>


    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
    <!-- Datatable -->
    <script src="../plugins/DataTables/datatables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap4.min.js"></script>
    <!-- TOAST -->
    <script src="../plugins/toastr/toastr.js"></script>

    <script src="../dist/js/cita.js"></script>

    <script src="../plugins/bootbox/bootbox.min.js"></script>

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
            $('#pagototal').val('₡' + total);
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