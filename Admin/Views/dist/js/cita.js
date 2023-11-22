
function limpiarForms() {
  $('#cita_add').trigger('reset');
  $('#cita_update').trigger('reset');
}

/* ---------------------------------------------------------------LISTAR LOS CLIENTES--------------------------------------------------------------- */
function listarCitasTodas() {
  tabla = $('#listadoCita').dataTable({
    aProcessing: true, //actiavmos el procesamiento de datatables
    aServerSide: true, //paginacion y filtrado del lado del serevr
    dom: 'Bfrtip', //definimos los elementos del control de tabla
    buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdf'],
    ajax: {
      url: '../../../admin/Controllers/citaController.php?op=listaTabla',
      type: 'get',
      dataType: 'json',
      error: function (e) {
        console.log(e.responseText)
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
      { data: "0" },  // Idcita
      { data: "1" },  // Cliente
      { data: "2" },  // Nombre
      { data: "3" },  // Apellido
      { data: "4" },  // Estilista
      { data: "5" },  // Tratamiento
      { data: "6" },  // Fecha
      { data: "7" },  // Hora
      {
        // Última columna con botones
        data: null,
        render: function (data, type, row) {
          return '<a type="button" class="btn btn-danger float-right eliminar-cita" data-id="' + data[0] + '"><i class="fas fa-trash"></i> Eliminar</a>' +
            '<a id="modificarCliente" class="editar-btn btn btn-success float-right" style="margin-right: 8px;" href="editarCita.php?IdCita=' + data[0] + '"><i class="fas fa-pencil-alt"></i>Editar</a>' +
            '<a type="button" class="btn btn-primary float-right" style="margin-right: 8px;" href="verCita.php?IdCita=' + data[0] + '"><i class="fas fa-eye"></i>Ver</a>';
        }
      }
    ]
  });
}
$(function () {
  listarCitasTodas();
});



/* ---------------------------------------------------------------CREAR LAS CITAS--------------------------------------------------------------- */
$('#crearCita').on('submit', function (event) {
  event.preventDefault();
  $('#btnRegistrarCita').prop('disabled', true);
  var formData = new FormData($('#crearCita')[0]);
  $.ajax({
    url: '../../../admin/Controllers/citaController.php?op=insertar',
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
              $('#crearCita')[0].reset();
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

/* ---------------------------------------------------------------OBTENER LOS DATOS DEL CLIENTE--------------------------------------------------------------- */
const rellenarFormularioCita = async () => {
  const urlSearchParams = new URLSearchParams(window.location.search);
  const IdCita = urlSearchParams.get("IdCita");

  if (IdCita) {
    try {
      const response = await fetch(`../../../admin/Controllers/citaController.php?op=obtener&IdCita=${IdCita}`);
      if (response.ok) {
        const datos = await response.json();

        $("#Enombre").val(datos.nombreCliente);
        $("#Eapellido").val(datos.apellidoCliente);
        $("#Ecorreo").val(datos.correoCliente);
        $("#Eestilista").val(datos.nombreEmpleado + " " + datos.apellidoEmpleado);

        const precios = datos.tratamientos.match(/₡\d+(\.\d+)?/g);
        let total = 0;
        if (precios) {
          precios.forEach(precio => {
            const valorNumerico = parseFloat(precio.replace("₡", ""));
            total += valorNumerico;
          });
        }

        $("#EpagoTotal").val('₡' + total.toFixed(2)); // Se muestra el total
        $("#Etratamiento").val(datos.tratamientos);
        $("#EfechaCita").val(datos.fechaCita);
        $("#EhoraCita").val(datos.horaCita);
        $("#EhoraFin").val(datos.horaFin);

      } else {
        console.error("Error al obtener los datos de la cita");
      }
    } catch (error) {
      console.error("Error en la solicitud AJAX:", error);
    }
  }
};

rellenarFormularioCita();
/* ---------------------------------------------------------------EDITAR LOS DATOS DEL CLIENTE--------------------------------------------------------------- */
$('#cita_update').on('submit', function (event) {

  event.preventDefault();

  var urlParams = new URLSearchParams(window.location.search);
  var IdCita = urlParams.get('IdCita');

  Swal.fire({
    title: 'Confirmación de Modificación',
    text: '¿Desea modificar los datos de la cita?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Sí, modificar',
    cancelButtonText: 'Cancelar'
  }).then((result) => {
    if (result.isConfirmed) {
      var formData = new FormData($('#cita_update')[0]);
      formData.append('IdCita', IdCita);
      modificarCita(formData);
    }
  });
});

function modificarCita(formData) {
  $.ajax({
    url: '../../../admin/Controllers/citaController.php?op=editar',
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
            text: 'Cita actualizada exitosamente',
            showConfirmButton: false
          });
          setTimeout(function () {
            window.location.href = 'historialCitas.php'; // Redirige a la lista después de 1 segundo
          }, 1000)
          break;
        case '2':
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Error: Cambiar los datos para actualizar'
          });
          break;
        case '3':
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Error: No se pudo editar la cita.'
          });
        default:
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: datos,
          });
          break;
      }
    },
  });
}

