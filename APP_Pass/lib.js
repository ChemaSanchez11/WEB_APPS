$(document).ready(async function () {

    var token = $("meta[authorization]").attr('authorization');
    let authorized = false;

    if (token.length >= 1) {
        authorized = true;
    }

    $('.btn-action').on('click', function (event) {
        // alert($(this).data('action').toLowerCase());
        var action = $(this).attr('id').toLowerCase();
        $.ajax({
            url: 'http://localhost/APP_Pass/lib/get_passwd.php?action=' + action,
            type: 'post',
            data: {token: token, platform: action},
            dataType: 'json',
            timeout: 500,     // timeout milliseconds
            success: function (data, status) {   // success callback function
                var platform = data['platform'];
                var password = data['passwd'];
                var passwd_decrypt = data['passwd_decrypt'];
                $('#close_edit').html('<button type="button" class="btn btn-warning" id="edit-pass">Editar</button>');
                $('#save_edit').html('<button type="submit" class="btn btn-success" data-bs-dismiss="modal">Cerrar</button>');



                //Mostrar Modal
                $('#modal_show').modal('show');
                $('#show-title').html('<img height=\'80px\' src="http://localhost/APP_Pass/img/' + platform + '.png">');
                $('#show-content').html('<h1 class="text-center"><span class="titulos">' + passwd_decrypt + '</span></h1>');

                //Cuaando le damos a editar
                $('#edit-pass').on('click', function () {
                    //Mostramos el input
                    $('#show-content').html('<input type="password" class="form-control" id="edit_password">');
                    //Cambiamos boton de cerrar por Guardar
                    $('#save_edit').html('<button type="submit" id="save_pass_edit" class="btn btn-success">Guardar</button>');
                    //Cambiamos el boton de editar por Cerrar
                    $('#close_edit').html('<button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>');

                    $('#save_pass_edit').on('click', function () {
                        var new_pass = $('#edit_password').val();
                        var user_edit = $('#user_edit').val();

                        $.ajax({
                            url: 'http://localhost/APP_Pass/lib/add_platform.php',
                            type: 'POST',
                            data: {update: true, pass: new_pass, user: user_edit, platform: platform},
                            //data: {platform:  formData.get('platform'), password:  formData.get('password')},
                            timeout: 500,     // timeout milliseconds
                            success: function (data, status) {   // success callback function
                                $('#show-content').html(`<div class="row text-center m-0">
                                         <div role="alert" class="alert alert-success mx-auto"> <h4>Actualizado Correctamente</h4> </div>
                                      </div>`);
                                sleep(2000).then(() => {
                                    location.reload();
                                });
                            },
                            error: function (jqXhr, textStatus, errorMessage) { // error callback
                                console.log(errorMessage);
                            }
                        });

                    });
                });
            },
            error: function (jqXhr, textStatus, errorMessage) { // error callback
                console.log(errorMessage);
            }
        });
    })

    //Añadir

    //Mostrar Modal
    $('#add_platform').on('click', function () {
        $('#modal').modal('show');
    });

    //Enviar Formulario
    const form = $('#form_platform');

    form.submit(async function (event) {

        event.preventDefault();
        var formData = new FormData(form[0]);

        $.ajax({
            url: 'http://localhost/APP_Pass/lib/add_platform.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            //data: {platform:  formData.get('platform'), password:  formData.get('password')},
            timeout: 500,     // timeout milliseconds
            success: function (data, status) {   // success callback function
                alert(status);
                $('#modal-body').html(`<div class="row text-center m-0">
                                         <div role="alert" class="alert alert-success mx-auto"> <h4>Añadido Correctamente</h4> </div>
                                      </div>`);
                sleep(3000).then(() => {
                    location.reload();
                });
            },
            error: function (jqXhr, textStatus, errorMessage) { // error callback
                console.log(errorMessage);
            }
        });
    });

});

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

