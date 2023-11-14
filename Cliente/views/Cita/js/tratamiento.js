
/* --------------------------------------------------------------LISTA TRATAMIENTO en Cita --------------------------------------------------------------- */

$(document).ready(function () {
  $.ajax({
    url: '../../../admin/Controllers/tratamientoController.php?op=listaTratamiento',
    type: 'GET',
    dataType: 'json',
    success: function (data) {
      // Verifica si se recibieron datos
      if (data.length > 0) {
        var select = $('#tratamiento');

        select.empty();

        // Recorre los datos y agrega opciones al select
        $.each(data, function (index, tratamiento) {
          var option = $('<option>', {
            value: tratamiento.IdTratamiento, // Cambia a ID del tratamiento
            'data-precio': tratamiento.precio,
            'data-duracion': tratamiento.duracion 
          }).text(tratamiento.nombre + ' - ₡' + tratamiento.precio + ' - dur: '+ tratamiento.duracion );

          select.append(option);
        });
      } else {
        console.log('No se encontraron tratamientos.');
      }
    },
    error: function (error) {
      console.log('Error en la solicitud AJAX: ' + error.responseText);
    }
  });
});

