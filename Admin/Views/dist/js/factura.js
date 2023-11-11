function limpiarForms() {
    $('#factura_add').trigger('reset');
    $('#factura_update').trigger('reset');
}

/* ---------------------------------------------------------------LISTAR LAS FACTURAS--------------------------------------------------------------- */
function listarFacturas() {
    tabla = $('#tblistadoFactura').dataTable({
        aProcessing: true, //actiavmos el procesamiento de datatables
        aServerSide: true, //paginacion y filtrado del lado del serevr
        dom: 'Bfrtip', //definimos los elementos del control de tabla
        buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdf'],
        ajax: {
            url: '../../../admin/Controllers/facturaController.php?op=listaTabla',
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
            { data: "0" },  // ID de la factura
            { data: "1" },  // ID de la cita
            { data: "2" },  // Nombre
            { data: "3" },  // Apellido
            { data: "4" },  // Correo
            { data: "5" },  // Producto
            { data: "6" },  // Método de pago
            { data: "7" },  // Pago total
            {
                // Última columna con botones
                data: null,
                render: function (data, type, row) {
                    return '<a type="button" class="btn btn-danger float-right eliminar-factura" data-id="' + data[0] + '"><i class="fas fa-trash"></i> Eliminar</a>' +
                        '<a id="modificarFactura" class="editar-btn btn btn-success float-right" style="margin-right: 8px;" href="editarFactura.php?id=' + data[0] + '"><i class="fas fa-pencil-alt"></i> Editar</a>' +
                        '<a type="button" class="btn btn-primary float-right" style="margin-right: 8px;" href="verFactura.php?id=' + data[0] + '"><i class="fas fa-eye"></i> Ver</a>';
                }
            }
        ]
    });
}
$(function () {
    listarFacturas();
});


/* ---------------------------------------------------------------CREAR LAS FACTURAS--------------------------------------------------------------- */

$(document).ready(function () {
    $('#crearFactura').on('submit', function (event) {
        event.preventDefault();
        $('#btnRegistrar').prop('disabled', true);
        var formData = new FormData($('#crearFactura')[0]);
        $.ajax({
            url: '../../../admin/Controllers/facturaController.php?op=insertar',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (datos) {
                switch (datos) {
                    case '1':
                        toastr.success('Factura registrada');
                        $('#crearFactura')[0].reset();
                        tabla.api().ajax.reload();
                        break;
                    default:
                        toastr.error(datos);
                        break;
                }
                $('#btnRegistrar').removeAttr('disabled');
            }
        });
    });
});


/* ---------------------------------------------------------------BUSCAR UNA CITA --------------------------------------------------------------- */
$(document).ready(function() {
    $('#buscarCliente').click(function() {
        var busquedaCitas = $('#busquedaCitas').val();
        $.ajax({
            type: 'POST',
            url: '../../../admin/Controllers/facturaController.php?op=buscarCita',
            data: { busquedaCitas: busquedaCitas },
            dataType: 'json',
            success: function(response) {
                // Procesar la respuesta del servidor y llenar los campos del formulario
                if (response.success) {
                    var cita = response.cita; // Acceder al objeto 'cita' de la respuesta

                    $('#nombre').val(cita.nombreCliente);
                    $('#apellido').val(cita.apellidoCliente);
                    $('#correo').val(cita.correo);
                    $('#estilista').val(cita.nombreEmpleado + ' ' + cita.apellidoEmpleado);
                    $('#horaCita').val(cita.horaCita);
                    $('#fechaCita').val(cita.fechaCita);
                    
                    // No necesitas actualizar otros campos ya presentes en el formulario
                } else {
                    // Manejar el caso en el que no se encontró la cita
                    alert('Cita no encontrada');
                }
            },
            error: function(error) {
                console.log(error);
                alert('Error al buscar la cita');
            }
        });
    });
});
/* ---------------------------------------------------------------RELLANAR FORMULARIO DE FACTURA PARA EDICIÓN--------------------------------------------------------------- */

const rellenarFormularioFactura = async () => {
    const urlSearchParams = new URLSearchParams(window.location.search);
    const idFactura = urlSearchParams.get("id");

    if (idFactura) {
        try {
            const response = await fetch(`../../../admin/Controllers/facturaController.php?op=obtener&id=${idFactura}`);
            if (response.ok) {
                const datos = await response.json();

                // Rellena el formulario con los datos obtenidos
                $("#Eid").val(datos.id);
                $("#EidCita").val(datos.idCita);
                $("#EcodigoProducto").val(datos.codigoProducto);
                $("#EmetodoPago").val(datos.metodoPago);
                $("#EpagoTotal").val(datos.pagoTotal);
            } else {
                console.error("Error al obtener los datos de la factura");
            }
        } catch (error) {
            console.error("Error en la solicitud AJAX:", error);
        }
    }
};

rellenarFormularioFactura(); // Llama a la función para rellenar el formulario

/* ---------------------------------------------------------------EDITAR LOS DATOS DE LA FACTURA--------------------------------------------------------------- */
$('#factura_update').on('submit', function (event) {
    event.preventDefault();
    bootbox.confirm('¿Desea modificar los datos?', function (result) {
        if (result) {
            var formData = new FormData($('#factura_update')[0]);
            $.ajax({
                url: '../../../admin/Controllers/facturaController.php?op=editar',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (datos) {
                    switch (datos) {
                        case '1':
                            toastr.success('Factura actualizada exitosamente', 'Éxito');
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

/* ---------------------------------------------------------------ELIMINAR LA FACTURA MEDIANTE EL ID--------------------------------------------------------------- */
$(document).on('click', '.eliminar-factura', function () {
    var idFactura = $(this).data('id');

    if (idFactura !== undefined) {
        if (confirm("¿Estás seguro de que deseas eliminar esta factura?")) {
            $.ajax({
                url: '../../../admin/Controllers/facturaController.php?op=eliminar',
                method: 'POST',
                data: { op: 'eliminar', id: idFactura },
                success: function (response) {
                    if (response === '1') {
                        toastr.error("No se pudo eliminar la factura. Inténtalo de nuevo");
                    } else {
                        location.reload();
                    }
                },
                error: function (error) {
                    console.error("Error al eliminar la factura:", error);
                }
            });
        }
    }
});