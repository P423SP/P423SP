

var imagenes = ['1.PNG', '2.PNG', '3.png'];
var cont = 0;
//  var intervalo = setInterval($(document).ready(function () { $('#imag').fadeOut('slow'), rotarImagenes(imagenes), $('#imag').fadeIn('slow') }), 2000);
// var intervalo = setInterval(function () { rotarImagenes(imagenes) }, 2000);

function rotarImagenes() {
    var im=$(".foto");

    im.eq(cont).fadeOut();
    cont=(cont+1) % im.length;
    im.eq(cont).fadeIn();

    // var img = $('#imag');
    // var img = document.getElementById('imag');
    // img.src = "../imagenes/Index/imgs/" + imagenes[cont % imagenes.length];

}

$(function () {

    setInterval(function () { rotarImagenes()}, 3000);

});