var msgbox;

function listarTelefono() {
    dbApiEnviar({ funcion: 'llistarTelefono' }, listarTelefonoCompletado);
}

function listarTelefonoCompletado(response) {
    var lista = "";

    if (response.estado != 'success') {
        dbApiDefault(response);
    } else {
        tabladef = {
            row1id: ['', ['Nombre', 'Nombre']],
            fields: [
                [' text-center', 'Nombre'],
                [' text-center', 'Telefono'],
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
    listarTelefono();
});