/* ---------------------------------------------------------------ELIMINAR EL CLIENTE MEDIANTE EL ID--------------------------------------------------------------- */

// Eliminar una cita
$(document).on('click', '.eliminar-cita', function () {
  var id = $(this).data('id');
  console.log('Id de la cita: ' + id);

  Swal.fire({
    title: 'Confirmación de Eliminación',
    text: '¿Estás seguro de que deseas eliminar esta cita?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Sí, eliminar',
    cancelButtonText: 'Cancelar'
  }).then((result) => {
    if (result.isConfirmed) {
      eliminarCita(id);
    }
  });
});


function eliminarCita(id) {
  $.ajax({
    url: '../../../admin/Controllers/citaController.php?op=eliminar',
    method: 'POST',
    data: { op: 'eliminar', id: id },
    success: function (response) {
      switch (response) {
        case '1':
          Swal.fire({
            icon: 'success',
            title: 'Éxito',
            text: 'Cita eliminada exitosamente',
            showConfirmButton: false
          });
          setTimeout(function () {
            location.reload(); // Recargar la página o redirigir si es necesario
          }, 1800);
          break;
        case '2':
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Error: No se pudieron cambiar los datos antes de eliminar'
          });
          break;
        case '3':
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'No se pudo eliminar la cita. Asegúrate de que no haya facturas asociadas.'
          });
          break;
        default:
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Error inesperado. No se pudo eliminar la cita.'
          });
      }
    },
    error: function (error) {
      console.error("Error al eliminar la cita:", error);
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'No se pudo eliminar la cita. Inténtalo de nuevo'
      });
    }
  });
}



/* ---------------------------------------------------------------CARGAR LOS ESTILISTAS-------------------------------------------------------------- */

function cargarEstilistas() {
  $.ajax({
    url: '../../../admin/Controllers/empleadoController.php?op=cargarEstilistas',
    type: 'POST',
    dataType: 'json',
    success: function (data) {
      var selectEstilista = $('#cedulaEmpleado, #EcedulaEmpleado');
      selectEstilista.empty();

      selectEstilista.append('<option value="" disabled selected>Seleccionar Estilista</option>');

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

//
/* ---------------------------------------------------------------CARGAR LOS CLIENTES-------------------------------------------------------------- */

function cargarCliente() {
  $.ajax({
    url: '../../../admin/Controllers/clienteController.php?op=cargarCliente',
    type: 'POST',
    dataType: 'json',
    success: function (data) {
      var selectCliente = $('#cliente, #Ecliente');
      selectCliente.empty();

      selectCliente.append('<option value="" disabled selected>Seleccionar Cliente</option>');

      if (data && data.length > 0) {
        $.each(data, function (index, cliente) {
          // Agrega una opción para cada cliente con nombre y apellido
          selectCliente.append('<option value="' + cliente.IdCliente + '">' + cliente.nombre + ' ' + cliente.apellido + '</option>');
        });

        // Evento change para el select de clientes
        selectCliente.change(function () {
          // Obtiene el cliente seleccionado
          var selectedClienteId = $(this).val();

          // Encuentra el cliente seleccionado en el array 'data'
          var selectedCliente = data.find(function (cliente) {
            return cliente.IdCliente == selectedClienteId;
          });

          // Llena los campos con la información del cliente seleccionado
          if (selectedCliente) {
            $("#nombre, #Enombre").val(selectedCliente.nombre);
            $("#apellido, #Eapellido").val(selectedCliente.apellido);
            $("#correo, #Ecorreo").val(selectedCliente.correo);
          }
        });
      }
    },
    error: function () {
      console.log('Error al cargar clientes');
    }
  });
}

$(document).ready(function () {
  cargarCliente();
});


/* ---------------------------------------------------------------FUNCIONAMIENTO DE INTERVALOS-------------------------------------------------------------- */
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
        url: '../../../admin/Controllers/citaController.php?op=horariosDisponibles',
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