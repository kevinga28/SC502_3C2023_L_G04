<!DOCTYPE html>
<html lang="en">

<head>
<<<<<<< HEAD
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Evolve</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">

    <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">

    <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <link rel="stylesheet" href="../plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">

    <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

    <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">

    <link rel="stylesheet" href="../dist/css/adminlte.min.css?v=3.2.0">

    <link rel="stylesheet" href="../dist/css/style.css">
=======
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
>>>>>>> 1e6fbd6b3d549bdcffed4a474047ba3dd080b7ea


</head>

<body class="hold-transition sidebar-mini">
<<<<<<< HEAD
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
                            <h1>Sistema de Productos</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
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


                            <!-- FORMULARIO PARA CREAR UN PAGO O FACTURA -->
                            <div class="row">
                                <div class="col-sm-12">
                                    <!-- TITULO DEL FORMULARIO -->
                                    <div class="card card-primary">
                                        <div class="card-header" style="background-color: #F7F4ED; color: #202126;">
                                            <h3 class="card-title">Editar Producto</h3>
                                        </div>
                                        <!-- EMPIEZA EL FORMULARIO -->
                                        <form method="POST" action="editar_factura.php">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="Nombre">Nombre Producto</label>
                                                            <input type="text" class="form-control" id="Nombre" name="Nombre" placeholder="Nombre Producto">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="Apellido">Descripción Producto</label>
                                                            <input type="text" class="form-control" id="Descripción" name="Descripción" placeholder="Descripción Producto">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="correoCliente">Cantidad Producto</label>
                                                            <input type="email" class="form-control" id="Cantidad" name="Cantidad" placeholder="Cantidad Producto">
                                                        </div>

                                                        <div class="form-group">
                                                        <label for="Categoría">Categoría</label>
                                                        <select class="form-control" id="Categoría">
                                                            <option value="categoria0">Seleccione una categoría...</option>
                                                            <option value="categoria1">Cabello</option>
                                                            <option value="categoria2">Tratamientos Faciales</option>
                                                            <option value="categoria3">Uñas</option>
                                                        </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="Precio">Precio</label>
                                                            <input type="text" class="form-control" id="Precio" placeholder="Precio">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="Imagen">Imagen Referencia</label>
                                                            <input type="text" class="form-control" id="Imagen" placeholder="URL de la imagen">
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 mb-4">
                                                <a href="productos.php" class="btn btn-secondary">Volver</a>
                                                <input type="submit" value="Actualizar Producto" class="btn float-right" style="background-color: #202126; color: #F7F4ED;">
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

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>


    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="../plugins/chart.js/Chart.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
    <!-- Page specific script -->
=======
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
              <div class="callout callout-info">
                <h5><i class="fas fa-info"></i> Nota:</h5>
                Esta pagina sera configurada con el mvc
              </div>


              <!-- FORMULARIO PARA CREAR UN PRODUCTO -->
              <div class="row">
                <div class="col-sm-12">
                  <!-- TITULO DEL FORMULARIO -->
                  <div class="card card-primary">
                    <div class="card-header" style="background-color: #F7F4ED; color: #202126;">
                      <h3 class="card-title">Editar Producto</h3>
                    </div>
                    <!-- EMPIEZA EL FORMULARIO -->
                    <form method="POST" action="guardar_producto.php">
                      <div class="card-body">

                        <div class="form-group">
                          <label for="codigoProducto">Codigo</label>
                          <input type="text" class="form-control" id="Codigo" placeholder="Codigo Producto" name="codigoProducto" required>
                        </div>

                        <div class="form-group">
                          <label for="nombre">Nombre</label>
                          <input type="text" class="form-control" id="Nombre" nombre="Nombre Producto" placeholder="Nombre Producto" name="nombre" required>
                        </div>

                        <div class="form-group">
                          <label for="descripcion">Descripción</label>
                          <input type="text" class="form-control" id="descripcion" placeholder="Descripción" name="descripcion" required> 
                        </div>
                        <div class="form-group">
                          <label for="cantidad">Cantidad</label>
                          <input type="number" class="form-control" id="cantidad" placeholder="Cantidad" name="cantidad" required>
                        </div>

                        <div class="form-group">
                          <label for="precio">Precio</label>
                          <input type="text" class="form-control" id="precio" placeholder="Precio" name="precio" required>
                        </div>
                      </div>


                      <div class="col-12 mb-4">
                        <a href="productos.php" class="btn btn-secondary">Volver</a>
                        <input type="submit" value="Actualizar Producto" class="btn float-right" style="background-color: #202126; color: #F7F4ED;">
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
>>>>>>> 1e6fbd6b3d549bdcffed4a474047ba3dd080b7ea

</body>


</html>