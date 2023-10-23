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
                                        <form method="POST" action="editar_factura.php">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">

                                                        <label for="cedula">Cédula:</label>
                                                        <input type="text" id="cedula" name="cedula"
                                                            placeholder="Cédula" value="12345678">

                                                        <label for="nombre">Nombre:</label>
                                                        <input type="text" id="nombre" name="nombre"
                                                            placeholder="Primer Nombre" value="Ejemplo de Nombre">

                                                        <label for="telefono">Teléfono:</label>
                                                        <input type="tel" id="telefono" name="telefono"
                                                            placeholder="Teléfono" value="123-456-7890">

                                                        <label for="correo">Correo Electrónico:</label>
                                                        <input type="email" id="correo" name="correo"
                                                            placeholder="Ingresar Correo" value="ejemplo@email.com">

                                                        <label for="edad">Edad:</label>
                                                        <input type="number" id="edad" name="edad" placeholder="Edad"
                                                            value="30">

                                                        <label for="provincia">Provincia:</label>
                                                        <input type="text" id="provincia" name="provincia"
                                                            placeholder="Provincia" value="San José">

                                                        <label for="canton">Cantón:</label>
                                                        <input type="text" id="canton" name="canton"
                                                            placeholder="Cantón" value="San José">

                                                        <label for="distrito">Distrito:</label>
                                                        <input type="text" id="distrito" name="distrito"
                                                            placeholder="Distrito" value="Distrito 1">

                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="col-12 mb-4">
                                        <a href="#" class="btn btn-secondary">Volver</a>
                                        <input type="submit" value="Actualizar Facturas" class="btn float-right"
                                            style="background-color: #202126; color: #F7F4ED;">
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
        // Validación básica para campos obligatorios
        const tratamiento = document.getElementById("tratamiento").value;
        const cedula = document.getElementById("cedula").value;
        const nombre = document.getElementById("nombre").value;
        const telefono = document.getElementById("telefono").value;
        const correo = document.getElementById("correo").value;

        if (!tratamiento || !cedula || !nombre || !telefono || !correo) {
            alert("Completa todos los campos obligatorios.");
            return false;
        }

        return true;
    }

    function cancelEdit() {
        // Implementa aquí la acción para cancelar la edición (puede ser una redirección o cualquier otra acción).
        alert("Edición cancelada");
    }

    document.getElementById("volverButton").addEventListener("click", function() {
        window.location.href = "http://localhost/proyecto_ambiente_web/Admin/Views/cita/verCita.php#"; // Reemplaza "tu_pagina_de_destino.html" con la URL deseada.
    });
    </script>

</body>


</html>