<?php
require_once '../../../admin/config/global.php';
require_once '../../../admin/config/conexion.php';
require_once '../../Controllers/AuthController.php';



$conexion = Conexion::conectar();
$query = $conexion->query("SELECT nombre, cantidad FROM producto ORDER BY cantidad DESC LIMIT 3");
$productos = $query->fetchAll(PDO::FETCH_ASSOC);

$nombres = [];
$cantidades = [];

foreach ($productos as $producto) {
  $nombres[] = $producto['nombre'];
  $cantidades[] = $producto['cantidad'];
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
                      <div>
                        <canvas id="myChart"></canvas>
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
  <!-- Productos JS -->
  <script src="../dist/js/producto.js"></script>
  <!-- ChartJS -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <!-- Estadistica -->

  <script>
    const ctx = document.getElementById('myChart');
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: <?php echo json_encode($nombres); ?>,
        datasets: [{
          label: 'Cantidad de productos',
          data: <?php echo json_encode($cantidades); ?>,
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