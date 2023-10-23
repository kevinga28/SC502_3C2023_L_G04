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
              <h1>Sistema de Clientes</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                <li class="breadcrumb-item active">Clientes</li>
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


              <!-- FORMULARIO PARA CREAR UN CLIENTE -->
              <div class="row">
                <div class="col-sm-6">
                  <!-- TITULO DEL FORMULARIO -->
                  <div class="card card-primary">
                    <div class="card-header" style="background-color: #F7F4ED; color: #202126; ">
                      <h3 class="card-title">Agregar Cliente</h3>
                    </div>
                    <!-- EMPIEZA EL FORMULARIO -->
                    <form method="POST" action="guardar_factura.php">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-6">

                            <div class="form-group">
                              <label for="Nombre">Nombre</label>
                              <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Primer Nombre">
                            </div>

                            <div class="form-group">
                              <label for="apellido">Apellido</label>
                              <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido">
                            </div>

                            <div class="form-group">
                              <label for="correo">Correo Electrónico</label>
                              <input type="email" class="form-control" id="correo" name="correo" placeholder="correo">
                            </div>

                            <div class="form-group">
                              <label for="contraseña">Contraseña</label>
                              <input type="password" class="form-control" id="contraseña" name="contraseña" placeholder="Contraseña">
                            </div>

                            <div class="form-group">
                              <label for="telefono">Telefono</label>
                              <input type="number" class="form-control" id="telefono" name="telefono" placeholder="Telefono">
                            </div>



                          </div>
                          <div class=" col-md-6">




                            <div class="form-group">
                              <label for="fechaCita">Provincia</label>
                              <input type="text" class="form-control" id="fechaCita" name="fechaCita" placeholder="Provincia">
                            </div>

                            <div class="form-group">
                              <label for="distrito">Distrito</label>
                              <input type="text" class="form-control" id="distrito" name="distrito" placeholder="Distrito">
                            </div>

                            <div class="form-group">
                              <label for="canton">Canton</label>
                              <input type="text" class="form-control" id="canton" name="canton" placeholder="Canton">
                            </div>


                            <div class="form-group">
                              <label for="otros">Otros</label>
                              <input type="text" class="form-control" id="otros" name="otros" placeholder="Otras Señales">
                            </div>

                            <div class="form-check">
                              <input type="checkbox" class="form-check-input" id="EmpleadoCheck">
                              <label class="form-check-label" for="EmpleadoCheck">Empleado</label>
                            </div>

                          </div>
                        </div>
                      </div>

                      <div class="card-footer">
                        <button type="submit" class="btn" style="background-color: #202126; color: #F7F4ED;">Agregar Cliente</button>
                      </div>
                    </form>

                  </div>
                </div>

                <!-- ESTADISTICAS DE LOS CLIENTES  -->
                <div class="col-sm-6">
                  <!-- GRAFICOS EN BARRA-->
                  <div class="card card-success">
                    <div class="card-header" style="background-color: #F7F4ED; color: #202126;">
                      <h3 class="card-title">Estadisticas</h3>

                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                          <i class="fas fa-times"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="chart">
                        <canvas id="barChart" style="min-height: 320px; height: 335px; max-height: 335px; max-width: 100%;"></canvas>
                      </div>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>

              </div>

              <!-- Main content -->
              <div class="invoice p-3 mb-3">
                <!-- title row -->
                <div class="row">
                  <div class="col-12">
                    <h4>
                      <i class="fas fa-globe"></i> Tabla Clientes
                    </h4>
                  </div>
                  <!-- /.col -->
                </div>

                <!-- Table row -->
                <div class="row">
                  <div class="col-12 table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Nombre</th>
                          <th>Apellido</th>
                          <th>Direccion</th>
                          <th>Correo</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>1</td>
                          <td>Hersal</td>
                          <td>Alfaro</td>
                          <td>Alajuela</td>
                          <td>prueba@hotmail.com</td>
                          <td>
                          <a type="button" class="btn btn-danger float-right" style="margin-right: 8px;" href="eliminar.php">
                        <i class="fas fa-download"></i> Eliminar
                      </a>
                      <a type="button" class="btn btn-success float-right" style="margin-right: 8px;" href="editarCliente.php">
                        <i class="fas fa-download"></i> Editar
                      </a>
                      <a type="button" class="btn btn-primary float-right" style="margin-right: 8px;" href="verCliente.php">
                        <i class="fas fa-download"></i> Ver
                      </a>
                          </td>
                        </tr>


                      </tbody>
                    </table>
                    <br>
                    <table class="table table-striped"></table>
                  </div>

                </div>

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
  <!-- ChartJS -->
  <script src="../plugins/chart.js/Chart.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.min.js"></script>


  <!-- Page specific script -->
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



</body>


</html>