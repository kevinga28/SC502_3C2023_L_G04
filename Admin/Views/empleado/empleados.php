<?php
require_once '../../../admin/config/global.php';
require_once '../../../admin/config/conexion.php';
require_once '../../Controllers/AuthController.php';



$conexion = Conexion::conectar();
$query = $conexion->query("SELECT rol, COUNT(*) as cantidad_empleados FROM empleado GROUP BY rol");
$empleados = $query->fetchAll(PDO::FETCH_ASSOC);

$nombres = [];
$roles = [];

foreach ($empleados as $empleado) {
  $nombres[] = $empleado['rol'];
  $roles[] = $empleado['cantidad_empleados'];
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

  <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">

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
              <h1>Sistema de Empleados</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                <li class="breadcrumb-item active">Empleados</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">

              <!-- FORMULARIO PARA CREAR UN EMPLEADO -->
              <div class="row">
                <div class="col-sm-6">
                  <!-- TITULO DEL FORMULARIO -->
                  <div class="card card-primary">
                    <div class="card-header" style="background-color: #F7F4ED; color: #202126; ">
                      <h3 class="card-title">Agregar Empleado</h3>
                    </div>
                    <!-- EMPIEZA EL FORMULARIO -->
                    <form method="POST" name="modulos_add" id="crearEmpleado">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-6">

                            <div class="form-group">
                              <label for="Nombre">Cedula</label>
                              <input type="text" class="form-control" id="cedula" name="cedula" placeholder="Cedula" required>
                            </div>

                            <div class="form-group">
                              <label for="imagen">Imagen</label>
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" id="imagen" name="imagen" accept="image/*" required>
                                <label class="custom-file-label" for="imagen" data-browse="Elegir archivo">Seleccionar archivo</label>
                              </div>
                            </div>

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
                              <label for="Contraseña">Contraseña</label>
                              <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Contraseña" required>
                            </div>

                            <div class="form-group">
                              <label for="telefono">Telefono</label>
                              <input type="number" class="form-control" id="telefono" name="telefono" placeholder="Telefono" required>
                            </div>


                          </div>
                          <div class=" col-md-6">

                            <div class="form-group">
                              <label for="fechaCita">Provincia</label>
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


                            <div class="form-group">
                              <label for="rol">genero</label>
                              <select class="select2 select2-hidden-accessible" id="genero" name="genero" data-placeholder="Seleccionar genero" data-dropdown-css-class="select2-danger" style="width: 100%;" tabindex="1" aria-hidden="true">
                                <option>Masculino</option>
                                <option>Femenino</option>
                              </select>
                            </div>

                            <div class="form-group">
                              <label for="rol">Rol</label>
                              <select class="select2 select2-hidden-accessible" id="rol" name="rol" data-placeholder="Seleccionar Rol" data-dropdown-css-class="select2-danger" style="width: 100%;" tabindex="1" aria-hidden="true">
                                <option>Gerente</option>
                                <option>Estilista</option>
                                <option>Admin</option>
                              </select>
                            </div>

                          </div>
                        </div>
                      </div>

                      <div class="card-footer">
                        <input type="submit" class="btn" value="Agregar Empleado" id="btnRegistrar" style="background-color: #202126; color: #F7F4ED;"></input>
                      </div>
                    </form>

                  </div>
                </div>

                <!-- ESTADISTICAS DE LOS EMPLEADOS  -->
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

  <script src="../plugins/select2/js/select2.full.min.js"></script>


  <script>
    $(function() {
      //Initialize Select2 Elements
      $('.select2').select2()

    })
  </script>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script>
    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: <?php echo json_encode($nombres); ?>,
        datasets: [{
          label: 'Rol de Empleados',
          data: <?php echo json_encode($roles); ?>,
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
<script>
    document.getElementById('imagen').addEventListener('change', function () {
        var fileName = document.getElementById('imagen').files[0].name;
        var nextSibling = document.querySelector('.custom-file-label');
        nextSibling.innerText = fileName;
    });
</script>
  <script src="../dist/js/empleado.js"></script>

</body>


</html>