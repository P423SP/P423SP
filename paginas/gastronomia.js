function masInfo(){
    var pare = document.getElementById('content');
    pare.innerHTML = '';
    
    var page = document.createElement('div');
    page.id='informacion';

    var img = document.createElement('img');
    img.src = '../imagenes/gastronomia/corrales/1.jpg';
    img.style.width = '300px';
    img.id = 'img';
    var intervalo = setInterval(function () { CambiarIMG() },2000);

    var nom;
    var direccion;
    var telefono;
    var horario;
    var textCom;
    var butt = document.createElement('button');
    var info = document.createElement('p');
    info.innerHTML = nom + "</br>" + direccion + "</br>" + telefono + "</br>" + 'Horario: ' +  horario + "</br>" + textCom + "</br>" + "<button type='cancel' id='cerrar' class='btn btn-danger'>Cerrar</button>";
    pare.appendChild(page);
    page.appendChild(img);
    page.appendChild(info);

}

var imagenes = ['1.jpg', '2.jpg', '3.jpg'];
var cont = 0;

function CambiarIMG(){
    cont++;
    var img = document.createElement('img');
    img.src = img.src + imagenes[cont % imagenes.length];
}

$(function () {
    $('#info').on('click', function () { masInfo()});
    $('#cerrar').on('click', function () { window.open('gastronomia.php', '_self')});
    
})