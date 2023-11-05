function limpiarForms() {
    $('#modulos_add').trigger('reset');
    $('#modulos_update').trigger('reset');
  }
  
  /* ---------------------------------------------------------------LISTAR LOS CLIENTES--------------------------------------------------------------- */
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
            return '<a type="button" class="btn btn-danger float-right eliminar-cliente" data-cedula="<?= $cedula ?>"><i class="fas fa-trash"></i> Eliminar</a>' +
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

$('#crearEmpleado').on('submit', function (event) {
    event.preventDefault();
    console.log('Formulario enviado');
    $('#btnRegistrar').prop('disabled', true);
    var formData = new FormData($('#crearEmpleado')[0]);
    console.log('Datos del formulario:', formData);
    $.ajax({
      url: '../../../admin/Controllers/empleadoController.php?op=insertar',
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      success: function (datos) {
        console.log('Respuesta del servidor:', datos);
        switch (datos) {
          case '1':
            toastr.success(
              'Empleado registrado'
            );
            $('#crearEmpleado')[0].reset();
            tabla.api().ajax.reload();
            break;
          case '2':
            toastr.error('El correo ya existe. Corrija e inténtelo nuevamente.');
            break;
          case '3':
            toastr.error('El correo ya existe. Corrija e inténtelo nuevamente.');
            break;
          default:
            toastr.error(datos);
            break;
        }
        $('#btnRegistrar').removeAttr('disabled');
      },
    });
  });