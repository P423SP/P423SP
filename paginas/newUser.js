var msgbox;
function comprobarForm() {
    var usuario = $('#usr').val();
    var dni = $('#dni').val().toUpperCase();
    var email = $('#email').val();
    var pass1 = $('#pass1').val();
    var pass2 = $('#pass2').val();
    comprobarDNI(dni);

    if (usuario == "" || dni == "" || pass1 == "" || pass2 == "" || email == "") {
        msgbox.show('error', 'Error', 'Rellena todos los campos.');
    } else if (pass1 !== pass2) {
        msgbox.show('error', 'error', 'Las contraseñas no coinciden.');
    } else if (comprobarEmail(email) == false) {
        msgbox.show('error', 'error', 'El correo no es valido');
    } else if (comprobarDNI(dni) == false) {
        msgbox.show('error', 'DNI', 'El dni no es válido');
    } else {
        dbApiEnviar({ funcion: 'crearUser', usuario: usuario, pass1: pass1, email: email, dni: dni }, crearUsuarioCompletado);
    }

}

function comprobarEmail(email) {
    if (/^\w+([.-]?\w+)@\w+([.-]?\w+)(.\w{2,4})+$/.test(email)) {
        return true;
    } else {
        return false;
    }
}

function comprobarDNI(dni) {
    var numero;
    var letraDni;
    var letra;
    var exrd = /^\d{8}[A-Z]$/;

    dni = dni.toUpperCase();

    if (exrd.test(dni) === true) {
        numero = dni.substring(0, dni.length - 1);
        letraDni = dni.substring(dni.length, 8);
        numero = numero % 23;
        letra = 'TRWAGMYFPDXBNJZSQVHLCKET';
        letra = letra.substring(numero, numero + 1);
        if (letra != letraDni) {
            // msgbox.show('error', 'El dni no es válido');
            return false;
        } else {
            return true;
        }
    } else {
        return false;
    }
}

function cancelar() {
    window.open('login.php', '_self');
}

function crearUsuarioCompletado(response) {
    if (response.estado != 'success') {
        dbApiDefault(response);
    } else {
        msgbox.ask('Usuario creado', 'El usuario ha sido creado', function () {
            if (msgbox.estado == 'aceptado') {
                window.open('Index.php', '_self');
            }
        });
    }
}

$(function () {
    msgbox = new Msgbox('msgbox');
    $('#Cancelar').on('click', cancelar);
    $('#Enviar').on('click', comprobarForm);
});