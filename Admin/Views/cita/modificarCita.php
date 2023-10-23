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
                            <h1>Sistema de citas</h1>
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
                                Esta pagina sera configurada con el mvc
                            </div>


                            <!-- FORMULARIO PARA CREAR UN PAGO O FACTURA -->
                            <div class="row">
                                <div class="col-sm-12">
                                    <!-- TITULO DEL FORMULARIO -->
                                    <div class="card card-primary">
                                        <div class="card-header" style="background-color: #F7F4ED; color: #202126;">
                                            <h3 class="card-title">Modificar Factura</h3>
                                        </div>
                                        <!-- EMPIEZA EL FORMULARIO -->
                                        <form method="POST" action="procesar_edicion_cita.php"
                                            onsubmit="return validateForm()">
                                            <label for="tratamiento">Tratamiento:</label>
                                            <select id="tratamiento" name="tratamiento">
                                                <option value="CorteMujer" data-precio="30">Corte Mujer - $30</option>
                                                <option value="LargoLavadoMujer" data-precio="40">Largo + Lavado Mujer -
                                                    $40</option>
                                                <option value="CortoLavadoMujer" data-precio="35">Corto + Lavado Mujer -
                                                    $35</option>
                                                <option value="LargoHombre" data-precio="25">Largo Hombre - $25</option>
                                                <option value="CortoHombre" data-precio="20">Corto Hombre - $20</option>
                                                <option value="LargoLavadoHombre" data-precio="30">Largo + Lavado Hombre
                                                    - $30 </option>
                                                <option value="CortoLavadoHombre" data-precio="25">Corto + Lavado Hombre
                                                    - $25</option>
                                                <option value="NinioNinia" data-precio="15">Niño - Niña - $15</option>

                                            </select>

                                            <div class="form-group">
                                                <label for="cedula">Cédula:</label>
                                                <input type="text" id="cedula" name="cedula" placeholder="Cédula"
                                                    value="12345678" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="nombre">Nombre:</label>
                                                <input type="text" id="nombre" name="nombre" placeholder="Primer Nombre"
                                                    value="Ejemplo de Nombre" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="telefono">Teléfono:</label>
                                                <input type="tel" id="telefono" name="telefono" placeholder="Teléfono"
                                                    value="123-456-7890" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="correo">Correo Electrónico:</label>
                                                <input type="email" id="correo" name="correo"
                                                    placeholder="Ingresar Correo" value="ejemplo@email.com" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="edad">Edad:</label>
                                                <input type="number" id="edad" name="edad" placeholder="Edad" value="30"
                                                    required>
                                            </div>

                                            <div class="form-group">
                                                <label for="provincia">Provincia:</label>
                                                <input type="text" id="provincia" name="provincia"
                                                    placeholder="Provincia" value="San José" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="canton">Cantón:</label>
                                                <input type="text" id="canton" name="canton" placeholder="Cantón"
                                                    value="San José" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="distrito">Distrito:</label>
                                                <input type="text" id="distrito" name="distrito" placeholder="Distrito"
                                                    value="Distrito 1" required>
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Actualizar</button>
                                                <button type="button" onclick="cancelEdit()"
                                                    class="btn btn-secondary">Cancelar</button>

                                            </div>
                                            <div class="col-12 mb-4">
                                                <a href="Citas.php" class="btn btn-secondary float-right">Volver</a>
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
    function validateForm() {
        const requiredFields = ["cedula", "nombre", "telefono", "correo", "edad", "provincia", "canton", "distrito"];
        for (const field of requiredFields) {
            const value = document.getElementById(field).value;
            if (!value) {
                alert("Completa este campo: " + field);
                return false;
            }
        }
        return true;
    }

    function cancelEdit() {
        alert("Edición cancelada");
    }
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