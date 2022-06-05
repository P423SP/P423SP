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
    $('#lista2').html(lista);
    ajustarTabla('#lista2', true);
}

function listarTrabajadores() {
    dbApiEnviar({ funcion: 'listarTrabajadores' }, listarTrabajadoresCompletado);
}

function listarTrabajadoresCompletado(response) {
    var lista = "";

    if (response.estado != 'success') {
        dbApiDefault(response);
    } else {
        tabladef = {
            row1id: ['', ['nombre', 'nombre']],
            fields: [
                [' text-center', 'Nombre'],
                [' text-center', 'Puesto'],
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
    listarTrabajadores();
});