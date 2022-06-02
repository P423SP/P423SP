<?php /*
    include_once('../api/db.php');
    include('../api/funciones.php');
    $db = new DB($db_host, $db_database, $db_user, $db_password);
    $db->conectarDB();
    $usuario= $user['name']; */
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Gastronomia</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='navbar.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='gastronomia.css'>
    <script src="../jquery/jquery-3.6.0.min.js"></script>
    <link rel='stylesheet' href='../boostrap2/css/bootstrap.min.css'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src='../boostrap2/js/bootstrap.min.js'></script>
    <script src="https://kit.fontawesome.com/5da91507d8.js" crossorigin="anonymous"></script>
    <script src='gastronomia.js'></script>
</head>

<body>
    <?php include('navbar.php') ?>

    <div id='content'>
        <div class="card-deck">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="../imagenes/gastronomia/corrales/3.jpg" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Bar Corrales</h5>
                    <p class="card-text">Dirección: Carrer Major, 51, 46726 Llocnou de Sant Jeroni, Valencia</p>
                    <p class="card-text">Teléfono: 962 89 60 17</p>
                    <a id='info' class="btn btn-primary">Mas Información</a>
                </div>
            </div>

            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="../imagenes/gastronomia/pakis/1.PNG" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Pakis Bar </h5>
                    <p class="card-text">Dirección:.</p>
                    <p class="card-text">Teléfono:.</p>
                    <a id='info' class="btn btn-primary">Mas Información</a>
                </div>
            </div>

            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="../imagenes/gastronomia/andreu/1.jpg" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Venta Andreu </h5>
                    <p class="card-text">Dirección: Partida Coll Blanc, 2, 46726, Valencia.</p>
                    <p class="card-text">Teléfono: 962835040</p>
                    <a id='info' class="btn btn-primary">Mas Información</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>