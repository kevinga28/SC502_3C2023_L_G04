
const limpiarForms = () => {
    // Selecciona el formulario y restablece su estado
    $('#usuario_add')[0].reset();
};


$('#usuario_add').on('submit', function (event) {
    event.preventDefault();
    $('#btnRegistar').prop('disabled', true);
    var formData = new FormData($('#usuario_add')[0]);
    $.ajax({
        url: '../../Controller/SessionController.php?op=insertar',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (datos) {
            switch (datos) {
                case '1':
                    Swal.fire({
                        icon: 'error',
                        title: 'Correo ya registrado',
                        text: 'Ya existe una cuenta con ese correo electronico.',
                    });
                    limpiarForms();
                    break;
                case '2':
                    Swal.fire({
                        icon: 'error',
                        title: 'Contraseña invalida',
                        text: 'la contraseña debe tener al menos 8 caracteres.',});
                    limpiarForms();
                    break;
                case '3':
                    Swal.fire({
                        icon: 'Success',
                        title: 'Registro Exitoso',
                        text: 'El cliente se registro exitosamente',
                        willClose: function () {
                            window.location.href = 'login.php';
                        },
                    });

                    limpiarForms();

                    break;


                    break;
                case '4':
                    Swal.fire({
                        icon: 'error',
                        title: 'Registro Exitoso',
                        text: 'El cliente se registro exitosamente',
                        willClose: function () {
                            window.location.href = 'login.php';
                        },
                    });

                    limpiarForms();
                    break;

            }
            $('#btnRegistar').removeAttr('disabled');
        },
    });
});