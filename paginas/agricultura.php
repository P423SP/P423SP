<?php 
    include_once('../api/db.php');
    include('../api/funciones.php');

    $db = new DB($db_host, $db_database, $db_user, $db_password);
    $db->conectarDB();

    $conectado=isset($_SESSION['dni']);
?>
<!DOCTYPE htmlhtml>

<head>
    <meta charset="utf-8">
    <title>Agricultura</title>
    <script src="../jquery/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src='../boostrap2/js/bootstrap.min.js'></script>
    <script src="https://kit.fontawesome.com/5da91507d8.js" crossorigin="anonymous"></script>
    <link rel='stylesheet' href='../boostrap2/css/bootstrap.min.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='navbar.css'>
    
    <link rel='stylesheet' type='text/css' media='screen' href='agricultura.css'>
</head>

<body>
    <?php include('navbar.php') ?>

    <div>
        <h1>PLAN DE QUEMA</h1>
        <table class="table" id="tabla">
            <thead>
                <tr>
                    <th>Invierno</th>
                    <th>Verano</th>
                </tr>
            </thead>
            <tbody>
                <td>Desde la salida del sol hasta 2 horas antes de su puesta</td>
                <td>Hasta la 12</td>
            </tbody>
        </table>
    </div>
    <h2>NORMAS A SEGUIR</h2>
    <p>1-Los días de viento fuerte está prohibido realizar ningun tipo de quema.
        Si una vez iniciada la quema se produce la aparición de viento se debe cancelar de inmediato la activida y apagar el fuego.</p>
    <p>2-No se podrá abandonar la zona de quema hata que el fuego se haya extinguido por completo y pasen 2 horas sin que se observe ninguna brasa.</p>
    <p>3-La persona interesada en realizar la quema deberá de limpiar un area de minimo 2 metros alrededor de la zona de quema, tomando las medidas que
        crea necesarias, será responsable en todo momento de cualquier daño que pueda cuasar.</p>
    <p>4-Las quemas solo se podran realizar dentro de los horarios establezidos</p>
    <p>5-Cuando la acumulación sea de leña,residuos agrícolas o residuaos forestales, ésta no podra realizarse ni en los caminos forestales,ni en una área de 10 metros junto los mismos.</p>
    <p>6-Todas las personas que adviertan de la existencia o el inicio de un incendio forestal tendran que dar parte de este,
        llamando al telefono de emergencias de la Generalitat 085 o 112 , o por el medio mas rápido posible Ayuntamiento, Agentes forestales, Policía, Guardia Civil o al agente de la autoridad más cercano.
    </p>

    <h3><a class="fa-solid fa-ban"></a> PROHIBICIONES</h3>
    <p>Todo aquel que no cumpla con este plan sera sancionado de acuerdo con lo establecido en la Ley Forestal de la Comunidad Valenciana y la Ley de incendos forestales.</p>


    <h1>MAPA DE PLAN DE QUEMAS</h1>
    <div>
        <img src='../imagenes/agricultura/quema.PNG'>
    </div>

</body>

</html>