
$('#logout').on('submit', function (event) {
    event.preventDefault();
    $('#btnlogout').prop('disabled', true);
    var formData = new FormData($('#logout')[0]);
    $.ajax({
        //url: 'http://localhost/SC502_3C2023_L_G04/Cliente/Controller/InicioSesionController.php?op=login',
        url: '../Controllers/loginController.php?op=logout',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {

            switch (data) {
                case '1':


                    window.location.href = "./logueo/logueo.php";

                    break;


            }
            $('#btnlogout').removeAttr('disabled');
        },
    });
});