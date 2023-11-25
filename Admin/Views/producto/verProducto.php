<?php
require_once '../../Controllers/AuthController.php';
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
                <li class="breadcrumb-item active">Editar Producto</li>
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
                <div class="col-sm-12">
                  <!-- TITULO DEL FORMULARIO -->
                  <div class="card card-primary">
                    <div class="card-header" style="background-color: #F7F4ED; color: #202126;">
                      <h3 class="card-title">Ver Producto</h3>
                    </div>
                    <!-- EMPIEZA EL FORMULARIO -->
                    <form>
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-6">

                            <div class="form-group">
                              <label for="nombre">Nombre</label>
                              <input type="text" class="form-control" id="Enombre" name="nombre" placeholder="Nombre" readonly>
                            </div>

                            <div class="form-group">
                              <label for="descripcion">Descripcion</label>
                              <input type="text" class="form-control" id="Edescripcion" name="descripcion" placeholder="Descripcion" readonly>
                            </div>

                            <div class="form-group">
                              <label for="cantidad">Cantidad</label>
                              <input type="text" class="form-control" id="Ecantidad" name="cantidad" placeholder="Cantidad" readonly>
                            </div>

                            <div class="form-group">
                              <label for="precio">Precio</label>
                              <input type="text" class="form-control" id="Eprecio" name="precio" placeholder="Precio" readonly>
                            </div>

                          </div>
                        </div>
                      </div>


                      <div class="col-12 mb-4">
                        <a href="productos.php" class="btn btn-secondary">Volver</a>
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

  <script src="../dist/js/producto.js"></script>



</body>


</html>