class Msgbox {
    cuentaAtras = 0;
    msgboxTimer = 0;
    id = "msgbox";
    jqid = "#msgbox";
    estado = "";

    constructor(id) {
        var html = "";

        this.id = id;
        this.jqid = "#" + id;
        html = "<div id='" + id + "' class='modal fade' tabindex='-1' role='dialog' aria-labelledby='messageBox' aria-hidden='true'>";
        html += "     <div class='modal-dialog modal-dialog-centered' role='document'>";
        html += "         <div class='modal-content'>";
        html += "             <div class='modal-header'>";
        html += "                <h5 class='modal-title msgboxTitle'>Modal title</h5>";
        html += "                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
        html += "                    <span class='autoclose'></span>";
        html += "                    <span aria-hidden='true'>&times;</span>";
        html += "                </button> ";
        html += "             </div>";
        html += "             <div class='modal-body msgboxMessage'></div>";
        html += "             <div class='modal-footer'>";
        html += "                 <button type='button' class='btn btn-sm btn-danger cerrar' data-dismiss='modal'><span class='fas fa-times'></span> Cerrar</button>";
        html += "                 <button type='button' class='btn btn-sm btn-primary aceptar' data-dismiss='modal'><span class='fas fa-check'></span> Aceptar</button>";
        html += "             </div>";
        html += "         </div>";
        html += "     </div>";
        html += "</div>";
        $("body").append(html);
        var me = this;
        $(this.jqid + " .cerrar").on('click',function () { me.estado = "cancelado" });
        $(this.jqid + " .aceptar").on('click',function () { me.estado = "aceptado" });
        $(this.jqid).on('hide.bs.modal', function () { if (me.msgboxTimer != 0) clearTimeout(me.msgboxTimer) });
    }

    destroy() {
        $(this.jqid).remove();
    }

    aceptado() {
        return this.estado == 'aceptado';
    }

    cancelado() {
        return this.estado == 'cancelado';
    }

    fnCuentaAtras() {
        $(this.jqid + " .modal-header .autoclose").text(this.cuentaAtras);
        if (this.cuentaAtras > 0) {
            this.cuentaAtras--;
            var me = this;
            this.msgboxTimer = setTimeout(function () { me.fnCuentaAtras() }, 1000)
        } else {
            this.cuentaAtras = 0;
            $(this.jqid + " .cerrar").on('click');
        }
    }

    show(tipo, titulo, mensaje, cuentaAtras = 0, onClose = undefined) {
        $(this.jqid + " .modal-header").removeClass("error").removeClass("warning").removeClass("normal").addClass(tipo);
        $(this.jqid + " .msgboxTitle").text(titulo);
        $(this.jqid + " .modal-footer").removeClass("question");
        $(this.jqid + " .aceptar").addClass("oculto");
        $(this.jqid + " .msgboxMessage").html(mensaje);
        $(this.jqid).off('hidden.bs.modal')
        if (onClose != undefined) {
            $(this.jqid).on('hidden.bs.modal', onClose)
        }
        $(this.jqid).modal({ backdrop: 'static', keyboard: false })
        this.cuentaAtras = cuentaAtras;
        if (this.cuentaAtras > 0) {
            $(this.jqid + " .modal-header .autoclose").show();
            this.fnCuentaAtras();
        } else {
            $(this.jqid + " .modal-header .autoclose").hide();
        }
    }

    ask(titulo, mensaje, onClose) {
        this.estado = "";
        $(this.jqid + " .modal-header").removeClass("error").removeClass("warning").addClass("normal");
        $(this.jqid + " .modal-footer").addClass("question");
        $(this.jqid + " .aceptar").removeClass("oculto");
        $(this.jqid + " .msgboxTitle").text(titulo);
        $(this.jqid + " .msgboxMessage").html(mensaje);
        $(this.jqid).off('hidden.bs.modal')
        $(this.jqid).on('hidden.bs.modal', onClose)
        $(this.jqid + " .modal-header .autoclose").hide();
        $(this.jqid).modal({ backdrop: 'static', keyboard: false })
    }

    estaAbierto() {
        return $(this.jqid).is(":visible");

    }
}