var msgbox;


function login() {
    var dni = $('#dni').val().toUpperCase();
    var password = $('#paswd').val();
    dbApiEnviar({ funcion: 'doLogin', dni: dni, password: password }, loginCompleto);
}

function loginCompleto(response) {
    if (response.estado == 'success') {
        window.open("Index.php", '_top');
    } else {
        msgbox.show('normal','hola','prueba')
        dbApiDefault(response);
    }

}

function cancelar() {
    window.open('Index.php', '_self');
}


$(function () {
    msgbox = new Msgbox('msgbox');
    $('#Enviar').on('click', login);
    $('#Cancelar').on('click', cancelar);
    
    var expired = false;
    if (expired) {
        msgbox.show('error', 'Seguridad', 'Se ha superado el tiempo máximo de inactividad. La sesión se ha cerrado.');
    }
});