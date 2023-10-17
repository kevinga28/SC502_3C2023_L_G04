<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Evolve</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../dist/css/style.css">
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
                            <div class="callout callout-info">
                                <h5><i class="fas fa-info"></i> Nota:</h5>
                                Esta página será configurada con el MVC.
                            </div>

                            <!-- FORMULARIO PARA CREAR UNA CITA -->
                            <div class="card card-primary">
                                <div class="card-header" style="background-color: #F7F4ED; color: #202126;">
                                    <h3 class="card-title">Crear Cita</h3>
                                </div>
                                <form>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="Cedula">Cédula de Identidad</label>
                                            <input type="number" class="form-control" name="Cedula"
                                                placeholder="Número de cédula" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="Nombre">Nombre Completo</label>
                                            <input type="text" class="form-control" name="Nombre"
                                                placeholder="Nombre completo" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="Telefono">Teléfono</label>
                                            <input type="tel" class="form-control" name="Telefono" placeholder="Teléfono"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="Email">Correo Electrónico</label>
                                            <input type="email" class="form-control" name="Email"
                                                placeholder="nombre@ejemplo.com" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="Fecha">Fecha de la Cita</label>
                                            <input type="date" class="form-control" name="Fecha" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="Edad">Edad</label>
                                            <input type="number" class="form-control" name="Edad" placeholder="Edad"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="Direccion">Dirección de Residencia</label>
                                            <input type="text" class="form-control" name="Direccion"
                                                placeholder="Dirección" required>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn"
                                            style="background-color: #202126; color: #F7F4ED;">
                                            Agendar Cita
                                        </button>


                                    </div>
                                </form>
                            </div>

                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th><input id="my-input" class="form-control" type="text" name=""></th>
                                                <th>Nombre del Cliente</th>
                                                <th>Fecha</th>
                                                <th>Hora</th>
                                                <th>Servicio</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Stephanie</td>
                                                <td>2023-10-15</td>
                                                <td>14:30</td>
                                                <td>Corte de Pelo</td>
                                                <td>
                                                    <button type="button" class="btn btn-danger">
                                                        <i class="fas fa-trash"></i> Eliminar
                                                    </button>
                                                    <button type="button" class="btn btn-success" id="editarButton">
                                                        <i class="fas fa-edit"></i> Editar
                                                    </button>
                                                    <button type="button" class="btn btn-primary"
                                                        onclick="redireccionar()">
                                                        <i class="fas fa-eye"></i> Ver
                                                    </button>
                                </div>
                            </div>

                            </button>
                            </td>
                            </tr>
                            </tbody>
                            </table>
                            <br>
                            <table class="table table-striped">
                            </table>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                    <div class="row no-print">
                        <div class="col-12">
                            <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                                <i class="fas fa-download"></i> Generar PDF
                            </button>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer no-print">
        <?php include 'fragments/footer.php'; ?>
    </footer>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="../plugins/chart.js/Chart.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>

    <!-- Page specific script -->
    <script>
    $(function() {


    });
    </script>

    <script>
    function redireccionar() {
        // Redirige a la página deseada
        window.location.href = 'http://localhost/proyecto_ambiente_web/Admin/Views/cita/verCita.php';
    }
    </script>
</body>

</html>