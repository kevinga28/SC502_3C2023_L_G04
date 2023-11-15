
const limpiarForms = () => {
    // Selecciona el formulario y restablece su estado
    $('#usuario_add')[0].reset();
};


$('#usuario_add').on('submit', function (event) {
    event.preventDefault();
    $('#btnRegistar').prop('disabled', true);
    var formData = new FormData($('#usuario_add')[0]);
    $.ajax({
        url: '../../Controller/UsuarioController.php?op=insertar',
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
                        text: 'Ya existe un usuario con ese correo electronico.',});
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
                        text: 'El cliente se registro exitosamente',});
                    limpiarForms();
                    window.location.href = "../index.php";
                    break;
                case '4':
                    alert('error')
                    break;

            }
            $('#btnRegistar').removeAttr('disabled');
        },
    });
});