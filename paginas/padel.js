var msgbox;

function reservar() {
    var pista = $('#pistas').val();
    var hora = $('#horario').val();
    var dni = $('#dni').val();

    dbApiEnviar({ funcion: 'reservar', pista: pista, hora: hora, dni: dni }, reservarCompletado);
}

function reservarCompletado(response) {
    if (response.estado != 'success') {
        dbApiDefault(response);
    } else {
        msgbox.show('normal', 'Reserva Completada', 'La reserva se a completado');
        listarReservasP();
    }
}

function listarReservasP() {
    dbApiEnviar({ funcion: 'listarReservasP' }, listarReservasPCompletado);  
}


function listarReservasPCompletado(response) {
    var lista = "";

    if (response.estado != 'success') {
        dbApiDefault(response);
    } else {
        tabladef = {
            row1id: ['', ['pista', 'Pista'], ['hora', 'Hora']],
            fields: [
                [' text-center', 'Pista'],
                [' text-center', 'Hora'],
                [' text-center','Usuario']
            ],
            ordenCol: ['c1', 'c2']
        }
        lista = crearTabla(response.cabeceras, response.filas, tabladef);
    }
    $('#lista').html(lista);
    ajustarTabla('#lista', true);
}


$(function () {
    msgbox = new Msgbox('msgbox');
    // matrizHorario();
    $('#reservar').on('click', function () { reservar(); });
    listarReservasP();

});