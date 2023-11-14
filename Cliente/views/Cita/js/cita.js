/* ---------------------------------------------------------------CARGAR LOS ESTILISTAS-------------------------------------------------------------- */

function cargarEstilistas() {
    $.ajax({
      url: '../../../admin/Controllers/empleadoController.php?op=cargarEstilistas',
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
          $('#pagototal').val('₡' + total);
      });
  });


  /* ---------------------------------------------------------------FUNCIONAMIENTO DE CITA PARA DURACION-------------------------------------------------------------- */

  $(document).ready(function() {
    $('#tratamiento').on('change', function() {
        var duracionTotal = 0;
        $('#tratamiento option:selected').each(function() {
            var duracionComoMinutos = convertirFormatoHoraAMinutos($(this).data('duracion'));
            duracionTotal += duracionComoMinutos;
        });
        $('#duracionTotal').val(convertirDuracionAFormatoHora(duracionTotal));
    });

    function convertirFormatoHoraAMinutos(horaEnFormatoHHMMSS) {
        var partes = horaEnFormatoHHMMSS.split(":");
        var horas = parseInt(partes[0]);
        var minutos = parseInt(partes[1]);
        var segundos = parseInt(partes[2]);
        return horas * 60 + minutos + segundos / 60;
    }

    function convertirDuracionAFormatoHora(duracionEnMinutos) {
        var horas = Math.floor(duracionEnMinutos / 60);
        var minutos = duracionEnMinutos % 60;
        return ('00' + horas).slice(-2) + ':' + ('00' + minutos).slice(-2);
    }
});
