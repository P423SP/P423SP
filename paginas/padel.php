<?php
include_once('../api/db.php');
include('../api/funciones.php');

$db = new DB($db_host, $db_database, $db_user, $db_password);
$db->conectarDB();

$conectado = isset($_SESSION['dni']);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <title>Padel</title>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <script src="../jquery/jquery-3.6.0.min.js"></script>
    <link rel='stylesheet' href='../boostrap2/css/bootstrap.min.css'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src='../boostrap2/js/bootstrap.min.js'></script>
    <script src="https://kit.fontawesome.com/5da91507d8.js" crossorigin="anonymous"></script>
    <link rel='stylesheet' type='text/css' media='screen' href='navbar.css'>
    <link rel='stylesheet' href="../comun/comun.css">
    <link rel='stylesheet' href="../comun/msgbox.css">
    <link rel='stylesheet' href="../comun/dbaseload.css">
    <link rel='stylesheet' href="../comun/tablas.css">
    <link rel='stylesheet' href="padel.css">
    <link rel='stylesheet' href="footer.css">

    <script src='../comun/msgbox.js'></script>
    <script src='../comun/tablas.js'></script>
    <script src='../comun/api.js'></script>
    <script src='padel.js'></script>
</head>

<body>
    <?php include('navbar.php'); ?>

    <h1>PISTAS</h1>
    <img id="pista" src='../imagenes/deportes/padel/1.png'>
    <h1>RESERVAS</h1>
    <div id='tabla' class='mt-2'>
        <tabla id='lista' class='table table-sm table-bordered'></tabla>
    </div>
    <h1>FORMULARIO DE RESERVA</h1>
    <div id="reserva">
        <span>PISTA</span><br>
        <select id='pistas' class='custom-select mt-1'>
            <option value='Pista 1'>Pista 1</option>
            <option value='Pista 2'>Pista 2</option>
            <option value='Pista 3'>Pista 3</option>
        </select>
        <br>
        <span>HORA</span><br>
        <select id='horario' class='custom-select mt-1'>
            <option value='8:00 - 9:00'>8:00 - 9:00</option>
            <option value='9:00 - 10:00'>9:00 - 10:00</option>
            <option value='10:00 - 11:00'>10:00 - 11:00</option>
            <option value='12:00 - 13:00'>12:00 - 13:00</option>
            <option value='13:00 - 14:00'>13:00 - 14:00</option>
            <option value='14:00 - 15:00'>14:00 - 15:00</option>
        </select>
        <br>
        <?php if ($conectado) { ?>
            <?php echo '<input type="text"  id="dni" value="'.$_SESSION['dni'].'" hidden>' ?>
            <button id='reservar' class="btn btn-primary">Reservar</button>
        <?php } else { ?>
            <button id='reservar' class="btn btn-primary" disabled>Reservar</button>
        <?php } ?>
        <br>
    </div>
</body>
<?php include('footer.php'); ?>

</html>