<?php
require_once '../../admin/config/global.php';
require_once '../../admin/config/conexion.php';

$conexion = Conexion::conectar();
// Consulta para obtener la cantidad de productos vendidos
$queryProductos = $conexion->query("SELECT COUNT(*) as cantidad FROM detalle_factura");
$resultadoProductos = $queryProductos->fetch(PDO::FETCH_ASSOC);
$cantidadProductos = $resultadoProductos['cantidad'];

// Consulta para obtener la cantidad de citas realizadas
$queryCitas = $conexion->query("SELECT COUNT(*) as cantidad FROM cita");
$resultadoCitas = $queryCitas->fetch(PDO::FETCH_ASSOC);
$cantidadCitas = $resultadoCitas['cantidad'];

?>

<?php
require_once '../Model/Empleado.php';


// Iniciar la sesión
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['cedula'])) {
    header("Location: ../views/logueo/logueo.php");
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["action"]) && $_GET["action"] == "logout") {
  // Destruir todas las variables de sesión
  $_SESSION = array();

  if (isset($_COOKIE[session_name()])) {
      setcookie(session_name(), '', time() - 42000, '/');
  }

  // Destruir la sesión
  session_destroy();

  // Redirigir a la página de inicio de sesión
  header("Location: ../views/logueo/logueo.php");
  exit();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Evolve | Inicio</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="dist/css/style.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">

</head>

<body class="hold-transition sidebar-mini layout-fixed">
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


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Sistema Evolve</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                <li class="breadcrumb-item active">General</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">

          <!-- Small boxes (CARTAS DE ESTADISTICAS GENERAL box) -->
          <div class="row">
            <?php
            include 'fragments/smallBox.php'
            ?>

          </div>
          <!-- /.row -->

          <!-- Main row -->
          <div class="row">
            <!-- COLUMNA IZQUIERDA DEL MAIN-->

            <section class="col-lg-9 connectedSortable">
              <!-- GRAFICOS DE BARRAS Y ESTADISTICAS -->
              <div class="row">
                <?php
                include 'fragments/estadistica.php'
                ?>
              </div>
              <!-- /.TERMINA EL CODIGO DE BARRAS Y ESTADISTICAS -->

            </section>
            <!-- /.Left col -->

            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-3 connectedSortable">

              <!-- LISTA DE INVENTARIO MEDIANTE PHP -->
              <div class="card">
                <?php
                include 'fragments/listaInventario.php'
                ?>
              </div>

            </section>

            <section class="col-lg-9 connectedSortable">

              <!-- CALENDARIO -->
              <div class="card">
                <?php
                include 'fragments/calendarioIndex.php'
                ?>
              </div>

            </section>


            <!-- right col -->
          </div>
          <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer no-print">
      <?php
      include 'fragments/footer.php'
      ?>
    </footer>

  </div>


  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  <!-- SWEETALERT -->
  <script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>

  <script src="plugins/select2/js/select2.full.min.js"></script>
  <script src="logueo/js/logout.js"></script>
  <!-- Custom JavaScript (main.js) -->
  <script src="dist/js/main.js"></script>
  <!-- ChartJS -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <!-- Estadistica -->
  
  <script>
    // Código Chart.js
const ctx = document.getElementById('myChart');

const data = {
    labels: ['Productos Vendidos', 'Citas Realizadas'],
    datasets: [{
        label: 'Cantidad',
        data: [<?php echo $cantidadProductos; ?>, <?php echo $cantidadCitas; ?>],
        backgroundColor: [
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 99, 132, 0.2)'
        ],
        borderColor: [
            'rgba(54, 162, 235, 1)',
            'rgba(255, 99, 132, 1)'
        ],
        borderWidth: 1
    }]
};

const config = {
    type: 'bar',
    data: data,
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
};

new Chart(ctx, config);

  </script>



</body>

</html>