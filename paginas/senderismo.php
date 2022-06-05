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
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Senderismo</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='navbar.css'>
    <script src="../jquery/jquery-3.6.0.min.js"></script>
    <link rel='stylesheet' href='../boostrap2/css/bootstrap.min.css'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src='../boostrap2/js/bootstrap.min.js'></script>
    <script src="https://kit.fontawesome.com/5da91507d8.js" crossorigin="anonymous"></script>
    <script src='senderismo.js'></script>
    <link rel='stylesheet' type='text/css' media='screen' href='footer.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='senderismo.css'>
</head>

<body>
    <?php include('navbar.php') ?>
    
    <div id="contenido">
        <div id='title'>
            <h1> RUTAS SENDERISMO </h1>
        </div>
        <div id='content'>
        </div>
    </div>
</body>
<?php include('footer.php') ?>

</html>