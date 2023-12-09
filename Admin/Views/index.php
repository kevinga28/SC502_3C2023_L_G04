<?php
require_once '../../admin/config/global.php';
require_once '../../admin/config/conexion.php';
require_once '../Controllers/AuthController.php';


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


session_start();

$authController = new AuthController();
$rol = $authController->obtenerRolUsuario();

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
<html lang="es">

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
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="dist/css/style.css">


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


    <div class="content-wrapper">

      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Sistema Evolve</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                <li class="breadcrumb-item active">General</li>
              </ol>
            </div>
          </div>
        </div>
      </div>



      <section class="content">
        <div class="container-fluid">

          <div class="row">
            <?php
            include 'fragments/smallBox.php'
            ?>

          </div>

          <div class="row">

            <section class="col-lg-9 connectedSortable">
              <div class="row">
                <?php
                include 'fragments/estadistica.php'
                ?>
              </div>

            </section>

            <section class="col-lg-3 connectedSortable">

              <div class="card">
                <?php
                include 'fragments/listaInventario.php'
                ?>
              </div>

            </section>

            <section class="col-lg-12 connectedSortable">
              <div class="row">
                <?php
                include 'fragments/estadistica2.php'
                ?>
              </div>

            </section>


            <section class="col-lg-12 connectedSortable">

              <div class="card">
                <?php
                include 'fragments/calendarioIndex.php'
                ?>
              </div>

            </section>



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
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  <!-- SWEETALERT -->
  <script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>

  <script src="plugins/select2/js/select2.full.min.js"></script>
  <script src="logueo/js/logout.js"></script>
  <!-- ChartJS -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  
  <!-- Script 1: Gráfico de Ventas y Citas -->
  <script>
    var ctx = document.getElementById('myChart');
    var data = {
      labels: ['Productos Vendidos', 'Citas Realizadas'],
      datasets: [{
        label: 'Ventas y Citas',
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
      type: 'line',
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

  <!-- Script 2: Gráfico de Citas por Día -->
  <script>
    var labels = <?php echo json_encode($labels); ?>;
    var data = <?php echo json_encode($data); ?>;
    var ctx1 = document.getElementById('total-citas').getContext('2d');
    var myChart1 = new Chart(ctx1, {
      type: 'line',
      data: {
        labels: labels,
        datasets: [{
          label: 'Citas',
          data: data,
          fill: false,
          borderColor: 'rgb(75, 192, 192)',
          tension: 0.1
        }]
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>

  <!-- Script 3: Gráfico de Reporte de Facturas -->
  <script>
    var labels = <?php echo json_encode($labels); ?>;
    var data = <?php echo json_encode($data); ?>;
    var ctx2 = document.getElementById('reporte-ventas').getContext('2d');
    var myChart2 = new Chart(ctx2, {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [{
          label: 'Reporte de Facturas',
          data: data,
          backgroundColor: [
            'rgba(0,123,255,0.8)',
            'rgba(255,193,7,0.8)',
          ],
          borderColor: [
            'rgb(0,123,255)',
            'rgb(255,193,7)',
          ],
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>


<!-- Script 4: Gráfico de Rentabilidad de Tratamientos -->
<script>
    var labels4 = <?php echo json_encode($labels4); ?>;
    var ingresos4 = <?php echo json_encode($ingresos4); ?>;
    var citas4 = <?php echo json_encode($citas4); ?>;
    var rentabilidad4 = <?php echo json_encode($rentabilidad4); ?>;
    var ctx4 = document.getElementById('rentabilidad-tratamientos').getContext('2d');
    var myChart4 = new Chart(ctx4, {
        type: 'bar',
        data: {
            labels: labels4,
            datasets: [{
                    label: 'Ingresos',
                    data: ingresos4,
                    backgroundColor: 'rgba(75, 192, 192, 0.8)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Costos',
                    data: citas4,
                    backgroundColor: 'rgba(255, 99, 132, 0.8)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Rentabilidad',
                    data: rentabilidad4,
                    backgroundColor: 'rgba(54, 162, 235, 0.8)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

<!-- Script para el gráfico de tratamientos filtrados -->
<script>
    var labels_tratamientos_filtrados = <?php echo json_encode($labels_tratamientos_filtrados); ?>;
    var data_tratamientos_filtrados = <?php echo json_encode($data_tratamientos_filtrados); ?>;
    var ctx_tratamientos_filtrados = document.getElementById('tratamientos-vendidos-filtrados').getContext('2d');
    var myChart_tratamientos_filtrados = new Chart(ctx_tratamientos_filtrados, {
        type: 'bar',
        data: {
            labels: labels_tratamientos_filtrados,
            datasets: [{
                label: 'Tratamientos Vendidos',
                data: data_tratamientos_filtrados,
                backgroundColor: 'rgba(75, 192, 192, 0.8)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>


<!-- Script para el gráfico de productos filtrados -->
<script>
    var labels_productos = <?php echo json_encode($labels_productos); ?>;
    var data_ventas_productos = <?php echo json_encode($data_ventas_productos); ?>;
    var ctx_productos = document.getElementById('productos-vendidos').getContext('2d');
    var myChart_productos = new Chart(ctx_productos, {
        type: 'bar',
        data: {
            labels: labels_productos,
            datasets: [{
                label: 'Productos Vendidos',
                data: data_ventas_productos,
                backgroundColor: 'rgba(75, 192, 192, 0.8)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
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