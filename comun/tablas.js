/*
//Ejemplo de definicion de tablas
tabladef={
    row1control:function(f){return f['Proyecto']}, // Opcional
    row2control:function(f){return f['Proyecto']}, // Opcional
    row1id:['clase',['data1','valordata1'],['data2','valordata2']],
    row2id:['clase',['data1','valordata1'],['data2','valordata2']],
    fields:[
        ['Ordenacion', 'Cabecera', 'Valor row1', 'Valor row2'],
        ['c12',             'Proyecto',     '',function(f){return "<a href='estado.php?token="+token+"&proyecto="+f['Proyecto']+"' target='_top'>"+f['Proyecto']+"</a></td>"}],
        ['c3',              'Cliente',      ''],
        ['c2',              'Artículo',       ,''],
        ['c6 text-right',   'Envases',      function(f,v){return numberToText(v)},''],
        ['c7 text-right',   'Kg',           function(f,v){return numberToText(v)},''],
        ['c4 text-center',  'Estado',         ,''],
        ['c5 text-center',  'Kg Stock',     function(f,v){return numberToText(v)},''],
        ['c8 text-center',  'OT',             ,''],
        ['c10 text-center', 'Fecha salida',   ,''],
        ['c1',              'Asignada a',   function(f){return "    <button class='btn btn-xs btn-outline-primary asignar sombra' type='submit'><span class='fas fa-edit'></span></button> "+f['Asignada a']},''],
        ['c11',             'Fabricando',     ,''],
        ['c9 text-center',  'Acciones',     function(f){return "    <button class='btn btn-xs btn-outline-success subir sombra' type='submit'><span class='fas fa-arrow-up'></span></button>"
                                                                +"    <button class='btn btn-xs btn-outline-warning bajar sombra' type='submit'><span class='fas fa-arrow-down'></span></button>"},
                                            function(f){return "    <button class='btn btn-xs btn-primary modificarpy sombra' type='submit'><span class='fas fa-edit'></span></button>"}]
    ]
};    
*/

let row1control;
let row2control;
function aRegistro(cabeceras, valores) {
    var r = [];

    for (var i = 0; i < valores.length; i++) {
        r[cabeceras[i]] = valores[i];
    }
    return r;
}

function rowiddef2Obj(rowiddef, f) {
    let data = "";
    let clase = "";

    if (rowiddef instanceof Array) {
        if (rowiddef[0] instanceof Function) {
            clase = "class='" + rowiddef[0](f) + "'";
        } else if (rowiddef[0] != '') {
            clase = "class='" + rowiddef[0] + "'";
        } else {
            clase = "";
        }
        for (var i = 1; i < rowiddef.length; i++) {
            data += "data-" + rowiddef[i][0] + "=";
            if (rowiddef[i][1] == '') {
                data += " ";
            } else {
                data += "'" + f[rowiddef[i][1]] + "' ";
            }
        }
    }
    return { data: data, clase: clase };
}

function crearTR(nrow, f, rowiddef, fieldDef) {
    var rowid = rowiddef2Obj(rowiddef, f);
    let tr = "<tr " + rowid.clase + " " + rowid.data + ">";

    for (var i = 0; i < fieldDef.length; i++) {
        let field = fieldDef[i];
        let firow = field[nrow + 1];
        if (firow == undefined) {
            firow = field[1];
        }
        if (firow instanceof Function) {
            var valor = firow(f);
        } else if (f[firow] == undefined) {
            var valor = firow;
        } else {
            var valor = f[firow];
        }
        tr += "<td>" + valor + "</td>";
    }
    tr += "</tr>";
    return tr;
}

