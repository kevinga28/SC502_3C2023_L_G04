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
                            <h1>Sistema de Clientes</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                                <li class="breadcrumb-item active">Ver Cliente</li>
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
                                            <h3 class="card-title">Ver Cliente</h3>
                                        </div>
                                        <!-- EMPIEZA EL FORMULARIO -->
                                        <form>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">

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
                                                            <label for="telefono">Telefono</label>
                                                            <input type="number" class="form-control" id="Etelefono" name="telefono" placeholder="Telefono" readonly>
                                                        </div>
                                                    </div>
                                                    <div class=" col-md-6">


                                                        <div class="form-group">
                                                            <label for="provincia">Provincia</label>
                                                            <input type="text" class="form-control" id="Eprovincia" name="provincia" placeholder="Provincia" readonly>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="distrito">Distrito</label>
                                                            <input type="text" class="form-control" id="Edistrito" name="distrito" placeholder="Distrito" readonly>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="canton">Canton</label>
                                                            <input type="text" class="form-control" id="Ecanton" name="canton" placeholder="Canton" readonly>
                                                        </div>


                                                        <div class="form-group">
                                                            <label for="otros">Otros</label>
                                                            <input type="text" class="form-control" id="Eotros" name="otros" placeholder="Otras Señales" readonly>
                                                        </div>


                                                        <div class="form-group">
                                                            <label for="Emppleado">Empleado</label>
                                                            <input type="text" class="form-control" id="EtipoCliente" name="tipoCliente" readonly>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-12 mb-4">
                                                <a href="listaClientes.php" class="btn btn-secondary">Volver</a>
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
    <!-- Datatable -->
    <script src="../plugins/DataTables/datatables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap4.min.js"></script>

    <script src="../dist/js/cliente.js"></script>



</body>


</html>