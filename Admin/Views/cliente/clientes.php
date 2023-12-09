<?php
require_once '../../../admin/config/global.php';
require_once '../../../admin/config/conexion.php';
require_once '../../Controllers/AuthController.php';

$conexion = Conexion::conectar();
$query = $conexion->query("SELECT provincia, COUNT(*) as cantidad_clientes FROM cliente GROUP BY provincia");
$clientes = $query->fetchAll(PDO::FETCH_ASSOC);

$nombres = [];
$provincias = [];

foreach ($clientes as $cliente) {
  $nombres[] = $cliente['provincia'];
  $provincias[] = $cliente['cantidad_clientes'];
}
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

              <!-- FORMULARIO PARA CREAR UN CLIENTE -->
              <div class="row">
                <div class="col-sm-6">
                  <!-- TITULO DEL FORMULARIO -->
                  <div class="card card-primary">
                    <div class="card-header" style="background-color: #F7F4ED; color: #202126; ">
                      <h3 class="card-title">Agregar Cliente</h3>
                    </div>
                    <!-- EMPIEZA EL FORMULARIO -->
                    <form method="POST" name="modulos_add" id="crearCliente">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-6">

                            <div class="form-group">
                              <label for="Nombre">Nombre</label>
                              <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Primer Nombre" required>
                            </div>

                            <div class="form-group">
                              <label for="apellido">Apellido</label>
                              <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido" required>
                            </div>


                            <div class="form-group">
                              <label for="correo">Correo Electrónico</label>
                              <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo" required>
                            </div>

                            <div class="form-group">
                              <label for="contraseña">Contraseña</label>
                              <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Contraseña" required>
                            </div>

                            <div class="form-group">
                              <label for="telefono">Telefono</label>
                              <input type="number" class="form-control" id="telefono" name="telefono" placeholder="Telefono" required>
                            </div>

                          </div>
                          <div class=" col-md-6">


                            <div class="form-group">
                              <label for="provincia">Provincia</label>
                              <input type="text" class="form-control" id="provincia" name="provincia" placeholder="Provincia" required>
                            </div>

                            <div class="form-group">
                              <label for="distrito">Distrito</label>
                              <input type="text" class="form-control" id="distrito" name="distrito" placeholder="Distrito" required>
                            </div>

                            <div class="form-group">
                              <label for="canton">Canton</label>
                              <input type="text" class="form-control" id="canton" name="canton" placeholder="Canton" required>
                            </div>


                            <div class="form-group">
                              <label for="otros">Otros</label>
                              <input type="text" class="form-control" id="otros" name="otros" placeholder="Otras Señales" required>
                            </div>


                            <div class="form-check">
                              <input type="checkbox" class="form-check-input" value="false" id="tipoCliente" name="tipoCliente">
                              <label class="form-check-label" for="EmpleadoCheck">Empleado</label>
                            </div>

                          </div>
                        </div>
                      </div>

                      <div class="card-footer">
                        <input type="submit" class="btn" value="Agregar Cliente" id="btnRegistrar" style="background-color: #202126; color: #F7F4ED;"></input>
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
                      <div>
                        <canvas id="myChart"></canvas>
                      </div>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
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
  <!-- SWEETALERT -->
  <script src="../plugins/sweetalert2/sweetalert2.all.min.js"></script>

  <script src="../dist/js/cliente.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
      const ctx = document.getElementById('myChart');

      new Chart(ctx, {
        type: 'bar',
        data: {
          labels: <?php echo json_encode($nombres); ?>,
          datasets: [{
            label: '# of Votes',
            data: <?php echo json_encode($provincias); ?>,
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });
    </script>



</body>


</html>