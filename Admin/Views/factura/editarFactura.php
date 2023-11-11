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

                            <!-- FORMULARIO PARA CREAR UN PAGO O FACTURA -->
                            <div class="row">
                                <div class="col-sm-12">
                                    <!-- TITULO DEL FORMULARIO -->
                                    <div class="card card-primary">
                                        <div class="card-header" style="background-color: #F7F4ED; color: #202126;">
                                            <h3 class="card-title">Editar Factura</h3>
                                        </div>

                                        <!-- EMPIEZA EL FORMULARIO -->
                                        <form method="POST" name="" id="">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">

                                                        <div class="form-group">
                                                            <label for="busquedaCitas">Buscar Cita Del Cliente</label>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" id="busquedaCitas" name="busquedaCitas" placeholder="Citas">
                                                                <div class="input-group-append">
                                                                    <button type="button" class="btn btn-primary" id="buscarCliente">Buscar</button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="nombre">Nombre</label>
                                                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Primer Nombre" required readonly>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="apellido">Apellido</label>
                                                            <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido" required readonly>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="correo">Correo Electrónico</label>
                                                            <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo" required readonly>
                                                        </div>


                                                        <div class="form-group">
                                                            <label for="metodoPago">Método de Pago</label>
                                                            <select class="select2 select2-hidden-accessible" id="metodoPago" name="metodoPago" data-placeholder="Seleccionar Pago" data-dropdown-css-class="select2-danger" style="width: 100%;" aria-hidden="true">
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
                                                            <input type="text" class="form-control" id="estilista" name="estilista" placeholder="Estilista" readonly>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="tratamiento">Producto</label>
                                                            <select class="select2 select2-hidden-accessible" multiple="multiple" id="IdProducto" name="producto[]" data-placeholder="Buscar Producto" data-dropdown-css-class="select2-danger" style="width: 100%;" tabindex="1" aria-hidden="true" required>
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="fechaCita">Fecha de la Cita</label>
                                                            <input type="date" class="form-control" id="fechaCita" name="fechaCita" readonly>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="horaCita">Hora de la Cita</label>
                                                            <input type="time" class="form-control" id="horaCita" name="horaCita" readonly>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="total">Total a Pagar</label>
                                                            <input type="text" class="form-control" id="total" name="total" readonly>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 mb-4">
                                                <a href="listaFactura.php" class="btn btn-secondary">Volver</a>
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
            include 'fragments/footer.php'
            ?>
        </footer>

    </div>



    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
    <!-- Datatable -->
    <script src="../plugins/DataTables/datatables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap4.min.js"></script>
    <!-- SWEETALERT -->
    <script src="../plugins/sweetalert2/sweetalert2.all.min.js"></script>

    <script src="../plugins/select2/js/select2.full.min.js"></script>

    <script src="../dist/js/factura.js"></script>



    <script>
        // Captura el cambio en la selección de tratamientos
        $('#tratamiento').on('change', function() {
            var total = 0;
            // Suma los precios de los tratamientos seleccionados
            $('#tratamiento option:selected').each(function() {
                total += parseInt($(this).data('precio'));
            });
            // Muestra el total en el campo correspondiente
            $('#total').val('₡' + total);
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