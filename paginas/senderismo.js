
window.onload = () => {
    cargarJSON();
}

function cargarJSON() {
    var peticion = new XMLHttpRequest();
    peticion.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let resposta = peticion.responseText;
            var senderismo = JSON.parse(resposta);
            // crearCard(senderismo);
            mostarCards(senderismo);
        }
    }
    peticion.open('GET', 'https://p423sp.github.io/P423SP/senderismo.json', true);
    peticion.send();
}

function mostarCards(senderismo) {
    console.log(senderismo);
    for (var i = 0; i < senderismo.senderismo.length; i++) {
        crearCard(senderismo.senderismo[i], i);
    }
}

function crearCard(senderismo, cont) {
    var pare = document.getElementById('content');

    var cardeck = document.createElement('div');
    cardeck.className = 'card-deck';
    cardeck.id = 'carta'

    var nombre = senderismo.nombre;
    var distancia = senderismo.distancia;
    var desnivel = senderismo.desnivel;
    var img = senderismo.img;

    cardeck.innerHTML = '<div class="card" style="width: 18rem;"> <img class="card-img-top" src="' + img + '1.jpg' + '" alt="Card image cap"> <div class="card-body">  <h5 class="card-title">' + nombre + '</h5> <p class="card-text"><span class="fa-solid fa-person-walking-arrow-right"></span>  Distancia: ' + distancia + '</p> <p class="card-text"><span class="fa-solid fa-mountain"></span> Desnivel: ' + desnivel + ' </p> <br><button id="info' + cont + '" class="btn btn-primary"> Mas Informacion</button> </div> </div>';
    pare.appendChild(cardeck);

    $("#info" + cont).on('click', function () {
        masInfo(senderismo);
    });
}

function masInfo(senderismo) {

    var pare = document.getElementById('content');
    pare.innerHTML = '';

    var page = document.createElement('div');
    page.id = 'informacion';

    var img = document.createElement('img');
    // img.src = '../imagenes/senderismo/corrales/1.jpg';
    img.src = senderismo.img + '1.jpg';
    img.id = 'img';
    var intervalo = setInterval(function () { rotarImagenes(senderismo) }, 3000);
    addEventListener('load', function () { rotarImagenes() }, 3000);

    var nombre = senderismo.nombre;
    var distancia = senderismo.distancia;
    var desnivel = senderismo.desnivel;
    var ruta = senderismo.ruta;

    $(function () {
        setInterval(function () { rotarImagenes() }, 3000);
    });

    var titulo = document.createElement('h1');
    titulo.innerHTML = nombre;
    var info = document.createElement('p');
    info.innerHTML = "</br>" + '<span class="fa-solid fa-person-walking-arrow-right"></span> distancia: ' + distancia + "</br>" + '<span class="fa-solid fa-mountain"></span> desnivel: ' + desnivel + "</br>" + "</br>" + " Ruta: <br> <img id='ruta' src='" + ruta + "'> <br></br>" + "<button id='cerrar' class='btn btn-danger'>Cerrar</button>";

    pare.appendChild(page);
    page.appendChild(titulo);
    page.appendChild(img);
    page.appendChild(info);

    $('#cerrar').on('click', function () {
        // window.open('senderismo.php', '_self');
        location.reload();
    });
}

var imagenes = ['1.PNG', '2.PNG', '3.png'];
var cont = 0;

function rotarImagenes() {
    var im = $(".foto");

    im.eq(cont).fadeOut();
    cont = (cont + 1) % im.length;
    im.eq(cont).fadeIn();
}
