$(document).ready(function () {
    //  $('.divGenerarOrden').hide();
});
var contador = 0; //variable para controlar el numero de equipos en la lista del detalle de la orden
//funcion para ver los agregar lo equipos al detalle de la orden


function eliminar(index) {
    $('.id' + index).remove();
    contador--;
}

function bloquearRegistroEquipo() {
    $('#serie_equipo').attr('disabled', 'disabled');
    $('#marca_e').attr('disabled', 'disabled');
    $('#modelo_e').attr('disabled', 'disabled');
    $('#tipo_t').attr('disabled', 'disabled');

}

function desbloquerRegistroEquipo() {
    $('#serie_equipo').removeAttr('disabled');
    $('#marca_e').removeAttr('disabled');
    $('#modelo_e').removeAttr('disabled');
    $('#tipo_t').removeAttr('disabled');

}


//funcion para ocultar los inputs cuando el equipo ya exista
function cargarEquipo() {

    $('#serie_equipo').val('');
    $('#marca_e').val('');
    $('#modelo_e').val('');
    $('#descripcion_e').val('');

}

///FUNCIONES PARA VER LOS ERRORES
function printErrorMsg(msg) {

    $(".print-error-msg").find("ul").html('');

    $(".print-error-msg").css('display', 'block');

    $.each(msg, function (key, value) {

        $(".print-error-msg").find("ul").append('<li>' + value + '</li>');

    });
}

function limpiarModal() {
    $('#serie_equipo').val('');
    $('#marca_e').val('');
    $('#modelo_e').val('');
    $('#descripcion_e').val('');
    $('#problema_re').val('');
    $('#accesorios_re').val('');
    $('#fecha_salida_re').val('');
    $('#searchEquipo').val('');
    $('#mensaje-equipo').attr('hidden', 'hidden');
    desbloquerRegistroEquipo();
}

/// eventos para el clien de los elemtos

$('#fecha_orden').change(function () {
    desbloarBotonesOrnde();
});
$('#orden_decrip').keyup(function () {
    desbloarBotonesOrnde();
    if ($(this).val() == '') {
        $('#orden_decrip').addClass("border-danger");
    } else {
        $('#orden_decrip').removeClass("border-danger");
    }
});

function desbloarBotonesOrnde() {
    if (contador != 0 && $('#orden_decrip').val() != '' && $('#fecha_orden').val() != '') {
        $('.btnGenerarOrden').removeAttr('disabled');
        $('.btnCancelarOrden').removeAttr('disabled');
    }
}


$('#btncerrarModal').click(function () {
    limpiarModal();
});

$('#btnAgregarEquipo').click(function () {
    $('#idModal').modal('show');
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






