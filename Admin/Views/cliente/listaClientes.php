<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Evolve</title>

  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css">


  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- TOAST-->
  <link rel="stylesheet" href="../plugins/toastr/toastr.css">
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


                <div class="card-body">
                  <div id="tabla_wrapper" class="dataTables_wrapper dt-bootstrap4">

                    <div class="row">
                      <div class="col-sm-12">
                        <table id="tbllistado" class="table table-striped table-bordered table-hover">
                          <thead>
                            <tr>
                              <th>ID</th>
                              <th>Correo</th>
                              <th>Nombre</th>
                              <th>Apellido</th>
                              <th>Telefono</th>
                              <th>Provincia</th>
                              <th>Opciones</th>
                            </tr>
                          </thead>
                        </table>
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
  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.min.js"></script>
  <!-- Datatable -->
  <script src="../plugins/DataTables/datatables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap4.min.js"></script>
  <!-- TOAST -->
  <script src="../plugins/toastr/toastr.js"></script>

  <script src="../dist/js/cliente.js"></script>

  <script src="../plugins/bootbox/bootbox.min.js"></script>



</body>


</html>