var msgbox;

function editarPerfil() {
    var usuario = $('#usr').val();
    var dni = $('#dni').val();
    var email = $('#email').val();
    var emailn = $('#emailn').val();
    var password = $('#password').val();

    if (comprobarEmail(emailn) == false) {
        msgbox.show('error', 'error', 'El correo no es valido')
    } else if (emailn == '') {
        dbApiEnviar({ funcion: 'editarUser', usuario: usuario, dni: dni, email: email, emailn: emailn, password: password }, editarPerfilCompletado);
    }else {
        dbApiEnviar({ funcion: 'editarUser', usuario: usuario, dni: dni, email: email, emailn: emailn, password: password }, editarPerfilCompletado);
    }

}

function comprobarEmail(email) {
    if (/^\w+([.-]?\w+)@\w+([.-]?\w+)(.\w{2,4})+$/.test(email)) {
        return true;
    } else {
        return false;
    }
}

function editarPerfilCompletado(response) {
    if (response.estado != 'success') {
        dbApiDefault(response);
    } else {
        msgbox.ask('Cambio completado', 'Los datos se han actualizado correctamente', function () {
            if (msgbox.estado == 'aceptado') {
                window.open('Index.php', '_self');
            }
        });
    }
}

$(function () {
    msgbox = new Msgbox('msgbox');
    $('#guardar').on('click', editarPerfil);

});