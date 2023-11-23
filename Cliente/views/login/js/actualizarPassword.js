

const limpiarForms = () => {
    // Selecciona el formulario y restablece su estado
    $('#modulos_verif')[0].reset();
};



$('#actualizarPassword').on('submit', function (event) {
    event.preventDefault();
    $('#btnR').prop('disabled', true);
    var formData = new FormData($('#actualizarPassword')[0]);
    $.ajax({
        url: '../../Controller/SessionController.php?op=actualizarPassword',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (dataS) {
            switch (dataS) {
                case '1':
                    Swal.fire({
                        icon: 'success',
                        title: 'Contraseña actualizada',
                        text: ' ',
                        willClose: function () {
                            window.location.href = 'login.php';
                        }
                    });
                    break;
                case '2':
                    Swal.fire({
                        icon: 'error',
                        title: 'Contraseña no actualizada',
                        text: ' ',
                    });
                    break;

                case '3':
                    Swal.fire({
                        icon: 'error',
                        title: 'Contraseña Invalida',
                        text: ' La contraseña debe tener al menos 8 caracteres',
                    });
                    break;
            }
            $('#btnR').removeAttr('disabled');
        },
    });
});

