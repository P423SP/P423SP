//funciones API DB
var countLoading=0;
var timeoutLoading=0;

function dbApiEnviar(data, fdone) {
    countLoading++;
    if(countLoading==1) {
        timeoutLoading=setTimeout(function(){$("#dbaseload").removeClass("oculto")},100);
    }
    $.post('../api/api.php', data).done(fdone).fail(ffail).always(falways);
}

function dbApiDefault(response){
    if (response.estado=="critical") {
        msgbox.show("error", response.errorTitulo, response.errorMensaje+'<br>La sesión se cerrará en 5 segundos', 5);
        setTimeout(function(){window.open("logout.php","_top");},5000);
    } else if (response.estado=="warning") {
        msgbox.show("warning", response.errorTitulo, response.errorMensaje);
    } else if (response.estado=="error") {
        msgbox.show("error",response.errorTitulo,response.errorMensaje);
    } else {
        msgbox.show("error","ajaxDefault","Estado no reconocido: "+response);
    }
}

function ffail(jqXHR, textStatus, errorThrown) {
    console.log(jqXHR);
    msgbox.show("error","ffail",jqXHR.responseText);
}

function falways(data){
    countLoading--;
    if(countLoading==0){
        if(timeoutLoading!=0) {
            clearTimeout(timeoutLoading);
            timeoutLoading=0;
        }
        $("#dbaseload").addClass("oculto");
    }
    console.log(data);
}