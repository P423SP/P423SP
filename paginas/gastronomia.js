
window.onload = () => {
    cargarJSON();
}

function cargarJSON() {
    var peticion = new XMLHttpRequest();
    peticion.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let resposta = peticion.responseText;
            var gastronomia = JSON.parse(resposta);
            // crearCard(gastronomia);
            mostarCards(gastronomia);
        }
    }
    peticion.open('GET', 'https://p423sp.github.io/P423SP/gastronomia.json', true);
    peticion.send();
}

function mostarCards(gastronomia) {

    for (var i = 0; i < gastronomia.gastronomia.length; i++) {
        crearCard(gastronomia.gastronomia[i], i);
    }
}

function crearCard(gastronomia, cont) {
    var pare = document.getElementById('content');

    var cardeck = document.createElement('div');
    cardeck.className = 'card-deck';
    cardeck.id = 'carta'

    var nombre = gastronomia.nombre;
    var direccion = gastronomia.direccion;
    var telefono = gastronomia.telefono;
    var img = gastronomia.img;

    cardeck.innerHTML = '<div class="card" style="width: 18rem;"> <img class="card-img-top" src="' + img + '1.jpg' + '" alt="Card image cap"> <div class="card-body">  <h5 class="card-title">' + nombre + '</h5> <p class="card-text"><span class="fa-solid fa-diamond-turn-right"></span>  Dirección: ' + direccion + '</p> <p class="card-text"><span class="fa-solid fa-phone"></span> Teléfono: ' + telefono + ' </p> <br><button id="info' + cont + '" class="btn btn-primary"> Mas Informacion</button> </div> </div>';
    pare.appendChild(cardeck);

    $("#info" + cont).on('click', function () {
        masInfo(gastronomia);
    });
}

function masInfo(gastronomia) {

    var pare = document.getElementById('content');
    pare.innerHTML = '';

    var page = document.createElement('div');
    page.id = 'informacion';

    var img = document.createElement('img');
    // img.src = '../imagenes/gastronomia/corrales/1.jpg';
    img.src = gastronomia.img + '1.jpg';
    img.id = 'img';
    var intervalo = setInterval(function () { rotarImagenes(gastronomia) }, 3000);
    addEventListener('load', function () { rotarImagenes() }, 3000);

    var nombre = gastronomia.nombre;
    var direccion = gastronomia.direccion;
    var telefono = gastronomia.telefono;
    var horario = gastronomia.horario;
    var especialidad = gastronomia.especialidad;

    $(function () {
        setInterval(function () { rotarImagenes() }, 3000);
    });

    var titulo = document.createElement('h1');
    titulo.innerHTML = nombre;
    var info = document.createElement('p');
    info.innerHTML = "</br>" + '<span class="fa-solid fa-diamond-turn-right"></span> Direccion: ' + direccion + "</br>" + '<span class="fa-solid fa-phone"></span> Telefono: ' + telefono + "</br>" + '<span class="fa-solid fa-clock"></span> ' + 'Horario: ' + horario + "</br>" + "<span class='fa-solid fa-star'></span> Especialidad: " + especialidad + "<br></br>" + "<button id='cerrar' class='btn btn-danger'>Cerrar</button>";

    pare.appendChild(page);
    page.appendChild(titulo);
    page.appendChild(img);
    page.appendChild(info);

    $('#cerrar').on('click', function () {
        // window.open('gastronomia.php', '_self');
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
