<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Evolve</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">

  <link rel="stylesheet" href="dist/css/style.css">
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
              <h1>Sistema de Facturas</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                <li class="breadcrumb-item active">Facturas</li>
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
                <h5><i class="fas fa-info"></i> Note:</h5>
                This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
              </div>


              <!-- Main content -->
              <div class="invoice p-3 mb-3">
                <!-- title row -->
                <div class="row">
                  <div class="col-12">
                    <h4>
                      <i class="fas fa-globe"></i> Evolve Salon.
                      <small class="float-right">Fecha: traerla mediante php</small>
                    </h4>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                  <div class="col-sm-4 invoice-col">
                    De
                    <address>
                      <strong>Evolve Salon.</strong><br>
                      795 Folsom Ave, Suite 600<br>
                      Alajuela, Roble<br>
                      Phone: 123-5432<br>
                      Email: evolvecitas@gmail.com
                    </address>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 invoice-col">
                    Cliente
                    <address>
                      <strong>Traerlo php</strong><br>
                      Direccion<br>
                      Direccion<br>
                      Phone: 539-1037<br>
                      Email: Traerlo php
                    </address>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 invoice-col">
                    <b>Factura #007612</b><br>
                    <br>
                    <b>ID:</b> 4F3S8J<br>
                    <b>Fecha Pago:</b> 2/22/2014<br>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- Table row -->
                <div class="row">
                  <div class="col-12 table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Producto</th>
                          <th>Cantidad</th>
                          <th>Descripcion</th>
                          <th>Subtotal</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>1</td>
                          <td>Acondicionador</td>
                          <td>2</td>
                          <td>Para cabello corto </td>
                          <td>7.500</td>
                        </tr>

                      </tbody>

                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Tratamiento</th>
                          <th>Cliente</th>
                          <th>Descripcion</th>
                          <th>Subtotal</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>1</td>
                          <td>Corte Curly</td>
                          <td>Hersal Alfaro</td>
                          <td>Corte cabello corto con lavado</td>
                          <td>5.000</td>
                        </tr>

                      </tbody>
                    </table>
                    <br>
                    <table class="table table-striped">

                    </table>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->

                <div class="row">
                  <!-- accepted payments column -->
                  <div class="col-6">
                    <p class="lead">Metodos De Pago:</p>
                    <img src="dist/img/credit/visa.png" alt="Visa">
                    <img src="dist/img/credit/mastercard.png" alt="Mastercard">
                    <img src="dist/img/credit/american-express.png" alt="American Express">
                    <img src="dist/img/credit/paypal2.png" alt="Paypal">


                  </div>
                  <!-- /.col -->
                  <div class="col-6">
                    <p class="lead">Fecha Factura traer dia php</p>

                    <div class="table-responsive">
                      <table class="table">
                        <tr>
                          <th style="width:50%">Subtotal:</th>
                          <td>$12.500</td>
                        </tr>
                        <tr>
                          <th>Tax (13.0%)</th>
                          <td>$400</td>
                        </tr>
                        <tr>
                          <th>Total:</th>
                          <td>$12.900</td>
                        </tr>
                      </table>
                    </div>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- this row will not appear when printing -->
                <div class="row no-print">
                  <div class="col-12">
                    <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                      <i class="fas fa-download"></i> Generar PDF
                    </button>
                  </div>
                </div>
              </div>
              <!-- /.invoice -->
            </div><!-- /.col -->
          </div><!-- /.row -->
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

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="dist/js/demo.js"></script>
</body>

</html>