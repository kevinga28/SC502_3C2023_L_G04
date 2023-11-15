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

    <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">

    <link rel="stylesheet" href="../dist/css/adminlte.min.css?v=3.2.0">

    <link rel="stylesheet" href="../dist/css/style.css">

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand">
            <?php include 'fragments/navbar.php'; ?>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar elevation-4 color-custom">
            <?php include 'fragments/aside.php'; ?>
        </aside>

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Sistema de Citas</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                                <li class="breadcrumb-item active">Citas</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">


                            <!-- FORMULARIO PARA CREAR UNA CITA -->
                            <div class="row">
                                <div class="col-sm-12">
                                    <!-- TITULO DEL FORMULARIO -->
                                    <div class="card card-primary">
                                        <div class="card-header" style="background-color: #F7F4ED; color: #202126; ">
                                            <h3 class="card-title">Agregar Cita</h3>
                                        </div>
                                        <!-- EMPIEZA EL FORMULARIO -->
                                        <form method="POST" name="modulos_add" id="crearCita">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">

                                                        <div class="form-group">
                                                            <label for="cliente">Buscar Cliente</label>
                                                            <select class="select2 select2-hidden-accessible" id="cliente" name="cliente" data-placeholder="Seleccionar Cliente" data-dropdown-css-class="select2-danger" style="width: 100%;" tabindex="1" aria-hidden="true" required>
                                                                <!-- Clientes cargados desde PHP se insertarán aquí automáticamente -->
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="Nombre">Nombre</label>
                                                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Primer Nombre" readonly>
                                                        </div>


                                                        <div class="form-group">
                                                            <label for="apellido">Apellido</label>
                                                            <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido" readonly>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="correo">Correo Electrónico</label>
                                                            <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo" readonly>
                                                        </div>


                                                        <div class="form-group">
                                                            <label for="tratamiento">Tratamiento</label>
                                                            <select class="select2 select2-hidden-accessible" multiple="multiple" id="tratamiento" name="tratamiento[]" data-placeholder="Seleccionar Tratamiento" data-dropdown-css-class="select2-danger" style="width: 100%;" tabindex="1" aria-hidden="true" required>
                                                                <!-- Tratamientos cargados desde PHP se insertarán aquí automáticamente -->
                                                            </select>
                                                        </div>

                                                    </div>
                                                    <div class=" col-md-6">

                                                        <div class="form-group">
                                                            <label for="estilista">Estilista</label>
                                                            <select class="select2 select2-hidden-accessible" id="cedulaEmpleado" name="cedulaEmpleado" data-placeholder="Seleccionar Estilista" data-dropdown-css-class="select2-danger" style="width: 100%;" tabindex="1" aria-hidden="true" required>
                                                                <!-- Tratamientos cargados desde PHP se insertarán aquí automáticamente -->
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="fechaCita">Fecha de la Cita</label>
                                                            <input type="date" class="form-control" id="fechaCita" name="fechaCita" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="horaCita">Hora de la Cita</label>
                                                            <select class="form-control" id="horaCita" name="horaCita" required>
                                                                <!-- Opciones de horarios cargadas dinámicamente -->
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="horaFin">Finalización Cita</label>
                                                            <select class="form-control" id="horaFin" name="horaFin" required>
                                                                <!-- Opciones de horarios cargadas dinámicamente -->
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="duracionTotal">Duración Total</label>
                                                            <input type="time" class="form-control" id="duracionTotal" name="duracionTotal" readonly>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="pagoTotal">Total a Pagar</label>
                                                            <input type="text" class="form-control" id="pagoTotal" name="pagoTotal" readonly value="₡0">
                                                            <input type="hidden" id="pagoTotalHidden" name="pagoTotalHidden">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card-footer">
                                                <input type="submit" class="btn" value="Agregar Cita" id="btnRegistrarCita" style="background-color: #202126; color: #F7F4ED;"></input>
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
        <!-- /.content-wrapper -->
        <footer class="main-footer no-print">
            <?php
            include 'fragments/footer.php';
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
        $(document).ready(function() {
            $('#tratamiento').on('change', function() {
                var total = 0;
                // Suma los precios de los tratamientos seleccionados
                $('#tratamiento option:selected').each(function() {
                    total += parseInt($(this).data('precio'));
                });
                // Muestra el total en el campo correspondiente
                $('#pagoTotal').val('₡' + total);
                $('#pagoTotalHidden').val(total);
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Manejar el evento change para el elemento #tratamiento
            $('#tratamiento').on('change', function() {
                // Calcular la duración total sumando las duraciones de los tratamientos seleccionados
                var duracionTotal = 0;
                $('#tratamiento option:selected').each(function() {
                    var duracionComoMinutos = convertirFormatoHoraAMinutos($(this).data('duracion'));
                    duracionTotal += duracionComoMinutos;
                });

                $('#duracionTotal').val(convertirDuracionAFormatoHora(duracionTotal));

                generarHorarios();
            });

            function generarHorarios() {
    var duracionTotal = convertirFormatoHoraAMinutos($('#duracionTotal').val());

    if (duracionTotal <= 0) {
        cargarHorariosSelect([]);
        return;
    }

    var horarios = [];

    // Caso especial para duración total de 60 minutos
    if (duracionTotal === 60) {
        for (var i = 10; i <= 17; i++) {
            // Excluir el intervalo de 12:00 PM a 1:00 PM
            if (i !== 12) {
                var horaInicioFormato = i + ':00' + (i < 12 ? ' AM' : ' PM');
                horarios.push(horaInicioFormato);
            }
        }
    } else {
        // Iterar sobre las horas disponibles (10 AM a 5 PM)
        for (var i = 10; i <= 17; i++) {
            // Excluir el intervalo de 12:00 PM a 1:00 PM
            if (i !== 12) {
                var minutos = 0;
                var bloquesDe60Min = Math.floor(duracionTotal / 60); // Obtener la cantidad de bloques de 60 minutos
                var minutosRestantes = duracionTotal % 60; // Obtener los minutos restantes después de los bloques de 60 minutos

                // Iterar sobre los bloques de 60 minutos
                for (var bloque = 0; bloque < bloquesDe60Min; bloque++) {
                    // Verificar que no se supere las 17:00
                    if ((i + Math.floor(minutos / 60)) < 17) {
                        var horaInicio = i + Math.floor(minutos / 60);
                        var minutosInicio = minutos % 60;

                        // Formatear la hora de inicio
                        var horaInicioFormato = horaInicio + ':' + (minutosInicio === 0 ? '00' : minutosInicio) + (i < 12 ? ' AM' : ' PM');

                        // Evitar repeticiones
                        if (!horarios.includes(horaInicioFormato)) {
                            horarios.push(horaInicioFormato);
                        }
                    }

                    minutos += 60; // Mover al siguiente bloque de 60 minutos
                }

                // Verificar si hay minutos restantes para agregar otro bloque
                if (minutosRestantes > 0 && (i + Math.floor(minutos / 60)) < 17) {
                    var horaInicioRestante = i + Math.floor(minutos / 60);
                    var minutosInicioRestante = minutos % 60;

                    // Formatear la hora de inicio del bloque restante
                    var horaInicioFormatoRestante = horaInicioRestante + ':' + (minutosInicioRestante === 0 ? '00' : minutosInicioRestante) + (i < 12 ? ' AM' : ' PM');

                    // Evitar repeticiones
                    if (!horarios.includes(horaInicioFormatoRestante)) {
                        horarios.push(horaInicioFormatoRestante);
                    }
                }
            }
        }
    }

    cargarHorariosSelect(horarios);
}

            function cargarHorariosSelect(horarios) {
                var selectHoraCita = $('#horaCita');
                selectHoraCita.empty();

                if (horarios.length > 0) {
                    horarios.forEach(function(horario) {
                        selectHoraCita.append('<option value="' + horario + '">' + horario + '</option>');
                    });
                } else {
                    selectHoraCita.append('<option value="">Selecciona al menos un tratamiento</option>');
                }
            }

            function convertirFormatoHoraAMinutos(horaEnFormatoHHMMSS) {
                var partes = horaEnFormatoHHMMSS.split(":");
                var horas = parseInt(partes[0]);
                var minutos = parseInt(partes[1]);

                if (partes.length === 3) {
                    var segundos = parseInt(partes[2]);
                    return horas * 60 + minutos + segundos / 60;
                } else {
                    return horas * 60 + minutos;
                }
            }

            function convertirDuracionAFormatoHora(duracionEnMinutos) {
                var horas = Math.floor(duracionEnMinutos / 60);
                var minutos = duracionEnMinutos % 60;
                return ('00' + horas).slice(-2) + ':' + ('00' + minutos).slice(-2);
            }
        });
    </script>

    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()
            passive: true

        })
    </script>

    <script src="../dist/js/cita.js"></script>

    <script src="../dist/js/tratamiento.js"></script>







</body>

</html>