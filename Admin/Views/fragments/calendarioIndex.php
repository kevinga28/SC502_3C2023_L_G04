<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        #calendar {
            height: 600px;
        }
    </style>
    <!-- Incluye jQuery antes de FullCalendar -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Cambia a una versión específica de FullCalendar para evitar posibles cambios en la API -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.css" />
    <!-- Agregado el script de SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
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
            events: {
                url: '../Controllers/citaController.php?op=cargarCitaCalendario',
                method: 'GET',
                failure: function () {
                    alert('Error al cargar eventos desde el servidor');
                }
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
                    '<strong>CITA:</strong> '  + ' ' +
                    '<p><strong>Cliente:</strong> ' + cliente + '</p>' +
                    '<p><strong>Estilista:</strong> ' + nombreEmpleado + '</p>' +
                    '<p><strong>Tratamiento:</strong> ' + descripcion + '</p>' +
                    '<p><strong>Fecha:</strong> ' + fecha + '</p>' +
                    '<p><strong>Hora:</strong> ' + horaInicio + " - "+" "+" " + horaFinal+'</p>' +


                    '</div>';

                // Mostrar la ventana modal con la información de la cita
                Swal.fire({
                    title: 'Detalles de la Cita',
                    html: content

                });
            },

        });

        calendar.render();
    });
</script>
</body>
</html>
