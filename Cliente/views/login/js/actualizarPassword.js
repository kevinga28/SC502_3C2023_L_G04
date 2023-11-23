

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
                        icon: 'Success',
                        title: 'Contraseña actualizada',
                        text: ' ',
                    });
                    window.location.href = 'login.php';
                    break;
                case '2':
                    Swal.fire({
                        icon: 'error',
                        title: 'Contraseña no actualizada',
                        text: ' ',
                    });
                    break;
            }
            $('#btnR').removeAttr('disabled');
        },
    });
});
