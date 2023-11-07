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


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Sistema Facturas</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="../index.php">Inicio</a></li>
                <li class="breadcrumb-item active">Lista Facturas</li>
              </ol>
            </div>
          </div>
        </div>
      </section>

      <section class="content">


        <div class="invoice p-3 mb-3">

          <div class="row">
            <div class="col-12">
              <h4>
                <i class="fas fa-globe"></i> Tabla Facturas
              </h4>
            </div>
          </div>

          <div class="card-body">
            <div id="tabla_wrapper" class="dataTables_wrapper dt-bootstrap4">
              <div class="row">
                <div class="col-sm-12 col-md-6">
                  <div class="dt-buttons btn-group flex-wrap">
                    <button class="btn btn-secondary buttons-copy buttons-html5" tabindex="0" aria-controls="tabla" type="button"><span>Copy</span></button>
                    <button class="btn btn-secondary buttons-excel buttons-html5" tabindex="0" aria-controls="tabla" type="button"><span>Excel</span></button>
                    <button class="btn btn-secondary buttons-pdf buttons-html5" tabindex="0" aria-controls="tabla" type="button"><span>PDF</span></button>
                    <div class="btn-group">
                      <button class="btn btn-secondary buttons-collection dropdown-toggle buttons-colvis" tabindex="0" aria-controls="tabla" type="button" aria-haspopup="true">
                        <span>Column visibility</span>
                        <span class="dt-down-arrow"></span>
                      </button>
                    </div>
                  </div>
                </div>
                <div class="col-sm-12 col-md-6 text-md-right"> <!-- Cambiado a text-md-right -->
                  <div id="tabla_filter" class="dataTables_filter">
                    <label>Buscar:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="tabla"></label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <table id="tabla" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="tabla_info">
                    <thead>
                      <tr>
                        <th class="sorting sorting_asc" tabindex="0" aria-controls="tabla" rowspan="1" colspan="1" aria-sort="ascending" aria-label="ID: activate to sort column descending">ID</th>
                        <th class="sorting" tabindex="0" aria-controls="tabla" rowspan="1" colspan="1" aria-label="Nombre: activate to sort column ascending">Nombre</th>
                        <th class="sorting" tabindex="0" aria-controls="tabla" rowspan="1" colspan="1" aria-label="Apellido: activate to sort column ascending">Apellido(s)</th>
                        <th class="sorting" tabindex="0" aria-controls="tabla" rowspan="1" colspan="1" aria-label="Tratamiento: activate to sort column ascending">Tratamiento</th>
                        <th class="sorting" tabindex="0" aria-controls="tabla" rowspan="1" colspan="1" aria-label="Pago: activate to sort column ascending">Pago</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr class="odd">
                        <td class="dtr-control sorting_1" tabindex="0">Gecko</td>
                        <td>Firefox 1.0</td>
                        <td>Win 98+ / OSX.2+</td>
                        <td>1.7</td>
                        <td>A</td>
                        <td>
                          <a type="button" class="btn btn-danger float-right" style="margin-right: 8px;" href="eliminar.php">
                            <i class="fas fa-trash"></i> Eliminar
                          </a>
                          <a type="button" class="btn btn-success float-right" style="margin-right: 8px;" href="editarFactura.php">
                            <i class="fas fa-pencil-alt"></i> Editar
                          </a>
                          <a type="button" class="btn btn-primary float-right" style="margin-right: 8px;" href="verFactura.php">
                            <i class="fas fa-eye"></i> Ver
                          </a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-5">
                  <div class="dataTables_info" id="tabla_info" role="status" aria-live="polite">PHP</div>
                </div>
                <div class="col-sm-12 col-md-7">
                  <div class="dataTables_paginate paging_simple_numbers" id="tabla_paginate">
                    <ul class="pagination">
                      <li class="paginate_button page-item previous disabled" id="tabla_previous">
                        <a href="#" aria-controls="tabla" data-dt-idx="0" tabindex="0" class="page-link">Anterior</a>
                      </li>
                      <li class="paginate_button page-item active">
                        <a href="#" aria-controls="tabla" data-dt-idx="1" tabindex="0" class="page-link">1</a>
                      </li>
                      <li class="paginate_button page-item ">
                        <a href="#" aria-controls="tabla" data-dt-idx="2" tabindex="0" class="page-link">2</a>
                      </li>
                      <li class="paginate_button page-item ">
                        <a href="#" aria-controls="tabla" data-dt-idx="3" tabindex="0" class="page-link">3</a>
                      </li>
                      <li class="paginate_button page-item ">
                        <a href="#" aria-controls="tabla" data-dt-idx="4" tabindex="0" class="page-link">4</a>
                      </li>
                      <li class="paginate_button page-item ">
                        <a href="#" aria-controls="tabla" data-dt-idx="5" tabindex="0" class="page-link">5</a>
                      </li>
                      <li class="paginate_button page-item ">
                        <a href="#" aria-controls="tabla" data-dt-idx="6" tabindex="0" class="page-link">6</a>
                      </li>
                      <li class="paginate_button page-item next" id="tabla_next">
                        <a href="#" aria-controls="tabla" data-dt-idx="7" tabindex="0" class="page-link">Siguiente</a>
                      </li>
                    </ul>
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
  <!-- Bootstrap -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- jQuery UI -->
  <script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.min.js"></script>

</body>

</html>