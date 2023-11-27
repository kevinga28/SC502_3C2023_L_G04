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

    // Verifica si el rol está establecido en la sesión
    if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'Admin') {
        // Si el rol no es el adecuado, redirecciona o muestra un mensaje de acceso denegado
        header('Location: ../acceso_denegado.php');
        exit;
    }

    $authController = new AuthController();
    $authController->verificarAcceso(['Admin']);
    ?>


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
                            <h1>Sistema de Empleados</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                                <li class="breadcrumb-item active">Empleados</li>
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
                                            <h3 class="card-title">Editar Empleado</h3>
                                        </div>
                                        <!-- EMPIEZA EL FORMULARIO -->
                                        <form method="POST" name="empleado_update" id="empleado_update">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="Nombre">Cedula</label>
                                                            <input type="text" class="form-control" id="Ecedula" name="cedula" placeholder="Cedula" readonly>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="Nombre">Nombre</label>
                                                            <input type="text" class="form-control" id="Enombre" name="nombre" placeholder="Primer Nombre" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="apellido">Apellido</label>
                                                            <input type="text" class="form-control" id="Eapellido" name="apellido" placeholder="Apellido" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="correo">Correo Electrónico</label>
                                                            <input type="email" class="form-control" id="Ecorreo" name="correo" placeholder="Correo" readonly>
                                                        </div>


                                                        <div class="form-group">
                                                            <label for="telefono">Telefono</label>
                                                            <input type="number" class="form-control" id="Etelefono" name="telefono" placeholder="Telefono" required>
                                                        </div>


                                                    </div>
                                                    <div class=" col-md-6">


                                                        <div class="form-group">
                                                            <label for="fechaCita">Provincia</label>
                                                            <input type="text" class="form-control" id="Eprovincia" name="provincia" placeholder="Provincia" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="distrito">Distrito</label>
                                                            <input type="text" class="form-control" id="Edistrito" name="distrito" placeholder="Distrito" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="canton">Canton</label>
                                                            <input type="text" class="form-control" id="Ecanton" name="canton" placeholder="Canton" required>
                                                        </div>


                                                        <div class="form-group">
                                                            <label for="otros">Otros</label>
                                                            <input type="text" class="form-control" id="Eotros" name="otros" placeholder="Otras Señales" required>
                                                        </div>



                                                        <div class="form-group">
                                                            <label for="genero">Genero</label>
                                                            <input type="text" class="form-control" id="Egenero" name="genero" placeholder="Genero" readonly>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="rol">Rol</label>
                                                            <select class="select2 select2-hidden-accessible" id="Erol" name="rol" data-placeholder="Seleccionar Rol" data-dropdown-css-class="select2-danger" style="width: 100%;" tabindex="1" aria-hidden="true">
                                                                <option>Gerente</option>
                                                                <option>Estilista</option>
                                                                <option>Admin</option>
                                                            </select>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 mb-4">
                                                <a href="listaEmpleado.php" class="btn btn-secondary">Volver</a>
                                                <input type="submit" value="Actualizar Empleado" class="btn float-right" style="background-color: #202126; color: #F7F4ED;">
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

    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()

        })
    </script>

    <script src="../dist/js/empleado.js"></script>

</body>


</html>