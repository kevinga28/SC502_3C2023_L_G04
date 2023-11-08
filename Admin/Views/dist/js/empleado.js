function limpiarForms() {
  $('#modulos_add').trigger('reset');
  $('#modulos_update').trigger('reset');
}

/* ---------------------------------------------------------------LISTAR LOS empleadoS--------------------------------------------------------------- */
function listarEmpleados() {
  tabla = $('#tblistado').dataTable({
    aProcessing: true, //actiavmos el procesamiento de datatables
    aServerSide: true, //paginacion y filtrado del lado del serevr
    dom: 'Bfrtip', //definimos los elementos del control de tabla
    buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdf'],
    ajax: {
      url: '../../../admin/Controllers/empleadoController.php?op=listaEmpleados',
      type: 'get',
      dataType: 'json',
      error: function (e) {
        console.log(e.responseText);
      },

      bDestroy: true,
      iDisplayLength: 5,

    }, language: {
      sProcessing: "Procesando...", // Mensaje de procesamiento
      sLengthMenu: "Mostrar _MENU_ registros", // Menú para seleccionar cantidad de registros por página
      sZeroRecords: "No se encontraron resultados",
      sEmptyTable: "Ningún dato disponible en esta tabla",
      sInfo: "Mostrando _START_ al _END_ de _TOTAL_ registros",
      sInfoEmpty: "Mostrando 0 al 0 de 0 registros",
      sInfoFiltered: "(filtrado de _MAX_ registros en total)",
      sInfoPostFix: "",
      sSearch: "Buscar:",
      sUrl: "",
      sInfoThousands: ",",
      sLoadingRecords: "Cargando...",
      oPaginate: {
        sFirst: "Primero",
        sLast: "Último",
        sNext: "Siguiente",
        sPrevious: "Anterior",
      },
      oAria: {
        sSortAscending: ": Activar para ordenar la columna en orden ascendente",
        sSortDescending: ": Activar para ordenar la columna en orden descendente",
      },
    },
    columns: [
      { data: "0" },  // Cedula
      { data: "1" },  // Correo
      { data: "2" },  // Nombre
      { data: "3" },  // Apellido
      { data: "4" },  // Telefono
      { data: "5" },  // Provincia
      {
        // Última columna con botones
        data: null,
        render: function (data, type, row) {
          return '<a type="button" class="btn btn-danger float-right eliminar-empleado" data-cedula="' + data[0] + '"><i class="fas fa-trash"></i> Eliminar</a>' +
     '<a id="modificarEmpleado" class="editar-btn btn btn-success float-right" style="margin-right: 8px;" href="editarEmpleado.php?cedula=' + data[0] + '"><i class="fas fa-pencil-alt"></i>Editar</a>' +
     '<a type="button" class="btn btn-primary float-right" style="margin-right: 8px;" href="verEmpleado.php?cedula=' + data[0] + '"><i class="fas fa-eye"></i>Ver</a>';
        }
      }
    ]
  });
}
$(function () {

  listarEmpleados();
});

/* ---------------------------------------------------------------CREAR LOS Empleados--------------------------------------------------------------- */

$(document).ready(function() {
  $('#crearEmpleado').on('submit', function (event) {
      event.preventDefault();
      $('#btnRegistrar').prop('disabled', true);
      var formData = new FormData($('#crearEmpleado')[0]);
      $.ajax({
          url: '../../../admin/Controllers/empleadoController.php?op=insertar',
          type: 'POST',
          data: formData,
          contentType: false,
          processData: false,
          success: function (datos) {
              switch (datos) {
                  case '1':
                      toastr.success('Empleado registrado');
                      $('#crearEmpleado')[0].reset();
                      tabla.api().ajax.reload();
                      break;
                  default:
                      toastr.error(datos); // Muestra el mensaje de error
                      break;
              }
              $('#btnRegistrar').removeAttr('disabled');
          }
      });
  });
});


const rellenarFormulario = async () => {
  const urlSearchParams = new URLSearchParams(window.location.search);
  const cedula = urlSearchParams.get("cedula");

  if (cedula) {
    try {
      const response = await fetch(`../../../admin/Controllers/empleadoController.php?op=obtener&cedula=${cedula}`);
      if (response.ok) {
        const datos = await response.json();

        // Rellena el formulario con los datos obtenidos
        $("#Ecedula").val(datos.cedula);
        $("#Eimagen").val(datos.imagen);
        $("#Egenero").val(datos.genero);
        $("#Enombre").val(datos.nombre);
        $("#Eapellido").val(datos.apellido);
        $("#Ecorreo").val(datos.correo);
        $("#Etelefono").val(datos.telefono);
        $("#Eprovincia").val(datos.provincia);
        $("#Edistrito").val(datos.distrito);
        $("#Ecanton").val(datos.canton);
        $("#Eotros").val(datos.otros);
        $("#Erol").val(datos.rol);
        
      } else {
        console.error("Error al obtener los datos del empleado");
      }
    } catch (error) {
      console.error("Error en la solicitud AJAX:", error);
    }
  }
};

rellenarFormulario(); // Llamar la funcion 

/* ---------------------------------------------------------------EDITAR LOS DATOS DEL empleado--------------------------------------------------------------- */
$('#empleado_update').on('submit', function (event) {
  event.preventDefault();
  bootbox.confirm('¿Desea modificar los datos?', function (result) {
    if (result) {
      var formData = new FormData($('#empleado_update')[0]);
      $.ajax({
        url: '../../../admin/Controllers/empleadoController.php?op=editar',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (datos) {
          switch (datos) {
            case '1':
              toastr.success('Empleado actualizado exitosamente', 'Éxito');
              break;

            case '2':
              toastr.error('Error: No se pudieron actualizar los datos');
              break;

            case '3':
              toastr.error('Error: No se pudo editar.');
              break;
          }
        },
      });
    }
  });
});



/* ---------------------------------------------------------------ELIMINAR EL empleado MEDIANTE EL ID--------------------------------------------------------------- */
$(document).on('click', '.eliminar-empleado', function() {
  var cedula = $(this).data('cedula'); // Obtiene la cédula del empleado desde el atributo de datos

  if (cedula !== undefined) {
    if (confirm("¿Estás seguro de que deseas eliminar este empleado?")) {
      // Realiza una solicitud al controlador para eliminar el empleado
      $.ajax({
        url: '../../../admin/Controllers/empleadoController.php?op=eliminar',
        method: 'POST',
        data: { op: 'eliminar', cedula: cedula },
        success: function(response) {
          if (response === '1') {
            toastr.error("No se pudo eliminar el empleado. Inténtalo de nuevo");
          } else {
            location.reload(); // Actualiza la página
          }
        },
        error: function(error) {
          console.error("Error al eliminar el empleado:", error);
        }
      });
    }
  }
});











