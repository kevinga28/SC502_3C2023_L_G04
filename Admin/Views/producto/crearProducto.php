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

  <link rel="stylesheet" href="../plugins/toastr/toastr.css">

  <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">

  <link rel="stylesheet" href="../dist/css/adminlte.min.css?v=3.2.0">

  <link rel="stylesheet" href="../dist/css/style.css">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.4/dist/sweetalert2.min.css">

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
              <h1>Sistema de Produtos</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                <li class="breadcrumb-item active">Productos</li>
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


              <!-- FORMULARIO PARA CREAR UN PRODUCTO -->
              <div class="row">
                <div class="col-sm-6">
                  <!-- TITULO DEL FORMULARIO -->
                  <div class="card card-primary">
                    <div class="card-header" style="background-color: #F7F4ED; color: #202126;">
                      <h3 class="card-title">Agregar Producto</h3>
                    </div>
                    <!-- EMPIEZA EL FORMULARIO -->
                    <form method="POST" name="modulos_add" id="crearProducto">
                      <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">

                              <div class="form-group">
                                <label for="Codigo">Codigo</label>
                                <input type="text" class="form-control" id="Codigo" name="Codigo" placeholder="Codigo" required>
                              </div>

                              <div class="form-group">
                                <label for="Nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required>
                              </div>

                              <div class="form-group">
                                <label for="descripcion">Descripción</label>
                                <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripción" required>
                              </div>

                              <div class="form-group">
                                <label for="cantidad">Cantidad</label>
                                <input type="number" class="form-control" id="cantidad" name="cantidad" placeholder="Cantidad" required>
                              </div>

      <!--                        <div class="form-group">
                                <label for="Categoría">Categoría</label>
                                <select class="form-control" id="Categoría">
                                  <option value="categoria0">Seleccione una categoría...</option>
                                  <option value="categoria1">Cabello</option>
                                  <option value="categoria2">Tratamientos Faciales</option>
                                  <option value="categoria3">Uñas</option>
                                </select>
                              </div>
      -->
                              <div class="form-group">
                                <label for="Precio">Precio</label>
                                <input type="text" class="form-control" id="precio" name="precio" placeholder="Precio" required>
                              </div>
                              
                          </div>
                        </div>
                      </div>
                      

                      <!-- /.card-body -->

                      <div class="card-footer">
                        <input type="submit" class="btn" value="Agregar Producto" id="btnRegistrar" style="background-color: #202126; color: #F7F4ED;"></input>
                      </div>
                    </form>

                  </div>
                </div>

                <!-- ESTADISTICAS DE LOS PRODUCTOS  -->
                <div class="col-sm-6">
                  <!-- GRAFICOS EN BARRA-->
                  <div class="card card-success">
                    <div class="card-header" style="background-color: #F7F4ED; color: #202126;">
                      <h3 class="card-title">Estadisticas Producto</h3>

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
  <!-- Datatable -->
  <script src="../plugins/DataTables/datatables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap4.min.js"></script>
  <!-- TOAST -->
  <script src="../plugins/toastr/toastr.js"></script>

  <script src="../dist/js/producto.js"></script>

  <script src="../plugins/bootbox/bootbox.min.js"></script>

  <script src="../plugins/select2/js/select2.full.min.js"></script>


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
  
  <script>
    $(function() {
      //Initialize Select2 Elements
      $('.select2').select2()

    })
  </script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.4/dist/sweetalert2.min.js"></script>

</body>


</html>