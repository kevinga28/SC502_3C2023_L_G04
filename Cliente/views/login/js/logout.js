$('#logout').on('submit', function (event) {
    event.preventDefault();
    $('#btnlogout').prop('disabled', true);
    var formData = new FormData($('#logout')[0]);
    $.ajax({
        //url: 'http://localhost/Proyecto_Ambiente_Web/Cliente/Controller/InicioSesionController.php?op=login',
        url: '../Controller/SessionController.php?op=logout',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (dataS) {

            switch (dataS) {
                case '1':


                    window.location.href = "index.php";

                    break;


            }
            $('#btnlogout').removeAttr('disabled');
        },
    });
});