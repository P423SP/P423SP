var msgbox;

function listarMaquinas() {
    dbApiEnviar({ funcion: 'listarMaquinas' }, listarMaquinasCompletado);
}

function listarMaquinasCompletado(response) {
    var dni = $('#dni').val();

    if (response.estado != 'success') {
        dbApiDefault(response);
    } else {
        var lista = "";
        tabladef = {
            row1id: ['', ['Maquina', 'Maquina'], ['ejercicio', 'ejercicio']],
            fields: [
                [' text-center', 'Maquina'],
                [' text-center', 'Acción', function () {
                    if (dni == 'ADMINISTR') {
                        return "    <button id='ejercicios' class='btn btn-primary mb-2'>Ejercicios</button> "
                            + "    <button id='editar' class='btn btn-primary mb-2'>Editar</button> "
                            + "    <button id='eliminar' class='btn btn-danger mb-2'>Eliminar</button> ";
                    } else {
                        return " <buton id='ejercicios' class='btn btn-primary mb-2'>Ejercicios</button>";
                    }
                }],
            ],
            ordenCol: ['c1', 'c2']
        }
        lista = crearTabla(response.cabeceras, response.filas, tabladef);
    }
    $('#lista').html(lista);
    ajustarTabla('#lista', true);
}

function ejercicios() {
    var fila = $(this).closest("tr");
    var ejercicios = fila.data("ejercicio");
    var maquina = fila.data("maquina");

    html = "<p>Ejercicios " + maquina + "</p>";
    // html += "<p>Ejercicios</p>";
    html += "<div class='ejercicios'>";
    // html += "<span>Ejercicios</span>";
    // html += "<textarea class='form-control mt-1' id='descripcion' value='" + ejercicios + "' ><br>";
    html += ejercicios;
    html += "</div>";

    msgbox.show('normal', maquina, html);
}

function editarMaquina() {

    var fila = $(this).closest("tr");
    var ejercicios = fila.data("ejercicio");
    var maquina = fila.data("maquina");

    html = "<p>Editar Maquina</p>";
    html += "<div class='editarM'>";
    html += "<span>Maquina</span>";
    // html += "<input class='form-control mt-1' type='text' id='nombre' value=" + maquina + "><br>";
    html += "<input class='form-control mt-1' type='text' id='nombre'><br>";
    html += "<span>Ejercicios</span>";
    // html += "<input class='form-control mt-1' type='textarea' id='descripcion' value='" + ejercicios + "'><br>";
    html += "<input class='form-control mt-1' type='textarea' id='descripcion'><br>";
    html += "</div>";

    msgbox.ask("Editar maquina", html, function () {
        var maquina = fila.data("maquina");
        var ejercicios = $('#descripcion').val();
        var maquinan = $('#nombre').val();
        if (msgbox.aceptado()) {
            dbApiEnviar({ funcion: 'editarMaquina', maquina: maquina, maquinan: maquinan, ejercicios: ejercicios }, editarMaquinaCompletado);
        }
    });
}

function editarMaquinaCompletado(response) {
    if (response.estado != 'success') {
        dbApiDefault(response);
    } else {
        msgbox.show("normal", 'Completado', "La maquina se ha editado correctamente");
        listarMaquinas();
    }
}

function añadirMaquina() {

    html = "<p>Añadir Maquina</p>";
    html += "<div class='nuevaM'>";
    html += "<span>Maquina</span>";
    html += "<input class='form-control mt-1' type='text' id='nombre'><br>";
    html += "<span>Ejercicios</span>";
    html += "<input class='form-control mt-1' type='textarea' id='descripcion'><br>";
    html += "</div>";

    msgbox.ask("Nueva maquina", html, function () {
        var maquina = $('#nombre').val();
        var ejercicios = $('#descripcion').val();
        if (msgbox.aceptado()) {
            dbApiEnviar({ funcion: 'añadirMaquina', maquina: maquina, ejercicios: ejercicios }, añadirMaquinaCompletado);
        }
    });
}

function añadirMaquinaCompletado(response) {
    if (response.estado != 'success') {
        dbApiDefault(response);
    } else {
        msgbox.show("normal", 'Completado', "La maquina se ha añadido correctamente");
        listarMaquinas();
    }
}

function eliminarMaquina() {
    var fila = $(this).closest("tr");
    var maquina = fila.data("maquina");
    dbApiEnviar({ funcion: 'eliminarMaquina', maquina: maquina }, eliminarMaquinaCompletado);
}

function eliminarMaquinaCompletado(response) {
    if (response.estado != 'success') {
        dbApiDefault(response);
    } else {
        msgbox.show("normal", 'Completado', "La maquina se ha eliminado correctamente");
        listarMaquinas();
    }
}


$(function () {
    msgbox = new Msgbox('msgbox');
    $('#lista').on('click', '#ejercicios', ejercicios);
    $('#lista').on('click', '#editar', editarMaquina);
    $('#lista').on('click', '#eliminar', eliminarMaquina);
    $('#añadir').on('click', añadirMaquina);
    listarMaquinas();
});