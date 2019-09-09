$('.showModal').click(function () {
    $('#idModal').modal('show');
    $.ajax({
        url: "ver-admin/{id}",
        method: "GET",
        data: {id: $(this).data('id-user')},
        success: function (response) {
            $('#id-p').text(response.id);
            $('#cedula-p').text(response.cedula_p);
            $('#nom-p').text(response.nombres);
            $('#tel-p').text(response.telefono_p);
            $('#dir-p').text(response.direccion_p);
            $('#tipo-p').text(response.tipo_p);
            $('#estado-p').text(response.estado_p);
            $('#name-p').text(response.name);
            $('#email-p').text(response.email);

        }

    });

});
$('.deleteModal').click(function () {
    var estado = $(this).data('estado-user');
    if (estado == 0) {
        $('.modal-title').text('Habilitar usuario');
    } else {
        $('.modal-title').text('Inhabilitar usuario');
    }
    var status = $(this).data('estado-actual');
    if (status != 'activo') {
        $('#estado-actua-user').removeClass('btn-success');
        $('#estado-actua-user').addClass('btn-deep-orange');
    } else {
        $('#estado-actua-user').removeClass('btn-deep-orange');
        $('#estado-actua-user').addClass('btn-success');
    }
    $('#idModalEliminacion').modal('show');
    $('#id-user-edit').val($(this).data('id-user'));
    $('#estado-user-edit').val($(this).data('estado-user'));
    $('#estado-actua-user').text($(this).data('estado-actual'));
    $('#ci-usuario').text($(this).data('cedula-actual'));
});

$('.actionBtn').click(function () {
    // alert($('#id-user-edit').val());
    //alert($('#estado-user-edit').val());
    var id_user = $('#id-user-edit').val();
    var url = "estado-admin";
    $.ajax({
        type: "put",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url,//"estado-admin/" + $(this).data('id-user') + "/",
        data: {
            id: id_user,
            _token: "{{csrf_token()}}",
            _method: "PUT",
        },
        success: function (data) {

            $('#sectionRefresh').empty().append($(data)); //se toma la data en formato json, luego se borra el Div padre de el Sections y se pinta el json (data) como htlm
        },
        error: function (data) {
            var errors = data.responseJSON;
            if (errors) {
                $.each(errors, function (i) {
                    console.log(errors[i]);
                });
            }
        }
    });
});
