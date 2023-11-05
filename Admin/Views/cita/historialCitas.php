<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Evolve</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
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
                            <h1>Sistema Citas</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="../index.php">Inicio</a></li>
                                <li class="breadcrumb-item active">Historial Citas</li>
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
                                <i class="fas fa-globe"></i> Tabla Citas
                            </h4>
                        </div>
                    </div>

                    <div class="card-body">
                        <div id="tabla_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="dt-buttons btn-group flex-wrap">
                                        <button class="btn btn-secondary buttons-copy buttons-html5" tabindex="0"
                                            aria-controls="tabla" type="button"><span>Copy</span></button>
                                        <button class="btn btn-secondary buttons-excel buttons-html5" tabindex="0"
                                            aria-controls="tabla" type="button"><span>Excel</span></button>
                                        <button class="btn btn-secondary buttons-pdf buttons-html5" tabindex="0"
                                            aria-controls="tabla" type="button"><span>PDF</span></button>
                                        <div class="btn-group">
                                            <button
                                                class="btn btn-secondary buttons-collection dropdown-toggle buttons-colvis"
                                                tabindex="0" aria-controls="tabla" type="button" aria-haspopup="true">
                                                <span>Column visibility</span>
                                                <span class="dt-down-arrow"></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 text-md-right">
                                    <!-- Cambiado a text-md-right -->
                                    <div id="tabla_filter" class="dataTables_filter">
                                        <label>Buscar:<input type="search" class="form-control form-control-sm"
                                                placeholder="" aria-controls="tabla"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="tabla" class="table table-bordered table-striped dataTable dtr-inline"
                                        aria-describedby="tabla_info">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nombre</th>
                                                <th>Apellido(s)</th>
                                                <th>Tratamiento</th>
                                                <th>Correo</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>John</td>
                                                <td>Doe</td>
                                                <td>Tratamiento 1</td>
                                                <td>john@example.com</td>
                                                <td>
                                                    <a type="button" class="btn btn-danger float-right"
                                                        style="margin-right: 8px;" href="verCita.php">
                                                        <i class="fas fa-eye"></i> ver
                                                    </a>
                                                    <a type="button" class="btn btn-danger float-right"
                                                        style="margin-right: 8px;" href="eliminar.php">
                                                        <i class="fas fa-trash"></i> Eliminar
                                                        <?php
                                                  // Obténer el ID del registro a eliminar desde la solicitud POST
                                                     if (isset($_POST['id'])) {
                                                          $id = $_POST['id'];

                                                // Realiza la eliminación del registro en la base de datos aquí

                                             // Verifica si la eliminación fue exitosa y devuelve una respuesta
                                                  if (/* Lógica para la eliminación exitosa */) {
                                                         echo "exito";
                                                         } else {
                                                          echo "error";
                                                          }
                                                        } else {
                                                        echo "error"; // Si no se proporciona un ID válido
                                                          }
                                                         ?>

                                                    </a>
                                                    <a type="button" class="btn btn-success float-right edit-button"
                                                        data-toggle="modal" data-target="#editarModal" data-id="1"
                                                        data-nombre="John" data-apellido="Doe"
                                                        data-tratamiento="Tratamiento 1" data-correo="john@example.com">
                                                        <i class="fas fa-pencil-alt"></i> Editar
                                                    </a>
                                                </td>
                                            </tr>
                                            <!-- Otras filas de datos aquí -->
                                        </tbody>
                                    </table>

                                    <!-- Modal de edición -->
                                    <div class="modal fade" id="editarModal" tabindex="-1" role="dialog"
                                        aria-labelledby="editarModalLabel" aria-hidden="true">
                                        <td>
                                            <a type="button" class="btn btn-danger float-right eliminar-button"
                                                style="margin-right: 8px;" data-id="1" href="eliminar.php">
                                                <i class="fas fa-trash"></i> Eliminar
                                            </a>
                                        </td>

                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editarModalLabel">Editar Cita</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Cerrar">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="editarForm">
                                                        <div class="form-group">
                                                            <label for="editarNombre">Nombre</label>
                                                            <input type="text" class="form-control" id="editarNombre"
                                                                name="editarNombre">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="editarApellido">Apellido(s)</label>
                                                            <input type="text" class="form-control" id="editarApellido"
                                                                name="editarApellido">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="editarTratamiento">Tratamiento</label>
                                                            <input type="text" class="form-control"
                                                                id="editarTratamiento" name="editarTratamiento">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="editarCorreo">Correo</label>
                                                            <input type="text" class="form-control" id="editarCorreo"
                                                                name="editarCorreo">
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Cerrar</button>
                                                    <button type="button" class="btn btn-primary"
                                                        id="guardarCambios">Guardar Cambios</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <script>
                                    $(document).ready(function() {
                                        $('.edit-button').click(function() {

                                            var id = $(this).data('id');
                                            var nombre = $(this).data('nombre');
                                            var apellido = $(this).data('apellido');
                                            var tratamiento = $(this).data('tratamiento');
                                            var correo = $(this).data('correo');

                                            $('#editarForm #editarNombre').val(nombre);
                                            $('#editarForm #editarApellido').val(apellido);
                                            $('#editarForm #editarTratamiento').val(tratamiento);
                                            $('#editarForm #editarCorreo').val(correo);
                                        });

                                        $('#guardarCambios').click(function() {

                                        });
                                    });

                                    var respuestaDelServidor = {
                                        id: 1,
                                        nombre: "NuevoNombre",
                                        apellido: "NuevoApellido",
                                        tratamiento: "NuevoTratamiento",
                                        correo: "nuevo@example.com"
                                    };

                                    // Actualiza la fila en la tabla con los nuevos datos
                                    function actualizarFilaEnTabla(data) {
                                        var id = data.id;
                                        var nombre = data.nombre;
                                        var apellido = data.apellido;
                                        var tratamiento = data.tratamiento;
                                        var correo = data.correo;

                                        // Encuentra la fila correspondiente en la tabla
                                        var fila = $('tr[data-id="' + id + '"]');

                                        // Actualiza las celdas de la fila con los nuevos datos
                                        fila.find('td:eq(1)').text(nombre);
                                        fila.find('td:eq(2)').text(apellido);
                                        fila.find('td:eq(3)').text(tratamiento);
                                        fila.find('td:eq(4)').text(correo);
                                    }

                                    // Llama a la función para actualizar la fila en la tabla después de recibir la respuesta del servidor
                                    actualizarFilaEnTabla(respuestaDelServidor);
                                    </script>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>


        </div>
        <div class="row">
            <div class="col-sm-12 col-md-5">
                <div class="dataTables_info" id="tabla_info" role="status" aria-live="polite">PHP
                </div>
            </div>
            <div class="col-sm-12 col-md-7">
                <div class="dataTables_paginate paging_simple_numbers" id="tabla_paginate">
                    <ul class="pagination">
                        <li class="paginate_button page-item previous disabled" id="tabla_previous">
                            <a href="#" aria-controls="tabla" data-dt-idx="0" tabindex="0"
                                class="page-link">Anterior</a>
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
                            <a href="#" aria-controls="tabla" data-dt-idx="7" tabindex="0"
                                class="page-link">Siguiente</a>
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


    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../plugins/jszip/jszip.min.js"></script>
    <script src="../plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>


    <script>
    $(function() {
        $("#tabla").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#tabla_wrapper .col-md-6:eq(0)');
        $('#tabla').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Asegúrate de incluir jQuery -->
    <script>
    $(document).ready(function() {
        $(".edit-button").click(function() {
            var rowId = $(this).data("nombre");
            // Obtén los detalles de la fila con el ID 'rowId' usando AJAX y colócalos en el formulario de edición
            // Por ejemplo, puedes hacer una solicitud AJAX a "obtener_detalle_cita.php?id=rowId"
            // y luego cargar los datos en los campos del formulario en el modal
        });
    });
    </script>
    <script>
    $(document).ready(function() {
        $(".edit-button").click(function() {
            // ... (Código previo para llenar el formulario)

            // Cuando se haga clic en el botón "Guardar Cambios" en el modal
            $('#guardarCambios').click(function() {
                // Obtén los valores editados desde el formulario
                var id = $('#editarForm #editarId').val();
                var nuevoNombre = $('#editarForm #editarNombre').val();
                var nuevoApellido = $('#editarForm #editarApellido').val();
                var nuevoTratamiento = $('#editarForm #editarTratamiento').val();
                var nuevoCorreo = $('#editarForm #editarCorreo').val();

                // Realiza una solicitud AJAX para actualizar los datos en el servidor
                $.ajax({
                    type: "POST",
                    url: "historialCitas.php", // Ruta al archivo PHP que maneja la actualización
                    data: {
                        id: id,
                        nuevoNombre: nuevoNombre,
                        nuevoApellido: nuevoApellido,
                        nuevoTratamiento: nuevoTratamiento,
                        nuevoCorreo: nuevoCorreo
                    },
                    success: function(response) {
                        // Comprueba si la actualización fue exitosa
                        if (response.success) {
                            // Actualiza la fila en la tabla con los nuevos datos
                            actualizarFilaEnTabla(id, nuevoNombre, nuevoApellido,
                                nuevoTratamiento, nuevoCorreo);

                            // Cierra el modal
                            $('#editarModal').modal('hide');
                        } else {
                            alert(response
                                .message
                            ); // Muestra un mensaje de error si la actualización falló
                        }
                    },
                    error: function() {
                        alert(
                            "Error en la solicitud AJAX"
                        ); // Maneja errores en la solicitud AJAX
                    }
                });
            });

            // Resto del código para llenar el formulario y actualizar la fila en la tabla
        });
    });

    // Función para actualizar la fila en la tabla con los nuevos datos
    function actualizarFilaEnTabla(id, nuevoNombre, nuevoApellido, nuevoTratamiento, nuevoCorreo) {
        var fila = $('tr[data-id="' + id + '"]');
        fila.find('td:eq(1)').text(nuevoNombre);
        fila.find('td:eq(2)').text(nuevoApellido);
        fila.find('td:eq(3)').text(nuevoTratamiento);
        fila.find('td:eq(4)').text(nuevoCorreo);
    }
    </script>




</body>

</html>