

const limpiarForms = () => {
    // Selecciona el formulario y restablece su estado
    $('#modulos_verif')[0].reset();
};

$('#recuperar').on('submit', function (event) {
    event.preventDefault();
    $('#btnR').prop('disabled', true);
    var formData = new FormData($('#recuperar')[0]);
    $.ajax({
        url: '../../Controller/SessionController.php?op=recuperar',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (dataS) {
            switch (dataS) {
                case '1':
                    // Redirige a la página de actualización de contraseña
                    Swal.fire({
                        icon: 'Success',
                        title: 'Email',
                        text: 'Revisa tu correo electrónico para terminar de restablecer tu contraseña',
                    });
                    limpiarForms();
                    break;
                case '0':
                    // Manejar el caso en que el cliente no fue encontrado
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Cliente no registrado',
                    });
                    limpiarForms();
                    break;
                default:
                    // Manejar otros casos
                    console.log('Error: ' + dataS);
            }
            $('#btnR').removeAttr('disabled');
        },
    });
});





