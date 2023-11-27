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
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">

    <link rel="stylesheet" href="../dist/css/adminlte.min.css?v=3.2.0">

    <link rel="stylesheet" href="../dist/css/style.css">

    <!-- Incluye jQuery antes de FullCalendar -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Cambia a una versión específica de FullCalendar para evitar posibles cambios en la API -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.css" />
    <!-- Agregado el script de SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    #calendar{
        height:800px;
    }
</style>


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
                        <h1>Calendario</h1>
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



                        <!-- Main content -->
                        <div class="invoice p- mb-1">

                            <div id="calendar"></div>

                            <script>



                                document.addEventListener('DOMContentLoaded', function () {
                                    var calendarEl = document.getElementById('calendar');
                                    var calendar = new FullCalendar.Calendar(calendarEl, {
                                        headerToolbar: {
                                            left: 'prev,next today',
                                            center: 'title',
                                            right: 'dayGridMonth, timeGridWeek, timeGridDay'
                                        },
                                        events: function (fetchInfo, successCallback, failureCallback) {
                                            // Realizar la solicitud AJAX para obtener los eventos
                                            $.ajax({
                                                url: '../../Controllers/citaController.php?op=cargarCitaCalendario',
                                                method: 'GET',
                                                success: function (response) {
                                                    var eventos = JSON.parse(response);

                                                    // Verificar si hay eventos
                                                    if (eventos.length > 0) {
                                                        // Si hay eventos, llamar a successCallback con los eventos
                                                        successCallback(eventos);

                                                    } else {
                                                        // Si no hay eventos, mostrar un mensaje o hacer lo que desees
                                                        // También puedes llamar a successCallback con un array vacío
                                                        successCallback([]);
                                                    }
                                                },
                                                error: function (error) {
                                                    // Manejar el error, por ejemplo, mostrar un mensaje de error
                                                    alert('Error al cargar eventos desde el servidor');
                                                    failureCallback(error);
                                                }
                                            });
                                        },
                                        eventClick: function (info) {
                                            var cliente = info.event.title;
                                            var descripcion = info.event.extendedProps.tratamientos;
                                            var nombreEmpleado = info.event.extendedProps.nombreEmpleado;
                                            var fecha = moment(info.event.start).format('YYYY-MM-DD');
                                            var horaInicio = moment(info.event.start).format('HH:mm:ss');
                                            var horaFinal = moment(info.event.end).format('HH:mm:ss');
                                            var end = info.event.end ? moment(info.event.end).format('YYYY-MM-DD HH:mm:ss') : 'Sin fecha de fin';

                                            // Crear el contenido HTML para Swal.fire
                                            var content = '<div>' +
                                                '<strong>CITA:</strong> ' + ' ' +
                                                '<p><strong>Cliente:</strong> ' + cliente + '</p>' +
                                                '<p><strong>Estilista:</strong> ' + nombreEmpleado + '</p>' +
                                                '<p><strong>Tratamiento:</strong> ' + descripcion + '</p>' +
                                                '<p><strong>Fecha:</strong> ' + fecha + '</p>' +
                                                '<p><strong>Hora:</strong> ' + horaInicio + " - " + " " + horaFinal + '</p>' +
                                                '</div>';

                                            // Mostrar la ventana modal con la información de la cita
                                            Swal.fire({
                                                title: 'Detalles de la Cita',
                                                html: content
                                            });
                                        }
                                    });

                                    calendar.render();
                                });



                            </script>

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

<script src="../dist/js/empleado.js"></script>



</body>


</html>