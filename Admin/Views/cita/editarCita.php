<?php
require_once '../../Controllers/AuthController.php';
?>

<!DOCTYPE html>
<html lang="es">

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
    <?php
    session_start();

    $rolesPermitidos = ['Admin', 'Gerente', 'Estilista'];

    if (!isset($_SESSION['rol']) || !in_array($_SESSION['rol'], $rolesPermitidos)) {
        header('Location: ../acceso_denegado.php');
        exit;
    }

    $authController = new AuthController();
    $authController->verificarAcceso(['Admin', 'Estilista', 'Gerente']);
    ?>

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
                            <div class="row">
                                <div class="col-sm-12">
                                    <!-- TITULO DEL FORMULARIO -->
                                    <div class="card card-primary">
                                        <div class="card-header" style="background-color: #F7F4ED; color: #202126; ">
                                            <h3 class="card-title">Editar Cita</h3>
                                        </div>
                                        <!-- EMPIEZA EL FORMULARIO -->
                                        <form method="POST" name="cita_update" id="cita_update">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">


                                                        <div class="form-group">
                                                            <label for="cliente">Buscar Cliente</label>
                                                            <select class="select2 select2-hidden-accessible" id="Ecliente" name="cliente" data-placeholder="Seleccionar Cliente" data-dropdown-css-class="select2-danger" style="width: 100%;" tabindex="1" aria-hidden="true" required>
                                                                <!-- Clientes cargados desde PHP se insertarán aquí automáticamente -->
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="Nombre">Nombre</label>
                                                            <input type="text" class="form-control" id="Enombre" name="nombre" placeholder="Primer Nombre" readonly>
                                                        </div>


                                                        <div class="form-group">
                                                            <label for="apellido">Apellido</label>
                                                            <input type="text" class="form-control" id="Eapellido" name="apellido" placeholder="Apellido" readonly>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="correo">Correo Electrónico</label>
                                                            <input type="email" class="form-control" id="Ecorreo" name="correo" placeholder="Correo" readonly>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="tratamiento">Tratamiento</label>
                                                            <select class="select2 select2-hidden-accessible" multiple="multiple" id="Etratamiento" name="tratamiento[]" data-placeholder="Seleccionar Tratamiento" data-dropdown-css-class="select2-danger" style="width: 100%;" tabindex="1" aria-hidden="true" required>
                                                                <!-- Tratamientos cargados desde PHP se insertarán aquí automáticamente -->
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class=" col-md-6">


                                                        <div class="form-group">
                                                            <label for="estilista">Estilista</label>
                                                            <select class="select2 select2-hidden-accessible" id="cedulaEmpleado" name="cedulaEmpleado" data-placeholder="Seleccionar Estilista" data-dropdown-css-class="select2-danger" style="width: 100%;" tabindex="1" aria-hidden="true" required>
                                                                <!-- Tratamientos cargados desde PHP se insertarán aquí automáticamente -->
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="fechaCita">Fecha de la Cita</label>
                                                            <input type="date" class="form-control" id="fechaCita" name="fechaCita" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="horaCita">Hora de la Cita</label>
                                                            <select class="form-control" id="horaCita" name="horaCita" required>
                                                                <!-- Opciones de horarios cargadas dinámicamente -->
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="duracionTotal">Duración Total</label>
                                                            <input type="time" class="form-control" id="duracionTotal" name="duracionTotal" readonly>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="pagoTotal">Total a Pagar</label>
                                                            <input type="text" class="form-control" id="EpagoTotal" name="pagoTotal" readonly value="₡0">
                                                            <input type="hidden" id="EpagoTotalHidden" name="pagoTotalHidden">
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 mb-4">
                                                <a href="historialCitas.php" class="btn btn-secondary">Volver</a>
                                                <input type="submit" value="Actualizar Cita" class="btn float-right" style="background-color: #202126; color: #F7F4ED;">
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
        <!-- /.content-wrapper -->
        <footer class="main-footer no-print">
            <?php
            include 'fragments/footer.php';
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


    <script>
        $(document).ready(function() {
            $('#Etratamiento').on('change', function() {
                var total = 0;
                // Suma los precios de los tratamientos seleccionados
                $('#Etratamiento option:selected').each(function() {
                    total += parseInt($(this).data('precio'));
                });
                // Muestra el total en el campo correspondiente
                $('#EpagoTotal').val('₡' + total);
                $('#EpagoTotalHidden').val(total);
            });
        });
    </script>

    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()
            passive: true

        })
    </script>

    <script src="../dist/js/cita.js"></script>

    <script src="../dist/js/tratamiento.js"></script>


</body>

</html>