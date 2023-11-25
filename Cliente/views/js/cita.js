/* ---------------------------------------------------------------CARGAR LOS ESTILISTAS-------------------------------------------------------------- */

function cargarEstilistas() {
    $.ajax({
      url: '../../admin/Controllers/empleadoController.php?op=cargarEstilistas',
      type: 'POST',
      dataType: 'json',
      success: function (data) {
        var selectEstilista = $('#cedulaEmpleado, #EcedulaEmpleado');
        selectEstilista.empty();
  
        if (data && data.length > 0) {
          $.each(data, function (index, estilista) {
            // Agrega una opción para cada estilista con nombre y apellido
            selectEstilista.append('<option value="' + estilista.cedula + '">' + estilista.nombre + ' ' + estilista.apellido + '</option>');
            
          });
        }
      },
      error: function () {
        console.log('Error al cargar estilistas');
      }
    });
  }
  
  cargarEstilistas();


  /* ---------------------------------------------------------------Suma de precio tratamiento-------------------------------------------------------------- */

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

  /* ---------------------------------------------------------------FUNCIONAMIENTO DE CITA PARA CREAR CITA------------------------------------------------------------- */
  $('#crearCitaVC').on('submit', function (event) {
    event.preventDefault();
    $('#btnRegistrarCita').prop('disabled', true);
    var formData = new FormData($('#crearCitaVC')[0]);
    $.ajax({
      url: '../../admin/Controllers/citaController.php?op=insertar',
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      success: function (datos) {
        switch (datos) {
          case '1':
            Swal.fire({
              icon: 'success',
              title: 'Éxito',
              text: 'Cita registrada',
            }).then((result) => {
              if (result.isConfirmed) {
                $('#crearCitaVC')[0].reset();
                tabla.api().ajax.reload();
              }
            });
            break;
          case '2':
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'No se pudieron actualizar los datos',
            });
            break;
          case '3':
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'La cita ya existe. Corrija e inténtelo nuevamente.',
            });
            break;
          default:
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: datos,
            });
            break;
        }
        $('#btnRegistrarCita').removeAttr('disabled');
      },
    });
  });

/* ---------------------------------------------------------------FUNCIONAMIENTO DE INTERVALOS CITAS-------------------------------------------------------------- */


$(document).ready(function() {
  $('#tratamiento, #Etratamiento').on('change', function() {
    calcularDuracionTotal();
  });

  $('#fechaCita, #EfechaCita').change(function () {
    obtenerHorarios();
  });

  $('#cedulaEmpleado, #EcedulaEmpleado').change(function () {
    obtenerHorarios();
  });

  function calcularDuracionTotal() {
    var duracionTotal = 0;
    $('#tratamiento option:selected,#Etratamiento option:selected').each(function() {
      var duracionComoMinutos = convertirFormatoHoraAMinutos($(this).data('duracion'));
      duracionTotal += duracionComoMinutos;
    });

    $('#duracionTotal, #EduracionTotal').val(convertirDuracionAFormatoHora(duracionTotal));
    obtenerHorarios();
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

  function obtenerHorarios() {
    var selectedDate = $('#fechaCita, #EfechaCita').val();
    var selectedDay = new Date(selectedDate).getDay();
    var cedulaEmpleado = $('#cedulaEmpleado, #EcedulaEmpleado').val();

    if (selectedDay !== null && cedulaEmpleado !== null) {
      $.ajax({
        url: '../../admin/Controllers/citaController.php?op=horariosDisponibles',
        type: 'POST',
        dataType: 'json',
        data: {
          cedulaEmpleado: cedulaEmpleado,
          diaSemana: selectedDay
        },
        success: function (data) {
          console.log('Horarios disponibles:', data);
          var duracionTotal = convertirFormatoHoraAMinutos($('#duracionTotal, #EduracionTotal').val());
          var intervalos = generarIntervalosCitasConDuracion(data, duracionTotal);
          actualizarHorariosEnSelect(intervalos);
        },
        error: function (xhr, status, error) {
          console.log('Error al obtener los horarios disponibles');
          console.log(xhr.responseText); 
        }
      });
    }
  }

  function generarIntervalosCitasConDuracion(horariosDisponibles, duracionTotal) {
    const intervalos = [];

    for (const horario of horariosDisponibles) {
      const horaInicio = convertirFormatoHoraAMinutos(horario.horaInicio);
      const horaFin = convertirFormatoHoraAMinutos(horario.horaFin);
      let tiempoActual = horaInicio;

      while (tiempoActual + duracionTotal <= horaFin) {
        const intervalo = {
          horaInicio: convertirDuracionAFormatoHora(tiempoActual),
          horaFin: convertirDuracionAFormatoHora(tiempoActual + duracionTotal)
        };
        intervalos.push(intervalo);
        tiempoActual += duracionTotal;
      }
    }
    return intervalos;
  }

  function actualizarHorariosEnSelect(intervalos) {
    var selectHorasCita = $('#horaCita, #EhoraCita');
    selectHorasCita.empty();

    intervalos.forEach(function(intervalo) {
      var optionText = intervalo.horaInicio + ' - ' + intervalo.horaFin;
      selectHorasCita.append($('<option>', {
        value: optionText,
        text: optionText
      }));
    });
  }
});