function crearTabla(cabeceras, filas, definicion) {
    let tabla = "";

    //Creamos la cabecera de la tabla
    tabla += "<thead><tr>";
    for (var i = 0; i < definicion.fields.length; i++) {
        let fieldDef = definicion.fields[i];
        tabla += "<th class='" + fieldDef[0] + "' scope='col'>" + fieldDef[1] + "</th>";
    }
    tabla += "</tr></thead>";

    //Creamos el cuerpo de la tabla
    tabla += "<tbody>";
    var row1control = "";
    var row2control = "";
    for (var j = 0; j < filas.length; j++) {
        let f = aRegistro(cabeceras, filas[j]);
        if (definicion.row1control == undefined) {
            tabla += crearTR(1, f, definicion.row1id, definicion.fields);
        } else if (definicion.row1control instanceof Function) {
            let rowControlActual = definicion.row1control(f);
            if (rowControlActual === true || typeof rowControlActual != "boolean" && row1control != rowControlActual) {
                row1control = rowControlActual;
                tabla += crearTR(1, f, definicion.row1id, definicion.fields);
            }
        }
        if (definicion.row2control instanceof Function) {
            let rowControlActual = definicion.row2control(f);
            if (rowControlActual === true || typeof rowControlActual != "boolean" && row2control != rowControlActual) {
                row2control = rowControlActual;
                tabla += crearTR(2, f, definicion.row2id, definicion.fields);
            }
        }
    }
    tabla += "</tbody>";
    if (definicion.rowfoot instanceof Function) {
        tabla += definicion.rowfoot();
    }
    return tabla;
}

function ajustarTabla(idTabla, sortable = false) {
    var parentWidth = $(idTabla).parent().width();
    var numcols = $(idTabla + " thead tr:first-child th").length;

    $(idTabla + " thead tr th").addClass("celdaFija");
    $(idTabla + " thead tr th.c1").removeClass("celdaFija").addClass("celdaVariable");
    $(idTabla + " thead tr:first-child th").each(function () {
        if (sortable) {
            $(this).html($(this).html() + " <span class='fas fa-sort'></span>");
        }
        $(idTabla + " tbody tr td:nth-child(" + ($(this).index() + 1) + ")").attr("class", $(this).attr("class"))
    });

    for (var i = 1; i <= numcols; i++) {
        if ($(idTabla).width() <= parentWidth) {
            break;
        } else {
            $(idTabla + " thead tr th.c" + i).removeClass("celdaFija").addClass("celdaVariable");
            $(idTabla + " tbody tr td.c" + i).removeClass("celdaFija").addClass("celdaVariable");
        }
    }
}

function hayQueOrdenar(x, y, dir, esNumero) {
    if (dir == 'asc') {
        if (esNumero) {
            return Number(x) > Number(y);
        } else {
            return x > y;
        }
    } else {
        if (esNumero) {
            return Number(x) < Number(y);
        } else {
            return x < y;
        }
    }
}

function ordenarTabla(elem, dir) {
    var n = $(elem).closest("th").index();
    var tabla = $(elem).closest(".table");

    // Ponemos el icono que indica el sentido de la ordenación
    tabla.find("thead .fa-sort-up").removeClass("fa-sort-up").addClass("fa-sort");
    tabla.find("thead .fa-sort-down").removeClass("fa-sort-down").addClass("fa-sort");
    if (dir == 'asc') {
        $(elem).removeClass("fa-sort").addClass("fa-sort-up")
    } else if (dir == 'desc') {
        $(elem).removeClass("fa-sort").addClass("fa-sort-down")
    }

    // Comprobamos si la columna es numérica o no
    var esNumero = true;
    tabla.find("tbody tr td:nth-child(" + (n + 1) + ")").each(function () {
        esNumero = $.isNumeric(this.innerHTML);
        return esNumero;
    });

    // Ordenamos la tabla según las opciones elegidas
    var switching = true;
    var table = tabla.children("tbody")[0];
    while (switching) {
        switching = false;
        var rows = table.rows;
        for (var i = 0; i < (rows.length - 1); i++) {
            var x = rows[i].getElementsByTagName("td")[n];
            var y = rows[i + 1].getElementsByTagName("td")[n];
            if (hayQueOrdenar(x.innerHTML.toLowerCase(), y.innerHTML.toLowerCase(), dir, esNumero)) {
                table.insertBefore(rows[i + 1], rows[i]);
                switching = true;
                break;
            }
        }
    }
}

function ordenarUp() {
    ordenarTabla(this, 'asc')
}

function ordenarDown() {
    ordenarTabla(this, 'desc')
}

$(document).ready(function () {
    $(".table").on("click", ".fa-sort", ordenarUp);
    $(".table").on("click", ".fa-sort-up", ordenarDown);
    $(".table").on("click", ".fa-sort-down", ordenarUp);
});