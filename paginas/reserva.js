var msgbox;

function listarReservas() {
    var dni = $('#dni').val();
    if (dni == 'ADMINISTR') {
        dbApiEnviar({ funcion: 'listarReservasAdm' }, listarReservasADMCompletado);
    } else {
        dbApiEnviar({ funcion: 'listarReservas', dni: dni }, listarReservasCompletado);
    }
}

function listarReservasCompletado(response) {
    var lista = "";

    if (response.estado != 'success') {
        dbApiDefault(response);
    } else {
        tabladef = {
            row1id: ['', ['pista', 'Pista'], ['hora', 'Hora']],
            fields: [
                [' text-center', 'Pista'],
                [' text-center', 'Hora'],
                [' text-center', 'Accion', function () {
                    return "    <button class='btn btn-xs btn-danger cancelar sombra' type='submit'><span class='fas fa-ban'></span> Cancelar </button>";
                }]
            ],
            ordenCol: ['c1', 'c2', 'c3']
        }
        lista = crearTabla(response.cabeceras, response.filas, tabladef);
    }
    $('#lista').html(lista);
    ajustarTabla('#lista', true);
}
function listarReservasADMCompletado(response) {
    var lista = "";

    if (response.estado != 'success') {
        dbApiDefault(response);
    } else {
        tabladef = {
            row1id: ['', ['pista', 'Pista'], ['hora', 'Hora']],
            fields: [
                [' text-center', 'Pista'],
                [' text-center', 'Hora'],
                [' text-center', 'Accion', function () {
                    return "    <button class='btn btn-xs btn-danger cancelar sombra' type='submit'><span class='fas fa-ban'></span> Cancelar </button>";
                }]
            ],
            ordenCol: ['c1', 'c2', 'c3']
        }
        lista = crearTabla(response.cabeceras, response.filas, tabladef);
    }
    $('#lista').html(lista);
    ajustarTabla('#lista', true);
}

function cancelar() {
    var dni = $('#dni').val();
    var fila = $(this).closest("tr");
    var pista = fila.data('pista');
    var hora = fila.data('hora');

    if(dni == 'ADMINISTR'){
        dbApiEnviar({ funcion: 'eliminarReservaADM', pista: pista, hora: hora }, cancelarCompletado);
    }else{
    dbApiEnviar({ funcion: 'eliminarReserva', pista: pista, hora: hora, dni: dni }, cancelarCompletado);
    }
}

function cancelarCompletado(response) {
    if (response.estado != 'success') {
        dbApiDefault(response);
    } else {
        msgbox.show('normal', 'Cancelación Completa', 'Tu reserva a sido cancelado con exito');
        listarReservas();
    }
}
function cancelarADMCompletado(response) {
    if (response.estado != 'success') {
        dbApiDefault(response);
    } else {
        msgbox.show('normal', 'Cancelación Completa', 'La reserva a sido cancelado con exito');
        listarReservas();
    }
}

$(function () {
    msgbox = new Msgbox('msgbox');
    $('#lista').on('click', 'button.cancelar', cancelar)
    listarReservas();
});